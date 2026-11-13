<?php
/** @var string $result */
require_once "Public/Plantilla.html";
startblock('article');
?>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($result, ENT_QUOTES, 'UTF-8') ?>
        </div>
        <a class="btn btn-sm btn-warning" href="<?php echo BASE ?>/estudiante">Volver</a>
    </div>
</div>
<?php endblock(); ?>