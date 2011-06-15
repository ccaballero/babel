<?php

class Catalogs_IndexController extends Babel_Action
{
    public function indexAction() {
        $model_catalogs = new Catalogs();
        $this->view->catalogs = $model_catalogs->fetchAll();
    }

    public function newAction() {
        $request = $this->getRequest();
        $form = new Catalogs_Form_Create();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model_users = new Users();
                $user = $model_users->createRow();

                $key = Zend_Registry::get('Config')->babel->properties->key;

                $user->fullname = $request->getParam('fullname');
                $user->email = $request->getParam('email');
                $user->password = sha1($key . '.asdf.' . $key);

                $user->save();
                $this->_helper->flashMessenger->addMessage('The user ' . $user->fullname . ' was created');
                $this->_helper->redirector('index', 'index', 'users');
            }
        }

        $this->view->form = $form;
    }
}
