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

        $books = array();

        Zend_Search_Lucene_Search_Query_Wildcard::setMinPrefixLength(0);

        $value = strtolower($form->getElement('q')->getValue());

        $model_keywords = new Search_Keywords();
        $keyword = $model_keywords->createRow();
        $keyword->keyword = $value;
        $keyword->tsregister = time();
        $keyword->save();

        $index = Zend_Search_Lucene::open(APPLICATION_PATH . '/../data/lucene');
        $hits = $index->find($value);
        foreach ($hits as $hit) {
            $class = new Books_Book_Empty();

            $class->id = $hit->id;
            $class->score = $hit->score;

            $class->book = $hit->book;
            $class->title = $hit->title;
            $class->author = $hit->author;
            $class->publisher = $hit->publisher;
            $class->language = $hit->language;

            $class->avatar = $hit->avatar;

            $books[] = $class;
        }

        $this->view->form = $form;
        $this->view->books = $books;
    }
}
