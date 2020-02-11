<div id="right-panel" class="right-panel">
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Panel</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="<?php echo URL_BASE ?>">Dashboard</a></li>
                                <li class="active"><?php echo $single['nombre'] ?> <?php echo $single['apellido'] ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="animated fadeIn">
            <div class="ui-typography">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="max-width: 100%;">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" value="<?php echo $single['nombre'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="apellido">Apellido</label>
                                            <input type="text" class="form-control" value="<?php echo $single['apellido'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nPersonas">Número de personas</label>
                                            <input type="text" class="form-control" value="<?php echo $single['nPersonas'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="hora">Hora</label>
                                            <input type="time" class="form-control" value="<?php echo $single['hora'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="fecha">Fecha</label>
                                            <input type="date" class="form-control" value="<?php echo $single['fecha'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="motivo">Motivo</label>
                                            <input type="text" class="form-control" value="<?php echo $single['motivo'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="correo">Correo</label>
                                            <input type="email" class="form-control" value="<?php echo $single['correo'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="celular">Celular</label>
                                            <input type="text" class="form-control" value="<?php echo $single['celular'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-12">
                                        <label for="comentario">Comentario</label>
                                        <textarea name="" id="" cols="30" rows="10" class="text-control w-100"><?php echo $single['comentario'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>