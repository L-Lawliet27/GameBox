<?php
class Database {
    private static $data = null;
    private static $conn = null;

    protected function __construct() {
    }

    private function __clone() {
    }

    private function __wakeup() {
    }

    public static function init($data) {
        if (Database::$data == null) {
            Database::$data = $data;
        }
    }

    public static function connection() {
        if (Database::$data != null && Database::$conn == null) {
            Database::$conn = new \mysqli(Database::$data["hostname"], Database::$data["username"], Database::$data["password"], Database::$data["database"]);
            if (Database::$conn->connect_errno) {
                echo "Error de conexión a la BD: (" . Database::$conn->connect_errno . ") " . utf8_encode(Database::$conn->connect_error);
                exit();
            }
            if (!Database::$conn->set_charset("utf8mb4")) {
                echo "Error al configurar la codificación de la BD: (" . Database::$conn->errno . ") " . utf8_encode(Database::$conn->error);
                exit();
            }
        }
        return Database::$conn;
    }
}
?>
