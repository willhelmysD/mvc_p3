<?php 
require_once "public/plantilla.html";
startblock('article');
?>
<h1>Detalle Programas:</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="text-muteds">Formulario Editar:</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE?>/programa/editar" method="post" id="form-editar">
                    <input type="hidden" name="id" value="<?php echo $detalle->getID()?>" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="m-3">
                                <label for="nombre">Nombre:</label>                                    
                                <input class="form-control" name="nombre" value="<?php echo $detalle->getNombre()?>" id="nombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="m-3">
                                <label for="estado">Estado</label>
                                <input class="form-control" name="estado" value="<?php echo $detalle->getEstado()?>" id="estado">
                            </div>
                        </div>                                                       
                    </div>  
                    
                    <a class="btn btn-sm btn-warning" type="button" href="<?php echo BASE?>/programa">Cancelar</a>
                    <button class="btn btn-sm btn-success" type="button" onclick="editarPrograma()">Enviar</button>                                                                         
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function editarPrograma(){

        var id = $('#id').val();
        var nombre = $('#nombre').val();
        var estado = $('#estado').val();

        if(id=="" || nombre =="" || estado == ""){
            alert("todos los campos son requeridos!");
            return false;
        }

        $("#form-editar").submit();
        
    }
</script>
<?php  endblock();?>
