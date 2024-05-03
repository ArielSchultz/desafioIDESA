<?php 

require_once 'Database.php';

class DesafioUno {


    public static function getClientDebt(int $clientID)
    {
        Database::setDB();
        /*$fecha_actual = '2024-05-05';*/
        $lotes = self::getLotes($clientID);
        
        // Estructura inicial de cobro
        $cobrar = [
            'status' => false,
            'message' => 'No hay Lotes para cobrar',
            'data' => [
                'total' => 0,
                'detail' => []
            ]
        ];
        
        foreach ($lotes as $lote) {
            if ($lote->vencimiento && $lote->vencimiento && strtotime($lote->vencimiento) < strtotime(date('Y-m-d'))) {
                $cobrar['status'] = true;
                $cobrar['message'] = 'Tienes Lotes para cobrar';
                $cobrar['data']['total'] += $lote->precio;
                $cobrar['data']['detail'][] = [
                    'id' => $lote->id,
                    'lote' => $lote->lote,
                    'precio' => $lote->precio,
                    'clientID' => $lote->clientID,
                    'vencimiento' => $lote->vencimiento
                ]; 
            } else if ($lote->vencimiento === null) {
                $cobrar = [
                    'status' => false,
                    'message' => 'No se verifica fecha de vencimiento',
                    'data' => [
                        'total' => 0,
                        'detail' => []
                    ]
                ];
            }
        }
        
        // Devolver el resultado como JSON
        return json_encode($cobrar);
    }
    private static function getLotes(int $clientID) : array 
    {
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->prepare("SELECT * FROM debts WHERE clientID = :clientID");
        $stmt->bindValue(':clientID', $clientID, SQLITE3_INTEGER);
        $result = $stmt->execute();

        while ($rows = $result->fetchArray(SQLITE3_ASSOC)) {
            $rows['clientID'] = (string) $rows['clientID'];
            $lotes[] = (object) $rows;
        }
        return $lotes;
    }
}

echo DesafioUno::getClientDebt(123456);