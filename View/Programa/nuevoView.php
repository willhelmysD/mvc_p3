<?php 
require_once "public/plantilla.html";
startblock('article');
?>
<h1>Nuevo Programa:</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="text-muteds">Formulario Nuevo:</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE?>/programa/guardar" method="post" id="form-nuevo">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="m-3">
                                <label for="nombre">Nombre:</label>                                    
                                <input class="form-control" name="nombre" id="nombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="m-3">
                                <label for="estado">Estado (1 Activo / 0 Inactivo):</label>
                                <input class="form-control" name="estado" id="estado" value="1">
                            </div>
                        </div>                                                       
                    </div>  
                    
                    <a class="btn btn-sm btn-warning" type="button" href="<?php echo BASE?>/programa">Cancelar</a>
                    <button class="btn btn-sm btn-success" type="button" onclick="guardarPrograma()">Guardar</button>                                                                         
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function guardarPrograma(){

        var nombre = $('#nombre').val();
        var estado = $('#estado').val();

        if(nombre == "" || estado == ""){
            alert("todos los campos son requeridos!");
            return false;
        }

        $("#form-nuevo").submit();
        
    }
</script>
<?php  endblock();?>
