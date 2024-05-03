<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

class Database {
    static $dbName = 'idesa.db';

    public static function setDB(): void {
        $db = self::getConnection();
        $db->exec("DROP TABLE debts");
        $db->exec("CREATE TABLE debts(id INTEGER PRIMARY KEY, lote TEXT, precio INT, clientID INT, vencimiento DATE)");
        $db->exec("INSERT INTO debts(id, lote, precio, clientID, vencimiento) VALUES (1,'00145',150000,123456, '2024-09-01')");
        $db->exec("INSERT INTO debts(id, lote, precio, clientID, vencimiento) VALUES (2,'00146',110000,135486, NULL)");
        $db->exec("INSERT INTO debts(id, lote, precio, clientID, vencimiento) VALUES (3,'00147',160000,135486, NULL)");
        $db->exec("INSERT INTO debts(id, lote, precio, clientID, vencimiento) VALUES (4,'00148',130000,123456, '2024-10-01')");
        $db->exec("INSERT INTO debts(id, lote, precio, clientID, vencimiento) VALUES (5,'00148',145000,123456, NULL)");
        $db->exec("INSERT INTO debts(id, lote, precio, clientID, vencimiento) VALUES (6,'00148',190000,123456, '2024-12-01')");
        $db->exec("INSERT INTO debts(id, lote, precio, clientID, vencimiento) VALUES (7,'00148',190000,123456, '2024-01-01')");
        $db->exec("INSERT INTO debts(id, lote, precio, clientID, vencimiento) VALUES (8,'00148',190000,123456, '2024-02-01')");
        if (!$db) {
            echo "Error al establecer la conexión con la base de datos.\n";
            return;
        }
        echo "Conexión con la base de datos establecida correctamente.\n";

        $dropResult = $db->exec("DROP TABLE IF EXISTS debts");
        if (!$dropResult) {
            echo "Error al eliminar la tabla 'debts'.\n";
        } else {
            echo "Tabla 'debts' eliminada correctamente.\n";
        }

        $createResult = $db->exec("CREATE TABLE debts(id INTEGER PRIMARY KEY, lote TEXT, precio INT, clientID INT, vencimiento DATE)");
        if (!$createResult) {
            echo "Error al crear la tabla 'debts'.\n";
        } else {
            echo "Tabla 'debts' creada correctamente.\n";
        }

        // Agregar inserciones de datos y otras operaciones aquí...

        $db->close();
    }

    public static function getConnection() {
        return new SQLite3(self::$dbName);
    }
}

// Ejecutar la configuración de la base de datos
Database::setDB();
