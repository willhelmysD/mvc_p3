<?php 
require_once "public/plantilla.html";
startblock('article');
?>
<h1>Eliminar Cursos:</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="text-muteds">Formulario Eliminar:</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE?>/curso/cambiarEstado" method="post" id="form-eliminar">
                    <input type="hidden" name="id" value="<?php echo $detalle->getID()?>" id="id">
                    <p>Cambiar Estado del curso <strong><?php echo $detalle->getNombre()?></strong> de 1 a 0.</p>
                    <a class="btn btn-sm btn-warning" type="button" href="<?php echo BASE?>/curso">Cancelar</a>
                    <button class="btn btn-sm btn-success" type="button" onclick="estadoCurso()">Enviar</button>                                                                         
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function estadoCurso(){
        var id = $('#id').val();
        if(id==""){
            alert("todos los campos son requeridos!");
            return false;
        }
        $("#form-eliminar").submit();
    }
</script>
<?php  endblock();?>
