<?php 
	$users = UserData::getAll();
	$plantas = PlantaData::getAll();
	$areas = AreaData::getAll();
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
  			<div class="card-header" data-background-color="blue">
      			<h4 class="title">Usuarios</h4>
  			</div>
  			<div class="card-content table-responsive">
				<a href="#" class="btn btn-info" data-toggle="modal" data-target="#newUser"><i class='fa fa-user'></i> Nuevo Usuario</a>
				<?php if(count($users)>0){ ?> <!-- // si hay usuarios --> 
					<table class="table table-bordered table-hover">
						<thead>
							<th>USUARIO</th>
							<th>CONTRASEÑA</th>
							<th>TIPO USUARIO</th>
							<th>PLANTA</th>
							<th>AREA</th>
							<th></th>
						</thead>
					<?php foreach($users as $user){	?>
						<tr>
							<td><?php echo $user->nombre; ?></td>
							<td><?php echo $user->contra; ?></td>
							<td><?php echo ($user->rol == 1) ? 'Administrador' : 'Normal'; ?></td>
							<td><?php echo $user->planta; ?></td>
							<td><?php echo $user->area; ?></td>
							<td style="width:180px;">
							<a href="index.php?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs" title="Editar">Editar</a>
							<a href="index.php?action=deluser&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs" title="Eliminar" >Eliminar</a>
							</td>
						</tr>
					<?php }	?>
					</table>
				<?php }else{ ?>
					<p class='alert alert-danger'>No hay Usuarios</p>
				<?php }	?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Crear Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="./index.php?action=addUser" method="POST">
		<div class="modal-body">
			<span>Usuario</span>
			<input type="text" name="usuario">
			<span>Contraseña</span>
			<input type="text" name="contra">
			<span>Administrador</span><input type="radio" name="rol" value="1" checked>
			<span>Usuario</span><input type="radio" name="rol" value="2">
			<select name="planta_id" id="planta_id">
				<option value=""></option>
				<?php foreach ($plantas as $planta) { ?>
					<option value="<?php echo $planta->id ?>"><?php echo $planta->nombre ?></option>
				<?php } ?>
			</select>
			<select name="area_id" id="area_id">
				<option value=""></option>
				<?php foreach ($areas as $area) { ?>
					<option value="<?php echo $area->id ?>"><?php echo $area->nombre ?></option>
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