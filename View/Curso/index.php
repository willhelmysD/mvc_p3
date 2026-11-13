<?php
require_once "Public/Plantilla.html";
startblock('article');
?>
<h1>Cursos:</h1>

<div class="row justify-content-center mt-5">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="text-muted mb-0">Listado de Cursos:</h5>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="<?php echo BASE ?>/curso/nuevo" class="btn btn-primary btn-sm">Nuevo Curso</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($listado_cursos)) { ?>
                            <?php foreach ($listado_cursos as $curso) { ?>
                                <tr>
                                    <td><?php echo $curso->getId(); ?></td>
                                    <td><?php echo htmlspecialchars($curso->getNombre(), ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm"
                                           href="<?php echo BASE ?>/curso/detalle/<?php echo $curso->getId(); ?>">
                                            Detalles
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                           href="<?php echo BASE ?>/curso/eliminar/<?php echo $curso->getId(); ?>">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted">No hay cursos registrados.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endblock(); ?>