<?php

class PostController {
    public function createForm() {
        $session = new Session();
        $csrf_token = $session->generateCsrfToken();

        global $db;
        $modules = Module::getAllModules($db);

        $view = ViewController::getInstance();
        $view->set('csrf_token', $csrf_token);
        $view->set('modules', $modules);
        $view->set('disable_scroll', true);
        $view->set('title', 'New Post');
        $view->render('createPost');
    }

    public function create() {
        // validate csrf token
        $session = new Session();
        if (!$session->validateCsrfToken($_POST['csrf_token'])) {
            header('Location: ' . BASE_URL . 'post/create');
            exit;
        }

        global $db;

        if (isset($_POST['submit'])) {

            $result = Post::createPost($db);

            if ($result) {
                header('Location: ' . BASE_URL . 'home');
                exit;
            } else {
                header('Location: ' . BASE_URL . 'post/create');
                exit;
            }

        } else {
            header('Location: ' . BASE_URL . 'post/create');
            exit;
        }
    }

    public function show() {
        global $db;
        $post_id = getPostId();

        $post_content = Post::getPostById($db, $post_id);
        $comments = Comment::getAllComments($db, $post_id);

        // add user vote status
        if ($post_content && isLoggedIn()) {
            $user_vote = Vote::checkVote($db, $_SESSION['account_id'], $post_content['post_id']);
            $post_content['is_voted'] = !empty($user_vote) ? 1 : 0;
        } else {
            $post_content['is_voted'] = 0;
        }

        $view = ViewController::getInstance();
        $view->set('post_content', $post_content);
        $view->set('comments', $comments);
        $view->set('disable_scroll', false);
        $view->set('title', 'Viewing ' . $post_content['title']);
        $view->render('post');
    }

    public function editForm() {
        $session = new Session();
        $csrf_token = $session->generateCsrfToken();

        global $db;
        $post_id = getPostId();

        $modules = Module::getAllModules($db);
        $post_data = Post::getPostById($db, $post_id);
        
        if ($post_data['account_id'] !== $_SESSION['account_id']) {
            header('Location: ' . BASE_URL . 'home');
            exit;
        }

        $view = ViewController::getInstance();        
        $view->set('modules', $modules);
        $view->set('csrf_token', $csrf_token);
        $view->set('post_data', $post_data);
        $view->set('disable_scroll', true);
        $view->set('title', 'Edit a post');
        $view->render('editPostForm');
    }

    public function edit() {
        $session = new Session();
        if (!$session->validateCsrfToken($_POST['csrf_token'])) {
            header('Location: ' . BASE_URL . 'home');
            exit;
        }

        global $db;
        $post_id = getPostId();

        if (isset($_POST['submit'])) {
            $result = Post::updatePostById($db, $post_id);
    
            if ($result) {
                header('Location: ' . BASE_URL . 'post/' . $post_id);
                exit;
            } else {
                // error toase message maybe
                header('Location: ' . BASE_URL . 'edit/' . $post_id . '/edit');
                exit;
            }

        } else {
            header('Location: ' . BASE_URL . 'edit/' . $post_id . '/edit');
            exit;
        }

    }

    public function delete() {
        global $db;
        $post_id = getPostId();

        if (isset($_POST['submit'])) {

            $result = Post::deletePostById($db, $post_id);

            if ($result) {
                header('Location: ' . BASE_URL . 'home');
                exit;
            } else {
                header('Location: ' . BASE_URL . 'home');
                exit;
            }

        } else {
            header('Location: ' . BASE_URL . 'home');
            exit;
        }
        
    }
    
    public function bookmarks() {
        $view = ViewController::getInstance();
        $view->set('title', 'Bookmarks');
        $view->render('bookmarks');
    }

}
?>