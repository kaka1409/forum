<?php

class Account {

    public static function authenticate($db, $email, $password) {
        $sql = "SELECT * FROM `account` WHERE email = :email;";
        $stmt = $db->query($sql, [
            ':email' => $email
        ]);
        
        if ($stmt->rowCount() > 0) {
            $account = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $account['password_hash'])) {
                return $account;
            }
        }

        return false;
    }

    public static function login($db) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    
        $account = self::authenticate($db, $email, $password);
        if ($account) {
            $session = new Session();

            $session->set('account_id', $account['account_id']);
            $session->set('account_name', $account['account_name']);
            $session->set('account_avatar', $account['account_avatar']);
            $session->set('role_id', $account['role_id']);
            return true;
        }
    
        return false;
    }

    public static function register($db) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    
        $emailCheck = "SELECT * FROM `account` WHERE email = :email;";
        $emailCheckStmt = $db->query($emailCheck, [
            ':email' => $email
        ]);

        // check if email already exists
        if ($emailCheckStmt->rowCount() > 0) {
            return false;
        }

        $sql = "INSERT INTO `account`
                (`role_id`, `account_name`, `account_avatar`, `password_hash`, `email`, `create_at`) 
                VALUES (:role_id, :username, :account_avatar, :password_hash, :email, NOW())";

        $stmt = $db->query($sql, [
            ':role_id' => 1, // student is default role
            ':username' => $username,
            ':account_avatar' => 'uploads/account/default.jpg',
            ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ':email' => $email,
        ]);

        return $stmt;
        
    }

    public static function createAccount($db = null) {
        $role_id = trim($_POST['role']);
        $account_name = trim($_POST['account_name']);
        if (isset($_FILES['account_avatar'])) {
            $account_avatar = UPLOAD_FOLDER . 'account/' . basename($_FILES['account_avatar']['name']);
            $isOk = 1;

            $check = getimagesize($_FILES["account_avatar"]["tmp_name"]);
            if ($check !== false) {
                $isOk = 1;
            } else {
                sendJson([
                    'status' => 'error',
                    'message' => 'File is not an image.<br>'
                ]);
                $isOk = 0;
            }

            if ($isOk) {
                move_uploaded_file($_FILES['account_avatar']['tmp_name'], dirname(__DIR__, 2) . '/' . $account_avatar);
            } else {
                sendJson([
                    'status' => 'error',
                    'message' => 'Your file was not uploaded'
                ]);
            }
        } else {
            $account_avatar = UPLOAD_FOLDER . 'account/default.jpg';
        }
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = trim($_POST['email']);


        $sql = "INSERT INTO `account`
                (role_id, account_name, account_avatar, password_hash, email, create_at)
                VALUES (:role_id, :account_name, :account_avatar, :password_hash, :email, NOW())";

        $stmt = $db->query($sql, [
            ':role_id' => $role_id,
            ':account_name' => $account_name,
            ':account_avatar' => $account_avatar,
            ':password_hash' => $password_hash,
            ':email' => $email,
        ]);

        return $stmt;
    }

    public static function getAccountById($db = null, $account_id) {
        $sql = "SELECT account_id, role_id, account_name, account_avatar, email 
                FROM `account` 
                WHERE account_id = :account_id";

        $stmt = $db->query($sql, [
            ':account_id' => $account_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAccountPosts() {
        
    }

    public static function getAllAccounts($db = null) {
        $sql = "SELECT account_id, role_id, account_name, 
                account_avatar, email, create_at
                FROM `account`";
    
        $stmt = $db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    public static function getUserCount($db = null) {
        $sql = "SELECT COUNT(*) AS user_count FROM `account`;";

        $stmt = $db->query($sql);

        return $stmt->fetch();
    }

    public static function updateAccount($db = null, $account_id) {
        $role_id = trim($_POST['role']);
        $account_name = trim($_POST['account_name']);
        if (isset($_FILES['account_avatar'])) {
            $account_avatar = UPLOAD_FOLDER . 'account/' . basename($_FILES['account_avatar']['name']);
            $isOk = 1;

            $check = getimagesize($_FILES["account_avatar"]["tmp_name"]);
            if ($check !== false) {
                $isOk = 1;
            } else {
                sendJson([
                    'status' => 'error',
                    'message' => 'File is not an image.<br>'
                ]);
                $isOk = 0;
            }

            if ($isOk) {
                move_uploaded_file($_FILES['account_avatar']['tmp_name'], dirname(__DIR__, 2) . '/' . $account_avatar);
            } else {
                sendJson([
                    'status' => 'error',
                    'message' => 'Your file was not uploaded'
                ]);
            }
        } else {
            $account_avatar = UPLOAD_FOLDER . 'account/default.jpg';
        }
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = trim($_POST['email']);


        $sql = "UPDATE `account`
                SET role_id = :role_id, account_name = :account_name, 
                account_avatar = :account_avatar, password_hash = :password_hash, 
                email = :email
                WHERE account_id = :account_id;";

        $stmt = $db->query($sql, [
            ':account_id' => $account_id,
            ':role_id' => $role_id,
            ':account_name' => $account_name,
            ':account_avatar' => $account_avatar,
            ':password_hash' => $password_hash,
            ':email' => $email
        ]);

        return $stmt;
    }

    public static function deleteAccount($db = null, $account_id = null) {
        $sql = "DELETE FROM `account` WHERE account_id = :account_id;";

        $stmt = $db->query($sql, [
            ':account_id' => $account_id
        ]);

        return $stmt;
    }

    public static function searchAccount($db = null, $query = null) {
        $sql = "SELECT account_id, role_id, account_name, account_avatar, email, create_at
                FROM `account`
                WHERE account_name LIKE :query;";

        $stmt = $db->query($sql, [
            ':query' => '%'. $query .'%'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>