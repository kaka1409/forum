<?php

class Module {

    public static function createModule($db = null) {
        $sql = "INSERT INTO `module`
                (module_name, teacher, description)
                VALUES (:module_name, :teacher, :description)";

        $stmt = $db->query($sql, [
            ':module_name' => $module_name,
            ':teacher' => $teacher,
            ':description' => $description,
        ]);

        return $stmt;
    }

    public static function getAllModules($db) {
        $sql = "SELECT * FROM `module`;";
        $stmt = $db->query($sql);
        $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $modules;
    }

    public static function getModuleById($db, $module_id) {
        $sql = 'SELECT * FROM module WHERE module_id = :module_id;';
    
        $stmt = $db->query($sql, [
            ':module_id' => $module_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function countPostById($db, $module_id) {
        $sql = 'SELECT COUNT(module_id) AS `post_count` FROM `post` WHERE module_id = :module_id;';

        $stmt = $db->query($sql, [
            ':module_id' => $module_id
        ]);      

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAllPostById($db, $module_id) {
        $sql = 'SELECT post.post_id, post.account_id, post.title, post.content,
            post.post_at, post.vote, post.comments_count, post.thumbnail_url,
            account.account_name, account.account_avatar, module.module_id, module.module_name
            FROM `post`
            INNER JOIN `account` ON post.account_id = account.account_id
            INNER JOIN `module` ON post.module_id = module.module_id
            WHERE module.module_id = :module_id;';

        $stmt = $db->query($sql, [
            ':module_id' => $module_id
        ]);      

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getModuleCount($db = null) {
        $sql = "SELECT COUNT(*) AS module_count FROM `module`;";

        $stmt = $db->query($sql);

        return $stmt->fetch();
    }

    public static function updateModule($db = null, $module_id = null) {
        $sql = "UPDATE `module`
                SET module_name = :module_name, teacher = :teacher,
                description = :description
                WHERE module_id = :module_id;";

        $stmt = $db->query($sql, [
            ':module_name' => $module_name,
            ':teacher' => $teacher,
            ':description' => $description,
            ':module_id' => $module_id,
        ]);

        return $stmt;
    }

    public static function deleteModule($db = null, $module_id = null) {
        $sql = "DELETE FROM `module` WHERE module_id = :module_id";

        $stmt = $db->query($sql, [
            ':module_id' => $module_id
        ]);

        return $stmt;
    }
}

?>