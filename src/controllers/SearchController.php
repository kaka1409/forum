<?php

class SearchController {
    public function index() {
        global $db;


        $search_option = $_GET['option'];
        $search_query = $_GET['query'];

        $view = ViewController::getInstance();
        $view->set('disable_scroll', false);

        switch($search_option) {
            case 'post': {

                $view->set('title', 'Search ' . $search_query);
                $view->render('searchPost');
                // echo $search_option;
                // echo $search_query;
            }

            case 'user': {
                $view->set('title', 'Search ' . $search_query);
                // $view->set()
                $view->render('searchUser');
            }
        }


    }   
}

?>