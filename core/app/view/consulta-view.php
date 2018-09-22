<?php
	$user = Core::$user;
	 $activas = ProcessData::getAllActiveGroup();
	 $allProcess = ProcessData::getAll();
	 $processMolderia = ProcessData::getAllMolderia();
	 $areas = AreaData::getAll();
 ?>
<div class="row"> 
	<div class="col-md-12">
		<div class="card">
  			<div class="card-header" data-background-color="blue">
      			<h4 class="title">Referencias</h4>
  			</div>
			<main>
				<input id="tab1" type="radio" name="tabs" checked>
				<label for="tab1">EN CURSO</label>
				<input id="tab2" type="radio" name="tabs">
				<label for="tab2">HISTORICO</label>
				<?php if($user != null && ($user->nombre == 'admin' || $user->area_id == 4)){ ?>
				<input id="tab3" type="radio" name="tabs">
				<label for="tab3">MOLDERÍA</label>
				<?php } ?>
				<section id="content1">
					<div class="card-content table-responsive">
						<?php if(count($activas)>0){ ?> <!--// si hay tickets -->
						<table class="table table-bordered table-hover">
							<thead>
								<th>COLECCIÓN</th>
								<th>REFERENCIA</th>
								<th>ESTADO MUESTRA</th>
								<th>AREA</th>
								<th>ENCARGADO</th>
								<th style="width:120px;"></th>
							</thead>
							<?php
								foreach($activas as $activa){
							?>
							<tr>
								<td><?php echo $activa->coleccion; ?></td>
								<td><?php echo $activa->referencia; ?></td>
								<td><?php echo $activa->muestra ?></td>
								<td><?php echo $activa->area; ?></td>
								<td><?php echo ($activa->encargado != 'admin')? $activa->encargado : '-'; ?></td>
								<td style="width:120px;" class="td-actions">
									<?php echo ($activa->isReceived) ? 'RECIBIDO' : 'NO RECIBIDO' ?>
								</td>
							</tr>
						<?php } ?>
						</table> 
						<?php }else{ ?>
						<p class='alert alert-danger'>No hay referencias en curso</p>
						<?php } ?>
					</div>
				</section>
				<section id="content2">
					<div class="card-content table-responsive">
						<?php if(count($allProcess)>0){ ?> <!--// si hay tickets -->
						<table class="table table-bordered table-hover">
							<thead>
								<th>COLECCIÓN</th>
								<th>REFERENCIA</th>
								<th>MUESTRA</th>
							</thead>
							<?php
								foreach($allProcess as $process){
							?>
							<tr>
								<td><?php echo $process->coleccion; ?></td>
								<td><?php echo $process->referencia; ?></td>
								<td><?php echo $process->muestra; ?></td>
							</tr>
							<tr class="collapse" id="<?php echo $ticket->id; ?>">
								<td colspan="6" style="padding:0;" >	 
									<form class="form-group" method="POST" action="index.php?action=addcomment&id=<?php echo $ticket->id;?>">
										<textarea class="form-control col-md-12" id="comentario" name="comentario"  placeholder="Comentario..." ></textarea>
										<input type="submit" class="btn btn-primary btn-xs" value="Enviar">
									</form>
								</td>
							</tr>
						<?php } ?>
						</table> 
						<?php }else{ ?>
						<p class='alert alert-danger'>No hay historial</p>
						<?php } ?>
					</div>
				</section>
				<section id="content3">
					<div class="card-content table-responsive">
						<?php if(count($processMolderia)>0){ ?> <!--// si hay tickets -->
						<table class="table table-bordered table-hover">
							<thead>
								<th>COLECCIÓN</th>
								<th>REFERENCIA</th>
								<th>ESTADO MUESTRA</th>
							</thead>
							<?php
								foreach($processMolderia as $pmolderia){
							?>
							<tr data-toggle="modal" data-target="#entregarModal" onclick="entregarRef(<?php echo $pmolderia->id ?>)">
								<td><?php echo $pmolderia->coleccion; ?></td>
								<td><?php echo $pmolderia->referencia; ?></td>
								<td><?php echo $pmolderia->muestra; ?></td>
							</tr>
						<?php } ?>
						</table> 
						<?php }else{ ?>
						<p class='alert alert-danger'>No hay refencias disponibles</p>
						<?php } ?>
					</div>
				</section>
			</main>
		</div>		
	</div>
</div>
<!-- Button to Open the Modal -->
<div class="modal fade" id="entregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >ENTREGAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="./index.php?action=entregaProcessRef" method="POST">
		<div class="modal-body">
			<div class="header">
				<p id="refEntrega" class="nameRef"></p>
				<span id="mueEntrega"></span><br/>
				<span id="colEntrega"></span>
			</div>
			<div class="body">
				<span id="pinEntrega"></span>
				<select name="area_id" id="area" required>
						<option value=""></option>
						<?php foreach ($areas as $area) { ?>
							<option value="<?php echo $area->id ?>"><?php echo $area->nombre ?></option>
						<?php  } ?>
				</select>
			</div>
		</div>
		<div class="modal-footer">
			<input type="hidden" id="idE" name="idEntrega">
			<button type="submit" class="btn btn-primary">ENTREGAR</button>
		</div>
	  </form>
    </div>
  </div>
</div>
<script>
	function entregarRef(id){
		let refEntrega = document.querySelector('#refEntrega');
		let colEntrega = document.querySelector('#colEntrega');
		let mueEntrega = document.querySelector('#mueEntrega');
		let pinEntrega = document.querySelector('#pinEntrega');
		let idInput = document.querySelector('#idE');
		var params = {
                "id" : id
        };
        $.ajax({
			data:  params,
			url:   './?action=getRefById',
			dataType: 'json',
			type:  'get',
			beforeSend: function () {
			},
			success:  function (response) {
				console.log(response);
				idInput.value = response.id;
				refEntrega.innerHTML = response.referencia;
				colEntrega.innerHTML = response.coleccion;
				mueEntrega.innerHTML = response.muestra;
				while (pinEntrega.hasChildNodes()) {
    				pinEntrega.removeChild(pinEntrega.childNodes[0]);
				}
				response.pinta.forEach(function(pin){
					let check = document.createElement('INPUT');
					check.setAttribute("type", "checkbox");
					check.setAttribute('checked', true);
					check.name = 'pinta[]';
					check.value = pin.codigo;
					pinEntrega.appendChild(check);
					pinEntrega.innerHTML += `#${pin.codigo}`;
				});

			}
		});
	}
</script>
