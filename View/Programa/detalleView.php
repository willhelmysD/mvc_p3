<?php
require_once "Public/Plantilla.html";
startblock('article');
?>
<h1>Detalle Programa:</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="text-muted mb-0">Formulario Editar:</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE ?>/programa/editar" method="post" id="form-editar">
                    <input type="hidden" name="id" value="<?php echo $detalle->getId(); ?>" id="id">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Programa:</label>
                        <input type="text" class="form-control" name="nombre"
                               value="<?php echo htmlspecialchars($detalle->getNombre(), ENT_QUOTES, 'UTF-8'); ?>"
                               id="nombre" maxlength="45" required>
                    </div>
                    <a class="btn btn-sm btn-warning" href="<?php echo BASE ?>/programa">Cancelar</a>
                    <button class="btn btn-sm btn-success" type="button" onclick="editarPrograma()">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function editarPrograma() {
        var id = $.trim($('#id').val());
        var nombre = $.trim($('#nombre').val());
        if (id === "" || nombre === "") {
            swal("Atención", "Todos los campos son requeridos.", "warning");
            return false;
        }
        if (nombre.length > 45) {
            swal("Atención", "El nombre no puede superar los 45 caracteres.", "warning");
            return false;
        }
        $("#form-editar").submit();
    }
</script>
<?php endblock(); ?>