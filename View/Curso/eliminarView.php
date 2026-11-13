<?php
require_once "Public/Plantilla.html";
startblock('article');
?>
<h1>Eliminar Curso:</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="text-muted mb-0">Confirmar Eliminación:</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE ?>/curso/borrar" method="post" id="form-eliminar">
                    <input type="hidden" name="id" value="<?php echo $detalle->getId(); ?>" id="id">
                    <p>¿Está seguro de eliminar el curso <strong><?php echo htmlspecialchars($detalle->getNombre(), ENT_QUOTES, 'UTF-8'); ?></strong>?</p>
                    <a class="btn btn-sm btn-warning" href="<?php echo BASE ?>/curso">Cancelar</a>
                    <button class="btn btn-sm btn-danger" type="button" onclick="eliminarCurso()">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function eliminarCurso() {
        var id = $.trim($('#id').val());
        if (id === "") {
            swal("Error", "ID de curso no válido.", "error");
            return false;
        }
        $("#form-eliminar").submit();
    }
</script>
<?php endblock(); ?>