<?php
/** @var Estudiante $detalle */
require_once "Public/Plantilla.html";
startblock('article');
?>
<h1>Eliminar Estudiante:</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="text-muted">Formulario Eliminar:</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE ?>/estudiante/borrar" method="post" id="form-eliminar">
                    <input type="hidden" name="id" value="<?php echo $detalle->getId() ?>" id="id">
                    <p>¿Está seguro de eliminar al estudiante <strong><?php echo htmlspecialchars($detalle->getNombres() . ' ' . $detalle->getApellidos(), ENT_QUOTES, 'UTF-8') ?></strong>?</p>
                    <a class="btn btn-sm btn-warning" href="<?php echo BASE ?>/estudiante">Cancelar</a>
                    <button class="btn btn-sm btn-danger" type="button" onclick="eliminarEstudiante()">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function eliminarEstudiante() {
        var id = $('#id').val();
        if (id == "") {
            alert("Todos los campos son requeridos!");
            return false;
        }
        $("#form-eliminar").submit();
    }
</script>
<?php endblock(); ?>