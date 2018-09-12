<?php
 $plantas = PlantaData::getAll(); 
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" data-background-color="blue">
				<h4 class="title">Plantas</h4>
			</div>
			<div class="card-content table-responsive">
				<a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Nueva Planta</a>
				<?php if(count($plantas)>0){ ?> <!--// si hay plantas  -->
				<table class="table table-bordered table-hover">
					<tr>
						<th>Nombre</th>
						<th style="width:80px;"></th>
					</tr>
					<?php foreach($plantas as $planta){ ?>
					<tr>
						<td><?php echo $planta->nombre; ?></td>
						<td style="width:80px;" class="td-actions">
							<a href="index.php?view=editPlanta&id=<?php echo $planta->id;?>" class="btn btn-simple btn-warning btn-xs"><i class='fa fa-pencil'></i></a>
							<a href="index.php?action=delPlanta&id=<?php echo $planta->id;?>" class="btn-simple btn btn-danger btn-xs"><i class='fa fa-remove'></i></a>
						</td>
					</tr>
					<?php }	?>
				</table>
			<?php }else{ ?>
			<p class='alert alert-danger'>No hay plantas</p>
			<?php } ?>
			</div>			
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Planta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="./index.php?action=addPlanta" method="POST">
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
