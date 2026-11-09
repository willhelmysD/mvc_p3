<?php 
require_once "public/plantilla.html";
startblock('article');
?>
    <h1>Docentes:</h1>


    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="text-muteds">Listado Docente:</h5>
                        </div>
                        <div class="col-md-4">
                            <a href="<?php echo BASE?>/docente/nuevo" type="button" class="btn btn-primary btn-sm">Nuevo Docente</a>
                        </div>
                    </div>
                </div>                
                <div class="card-body">
                    <table>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Estado</th>
                            <th>accion</th>
                        </tr>
                        <?php foreach($listado_docentes as $docente){?>
                        <tr>
                            <td><?php echo $docente->getID()?></td>
                            <td><?php echo $docente->getNombre()?></td>
                            <td><?php echo $docente->getApellido()?></td>
                            <td><?php echo $docente->getEstado()?></td>
                            <td>
                                <a 
                                type="button" 
                                class="btn btn-info btn-sm"
                                href="docente/detalle/<?php echo $docente->getID()?>">
                                Detalles
                                </a>
                                <a 
                                type="button" 
                                class="btn btn-danger btn-sm"
                                href="docente/eliminar/<?php echo $docente->getID()?>">
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
