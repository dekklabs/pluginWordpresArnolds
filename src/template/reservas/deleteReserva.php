<form action="<?php echo URL_BASE ?>&id=<?php echo $id ?>" method="POST" style="min-height: 550px;" class="d-flex flex-column justify-content-center">
    <input type="hidden" name="action" value="delete" >
    <h2 class="text-center mb-3">¿Seguro de eliminar esta reserva?</h2>
    <div style="display: flex;align-items: center;justify-content: center;">
        <button type="submit" class="btn btn-danger mr-2">Eliminar</button>
        <a href="<?php echo URL_BASE ?>" class="btn btn-primary d-block">Regresar</a>
    </div>
</form>