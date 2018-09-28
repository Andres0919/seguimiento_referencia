<?php 
	$estados = KindData::getAll(); 
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" data-background-color="blue">
				<h4 class="title">Estados Muestra</h4>
			</div>
  			<div class="card-content table-responsive">
				<a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Nuevo Estado Muestra</a>
				<?php if(count($estados)>0){// si hay estadoMuestra ?>
				<table class="table table-bordered table-hover">
					<thead>
						<th>NOMBRE</th>
						<th style="width:80px;"></th>
					</thead>
					<?php foreach($estados as $estado){ ?>
						<tr>
							<td><?php echo $estado->nombre; ?></td>
							<td style="width:80px;" class="td-actions">
								<a href="index.php?view=editcategory&id=<?php echo $estado->id;?>" rel="tooltip" title="Editar" class="btn btn-simple btn-warning btn-xs"><i class='fa fa-pencil'></i></a>
								<a href="index.php?action=delEstadoMuestra&id=<?php echo $estado->id;?>" rel="tooltip" title="Eliminar" class=" btn-simple btn btn-danger btn-xs"><i class='fa fa-remove'></i></a>
							</td>
						</tr>
					<?php } ?>
				</table>
				<?php }else{ ?>
				<p class='alert alert-danger'>No hay Estado Muestra</p>
				<?php }	?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Estado Muestra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="./index.php?action=addEstadoMuestra" method="POST">
		<div class="modal-body">
			<span>Nombre</span>
			<input name="nombre" type="text" autocomplete="off" required>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Crear</button>
		</div>
	  </form>
    </div>
  </div>
</div>