<?php

class PostController {
    public function createForm() {
        if (!isLoggedIn()) {
            header('Location: ' . BASE_URL . 'home');
            exit;
        }
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
            sendJson([
                'status' => 'error',
                'message' => 'csrf token is invalid',
                'redirect' => BASE_URL . 'post/create'
            ]);
            exit;
        }

        global $db;

        if (isset($_POST['submit'])) {

            $result = Post::createPost($db);

            if ($result) {
                if (isAdmin()) {
                    $pdo = $db->getConnection();
                    $post_id = $pdo->lastInsertId();
    
                    // collect admin audit logs
                    $log_result = Log::collectLog($db, $post_id, 'create', 'post') ?? null;
    
                    if ($log_result === null || !$log_result) {
                        throw new Error('Failed to create post log');
                    }
                }
                sendJson([
                    'status' => 'success',
                    'message' => 'Post created successfully',
                    'redirect' => BASE_URL . 'home'
                ]);
                exit;
            } else {
                sendJson([
                    'status' => 'error',
                    'message' => 'Failed to create post',
                    'redirect' => BASE_URL . 'post/create'
                ]);
                exit;
            }

        } else {
            sendJson([
                'status' => 'error',
                'message' => 'Failed to create post',
                'redirect' => BASE_URL . 'post/create'
            ]);
            exit;
        }
    }

    public function show() {
        global $db;
        $post_id = getPostId();

        $post_content = Post::getPostById($db, $post_id);
        $comments = Comment::getAllComments($db, $post_id);

        // add user's information status
        if ($post_content && isLoggedIn()) {

            // vote status
            $user_vote = Vote::checkVote($db, $_SESSION['account_id'], $post_content['post_id']);
            $post_content['is_voted'] = !empty($user_vote) ? 1 : 0;

            // bookmark status
            $user_bookmark = Post::checkBookmarked($db, $post_content['post_id']);
            $post_content['is_bookmarked'] = !empty($user_bookmark) ? 1 : 0;

            // user vote for comment
            foreach($comments as &$comment) {
                $user_comment_vote = CommentVote::checkVote($db, $_SESSION['account_id'], $comment['comment_id']) ?? null;
                $comment['is_voted'] = !empty($user_comment_vote) ? $user_comment_vote['vote_type'] : 0;
            }
        } else {
            $post_content['is_voted'] = 0;
            $post_content['is_bookmarked'] = 0;

            foreach($comments as &$comment) { 
                $comment['is_voted'] = 0;
            }
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
            if (!isAdmin()) {
                header('Location: ' . BASE_URL . 'home');
                exit;
            }
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
        global $db;
        $post_id = getPostId();

        $session = new Session();
        if (!$session->validateCsrfToken($_POST['csrf_token'])) {
            sendJson([
                'status' => 'error',
                'message' => 'csrf token is invalid',
                'redirect' => BASE_URL . 'edit/' . $post_id . '/edit'
            ]);
            exit;
        }

        if (isset($_POST['submit'])) {
            $result = Post::updatePostById($db, $post_id);
    
            if ($result) {
                if (isAdmin()) {

                    // collect admin audit logs
                    $log_result = Log::collectLog($db, $post_id, 'update', 'post') ?? null;

                    if ($log_result === null || !$log_result) {
                        throw new Error('Failed to collect post log');
                    }
                }

                sendJson([
                    'status' => 'success',
                    'message' => 'Post edited successfully',
                    'redirect' => BASE_URL . 'post/' . $post_id
                ]);
                exit;
            } else {
                // error toase message maybe
                sendJson([
                    'status' => 'error',
                    'message' => 'Failed to edit post',
                    'redirect' =>BASE_URL . 'edit/' . $post_id . '/edit'
                ]);
                exit;
            }

        } else {
            sendJson([
                'status' => 'error',
                'message' => 'Failed to edit post',
                'redirect' =>BASE_URL . 'edit/' . $post_id . '/edit'
            ]);
            exit;
        }

    }

    public function delete() {
        global $db;
        $post_id = getPostId();
        
        if (isset($_POST['submit']) ) {

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
    
    public function bookmarksView() {
        global $db;
        $posts = Post::getBookmarked($db);

        // add post's information status
        if ($posts && isLoggedIn()) {
            foreach ($posts as &$post) {
                $user_vote = Vote::checkVote($db, $_SESSION['account_id'], $post['post_id']);
                $post['is_voted'] = !empty($user_vote) ? $user_vote['vote_type'] : 0;

                $user_bookmark = Post::checkBookmarked($db, $post['post_id']);
                $post['is_bookmarked'] = !empty($user_bookmark) ? 1 : 0;
            } 
        } else {
            foreach ($posts as &$post) {
                $post['is_voted'] = 0;
                $post['is_bookmarked'] = 0;
            } 
        }

        $posts = FeedController::setPostFeed($posts);

        $view = ViewController::getInstance();
        $view->set('title', 'Bookmarks');
        $view->set('disable_scroll', false);
        $view->set('posts', $posts);
        $view->render('bookmarks');
    }

    public function bookmark() {
        global $db;
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : null;

        $bookmarked = Post::checkBookmarked($db, $post_id);
        if (empty($bookmarked)) {
    
            $result = Post::bookmarkPost($db,$post_id );
    
            if ($result) {
                sendJson([
                    'status' => 'success',
                    'bookmarked' => $_POST['post_id']
                ]);
            }

        } else {
            Post::removeBookmarked($db, $post_id);
        }

    }

}
?>