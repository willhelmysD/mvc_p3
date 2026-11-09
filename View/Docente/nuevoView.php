<?php 
require_once "public/plantilla.html";
startblock('article');
?>
<h1>Nuevo Docente:</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="text-muteds">Formulario Nuevo:</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE?>/docente/guardar" method="post" id="form-nuevo">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="m-3">
                                <label for="nombre">Nombre:</label>                                    
                                <input class="form-control" name="nombre" id="nombre">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="m-3">
                                <label for="apellido">Apellido:</label>
                                <input class="form-control" name="apellido" id="apellido">
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="m-3">
                                <label for="estado">Estado</label>
                                <input class="form-control" name="estado" id="estado">
                            </div>
                        </div>                                                       
                    </div>  
                    
                    <a class="btn btn-sm btn-warning" type="button" href="<?php echo BASE?>/docente">Cancelar</a>
                    <button class="btn btn-sm btn-success" type="button" onclick="guardarDocente()">Guardar</button>                                                                         
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function guardarDocente(){

        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var estado = $('#estado').val();

        if(nombre =="" || apellido == "" || estado == ""){
            alert("todos los campos son requeridos!");
            return false;
        }

        $("#form-nuevo").submit();
        
    }
</script>
<?php  endblock();?>
