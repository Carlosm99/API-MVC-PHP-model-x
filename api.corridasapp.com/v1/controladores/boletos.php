<?php
// Constantes de estado

class boletos
{
    // Datos de la tabla "corridas"
    const NOMBRE_TABLE =      "boletos";
    const ID_BOLETO =         "id_boleto";
    const ID_BUSLINE =        "id_usuario";
    const BUSLINENAME =       "id_corrida";
   

    public static function get($peticion)
    {
        //  $Origen =corridas::obtenerOrigen();
        if (empty($peticion[0])) {
            return self::obtenerboletos();
        } else {
            //    return self::obtenercorridas();

            throw new ExcepcionApi("Url mal formada", 400);
        }
    }
    

    private function obtenerboletos()
    {
        try {

            $comando = "SELECT *" . " FROM " . self::NOMBRE_TABLE;
            // Preparar sentencia
            $sentencia = ConexionBD::obtenerInstancia()->obtenerBD()->prepare($comando);
            // Ejecutar sentencia preparada
            if ($sentencia->execute()) {
                $boletos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                http_response_code(200);
                return ["boletos" => $boletos];
            } else {
                throw new ExcepcionApi(2, "Se ha producido un error");
            }
        } catch (PDOException $e) {
            throw new ExcepcionApi(3, $e->getMessage());
        }
    }

  
   



  
}
