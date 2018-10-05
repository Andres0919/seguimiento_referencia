<?php 
	$user = Core::$user;
	if($user != '' && $user->nombre == 'admin'){
		$references = ProcessData::getAllActive();
	}elseif($user != ''){
		$references = ProcessData::getAllRefByCole($user->area_id);
	}else{
			$references = ProcessData::getAllActivePublic();
	}
	$colecciones = ColeccionData::getAll();
	$referencias = ReferenciaData::getAll();
	$muestras = KindData::getAll();
	$areas = AreaData::getAll();
?>
<?php  ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
  			<div class="card-content table-responsive">
			  	<?php if(isset($user) && $user->rol = 1 && $user->area_id = 19 ){ ?>
					<a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">INICIO REFERENCIA</a>
					<?php } ?>
				<?php if(count($references)>0){// si hay usuarios ?>
					<form class="search">
            <input id="searchTerm" placeholder="BUSCAR REFERENCIA..." type="text" onkeyup="doSearch()" autocomplete="off" />
					</form>
				<table class="table table-bordered table-hover" id="datos">
					<thead>
						<th>COLECCIÓN</th>
						<th>REFERENCIA</th>
						<th>ESTADO MUESTRA</th>
						<th>PROCESO</th>
						<th></th>
					</thead>
					<?php foreach($references as $refe){ ?>
						<tr data-toggle="modal" data-target="#<?php echo ($refe->isReceived )? 'entregar' : 'recibir'?>Modal" onclick="<?php echo ($refe->isReceived)? 'entregar' : 'recibir' ?>Ref(<?php echo $refe->id ?>)">
							<td><?php echo $refe->coleccion; ?></td>
							<td><?php echo $refe->referencia; ?></td>
							<td><?php echo $refe->muestra; ?></td>
							<td><?php echo $refe->area; ?></td>
							<td><?php echo ($refe->isReceived)? 'Entregar': 'Recibir'; ?></td>
							<?php if(isset($user) && $user->rol == 1){ ?>						
							<?php } ?>																
						</tr>
					<?php } ?>
				</table>
				<?php }else{ ?>
				<p class='alert alert-danger'>No Hay Referencias en curso</p>
				<?php }	?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva referencia en curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="./index.php?action=addnewProcessRef" method="POST">
		<div class="modal-body">
			<div class="create-header">
				<span for="coleccion">Colección</span>
				<input name="coleccion" list="coleccion" type="text" autocomplete="off" required>
				<datalist id="coleccion" name="coleccion">
					<option selected></option>
					<?php foreach($colecciones as $res){ ?>
						<option value="<?php echo $res->nombre;?>"></option>
					<?php } ?>
				</datalist>
				<span for="referencia">Referencia</span>
				<input name="referencia" list="referencia" type="text" autocomplete="off" required>
				<datalist id="referencia" name="referencia">
					<option selected></option>
					<?php foreach($referencias as $res){ ?>
						<option value="<?php echo $res->nombre;?>"></option>
					<?php } ?>
				</datalist>
			</div>
			<div class="create-body">
				<div class="muestra">
					<span>Muestra <a onclick="addMuestraSelect()">+</a></span>
					<select name="muestra[]" id="muestra" required>
						<option value=""></option>
						<?php foreach($muestras as $muestra){ ?>
						<option value="<?php echo $muestra->id ?>"><?php echo $muestra->nombre ?></option>
						<?php } ?>
					</select>
					
				</div>
				<div class="pinta">
					<span for="pinta">Pinta</span>
					<input type="text" name="pinta" id="pinta" required>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Crear</button>
		</div>
	  </form>
    </div>
  </div>
</div>
<div class="modal fade modaltr" id="recibirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">RECIBIR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="./index.php?action=recibirProcessRef" method="POST">
		<div class="modal-body">
			<div class="header">
				<b><p id="refRecibida" class="nameRef"></p></b>
				<em><span id="mueRecibida"></span></em><br/>
				<b><span id="colRecibida"></span></b>
			</div>
			<div class="body">
				<span id="pinRecibida"></span><br/>
				<?php if(!$user){ ?>
				<input type="password" class="pass" name="pass" placeholder="ingresar contraseña" required>
				<?php } ?>
			</div>
		</div>
		<div class="modal-footer">
			<input type="hidden" id="idR" name="idRecibir">
			<button type="submit" class="btn btn-primary">Recibir</button>
		</div>
	  </form>
    </div>
  </div>
</div>
<div class="modal fade modaltr" id="entregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
						<b><p id="refEntrega" class="nameRef"></p></b>
						<em><span id="mueEntrega"></span></em><br/>
						<b><span id="colEntrega"></span></b>
					</div>
					<div class="body">
						<span id="pinEntrega"></span><br/>
						<select name="area_id" id="area" required>
							<?php foreach ($areas as $area) { ?>
								<?php if($user != '' && $user->area_id == 19 && $area->id == 17){ ?>
									<option value="<?php echo $area->id ?>"><?php echo $area->nombre ?></option>
								<?php }elseif($user != '' && $user->area_id == 17 && $area->id == 18){ ?>
									<option value="<?php echo $area->id ?>"><?php echo $area->nombre ?></option>
								<?php }elseif($user != '' && $user->area_id == 18 && $area->id == 10){ ?>
									<option value="<?php echo $area->id ?>"><?php echo $area->nombre ?></option>
								<?php  }elseif($user == '' && ($area->id != 19 || $area->id != 17 || $area->id != 18)){ ?>
								<option value="<?php echo $area->id ?>"><?php echo $area->nombre ?></option>
								<?php } ?>
							<?php } ?>
						</select> <br/>
						<?php if(!$user){ ?>
						<input type="password" class="pass" name="pass" placeholder="ingresar contraseña" required>
						<?php } ?>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="idE" name="idEntrega">
					<button type="submit" class="btn btn-primary">Entregar</button>
				</div>
			</form>
    </div>
  </div>
</div>
<script>
	function addMuestraSelect(){
		let div = document.querySelector('.muestra');
		let options = document.querySelector('#muestra').options;
		
		let br = document.createElement('br');
		let selectList = document.createElement("select");
		selectList.classList.add('copia');
		selectList.name = 'muestra[]';	
		div.appendChild(br);
		div.appendChild(selectList);
		for(i = 0; i < options.length; i++){
			let option = document.createElement("option");
			option.value = options[i].value;
			option.innerHTML = options[i].innerHTML;
			selectList.appendChild(option);
		}

	}

	function recibirRef(id){
		let refRecibida = document.querySelector('#refRecibida');
		let colRecibida = document.querySelector('#colRecibida');
		let mueRecibida = document.querySelector('#mueRecibida');
		let pinRecibida = document.querySelector('#pinRecibida');
		let idInput = document.querySelector('#idR');
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
				// console.log(response);
				idInput.value = response.id;
				refRecibida.innerHTML = response.referencia;
				colRecibida.innerHTML = response.coleccion;
				mueRecibida.innerHTML = response.muestra;
				pinRecibida.innerHTML = '';
				response.pinta.forEach((pin) => pinRecibida.innerHTML += `#${pin.codigo} ` );

			}
		});
	}

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
				// console.log(response);
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
					console.log(check.checked);
					pinEntrega.appendChild(check);
					pinEntrega.innerHTML += `#${pin.codigo} `;
				});

			}
		});
	}
	function doSearch(){
			var tableReg = document.getElementById('datos');
			var searchText = document.getElementById('searchTerm').value;
			var cellsOfRow="";
			var found=false;
			var compareWith="";

			// Recorremos todas las filas con contenido de la tabla
			for (var i = 1; i < tableReg.rows.length; i++)
			{
					cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
					found = false;
					// Recorremos todas las celdas
					for (var j = 0; j < cellsOfRow.length && !found; j++)
					{
							compareWith = cellsOfRow[j].innerHTML;
							// Buscamos el texto en el contenido de la celda
							if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
							{
									found = true;
							}
					}
					if(found)
					{
							tableReg.rows[i].style.display = '';
					} else {
							// si no ha encontrado ninguna coincidencia, esconde la fila de la tabla
							tableReg.rows[i].style.display = 'none';
					}
			}
	}
        
</script>