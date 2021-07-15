<?php
// Constantes de estado

class admin
{
    // Datos de la tabla "corridas"
    const NOMBRE_TABLE =    "admin";
    const ID_ADMIN =        "id_admin";
    const PRIMERNOMBRE =    "PrimerNombre";
    const APELLIDO =        "Apellido";
    const PERMISO =     "	 Permiso";
    const USERNAME =        "username";
    const PASSWORD=         "password";

    public static function get($peticion)
    {
        //  $Origen =corridas::obtenerOrigen();
        if (empty($peticion[0])) {
            return self::obteneradmin();
        } else {
            //    return self::obtenercorridas();

            throw new ExcepcionApi("Url mal formada", 400);
        }
    }
    

    private function obteneradmin()
    {
        try {

            $comando = "SELECT *" . " FROM " . self::NOMBRE_TABLE;
            // Preparar sentencia
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);
            // Ejecutar sentencia preparada
            if ($sentencia->execute()) {
                $admin = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                http_response_code(200);
                return ["busline" => $admin];
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
        $admin = json_decode($body);

        $id_admin = admin::crear($admin);

        http_response_code(201);
        return [
            "estado" => 1,
            "mensaje" => "Busline creado",
            "id" => $id_admin
        ];
    }
    private function crear($admin)
    {

        if ($admin) {
            try {

                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                //Sentencia INSERT
                $comando = "INSERT INTO " . self::NOMBRE_TABLE . " ( " .
                    self::PRIMERNOMBRE . "," .
                    self::APELLIDO . "," .
                    self::PERMISO . "," .
                    self::USERNAME . "," .
                    self::PASSWORD . ")" .
                    " VALUES(?,?,?,?,?)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);

                $sentencia->bindParam(1, $PrimerNombre);
                $sentencia->bindParam(2, $Apellido);
                $sentencia->bindParam(3, $Permiso);
                $sentencia->bindParam(4, $username);
                $sentencia->bindParam(5, $password);
                

                $PrimerNombre = $admin->PrimerNombre;
                $Apellido =     $admin->Apellido;
                $Permiso =      $admin->Permiso;
                $username =     $admin->username;
                $password =     $admin->password;
               

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

        $id_buslinex = $busline['id_admin'];
        try{
       // Sentencia DELETE
        $comando = "DELETE FROM " . self::NOMBRE_TABLE .
        " WHERE " . self::ID_ADMIN . "=?";

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
