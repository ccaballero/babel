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

                $user->fullname = $request->getParam('fullname');
                $user->username = $request->getParam('username');
                $user->password = sha1($key . '.asdf.' . $key);

                $user->save();
                $this->_helper->flashMessenger->addMessage('The user ' . $user->fullname . ' was created');
                $this->_helper->redirector('index', 'index', 'users');
            }
        }

        $this->view->form = $form;
    }
}
