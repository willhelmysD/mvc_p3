<?php
require_once "Core/BaseDatos.php";
require_once "Entities/Programa.php";

class ProgramaModel extends Conectar
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ListarProgramas()
    {
        try {
            $sql = "SELECT programaID, nombre FROM programa ORDER BY programaID ASC";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

            $lista = [];
            foreach ($resultados as $fila) {
                $lista[] = new Programa(
                    $fila['programaID'],
                    $fila['nombre']
                );
            }
            return $lista;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function buscarPrograma($id)
    {
        try {
            $sql = "SELECT programaID, nombre FROM programa WHERE programaID = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindValue(':id', $id, PDO::PARAM_INT);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                return new Programa(
                    $resultado['programaID'],
                    $resultado['nombre']
                );
            }
            return null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function GuardarPrograma(Programa $programa)
    {
        try {
            $sql = "INSERT INTO programa (nombre) VALUES (:nombre)";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindValue(':nombre', $programa->getNombre(), PDO::PARAM_STR);
            $sentencia->execute();
            return $this->conexion->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function EditarPrograma(Programa $programa)
    {
        try {
            $sql = "UPDATE programa SET nombre = :nombre WHERE programaID = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindValue(':nombre', $programa->getNombre(), PDO::PARAM_STR);
            $sentencia->bindValue(':id', $programa->getId(), PDO::PARAM_INT);
            $sentencia->execute();
            return ($sentencia->rowCount() > 0);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function EliminarPrograma($id)
    {
        try {
            $sql = "DELETE FROM programa WHERE programaID = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindValue(':id', $id, PDO::PARAM_INT);
            $sentencia->execute();
            return ($sentencia->rowCount() > 0);
        } catch (PDOException $e) {
            return false;
        }
    }
}