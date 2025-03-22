<?php

class Module {

    public static function getAllModules($db) {
        $sql = "SELECT module_id, module_name, description FROM `module`;";
        $stmt = $db->query($sql);
        $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $modules;
    }

    public function getModuleById($db, $module_id) {
        $sql = 'SELECT * FROM module WHERE module_id = :module_id';
    
        $stmt = $db->query($sql, [
            ':module_id' => $module_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function countPostById($db, $module_id) {
        $sql = 'SELECT COUNT(module_id) FROM `post` WHERE module_id = :module_id;';

        $stmt = $db->query($sql, [
            ':module_id' => $module_id
        ]);      

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>