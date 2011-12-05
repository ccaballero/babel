<?php

class Users_IndexController extends Babel_Action
{
    public function indexAction() {
        $this->requireLogin();

        $model_users = new Users();
        $this->view->users = $model_users->fetchAll();
    }

    public function newAction() {
        $this->requireLogin();

        $request = $this->getRequest();
        $form = new Users_Form_Create();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model_users = new Users();
                $user = $model_users->createRow();

                $key = Zend_Registry::get('Config')->babel->properties->key;

                $user->role = $this->user->role;
                $user->fullname = $form->getElement('fullname')->getValue();
                $user->username = $form->getElement('username')->getValue();
                $user->password = sha1($key . $form->getElement('password')->getValue() . $key);
                $user->tsregister = time();

                $user->save();
                $this->_helper->flashMessenger->addMessage('The user ' . $user->fullname . ' was created');
                $this->_helper->redirector('index', 'index', 'users');
            }
        }

        $this->view->form = $form;
    }
}
