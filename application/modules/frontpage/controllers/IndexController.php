<?php

class IndexController extends Babel_Action
{
    public function indexAction() {
        $form = new Search_Form_Search();
        $this->view->form = $form;
    }
}
