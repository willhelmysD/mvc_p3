<?php
require_once "Public/Plantilla.html";
startblock('article');
?>
<h1>Resultado:</h1>
<div class="row justify-content-center mt-4">
    <div class="col-md-5 text-center">
        <div class="alert alert-info">
            <h4 class="mb-0"><?php echo htmlspecialchars($result ?? 'Operación realizada.', ENT_QUOTES, 'UTF-8'); ?></h4>
        </div>
        <a class="btn btn-info btn-sm" href="<?php echo BASE ?>/curso">Volver a cursos</a>
    </div>
</div>
<?php endblock(); ?>