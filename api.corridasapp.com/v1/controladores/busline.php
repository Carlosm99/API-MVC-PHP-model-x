<?php
// Constantes de estado

class busline
{
    // Datos de la tabla "corridas"
    const NOMBRE_TABLE =      "busline";
    const ID_BUSLINE =        "id_busline";
    const BUSLINENAME =       "BuslineName";
    const OWNENOMBRE =        "ownerName";
    const OWNERAPELLIDO =     "ownerApellido";
    const ANTIGUEDAD=         "antiguedad";

    public static function get($peticion)
    {
        //  $Origen =corridas::obtenerOrigen();
        if (empty($peticion[0])) {
            return self::obtenerbusline();
        } else {
            //    return self::obtenercorridas();

            throw new ExcepcionApi("Url mal formada", 400);
        }
    }
    

    private function obtenerbusline()
    {
        try {

            $comando = "SELECT *" . " FROM " . self::NOMBRE_TABLE;
            // Preparar sentencia
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);
            // Ejecutar sentencia preparada
            if ($sentencia->execute()) {
                $busline = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                http_response_code(200);
                return ["busline" => $busline];
            } else {
                throw new ExcepcionApi(2, "Se ha producido un error");
            }
        } catch (PDOException $e) {
            throw new ExcepcionApi(3, $e->getMessage());
        }
    }

    public static function post($peticion)
    {
        $body = file_get_contents('php://input');
        $busline = json_decode($body);

        $id_busline = busline::crear($busline);

        http_response_code(201);
        return [
            "estado" => 1,
            "mensaje" => "Busline creado",
            "id" => $id_busline
        ];
    }
    private function crear($busline)
    {

        if ($busline) {
            try {

                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                //Sentencia INSERT
                $comando = "INSERT INTO " . self::NOMBRE_TABLE . " ( " .
                    self::BUSLINENAME . "," .
                    self::OWNENOMBRE . "," .
                    self::OWNERAPELLIDO . "," .
                    self::ANTIGUEDAD . ")" .
                    " VALUES(?,?,?,?)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);

                $sentencia->bindParam(1, $BuslineName);
                $sentencia->bindParam(2, $ownerName);
                $sentencia->bindParam(3, $ownerApellido);
                $sentencia->bindParam(4, $antiguedad);
                

                $BuslineName =        $busline->BuslineName;
                $ownerName =            $busline->ownerName;
                $ownerApellido =           $busline->ownerApellido;
                $antiguedad =    $busline->antiguedad;
               

                $sentencia->execute();

                // Retornar en el último id insertado
                return $pdo->lastInsertId();
            } catch (PDOException $e) {
                throw new ExcepcionApi(3, $e->getMessage());
            }
        } else {
            throw new ExcepcionApi(
                4,
                utf8_encode("Error en existencia o sintaxis de parámetros")
            );
        }
    }



    public static function delete($peticion)
    {
        if (!empty($peticion[0])) {
            if (self::eliminar($peticion[0]) > 0) {
                http_response_code(200);
                return [
                    "estado" => 1,
                    "mensaje" => "Registro eliminado correctamente",
                    
                ];            
            }else{
                throw new ExcepcionApi(5,
                "El contacto al que intentas acceder no existe", 404);
            }
        }else{
            throw new ExcepcionApi(4, "Falta id", 422);
        }
    }

    private function eliminar($busline){

        $id_buslinex = $busline['id_busline'];
        try{
       // Sentencia DELETE
        $comando = "DELETE FROM " . self::NOMBRE_TABLE .
        " WHERE " . self::ID_BUSLINE . "=?";

        // Preparar la sentencia
        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);
        $sentencia->bindParam(1, $id_buslinex);

        $sentencia->execute();

        return $sentencia->rowCount();


        }catch(PDOException $e){
            throw new ExcepcionApi(3, $e->getMessage());
        }
    }
}
