<?php 
require_once "public/plantilla.html";
startblock('article');
?>
<h1>Resultado:</h1>
<div class="row justify-content-center">
    <div class="col-md-4 text-center">
        <h2 class="text-info">
            <?php echo $result?>
        </h2>
        <a class="btn btn-info btn-sm" href="<?php echo BASE?>/curso">Volver a cursos</a>
    </div>
</div>
<?php  endblock();?>
