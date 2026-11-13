<?php
/** @var string $result */
require_once "Public/Plantilla.html";
startblock('article');
?>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($result, ENT_QUOTES, 'UTF-8') ?>
        </div>
        <a class="btn btn-sm btn-primary" href="<?php echo BASE ?>/estudiante">Volver al listado</a>
    </div>
</div>
<?php endblock(); ?>