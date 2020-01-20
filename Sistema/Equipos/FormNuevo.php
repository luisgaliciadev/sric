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
			

			<label>TIPO EQUIPO:</label>
		<select name="ID_TIPO" id="ID_TIPO" class="form-control" placeholder="Seleccione el tipo" required >
				<option value="" disabled selected>SELECCIONE TIPO...</option>
						<?php
							$Conector = Conectar();

							$vSQL = 'SELECT ID_TIPO_EQUIPO,DS_EQUIPO  FROM TIPO_EQUIPO ORDER BY ID_TIPO_EQUIPO';

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
                <label>NOMBRE:</label>
                <input id="NB_EQUIPO" type="text" maxlength="250" class="form-control" required>
            </div>
			
			<div class="form-group">
                <label>IP:</label>
                <input id="IP" type="text" maxlength="250" class="form-control" required>
            </div>

			<div class="form-group">
                <label>USUARIO:</label>
                <input id="USUARIO" type="text" maxlength="250" class="form-control" required>
            </div>

			<div class="form-group">
                <label>CONTRASEÑA:</label>
                <input id="CONTRASENA" type="text" maxlength="250" class="form-control" required>
            </div>

			

			<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
		     
        </form>
        
        <script>
			$(document).ready(function(e) 
			{				
                window.parent.Cargando(0);

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
				
				var	ID_TIPO=$("#ID_TIPO").val();
				var	COD_CLIENTE=$("#COD_CLIENTE").val();
				var	NB_EQUIPO=$("#NB_EQUIPO").val().toUpperCase();
				var	IP=$("#IP").val().toUpperCase();				
				var	USUARIO=$("#USUARIO").val().toUpperCase();
				var	CONTRASENA=$("#CONTRASENA").val();	
				
				
				Parametros="COD_CLIENTE="+COD_CLIENTE+"&NB_EQUIPO="+NB_EQUIPO+"&IP="+IP+"&USUARIO="+USUARIO+"&CONTRASENA="+CONTRASENA+"&ID_TIPO="+ID_TIPO;
				
				//alert(Parametros)
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Equipos/ScriptGuardar.PHP",			
					data: Parametros,	
					beforeSend: function() 
					{
						window.parent.Cargando(1);
					},												
					cache: false,			
					success: function(Resultado)
					{
						//alert(Resultado);
						
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

        </script>
    </body>
</html>