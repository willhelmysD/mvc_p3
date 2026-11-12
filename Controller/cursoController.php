<?php

require_once "Model/CursoModel.php";

class CursoController{

    private $model_curso;

    public function __construct(){
        $this->model_curso = new CursoModel();
    }

    public function inicio(){
        $listado_cursos = $this->model_curso->ListarCursos();
        require_once "View/Curso/index.php";
    }

    public function detalle($id){
        $id_curso = $id;
        $detalle = $this->model_curso->buscarCurso($id_curso);
        require_once "View/Curso/detalleView.php";
    }

    public function nuevo(){
        require_once "View/Curso/nuevoView.php";
    }

    public function eliminar($id){
        $id_curso = $id;
        $detalle = $this->model_curso->buscarCurso($id_curso);        
        require_once "View/Curso/eliminarView.php";
    }

    public function editar(){
        $id = trim($_POST['id'] ?? '');
        $nom = trim($_POST['nombre'] ?? '');
        $est = trim($_POST['estado'] ?? '');
        if($id === '' || $nom === '' || $est === ''){
            $result = "Todos los campos son requeridos";
            require_once "View/Curso/errorView.php";
        }else{
            $cur = new Curso($id, $nom, $est);
            $editar = $this->model_curso->EditarCurso($cur);
            if($editar){
                $result = "Proceso exitoso";
            }else{
                $result = "Nada que editar";
            }
            require_once "View/Curso/resultView.php";
        }
    }

    public function cambiarEstado(){
        $id = trim($_POST['id'] ?? '');
        if($id === ''){
            $result = "Todos los campos son requeridos";
            require_once "View/Curso/errorView.php";
        }else{
            $eliminar = $this->model_curso->EliminarCurso($id);
            if($eliminar){
                $result = "Proceso exitoso (Estado cambiado a 0)";
            }else{
                $result = "Nada que eliminar";
            }
            require_once "View/Curso/resultView.php";
        }
    }

    public function guardar(){
        $nom = trim($_POST['nombre'] ?? '');
        $est = trim($_POST['estado'] ?? '1');

        if($nom === '' || $est === ''){
            $result = "Todos los campos son requeridos";
            require_once "View/Curso/errorView.php";
        }else{
            $cur = new Curso(null, $nom, $est);
            $guardar = $this->model_curso->GuardarCurso($cur);
            if($guardar){
                $result = "Proceso exitoso";
            }else{
                $result = "Error al almacenar";
            }
            require_once "View/Curso/resultView.php";
        }        
    }

}
