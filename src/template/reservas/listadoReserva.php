<div id="right-panel" class="right-panel">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-4">
                                    <i class="pe-7s-users"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count"><?php echo $count_reservas ?></span></div>
                                        <div class="stat-heading">Total Reservas</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="pe-7s-cash"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text">$<span class="count">23569</span></div>
                                        <div class="stat-heading">Revenue</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-cart"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">3435</span></div>
                                        <div class="stat-heading">Sales</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div-->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-3">
                                    <i class="pe-7s-browser"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count"><?php echo $getContadorFechaMes->total ?></span></div>
                                        <div class="stat-heading"><?php echo $mes ?> <?php echo date("Y") ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="orders mb-4">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card" style="max-width: 100% !important;">
                            <div class="card-body">
                                <h2 class="box-title">Gráfico por mes</h2>
                            </div>
                            <div class="card-body">
                                <div id="charTemplate" class="loadingShow" style="position: relative;margin: auto;height: 40vh;">
                                    <div id="loadingChart"></div>
                                </div>
                            </div>
                        </div>
                        <?php if( sizeof($listado) != 0 ) : ?>
                        <div class="card" style="max-width: 100% !important;">
                            <div class="card-body">
                                <h2 class="box-title">Listado de Reservas</h2>
                            </div>
                            <div class="card-body" id="tablaReservas">
                                <div class="table-stats order-table ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>nPersonas</th>
                                                <th>fecha</th>
                                                <th>motivo</th>
                                                <th>Funcciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($listado as $key => $reserva) : ?>
                                            <tr>
                                                <td> <?php echo $reserva["id"] ?> </td>
                                                <td> <span class="product"><?php echo $reserva["nombre"] ?></span> </td>
                                                <td>  <span class="name"><?php echo $reserva["nPersonas"] ?></span> </td>
                                                <td> <span class="product"><?php echo $reserva["fecha"] ?></span> </td>
                                                <td> <span class="product"><?php echo $reserva["motivo"] ?></span> </td>
                                                <!-- Efecto de números -->
                                                <!-- <td><span class="count">123</span></td> -->
                                                <td>
                                                    <a class="badge badge-complete" href="<?php echo RESERVA_SINGLE ?>&id=<?php echo $reserva['id'] ?>" data-toggle="tooltip" data-placement="top" title="Ver Reserva"><i class="fas fa-eye"></i></a>
                                                    <a class="badge badge-danger" href="<?php echo RESERVA_DELETE ?>&id=<?php echo $reserva['id'] ?>"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div> <!-- /.table-stats -->
                            </div>
                        </div> <!-- /.card -->
                        <?php else: ?>
                            <div class="card w-100 h-100">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <p class="text-center">No hay datos</p>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-xl-12">
                        <div class="card bg-flat-color3" style="max-width: 100% !important;">
                            <div class="card-body">
                                <h2 class="box-title">Gráfico Motivos</h2>
                            </div>
                            <div class="card-body">
                                <div id="doughnutTemplate">
                                    <div id="loadingChart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>