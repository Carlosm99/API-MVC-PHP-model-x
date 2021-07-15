<?php
// Constantes de estado

class usuarios
{
    // Datos de la tabla "corridas"
    const NOMBRE_TABLE =     "usuarios";
    const ID_USARIO =        "id_usuario";
    const PRIMERNOMBRE =     "PrimerNombre";
    const APELLIDO =         "Apellido";
    const EMAIL =            "Email";
    const TELEFONO =         "Telefono";
    const LUGAR_DE_ORIGEN =  "lugar_de_origen";
    const USERNAME =         "username";
    const PASSWORD=          "password";

    public static function get($peticion)
    {
        //  $Origen =corridas::obtenerOrigen();
        if (empty($peticion[0])) {
            return self::obtenerusuario();
        } else {
            //    return self::obtenercorridas();

            throw new ExcepcionApi("Url mal formada", 400);
        }
    }
    

    private function obtenerusuario()
    {
        try {

            $comando = "SELECT *" . " FROM " . self::NOMBRE_TABLE;
            // Preparar sentencia
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);
            // Ejecutar sentencia preparada
            if ($sentencia->execute()) {
                $usuario = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                http_response_code(200);
                return ["busline" => $usuario];
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
        $usuario = json_decode($body);

        $id_usuario = usuarios::crear($usuario);

        http_response_code(201);
        return [
            "estado" => 1,
            "mensaje" => "Busline creado",
            "id" => $id_usuario
        ];
    }
    private function crear($usuario)
    {

        if ($usuario) {
            try {

                $pdo = ConexionBD::obtenerInstancia()->obtenerBD();

                //Sentencia INSERT
                $comando = "INSERT INTO " . self::NOMBRE_TABLE . " ( " .
                    self::PRIMERNOMBRE . "," .
                    self::APELLIDO . "," .
                    self::EMAIL . "," .
                    self::TELEFONO . "," .
                    self::LUGAR_DE_ORIGEN . "," .
                    self::USERNAME . "," .
                    self::PASSWORD . ")" .
                    " VALUES(?,?,?,?,?,?,?)";

                // Preparar la sentencia
                $sentencia = $pdo->prepare($comando);

                $sentencia->bindParam(1, $PrimerNombre);
                $sentencia->bindParam(2, $Apellido);
                $sentencia->bindParam(3, $Email);
                $sentencia->bindParam(4, $Telefono);
                $sentencia->bindParam(5, $lugar_de_origen);
                $sentencia->bindParam(6, $username);
                $sentencia->bindParam(7, $password);
                

                $PrimerNombre = $usuario->PrimerNombre;
                $Apellido =     $usuario->Apellido;
                $Email =      $usuario->Email;
                $Telefono =     $usuario->Telefono;
                $lugar_de_origen =     $usuario->lugar_de_origen;
                $username =     $usuario->username;
                $password =     $usuario->password;
               

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

    private function eliminar($usuario){

        $id_usuariox = $usuario['id_usuario'];
        try{
       // Sentencia DELETE
        $comando = "DELETE FROM " . self::NOMBRE_TABLE .
        " WHERE " . self::ID_USARIO . "=?";

        // Preparar la sentencia
        $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);
        $sentencia->bindParam(1, $id_usuariox);

        $sentencia->execute();

        return $sentencia->rowCount();


        }catch(PDOException $e){
            throw new ExcepcionApi(3, $e->getMessage());
        }
    }
}
