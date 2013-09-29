<?php

class Users_IndexController extends Babel_Action
{
    public function indexAction() {
        $this->requireLogin();

        $model_users = new Users();

        $users = $model_users->fetchAll($model_users->select()->where('contact <> ?', 0));
        $shuffle = array();
        foreach ($users as $user) {
            $shuffle[] = $user;
        }
        shuffle($shuffle);
        
        $this->view->users = $shuffle;
    }

    public function newAction() {
        $this->requireLogin();

        $request = $this->getRequest();
        $form = new Users_Form_Create();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost()) && $form->getSubForm('password')->isValid($request->getPost())) {
                $model_users = new Users();
                $user = $model_users->createRow();

                $key = Zend_Registry::get('config')->babel->properties->key;

                $user->role = $this->user->role;
                $user->contact = $this->user->ident;
                $user->fullname = $form->getSubForm('information')->getElement('fullname')->getValue();
                $user->username = $form->getSubForm('information')->getElement('username')->getValue();
                $user->password = sha1($key . $form->getSubForm('password')->getElement('password2')->getValue() . $key);
                $user->tsregister = time();

                $user->save();
                $this->_helper->flashMessenger->addMessage(sprintf($this->translate->_('User %s was created'), $user->fullname));
                $this->_helper->redirector('index', 'index', 'users');

                if (!Babel_Utils_FTPDirectoryManager::createAccount($user->username)) {
                    $this->_helper->flashMessenger->addMessage($this->translate->_('FTP account could not be created, Contact with the Administrator'));
                }
            }
        }

        $this->view->form = $form;
    }
}
