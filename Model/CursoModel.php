<?php
require_once "Core/BaseDatos.php";
require_once "Entities/Curso.php";

class CursoModel extends Conectar
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ListarCursos()
    {
        try {
            $sql = "SELECT cursoID, nombre FROM curso ORDER BY cursoID ASC";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

            $lista = [];
            foreach ($resultados as $fila) {
                $lista[] = new Curso(
                    $fila['cursoID'],
                    $fila['nombre']
                );
            }
            return $lista;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function buscarCurso($id)
    {
        try {
            $sql = "SELECT cursoID, nombre FROM curso WHERE cursoID = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindValue(':id', $id, PDO::PARAM_INT);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                return new Curso(
                    $resultado['cursoID'],
                    $resultado['nombre']
                );
            }
            return null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function GuardarCurso(Curso $curso)
    {
        try {
            $sql = "INSERT INTO curso (nombre) VALUES (:nombre)";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindValue(':nombre', $curso->getNombre(), PDO::PARAM_STR);
            $sentencia->execute();
            return $this->conexion->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function EditarCurso(Curso $curso)
    {
        try {
            $sql = "UPDATE curso SET nombre = :nombre WHERE cursoID = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindValue(':nombre', $curso->getNombre(), PDO::PARAM_STR);
            $sentencia->bindValue(':id', $curso->getId(), PDO::PARAM_INT);
            $sentencia->execute();
            return ($sentencia->rowCount() > 0);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function EliminarCurso($id)
    {
        try {
            $sql = "DELETE FROM curso WHERE cursoID = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindValue(':id', $id, PDO::PARAM_INT);
            $sentencia->execute();
            return ($sentencia->rowCount() > 0);
        } catch (PDOException $e) {
            return false;
        }
    }
}