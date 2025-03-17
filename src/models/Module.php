<?php

class Module {

    public static function getAllModules($db) {
        $sql = "SELECT module_id, module_name FROM `module`;";
        $stmt = $db->query($sql);
        $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $modules;
    }
}

?>