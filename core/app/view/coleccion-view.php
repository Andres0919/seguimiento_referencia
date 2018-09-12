<?php
	$colecciones = ColeccionData::getAll();
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" data-background-color="blue">
				<h4 class="title">Colección</h4>
			</div>
			<div class="card-content table-responsive">
				<a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Nueva Colección</a>
			<?php
				if(count($colecciones)>0){ ?> <!-- // si hay usuarios -->
				<table class="table table-bordered table-hover">
					<tr>
						<th>Nombre</th>
						<th style="width:80px;"></th>
					</tr>
					<?php
					foreach($colecciones as $coleccion){?>
						<tr>
						<td><?php echo $coleccion->nombre; ?></td>
						<td style="width:80px;" class="td-actions">
							<a href="index.php?view=editColeccion&id=<?php echo $coleccion->id;?>" class="btn btn-simple btn-warning btn-xs"><i class='fa fa-pencil-square-o'></i></a>
							<a href="index.php?action=delColeccion&id=<?php echo $coleccion->id;?>"  class="btn-simple btn btn-danger btn-xs"><i class='fa fa-remove'></i></a>
						</td>
						</tr>
					<?php }	?>
				</table>
			<?php }else{ ?>
				<p class='alert alert-danger'>No hay colecciones</p>
			<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Estado Muestara</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="./index.php?action=addColeccion" method="POST">
		<div class="modal-body">
			<span>Nombre</span>
			<input name="nombre" type="text">
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Save changes</button>
		</div>
	  </form>
    </div>
  </div>
</div>