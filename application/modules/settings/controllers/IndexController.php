<?php

class Settings_IndexController extends Babel_Action
{
    public function indexAction() {
        $this->requireLogin();

        $request = $this->getRequest();
        $form = new Settings_Form_Setting();

        if ($request->isPost()) {
            $form->setUser($this->user);

            if ($form->getSubForm('information')->isValid($request->getPost())) {
                $fullname = $form->getSubForm('information')->getElement('fullname')->getValue();
                $username = $form->getSubForm('information')->getElement('username')->getValue();

                if ($this->user->fullname <> $fullname) {
                    $this->user->fullname = $fullname;

                    $this->_helper->flashMessenger->addMessage($this->translate->_('Your fullname was updated successfully'));
                }

                if ($this->user->username <> $username) {
                    $this->user->username = $username;

                    // Move the FTP directory
                    $ftp = Zend_Registry::get('Config')->babel->properties->ftp;
                    rename($ftp->root . '/' . $ftp->prefix . $this->user->username, $ftp->root . '/' . $ftp->prefix . $username);

                    $this->_helper->flashMessenger->addMessage($this->translate->_('Your username was updated successfully'));
                }
            }

            if ($form->getSubForm('photo')->getElement('photo')->receive()) {
                $filename = $form->getSubForm('photo')->getElement('photo')->getFileName();

                if (!empty($filename)) {
                    $thumbnail = new Yachay_Helpers_Thumbnail();
                    $avatar = $thumbnail->thumbnail($filename, APPLICATION_PATH . '/../public/media/img/thumbnails/users/' . $this->user->ident . '.jpg', 100, 100);
                    unlink($filename);

                    if ($avatar) {
                        $this->_helper->flashMessenger->addMessage($this->translate->_('Your photo was updated successfully'));
                    }
                }
            }

            if ($form->getSubForm('password')->isValid($request->getPost())) {
                $new_password = $form->getSubForm('password')->getElement('password2')->getValue();
                if (!empty($new_password)) {
                    $config = Zend_Registry::get('Config');
                    $key = $config->babel->properties->key;
                    $this->user->password = sha1($key . $new_password . $key);

                    $this->_helper->flashMessenger->addMessage($this->translate->_('Your password was updated successfully'));
                }
            }

            if ($form->getSubForm('ftp')->isValid($request->getPost())) {
                $model_users_ftp = new Users_FTP();

                $ftp_password = $form->getSubForm('ftp')->getElement('password')->getValue();
                $ftp_activation = $form->getSubForm('ftp')->getElement('activation')->getValue();
                $ftp_is_activated = $this->user->isFTPActivate();

                if ($ftp_activation <> $ftp_is_activated) {
                    if ($ftp_activation) { // Activation of FTP account
                        $user_ftp = $model_users_ftp->createRow();
                        $user_ftp->user = $this->user->ident;
                        $user_ftp->username = $this->user->username;
                        $user_ftp->password = sha1($ftp_password);

                        $user_ftp->save();

                        if (!Babel_Utils_FTPDirectoryManager::createAccount($this->user->username)) {
                            $this->_helper->flashMessenger->addMessage($this->translate->_('FTP account could not be created, Contact with the Administrator'));
                        }

                        $this->_helper->flashMessenger->addMessage($this->translate->_('You FTP account is on'));
                    } else { // Deactivation of FTP account
                        $user_ftp = $model_users_ftp->findByUser($this->user->ident);

                        $user_ftp->delete();

                        $this->_helper->flashMessenger->addMessage($this->translate->_('You FTP account is off'));
                    }
                }

                if ($ftp_is_activated && !empty($ftp_password)) {
                    $user_ftp = $model_users_ftp->findByUser($this->user->ident);
                    $user_ftp->password = sha1($ftp_password);

                    $user_ftp->save();
                    $this->_helper->flashMessenger->addMessage($this->translate->_('You FTP Password was updated successfully'));
                }
            }

            $this->user->save();
            $this->view->auth->getStorage()->write($this->user);
        }

        $form->setUser($this->user);
        $this->view->form = $form;
    }
}
