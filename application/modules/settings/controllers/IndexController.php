<?php

class Settings_IndexController extends Babel_Action
{
    public function indexAction() {
        $this->requireLogin();

        $request = $this->getRequest();
        $form = new Settings_Form_Setting();

        if ($request->isPost()) {
            if ($form->getSubForm('information')->isValid($request->getPost())) {
                $this->user->fullname = $form->getSubForm('information')->getElement('fullname')->getValue();
                $this->user->username = $form->getSubForm('information')->getElement('username')->getValue();

                $this->_helper->flashMessenger->addMessage('The information of user ' . $this->user->fullname . ' was updated successfully');
            }

            if ($form->getSubForm('password')->isValid($request->getPost())) {
                $new_password = $form->getSubForm('password')->getElement('password2')->getValue();
                if (!empty($new_password)) {
                    $key = Zend_Registry::get('Config')->babel->properties->key;
                    $this->user->password = sha1($key . $new_password . $key);
                    $this->_helper->flashMessenger->addMessage('The password of user ' . $this->user->fullname . ' was updated successfully');
                }
            }

            if ($form->getSubForm('photo')->getElement('photo')->receive()) {
                $filename = $form->getSubForm('photo')->getElement('photo')->getFileName();

                $thumbnail = new Yachay_Helpers_Thumbnail();
                $thumbnail->thumbnail($filename, APPLICATION_PATH . '/../public/media/img/thumbnails/users/' . $this->user->ident . '.jpg', 0, 100);
                unlink($filename);

                $this->_helper->flashMessenger->addMessage('The photo of user ' . $this->user->fullname . ' was updated successfully');
            }

            $this->user->save();
            $this->view->auth->getStorage()->write($this->user);

            $this->_helper->redirector('index', 'index', 'frontpage');
        }

        $form->setUser($this->user);
        $this->view->form = $form;
    }
}
