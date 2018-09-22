<?php
  $referencias = ReferenciaData::getAll(); 
	$familias = CategoryData::getAll();	
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" data-background-color="blue">
				<h4 class="title">Referencias</h4>
			</div>
			<div class="card-content table-responsive">
				<a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Nueva Referencia</a>
				<?php if(count($referencias)>0){ ?> <!--// si hay referencias -->
				<table class="table table-bordered table-hover">
					<thead>
						<th>NOMBRE</th>
						<th style="width:80px;"></th>
					</thead>
					<?php foreach($referencias as $referencia){ ?>
					<tr>
						<td><?php echo $referencia->nombre; ?></td>
						<td style="width:80px;" class="td-actions">
							<a href="index.php?view=editreferencia&id=<?php echo $referencia->id;?>" class="btn btn-simple btn-warning btn-xs"><i class='fa fa-pencil'></i></a>
							<a href="index.php?action=delreferencia&id=<?php echo $referencia->id;?>" class="btn-simple btn btn-danger btn-xs"><i class='fa fa-remove'></i></a>
						</td>
					</tr>
					<?php }	?>
				</table>
			<?php }else{ ?>
				<p class='alert alert-danger'>No hay referencias</p>
			<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Referencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="./index.php?action=addReferencia" method="POST">
		<div class="modal-body">
			<span>Nombre</span>
			<input name="nombre" type="text" autocomplete="off">
			<span>Familia</span>
			<select name="familia" id="familia">
				<?php foreach($familias as $familia){ ?>
					<option value="<?php echo $familia->id ?>"><?php echo $familia->nombre ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Crear</button>
		</div>
	  </form>
    </div>
  </div>
</div>