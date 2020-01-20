<?php 
	$Nivel="../../";
	include($Nivel."Includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	ValidarSesion($Nivel);
	
	$Nivel="";
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    	<form id="vForm">
            
		<div class="form-group">
			<label>CLIENTE:</label>
			<select name="COD_CLIENTE" id="COD_CLIENTE" class="form-control" placeholder="Seleccione el cliente" required >
				<option value="" disabled selected>SELECCIONE CLIENTE...</option>
						<?php
							$Conector = Conectar();

							$vSQL = 'SELECT COD_CLIENTE,NB_CLIENTE  FROM VIEW_CLIENTE_LISTADO ORDER BY NB_CLIENTE';

							$ResultadoEjecutar = $Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA = "NO", $SP_BITACORA = 'NO', $SP_ACCION = '', $SP_NB_TABLA = '', $SP_VALOR_CAMPO_ID = '');

							$CONEXION = $ResultadoEjecutar["CONEXION"];

							$ERROR = $ResultadoEjecutar["ERROR"];
							$MSJ_ERROR = $ResultadoEjecutar["MSJ_ERROR"];
							$resultPrin = $ResultadoEjecutar["RESULTADO"];

							if ($CONEXION == "SI" and $ERROR == "NO") {
								while (odbc_fetch_row($resultPrin)) {
								$COD_CLIENTE = odbc_result($resultPrin, "COD_CLIENTE");
								$NB_CLIENTE = odbc_result($resultPrin, "NB_CLIENTE");
						?>
							<option value="<?php echo $COD_CLIENTE; ?>"><?php echo $NB_CLIENTE; ?></option>
						<?php

						}
						} else {
							echo $MSJ_ERROR;
						}
						$Conector->Cerrar();
						?>
			</select>
		</div>
			
		<div class="form-group">				
			<label>TIPO PRODUCTO:</label>
			<select name="ID_TIPO" id="ID_TIPO" class="form-control" placeholder="Seleccione el tipo" required >
				<option value="" disabled selected>SELECCIONE TIPO...</option>
						<?php
							$Conector = Conectar();

							$vSQL = 'SELECT ID_TIPO_EQUIPO,DS_EQUIPO  FROM TIPO_EQUIPO WHERE FG_SERVICIO = 1 ORDER BY ID_TIPO_EQUIPO';

							$ResultadoEjecutar = $Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA = "NO", $SP_BITACORA = 'NO', $SP_ACCION = '', $SP_NB_TABLA = '', $SP_VALOR_CAMPO_ID = '');

							$CONEXION = $ResultadoEjecutar["CONEXION"];

							$ERROR = $ResultadoEjecutar["ERROR"];
							$MSJ_ERROR = $ResultadoEjecutar["MSJ_ERROR"];
							$resultPrin = $ResultadoEjecutar["RESULTADO"];

							if ($CONEXION == "SI" and $ERROR == "NO") {
								while (odbc_fetch_row($resultPrin)) {
								$ID_TIPO_EQUIPO = odbc_result($resultPrin, "ID_TIPO_EQUIPO");
								$DS_EQUIPO = odbc_result($resultPrin, "DS_EQUIPO");
						?>
							<option value="<?php echo $ID_TIPO_EQUIPO; ?>"><?php echo $DS_EQUIPO; ?></option>
						<?php

						}
						} else {
							echo $MSJ_ERROR;
						}
						$Conector->Cerrar();
						?>
			</select>
		</div>

		<div class="form-group">				
		<label>PROVEEDOR:</label>
		<select name="ID_TIPO_PROVEEDOR" id="ID_TIPO_PROVEEDOR" class="form-control" placeholder="Seleccione el Proveedor" required >
				<option value="" disabled selected>SELECCIONE PROVEEDOR...</option>
						<?php
							$Conector = Conectar();

							$vSQL = 'SELECT ID_PROVEEDOR_SERVICIOS,NB_PROVEEDOR_SERVICIO  FROM TB_PROVEEDOR_SERVICIOS ORDER BY ID_PROVEEDOR_SERVICIOS';

							$ResultadoEjecutar = $Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA = "NO", $SP_BITACORA = 'NO', $SP_ACCION = '', $SP_NB_TABLA = '', $SP_VALOR_CAMPO_ID = '');

							$CONEXION = $ResultadoEjecutar["CONEXION"];

							$ERROR = $ResultadoEjecutar["ERROR"];
							$MSJ_ERROR = $ResultadoEjecutar["MSJ_ERROR"];
							$resultPrin = $ResultadoEjecutar["RESULTADO"];

							if ($CONEXION == "SI" and $ERROR == "NO") {
								while (odbc_fetch_row($resultPrin)) {
								$ID_PROVEEDOR_SERVICIOS = odbc_result($resultPrin, "ID_PROVEEDOR_SERVICIOS");
								$NB_PROVEEDOR_SERVICIO = odbc_result($resultPrin, "NB_PROVEEDOR_SERVICIO");
						?>
							<option value="<?php echo $ID_PROVEEDOR_SERVICIOS; ?>"><?php echo $NB_PROVEEDOR_SERVICIO; ?></option>
						<?php

						}
						} else {
							echo $MSJ_ERROR;
						}
						$Conector->Cerrar();
						?>
			</select>
		</div>
			
			
			<div class="form-group">
                <label>DESCRIPCION:</label>
                <input id="DESCRIPCION" type="text" maxlength="250" class="form-control" required>
            </div>

			
			<div class="form-group col-md-6">
                <label>FECHA EMISION:</label>
                <input id="FH_EMISION" type="date" maxlength="250" class="form-control" required>
			</div>
			<div class="form-group col-md-6">
				<label>FECHA VENCIMIENTO:</label>
                <input id="FH_VENCIMIENTO" type="date" maxlength="250" class="form-control" required>
       		</div>
		
		

			<div class="form-group col-md-6">  
				<label>MONEDA:</label>
		<select name="ID_MONEDA" id="ID_MONEDA" class="form-control" placeholder="Seleccione el Proveedor" required >
				<option value="" disabled selected>SELECCIONE MONEDA...</option>
						<?php
							$Conector = Conectar();

							$vSQL = 'SELECT ID_MONEDA,DS_MONEDA  FROM TB_MONEDA ORDER BY ID_MONEDA';

							$ResultadoEjecutar = $Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA = "NO", $SP_BITACORA = 'NO', $SP_ACCION = '', $SP_NB_TABLA = '', $SP_VALOR_CAMPO_ID = '');

							$CONEXION = $ResultadoEjecutar["CONEXION"];

							$ERROR = $ResultadoEjecutar["ERROR"];
							$MSJ_ERROR = $ResultadoEjecutar["MSJ_ERROR"];
							$resultPrin = $ResultadoEjecutar["RESULTADO"];

							if ($CONEXION == "SI" and $ERROR == "NO") {
								while (odbc_fetch_row($resultPrin)) {
								$ID_MONEDA = odbc_result($resultPrin, "ID_MONEDA");
								$DS_MONEDA = odbc_result($resultPrin, "DS_MONEDA");
						?>
							<option value="<?php echo $ID_MONEDA; ?>"><?php echo $DS_MONEDA; ?></option>
						<?php

						}
						} else {
							echo $MSJ_ERROR;
						}
						$Conector->Cerrar();
						?>
			</select>

		    </div>
			
			<div class="form-group col-md-6">
                <label>PRECIO:</label>
                <input id="PRECIO" type="text" class="form-control"  required onkeypress="return NumCheck(event, this)">
            </div>

			
			
		<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
		     
        </form>
  <!-- <script src="Includes/Plugins/daterangepicker/daterangepicker.js"></script> -->

        <script>
			$(document).ready(function(e) 
			{				
				window.parent.Cargando(0);
				
			//$('#PRECIO').inputmask('999.999,99', { numericInput: true });						
				
			$('#RIF').keyup(function(event) 
			{
				var keycode = (event.keyCode ? event.keyCode : event.which);

				if(keycode == '13') 
				{
					$('#btnIngresar').click();
				}
			});

			// $('#RIF').blur(function(event) 
			// {
			// 	if($(this).val().length!=10 && $(this).val().length>0)
			// 	{
			// 		window.parent.MostrarMensaje("Rojo", "Disculpe, Ingrese un RIF valido.");
			// 		$("#RIF").focus();
			// 		return;					
			// 	}
			// });

			$('#RIF').keydown(function (e)
			{
				if (e.shiftKey == 1) 
				{
					return false
				}

				var code = e.which;
				var key;

				//alert(code);

				key = String.fromCharCode(code);

				switch(true)
				{
					//Tipo de personas
					case code == 86 || code == 69 || code == 71 || code == 74 || code == 80:
					//Keyboard numbers
					case code >= 48 && code <= 57:
					//Keypad numbers
					case code >= 96 && code <= 105:
					//Negative sign
					case code == 189 || code == 109:
					// 37 (Left Arrow), 39 (Right Arrow), 8 (Backspace) , 46 (Delete), 36 (Home), 35 (End), 
					case code == 37 || code == 39 || code == 8 || code == 46 || code == 35 || code == 36 || code == 9:
						return;
					break;
				}

				e.preventDefault();
			});

			// $("#RIF").inputmask("a9{1,9}",{"placeholder": ""});



				$('#vForm').on('submit', function(e) 
				{
					e.preventDefault();
					
					Guardar();
				});
            });
			
			function Guardar()
			{	                					
				
				var	COD_CLIENTE=$("#COD_CLIENTE").val();				
				var	ID_TIPO=$("#ID_TIPO").val();				
				var	ID_TIPO_PROVEEDOR=$("#ID_TIPO_PROVEEDOR").val();
				var	DESCRIPCION=$("#DESCRIPCION").val().toUpperCase();
				var	FH_EMISION=$("#FH_EMISION").val();							
				var	FH_VENCIMIENTO=$("#FH_VENCIMIENTO").val();				
				var	ID_MONEDA=$("#ID_MONEDA").val();				
				var	PRECIO=$("#PRECIO").val()
				//var	PRECIO=retornar_num_mask($("#PRECIO").val());
				
				
				Parametros="COD_CLIENTE="+COD_CLIENTE+"&ID_TIPO="+ID_TIPO+"&ID_TIPO_PROVEEDOR="+ID_TIPO_PROVEEDOR+"&DESCRIPCION="+DESCRIPCION+"&FH_EMISION="+FH_EMISION+"&FH_VENCIMIENTO="+FH_VENCIMIENTO+"&ID_MONEDA="+ID_MONEDA+"&PRECIO="+PRECIO;
				//console.log(Parametros);
				//alert(Parametros)
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Servicios/ScriptGuardar.PHP",			
					data: Parametros,	
					beforeSend: function() 
					{
						window.parent.Cargando(1);
					},												
					cache: false,			
					success: function(Resultado)
					{
						//alert(Resultado);
						console.log(Resultado);
						if(window.parent.ValidarConexionError(Resultado)==1)
						{
							var Arreglo=jQuery.parseJSON(Resultado);
							
							var EXISTE=Arreglo['EXISTE'];
							//alert(EXISTE)
							if(EXISTE=="SI")
							{
								window.parent.Cargando(0);
								
								window.parent.MostrarMensaje("Amarillo", "Disculpe, Ya se encuentra registrado!");
								
								$("#NB_SERVICIO").focus();
							}
							else
							{		
								window.parent.FiltroConsulta(1);
								
								window.parent.$("#vModal").modal('toggle');			
								//vSQL=Arreglo['vSQL'];
								//alert(vSQL)
								
								window.parent.MostrarMensaje("Verde", "Operaci&oacuten realizada exit&oacutesamente!");
							}
						}		
					}						
				});
			}
		
	function NumCheck(e, field) {
    key = e.keyCode ? e.keyCode : e.which
        // backspace
    if (key == 8) return true
        // 0-9
    if (key > 47 && key < 58) {
        if (field.value == "") return true
        regexp = /.[0-9]{20}$/
        return !(regexp.test(field.value))
    }
    // .
    if (key == 46) {
        if (field.value == "") return false
        regexp = /^[0-9]+$/
        return regexp.test(field.value)
    }
    // other key
    return false
	}

		function ValidarCorreoRegistro(ID, ID_ENLAZADO, MSJ)
		{
			var valor	=	$("#"+ID).val().trim();
			var input	=	$("#"+ID);
			var icono	=	$("#"+ID+"_ICONO");

			var valorE	=	$("#"+ID_ENLAZADO).val().trim();
			var inputE	=	$("#"+ID_ENLAZADO);
			var iconoE	=	$("#"+ID_ENLAZADO+"_ICONO");

			if(valor.length>0)
			{
				//alert(valor.length);
				// Patron para el correo
				var patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

				if(valor.search(patron)==0)
				{
					input.css("color", "#000");
					icono.css("color", "#777777");
				}
				else
				{
					input.css("color", "#DD4B39");
					icono.css("color", "#DD4B39");

					if(MSJ)
					{
						window.parent.MostrarMensaje("Rojo", "Por Favor Ingrese un Correo Valido!");
					}

					return 0;
				}

				if(valor!=valorE && valor.length>0 && valorE.length>0)
				{
					input.css("color", "#DD4B39");
					icono.css("color", "#DD4B39");

					inputE.css("color", "#DD4B39");
					iconoE.css("color", "#DD4B39");

					if(MSJ)
					{
						window.parent.MostrarMensaje("Rojo", "Disculpe, los correos no coinciden!");
					}

					return 0;
				}
				else
				{
					if(valor.length>0)
					{
						input.css("color", "#00a65a");
						icono.css("color", "#00a65a");
					}
					else
					{
						input.css("color", "#000");
						icono.css("color", "#777777");
					}

					if(valorE.length>0)
					{
						inputE.css("color", "#00a65a");
						iconoE.css("color", "#00a65a");
					}
					else
					{
						inputE.css("color", "#000");
						iconoE.css("color", "#777777");
					}
					
					return 1;
				}
			}
		}

		function retornar_num_mask(monto) {

		var monto_aux = monto.split(',')
		var new_monto = monto_aux[0].replace(/\./g, '');

		new_monto = new_monto.replace(/\_/g, '');
		return new_monto + "." + monto_aux[1]

		}

        </script>
    </body>
</html>