<?php

class Database {
    private $connection = null;

    public function __construct() {
        try {
            // data source name
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET . ";port=" . DB_PORT;

            $this->connection = new PDO($dsn, DB_USER, DB_PASSWORD);

        } catch (Exception $e) {
            exit('Database connection failed' . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

}

?>