<?php 
require_once "public/plantilla.html";
startblock('article');
?>
    <h1>Cursos:</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="text-muteds">Listado Curso:</h5>
                        </div>
                        <div class="col-md-4">
                            <a href="<?php echo BASE?>/curso/nuevo" type="button" class="btn btn-primary btn-sm">Nuevo Curso</a>
                        </div>
                    </div>
                </div>                
                <div class="card-body">
                    <table>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>accion</th>
                        </tr>
                        <?php foreach($listado_cursos as $curso){?>
                        <tr>
                            <td><?php echo $curso->getID()?></td>
                            <td><?php echo $curso->getNombre()?></td>
                            <td><?php echo $curso->getEstado()?></td>
                            <td>
                                <a 
                                type="button" 
                                class="btn btn-info btn-sm"
                                href="<?php echo BASE?>/curso/detalle/<?php echo $curso->getID()?>">
                                Detalles
                                </a>
                                <a 
                                type="button" 
                                class="btn btn-danger btn-sm"
                                href="<?php echo BASE?>/curso/eliminar/<?php echo $curso->getID()?>">
                                Eliminar
                                </a>                                
                            </td>
                        </tr>
                        <?php }?>

                    </table>

                </div>
            </div>

        </div>

    </div>

<?php  endblock();?>
