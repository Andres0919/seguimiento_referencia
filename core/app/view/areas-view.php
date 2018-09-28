<?php
 $areas = AreaData::getAll(); 
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" data-background-color="blue">
				<h4 class="title">Áreas</h4>
			</div>
			<div class="card-content table-responsive">
				<a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Nueva área</a>
				<?php if(count($areas)>0){ ?> <!--// si hay proyectos  -->
				<table class="table table-bordered table-hover">
					<thead>
						<th>NOMBRE</th>
						<th style="width:80px;"></th>
					</thead>
					<?php foreach($areas as $area){ ?>
					<tr>
						<td><?php echo $area->nombre; ?></td>
						<td style="width:80px;" class="td-actions">
							<a href="index.php?view=editArea&id=<?php echo $area->id;?>" class="btn btn-simple btn-warning btn-xs"><i class='fa fa-pencil'></i></a>
							<a href="index.php?action=delArea&id=<?php echo $area->id;?>" class="btn-simple btn btn-danger btn-xs"><i class='fa fa-remove'></i></a>
						</td>
					</tr>
					<?php }	?>
				</table>
			</div>
			<?php }else{ ?>
			<p class='alert alert-danger'>No hay áreas</p>
			<?php } ?>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva área</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="./index.php?action=addArea" method="POST">
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