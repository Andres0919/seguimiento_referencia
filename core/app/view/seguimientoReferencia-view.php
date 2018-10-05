<?php 
    $reference = ColeccionData::getReference($_GET['id']);
    $process = ProcessData::getAllProcessReference($_GET['id']);
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
            <div class="card-header" data-background-color="blue">
				<h4 class="title">Seguimiento detallado</h4>
			</div>
  			<div class="card-content table-responsive">
			  	<?php if(isset($user) && $user->rol = 1 ){ ?>
					<a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">INICIO REFERENCIA</a>
                <?php } ?>
                <div>
                    <h3><b><?php echo $reference->referencia ?></b></h3>
                    <p><?php echo $reference->categoria ?></p>
                    <p><em><?php echo $reference->muestra ?></em></p>
                    <p><b><?php echo $reference->coleccion ?></b></p>
                </div>
                <table>
                    <thead>
                        <td>ÁREA</td>
                        <td>ENCARGADO</td>
                        <td>FECHA INICIO</td>
                        <td>PINTAS</td>
                  </thead>
                  <?php foreach ($process as $proceso) { ?>
                    <?php $pintas = ProcessData::getPintasByProcess($proceso->id) ?>
                    <tr>
                        <td><?php echo $proceso->area ?></td>
                        <td><?php echo ($proceso->encargado == 'admin' )? 'Sin recibir' : $proceso->encargado ?> </td>
                        <td><?php echo ($proceso->fecha_inicio == '0000-00-00 00:00:00')? 'Sin recibir' : substr($proceso->fecha_inicio,0,11) ?></td>
                        <td>
                            <?php foreach ($pintas as $pinta ) { ?>
                                <p><?php echo $pinta->codigo ?> -> <?php echo ($pinta->fecha_fin == '0000-00-00 00:00:00' )? 'En curso' : substr($pinta->fecha_fin, 0,11)  ?> </p>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
			</div>
		</div>
	</div>
</div>