<?php
/** @var array $programas */
require_once "Public/Plantilla.html";
startblock('article');
?>
<h1>Nuevo Estudiante:</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="text-muted">Formulario Registrar:</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE ?>/estudiante/guardar" method="post" id="form-nuevo">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="m-3">
                                <label for="nombres">Nombres:</label>
                                <input class="form-control" name="nombres" id="nombres" maxlength="45">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="m-3">
                                <label for="apellidos">Apellidos:</label>
                                <input class="form-control" name="apellidos" id="apellidos" maxlength="45">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="m-3">
                                <label for="edad">Edad:</label>
                                <input type="number" class="form-control" name="edad" id="edad" min="1" max="120">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="m-3">
                                <label for="programaFK">Programa:</label>
                                <select class="form-control" name="programaFK" id="programaFK">
                                    <option value="">-- Seleccione un programa --</option>
                                    <?php foreach ($programas as $prog): ?>
                                        <option value="<?php echo $prog['programaID'] ?>">
                                            <?php echo htmlspecialchars($prog['nombre'], ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-sm btn-warning" href="<?php echo BASE ?>/estudiante">Cancelar</a>
                    <button class="btn btn-sm btn-success" type="button" onclick="guardarEstudiante()">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function guardarEstudiante() {
        var nombres = $('#nombres').val().trim();
        var apellidos = $('#apellidos').val().trim();
        var edad = $('#edad').val().trim();
        var programaFK = $('#programaFK').val();

        if (nombres == "" || apellidos == "" || edad == "" || programaFK == "") {
            alert("Todos los campos son requeridos!");
            return false;
        }

        $("#form-nuevo").submit();
    }
</script>
<?php endblock(); ?>