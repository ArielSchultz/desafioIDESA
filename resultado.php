<?php
require_once 'Database.php';

// Definimos la clase para manejar las solicitudes REST
class LoteService {
    public static function handleRequest() {
        // Verificamos si se proporcionó un ID de lote en la URL
        if (isset($_GET['lote_id'])) {
            // Obtiene el ID de lote de la URL
            $loteID = $_GET['lote_id'];

            // Establecemos la conexión con la base de datos
            Database::setDB();

            // Obtienemos los datos del lote correspondiente al ID proporcionado
            $loteData = self::getLoteData($loteID);

            // Devuelve los datos del lote en formato JSON
            echo json_encode($loteData);
        } else {
            // Si no se proporciona un ID de lote, devuelve un mensaje de error
            echo json_encode(array('error' => 'ID de lote no proporcionado'));
        }
    }

    // Método para obtener los datos de un lote específico
    private static function getLoteData(int $loteID) :array {
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->prepare("SELECT * FROM debts WHERE id = :loteID");
        $stmt->bindValue(':loteID', $loteID, SQLITE3_INTEGER);
        $result = $stmt->execute();

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $row['lote'] = (string) $row['lote'];
            $lotes[] = (object) $row;
        }

        return $lotes;
    }
}

// Maneja la solicitud HTTP
LoteService::handleRequest();