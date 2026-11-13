<?php
/** @var Estudiante[] $listado_estudiantes */
require_once "Public/Plantilla.html";
startblock('article');
?>
<h1>Listado de Estudiantes:</h1>
<div class="row justify-content-center mt-4">
    <div class="col-md-10">
        <div class="mb-3 text-right">
            <a class="btn btn-sm btn-primary" href="<?php echo BASE ?>/estudiante/nuevo">Nuevo Estudiante</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="text-muted">Estudiantes Registrados</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Edad</th>
                                <th>Programa</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listado_estudiantes)): ?>
                                <?php foreach ($listado_estudiantes as $est): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($est->getId(), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?php echo htmlspecialchars($est->getNombres(), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?php echo htmlspecialchars($est->getApellidos(), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?php echo htmlspecialchars($est->getEdad() ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?php echo htmlspecialchars($est->getProgramaNombre() ?? 'Sin programa', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="<?php echo BASE ?>/estudiante/detalle/<?php echo $est->getId() ?>">Editar</a>
                                            <a class="btn btn-sm btn-danger" href="<?php echo BASE ?>/estudiante/eliminar/<?php echo $est->getId() ?>">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No hay estudiantes registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endblock(); ?>