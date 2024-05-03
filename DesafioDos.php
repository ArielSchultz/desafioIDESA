<?php 
require_once 'Database.php';

class DesafioDos {

    public static function retrieveLotes(string $loteID) {
        Database::setDB(); 
        $lotes = self::getLotes($loteID);
        echo json_encode($lotes);
    }

    private static function getLotes(string $loteID): array 
    {
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->prepare("SELECT * FROM debts WHERE lote = :loteID");
        $stmt->bindValue(':loteID', $loteID, SQLITE3_TEXT);
        $result = $stmt->execute();
        
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $row['loteID'] = (string) $row['loteID'];
            $lotes[] = (object) $row;
        }
        
        return $lotes;
    }
}

DesafioDos::retrieveLotes('00148');