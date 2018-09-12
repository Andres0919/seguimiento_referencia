<?php
	 $activas = ProcessData::getAllActive();
	 $allProcess = ProcessData::getAll();
	 $processMolderia = ProcessData::getAllMolderia();
 ?>
<div class="row"> 
	<div class="col-md-12">
		<div class="card">
  			<div class="card-header" data-background-color="blue">
      			<h4 class="title">Referencias</h4>
  			</div>
			<main>
				<input id="tab1" type="radio" name="tabs" checked>
				<label for="tab1">En Curso</label>
				<input id="tab2" type="radio" name="tabs">
				<label for="tab2">Historial</label>
				<input id="tab3" type="radio" name="tabs">
				<label for="tab3">Moldería</label>
				<section id="content1">
					<div class="card-content table-responsive">
						<?php if(count($activas)>0){ ?> <!--// si hay tickets -->
						<table class="table table-bordered table-hover">
							<tr>
								<th>COLECCIÓN</th>
								<th>REFERENCIA</th>
								<th>ESTADO MUESTRA</th>
								<th>AREA</th>
								<th>ENCARGADO</th>
								<th style="width:120px;"></th>
							</tr>
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
							<tr>
								<th>COLECCIÓN</th>
								<th>REFERENCIA</th>
								<th>MUESTRA</th>
							</tr>
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
							<tr>
								<th>COLECCIÓN</th>
								<th>REFERENCIA</th>
								<th>ESTADO MUESTRA</th>
							</tr>
							<?php
								foreach($processMolderia as $pmoderia){
							?>
							<tr>
								<td><?php echo $pmoderia->coleccion; ?></td>
								<td><?php echo $pmoderia->referencia; ?></td>
								<td><?php echo $pmoderia->muestra; ?></td>
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
						<p class='alert alert-danger'>No hay refencias disponibles</p>
						<?php } ?>
					</div>
				</section>
			</main>
		</div>		
	</div>
</div>
<!-- Button to Open the Modal -->
