<?php

class Auth_IndexController extends Babel_Action
{
    public function inAction() {
        $request = $this->getRequest();
        $form = new Auth_Form_Login();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {

                $key = Zend_Registry::get('Config')->babel->properties->key;

                $dbAdapter = Zend_Db_Table::getDefaultAdapter();
                $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
                $authAdapter->setTableName('babel_users')
                            ->setIdentityColumn('email')
                            ->setCredentialColumn('password')
                            ->setCredentialTreatment("SHA1(CONCAT('$key',?,'$key'))");

                $authAdapter->setIdentity($form->getElement('email')->getValue());
                $authAdapter->setCredential($form->getElement('password')->getValue());

                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);
                if ($result->isValid()) {
                    $user = $authAdapter->getResultRowObject();
                    $auth->getStorage()->write($user);
                    $this->_helper->redirector('index', 'index', 'frontpage');
                }
                $form->getElement('email')->addErrorMessage('Incorrect information')->markAsError();
            }
        }

        $this->view->form = $form;
    }

    public function outAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index', 'index', 'frontpage');
    }
}
