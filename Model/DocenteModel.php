<?php
require_once "core/BaseDatos.php";
require_once "entities/Docente.php";

class DocenteModel extends Conectar{

    public function __construct(){
        parent::__construct();
    }

    public function ListarDocentes(){

        try{           
            $sql = "select * from docente"; 
            $consulta =  $this->conexion->prepare($sql);
            $consulta->execute();	
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);                           
            $lista = [];
            foreach ($resultados as $fila) {
                $docente = new Docente(
                    $fila['docenteID'],
                    $fila['nombre'],
                    $fila['apellido'],
                    $fila['estado']
                    );
                $lista[] = $docente;
            }
            return $lista;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }    

    public function buscarDocente($id){
        try{
            $sql = "select * from docente where docenteID = :id";				
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id', $id);						
            $sentencia->execute();			
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);	
            if($resultado){ 
            $docente = new Docente(
                $resultado['docenteID'],
                $resultado['nombre'],
                $resultado['apellido'],
                $resultado['estado']
                );
                return $docente;
            }else{
                return null;
            }
        }catch(Exception $e){
            die($e->getMessage());
        }
    }        

    public function EditarDocente(Docente $docente){
        try{
            $sql = "UPDATE docente SET nombre = :n, apellido = :a, estado=:e WHERE docenteID = :id";
            $sentencia = $this->conexion->prepare($sql);	
            $sentencia->bindValue(':n', $docente->getNombre());
            $sentencia->bindValue(':a', $docente->getApellido());
            $sentencia->bindValue(':e', $docente->getEstado());
            $sentencia->bindValue(':id', $docente->getId());		            
            $sentencia->execute();
            return($sentencia->rowCount() > 0) ? true : false;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }    

    public function GuardarDocente(Docente $docente){
        try{
            $sql = "INSERT INTO docente (nombre, apellido, estado) VALUES (:nombre, :apellido, :estado)";
            $sentencia = $this->conexion->prepare($sql);	
            $sentencia->bindValue(':nombre', $docente->getNombre());		
            $sentencia->bindValue(':apellido',$docente->getApellido());	
            $sentencia->bindValue(':estado',$docente->getEstado());
            $sentencia->execute();
            $result = $this->conexion->lastInsertId();
            return $result;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    /*
    //READ
    public function findById($id){
        try{
            $sql = "select * from tabla where campo = :id";				
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id', $id);						
            $sentencia->execute();			
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);	
            if($resultado){ 
                //objeto                
                return //$objeto;
            }else{
                return null;
            }
        }catch(Exception $e){
            die($e->getMessage());
        }
    }    
    public function findAll(){

        try{           
            $sql = "select * from tabla"; 
            $consulta =  $this->conexion->prepare($sql);
            $consulta->execute();	
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);                           
            $lista = [];
            foreach ($resultados as $fila) {
                //objeto                
                $lista[] = //objeto;
            }
            return $lista;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
 
    public function update(Objeto $objeto){
        try{
            $sql = "UPDATE tabla SET valor1 = :valor1 WHERE valorID = :id";
            $sentencia = $this->conexion->prepare($sql);	
            $sentencia->bindValue(':valor1', $objeto->getValor1);		            
            $sentencia->bindValue(':id', $estudiante->getEstudianteId());		            
            $sentencia->execute();
            return($sentencia->rowCount() > 0) ? true : false;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }*/     
}    