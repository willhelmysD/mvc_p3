<?php
require_once "core/BaseDatos.php";
require_once "entities/Programa.php";

class ProgramaModel extends Conectar{

    public function __construct(){
        parent::__construct();
    }

    public function asegurarColumnaEstado(){
        try{
            $this->conexion->query("SELECT estado FROM programa LIMIT 1");
        }catch(Exception $e){
            try{
                $this->conexion->exec("ALTER TABLE programa ADD COLUMN estado INT DEFAULT 1");
            }catch(Exception $ex){}
        }
    }

    public function ListarProgramas(){
        try{
            $this->asegurarColumnaEstado();
            $sql = "select * from programa"; 
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();	
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);                           
            $lista = [];
            foreach ($resultados as $fila) {
                $programa = new Programa(
                    $fila['programaID'],
                    $fila['nombre'],
                    $fila['estado'] ?? 1
                    );
                $lista[] = $programa;
            }
            return $lista;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }    

    public function buscarPrograma($id){
        try{
            $this->asegurarColumnaEstado();
            $sql = "select * from programa where programaID = :id";				
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id', $id);						
            $sentencia->execute();			
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);	
            if($resultado){ 
                $programa = new Programa(
                    $resultado['programaID'],
                    $resultado['nombre'],
                    $resultado['estado'] ?? 1
                    );
                return $programa;
            }else{
                return null;
            }
        }catch(Exception $e){
            die($e->getMessage());
        }
    }        

    public function EditarPrograma(Programa $programa){
        try{
            $this->asegurarColumnaEstado();
            $sql = "UPDATE programa SET nombre = :n, estado = :e WHERE programaID = :id";
            $sentencia = $this->conexion->prepare($sql);	
            $sentencia->bindValue(':n', $programa->getNombre());
            $sentencia->bindValue(':e', $programa->getEstado());
            $sentencia->bindValue(':id', $programa->getId());		            
            $sentencia->execute();
            return($sentencia->rowCount() > 0) ? true : false;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }    

    public function EliminarPrograma($id){
        try{
            $this->asegurarColumnaEstado();
            $sql = "UPDATE programa SET estado = 0 WHERE programaID = :id";
            $sentencia = $this->conexion->prepare($sql);	
            $sentencia->bindValue(':id', $id);		            
            $sentencia->execute();
            return($sentencia->rowCount() > 0) ? true : false;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function GuardarPrograma(Programa $programa){
        try{
            $this->asegurarColumnaEstado();
            $sql = "INSERT INTO programa (nombre, estado) VALUES (:nombre, :estado)";
            $sentencia = $this->conexion->prepare($sql);	
            $sentencia->bindValue(':nombre', $programa->getNombre());		
            $sentencia->bindValue(':estado', $programa->getEstado());
            $sentencia->execute();
            $result = $this->conexion->lastInsertId();
            return $result;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
}
