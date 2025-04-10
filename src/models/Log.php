<?php

class Log {
    public static function collectLog($db = null, $id = null, $action = null, $type = null) {

        switch ($type) {
            case 'post':
                $result = self::createPostLog($db, $id, $action);
                break;
            case 'module':
                $result = self::createModuleLog($db, $id, $action);
                break;
            case 'user':
                $result = self::createUserLog($db, $id, $action);
                break;
            default:
                break;
        }

        return $result;
    }

    public static function createPostLog($db = null, $post_id = null, $action = null) {
        $sql = "INSERT INTO `logs` (admin_id, action, post_id)
                VALUES (:admin_id, :action, :post_id) ;";

        $stmt = $db->query($sql, [
            ':admin_id' => $_SESSION['account_id'],
            ':action' => $action,
            ':post_id' => $post_id,
        ]);
    
        return $stmt;
    }

    public static function createModuleLog($db = null, $module_id = null, $action = null) {
        $sql = "INSERT INTO `logs` (admin_id, action, module_id)
                VALUES (:admin_id, :action, :module_id) ;";

        $stmt = $db->query($sql, [
            ':admin_id' => $_SESSION['account_id'],
            ':action' => $action,
            ':module_id' => $module_id,
        ]);
    
        return $stmt;
    }

    public static function createUserLog($db = null, $user_id = null, $action = null) {
        $sql = "INSERT INTO `logs` (admin_id, action, user_id)
                VALUES (:admin_id, :action, :user_id) ;";

        $stmt = $db->query($sql, [
            ':admin_id' => $_SESSION['account_id'],
            ':action' => $action,
            ':user_id' => $user_id,
        ]);
    
        return $stmt;
    }

    public static function getLogs($db = null) {
        $sql = "SELECT logs.action, logs.admin_id, logs.post_id, logs.module_id, logs.user_id,
                    admin.account_name AS admin_name,
                    user.account_name AS username,
                    post.title AS post_title,
                    module.module_name AS module_name
                FROM logs
                LEFT JOIN account admin ON logs.admin_id = admin.account_id
                LEFT JOIN account user ON logs.user_id = user.account_id
                LEFT JOIN post ON logs.post_id = post.post_id
                LEFT JOIN module ON logs.module_id = module.module_id";
    
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>