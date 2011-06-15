<?php

class Search_IndexController extends Babel_Action
{
    public function indexAction() {
        $request = $this->getRequest();
        $q = $request->getParam('q');

        if (empty($q)) {
            $this->_helper->redirector('index', 'index', 'frontpage');
        }

        $form = new Search_Form_Search();
        $form->isValid($_GET);

        $index = Zend_Search_Lucene::open(APPLICATION_PATH . '/../data/lucene');
        $hits = $index->find($form->getElement('q')->getValue());

      /*  foreach ($hits as $hit) {
            var_dump($hit->title);
            var_dump($hit->score);
            echo '<hr/>';
        }
die;*/

        $model_books = new Books();
        $this->view->books = $model_books->fetchAll();

        $this->view->form = $form;
    }
}
