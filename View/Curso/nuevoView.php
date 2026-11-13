<?php
require_once "Public/Plantilla.html";
startblock('article');
?>
<h1>Nuevo Curso:</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="text-muted mb-0">Formulario Nuevo:</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE ?>/curso/guardar" method="post" id="form-nuevo">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Curso:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" maxlength="45" required>
                    </div>
                    <a class="btn btn-sm btn-warning" href="<?php echo BASE ?>/curso">Cancelar</a>
                    <button class="btn btn-sm btn-success" type="button" onclick="guardarCurso()">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function guardarCurso() {
        var nombre = $.trim($('#nombre').val());
        if (nombre === "") {
            swal("Atención", "El nombre del curso es obligatorio.", "warning");
            return false;
        }
        if (nombre.length > 45) {
            swal("Atención", "El nombre no puede superar los 45 caracteres.", "warning");
            return false;
        }
        $("#form-nuevo").submit();
    }
</script>
<?php endblock(); ?>