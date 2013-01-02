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

        $value = strtolower($form->getElement('q')->getValue());

        $model_keywords = new Search_Keywords();
        $keyword = $model_keywords->createRow();
        $keyword->keyword = $value;
        $keyword->tsregister = time();
        $keyword->save();

        try {
            if ($q == '*') {
                $model_collection = new Books_Collection();
                $hits = $model_collection->selectWithMetas();
            } else {
                Zend_Search_Lucene_Search_Query_Wildcard::setMinPrefixLength(1);

                $config = Zend_Registry::get('config');
                $index = Zend_Search_Lucene::open($config->babel->properties->lucene);

                $hits = $index->find($value);
            }
        } catch (Exception $e) {
            $hits = array();
        }

        $books = array();

        foreach ($hits as $hit) {
            $class = new Books_Book_Empty();

            if (isset($hit->id)) {
                $class->id = $hit->id;
                $class->score = $hit->score;
                $class->filename = $hit->filename;
            }

            $class->book = $hit->book;

            $class->title = $hit->title;
            $class->author = $hit->author;
            $class->publisher = $hit->publisher;
            $class->language = $hit->language;
            $class->year = $hit->year;

            $books[] = $class;
        }

        $this->view->form = $form;
        $this->view->books = $books;
    }
}
