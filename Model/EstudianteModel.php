<?php
require_once "Core/BaseDatos.php";
require_once "Entities/Estudiante.php";

class EstudianteModel extends Conectar
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ListarEstudiantes()
    {
        try {
            $sql = "SELECT e.*, p.nombre AS programaNombre 
                    FROM estudiantes e 
                    LEFT JOIN programa p ON e.programaFK = p.programaID
                    ORDER BY e.estudianteID DESC";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

            $lista = [];
            foreach ($resultados as $fila) {
                $estudiante = new Estudiante(
                    $fila['estudianteID'],
                    $fila['nombres'],
                    $fila['apellidos'],
                    $fila['edad'],
                    $fila['programaFK'],
                    $fila['programaNombre'] ?? 'Sin programa'
                );
                $lista[] = $estudiante;
            }
            return $lista;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function buscarEstudiante($id)
    {
        try {
            $sql = "SELECT e.*, p.nombre AS programaNombre 
                    FROM estudiantes e 
                    LEFT JOIN programa p ON e.programaFK = p.programaID 
                    WHERE e.estudianteID = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                return new Estudiante(
                    $resultado['estudianteID'],
                    $resultado['nombres'],
                    $resultado['apellidos'],
                    $resultado['edad'],
                    $resultado['programaFK'],
                    $resultado['programaNombre'] ?? 'Sin programa'
                );
            }
            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GuardarEstudiante(Estudiante $estudiante)
    {
        try {
            $sql = "INSERT INTO estudiantes (nombres, apellidos, edad, programaFK) 
                    VALUES (:nombres, :apellidos, :edad, :programaFK)";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindValue(':nombres', $estudiante->getNombres());
            $sentencia->bindValue(':apellidos', $estudiante->getApellidos());
            $sentencia->bindValue(':edad', $estudiante->getEdad(), $estudiante->getEdad() !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
            $sentencia->bindValue(':programaFK', $estudiante->getProgramaFK(), $estudiante->getProgramaFK() !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
            $sentencia->execute();
            return $this->conexion->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function EditarEstudiante(Estudiante $estudiante)
    {
        try {
            $sql = "UPDATE estudiantes 
                    SET nombres = :nombres, apellidos = :apellidos, edad = :edad, programaFK = :programaFK 
                    WHERE estudianteID = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindValue(':nombres', $estudiante->getNombres());
            $sentencia->bindValue(':apellidos', $estudiante->getApellidos());
            $sentencia->bindValue(':edad', $estudiante->getEdad(), $estudiante->getEdad() !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
            $sentencia->bindValue(':programaFK', $estudiante->getProgramaFK(), $estudiante->getProgramaFK() !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
            $sentencia->bindValue(':id', $estudiante->getId(), PDO::PARAM_INT);
            $sentencia->execute();
            return ($sentencia->rowCount() > 0);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function EliminarEstudiante($id)
    {
        try {
            $sql = "DELETE FROM estudiantes WHERE estudianteID = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
            $sentencia->execute();
            return ($sentencia->rowCount() > 0);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarProgramas()
    {
        try {
            $sql = "SELECT programaID, nombre FROM programa ORDER BY nombre ASC";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}