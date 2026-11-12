<?php
require_once "core/BaseDatos.php";
require_once "entities/Curso.php";

class CursoModel extends Conectar{

    public function __construct(){
        parent::__construct();
    }

    public function asegurarColumnaEstado(){
        try{
            $this->conexion->query("SELECT estado FROM curso LIMIT 1");
        }catch(Exception $e){
            try{
                $this->conexion->exec("ALTER TABLE curso ADD COLUMN estado INT DEFAULT 1");
            }catch(Exception $ex){}
        }
    }

    public function ListarCursos(){
        try{
            $this->asegurarColumnaEstado();
            $sql = "select * from curso"; 
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();	
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);                           
            $lista = [];
            foreach ($resultados as $fila) {
                $curso = new Curso(
                    $fila['cursoID'],
                    $fila['nombre'],
                    $fila['estado'] ?? 1
                    );
                $lista[] = $curso;
            }
            return $lista;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }    

    public function buscarCurso($id){
        try{
            $this->asegurarColumnaEstado();
            $sql = "select * from curso where cursoID = :id";				
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id', $id);						
            $sentencia->execute();			
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);	
            if($resultado){ 
                $curso = new Curso(
                    $resultado['cursoID'],
                    $resultado['nombre'],
                    $resultado['estado'] ?? 1
                    );
                return $curso;
            }else{
                return null;
            }
        }catch(Exception $e){
            die($e->getMessage());
        }
    }        

    public function EditarCurso(Curso $curso){
        try{
            $this->asegurarColumnaEstado();
            $sql = "UPDATE curso SET nombre = :n, estado = :e WHERE cursoID = :id";
            $sentencia = $this->conexion->prepare($sql);	
            $sentencia->bindValue(':n', $curso->getNombre());
            $sentencia->bindValue(':e', $curso->getEstado());
            $sentencia->bindValue(':id', $curso->getId());		            
            $sentencia->execute();
            return($sentencia->rowCount() > 0) ? true : false;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }    

    public function EliminarCurso($id){
        try{
            $this->asegurarColumnaEstado();
            $sql = "UPDATE curso SET estado = 0 WHERE cursoID = :id";
            $sentencia = $this->conexion->prepare($sql);	
            $sentencia->bindValue(':id', $id);		            
            $sentencia->execute();
            return($sentencia->rowCount() > 0) ? true : false;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function GuardarCurso(Curso $curso){
        try{
            $this->asegurarColumnaEstado();
            $sql = "INSERT INTO curso (nombre, estado) VALUES (:nombre, :estado)";
            $sentencia = $this->conexion->prepare($sql);	
            $sentencia->bindValue(':nombre', $curso->getNombre());		
            $sentencia->bindValue(':estado', $curso->getEstado());
            $sentencia->execute();
            $result = $this->conexion->lastInsertId();
            return $result;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
}
