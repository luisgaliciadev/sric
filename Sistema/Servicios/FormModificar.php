<?php 
	$Nivel="../../";
	include($Nivel."Includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	ValidarSesion($Nivel);
	
	$ID=$_GET['ID'];

	$vSQL="SELECT * FROM VIEW_DOMINIOS_HOST WHERE ID_SERVICIO='$ID'";

	$ArregloResultado=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ArregloResultado["CONEXION"];
	
	if($CONEXION=="SI")
	{
		$ERROR=$ArregloResultado["ERROR"];
		
		if($ERROR=="NO")
		{
			$result=$ArregloResultado["RESULTADO"];
			
			$COD_CLIENTE=odbc_result($result,"ID_CLIENTE");	
			$ID_TIPO_PRODUCTO=odbc_result($result,"ID_TIPO_PRODUCTO");
			$ID_PROVEEDOR=odbc_result($result,"ID_PROVEEDOR");
			$DESCRIPCION=odbc_result($result,"DESCRIPCION");
			$FH_EMISION=odbc_result($result,"FH_EMISION");
			$FH_VENCIMIENTO=odbc_result($result,"FH_VENCIMIENTO");
			$ID_MONEDA=odbc_result($result,"ID_MONEDA");
			$PRECIO=odbc_result($result,"PRECIO");
					
			//$NB_EQUIPO=odbc_result($result,"NB_EQUIPO");
			//$IP=odbc_result($result,"IP");
			//$USUARIO=odbc_result($result,"USUARIO");
			//$CONTRASENA=odbc_result($result,"CONTRASENA");
			
		
			
		}
		else
		{
			$MSJ_ERROR=$ArregloResultado["MSJ_ERROR"];		
			
			echo $MSJ_ERROR;
		}
	}
	else
	{
		$MSJ_ERROR=$ArregloResultado["MSJ_ERROR"];		
		
		echo $MSJ_ERROR;
	}
	
	$Conector->Cerrar();
	
	$Nivel="";
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    	<form id="vForm">
        	<input id="ID" type="hidden" value="<?php echo $ID;?>">
			
            <div class="form-group">
			<label>Cliente:</label>
                    <select class="form-control" required name="COD_CLIENTE" id="COD_CLIENTE" >
                    	<option value="" disabled>Seleccione...</option>
<?php 
						$Conector=Conectar();	

                        $vSQL='SELECT COD_CLIENTE,NB_CLIENTE  FROM VIEW_CLIENTE_LISTADO ORDER BY NB_CLIENTE';
						$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                        
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {			
                                $COD_CLIENTE_A=odbc_result($result,'COD_CLIENTE');
								$NB_CLIENTE=utf8_encode(odbc_result($result,'NB_CLIENTE'));									
								
								if($COD_CLIENTE==$COD_CLIENTE_A)
																
									$selected=" selected ";	
																
								else	
														
									$selected="  ";	
									echo "<option value=\"$COD_CLIENTE_A\" $selected>$NB_CLIENTE</option>"; 
								                           
                            }
                        }
                        else
                        {	
                            echo $MSJ_ERROR;
                            exit;
                        }
                        
                        $Conector->Cerrar();
?>           
					</select>
            </div>

			<div class="form-group">
			<label>TIPO PRODUCTO:</label>
                    <select class="form-control" required name="ID_TIPO" id="ID_TIPO" >
                    	<option value="" disabled>Seleccione...</option>
<?php 
						$Conector=Conectar();	

                        $vSQL='SELECT ID_TIPO_EQUIPO,DS_EQUIPO  FROM TIPO_EQUIPO WHERE FG_SERVICIO = 1 ORDER BY ID_TIPO_EQUIPO';
						$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                        
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {			
                                $ID_TIPO_EQUIPO_A=odbc_result($result,'ID_TIPO_EQUIPO');
								$DS_EQUIPO=utf8_encode(odbc_result($result,'DS_EQUIPO'));									
								
								if($ID_TIPO_PRODUCTO==$ID_TIPO_EQUIPO_A)
																
									$selected=" selected ";	
																
								else	
														
									$selected="  ";	
									echo "<option value=\"$ID_TIPO_EQUIPO_A\" $selected>$DS_EQUIPO</option>"; 
								                           
                            }
                        }
                        else
                        {	
                            echo $MSJ_ERROR;
                            exit;
                        }
                        
                        $Conector->Cerrar();
?>           
					</select>
            </div>

			<div class="form-group">
			<label>PROVEEDOR:</label>
                    <select class="form-control" required name="ID_TIPO_PROVEEDOR" id="ID_TIPO_PROVEEDOR" >
                    	<option value="" disabled>Seleccione...</option>
<?php 
						$Conector=Conectar();	

                        $vSQL='SELECT ID_PROVEEDOR_SERVICIOS,NB_PROVEEDOR_SERVICIO  FROM TB_PROVEEDOR_SERVICIOS ORDER BY ID_PROVEEDOR_SERVICIOS';
						$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                        
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {			
                                $ID_PROVEEDOR_SERVICIOS_A=odbc_result($result,'ID_PROVEEDOR_SERVICIOS');
								$NB_PROVEEDOR_SERVICIO=utf8_encode(odbc_result($result,'NB_PROVEEDOR_SERVICIO'));									
								
								if($ID_PROVEEDOR==$ID_PROVEEDOR_SERVICIOS_A)
																
									$selected=" selected ";	
																
								else	
														
									$selected="  ";	
									echo "<option value=\"$ID_PROVEEDOR_SERVICIOS_A\" $selected>$NB_PROVEEDOR_SERVICIO</option>"; 
								                           
                            }
                        }
                        else
                        {	
                            echo $MSJ_ERROR;
                            exit;
                        }
                        
                        $Conector->Cerrar();
?>           
					</select>
            </div>			
			
			<div class="form-group">
                <label>DESCRIPCION:</label>
                <input id="DESCRIPCION" type="text" class="form-control" maxlength="250" value="<?php echo $DESCRIPCION;?>">
            </div>

			 <div class="form-group col-md-6">
                <label>FECHA EMISION:</label>
                <input id="FH_EMISION" type="text" class="form-control" required value="<?php echo $FH_EMISION;?>" readonly>
            </div>
			
			<div class="form-group col-md-6">
                <label>FECHA VENCIMIENTO:</label>
                <input id="FH_VENCIMIENTO" type="text" class="form-control" required value="<?php echo $FH_VENCIMIENTO;?>" >
            </div>

			<div class="form-group col-md-6">
			<label>MONEDA:</label>
                    <select class="form-control" required name="ID_MONEDA" id="ID_MONEDA" >
                    	<option value="" disabled>Seleccione...</option>
<?php 
						$Conector=Conectar();	

                        $vSQL='SELECT ID_MONEDA,DS_MONEDA  FROM TB_MONEDA ORDER BY ID_MONEDA';
						$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
                        
                        $CONEXION=$ResultadoEjecutar["CONEXION"];						
                        $ERROR=$ResultadoEjecutar["ERROR"];
                        $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
                        $result=$ResultadoEjecutar["RESULTADO"];
                        
                        if($CONEXION=="SI" and $ERROR=="NO")
                        {		
                            while ($registro=odbc_fetch_array($result))
                            {			
                                $ID_MONEDA_A=odbc_result($result,'ID_MONEDA');
								$DS_MONEDA=utf8_encode(odbc_result($result,'DS_MONEDA'));									
								
								if($ID_MONEDA==$ID_MONEDA_A)
																
									$selected=" selected ";	
																
								else	
														
									$selected="  ";	
									echo "<option value=\"$ID_MONEDA_A\" $selected>$DS_MONEDA</option>"; 
								                           
                            }
                        }
                        else
                        {	
                            echo $MSJ_ERROR;
                            exit;
                        }
                        
                        $Conector->Cerrar();
?>           
					</select>
            </div>

			<div class="form-group col-md-6">
                <label>PRECIO:</label>
                <input id="PRECIO" type="text" class="form-control"  required onkeypress="return NumCheck(event, this)" value="<?php echo $PRECIO;?>">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
				<button type="button" class="btn btn-success" onclick="Renovar()">Renovar</button>
            </div>
        </form>
        
        <script>
			$(document).ready(function(e) 
			{				
                window.parent.Cargando(0);
				//$('#PRECIO').inputmask('999.999.999.999,99999', { numericInput: true });
				$( "#FH_EMISION" ).datepicker(
				{
					format: 'dd/mm/yyyy',
					defaultDate: "+1w",
					changeYear: true,
					changeMonth: true,
					yearRange: '-100:+1',
					numberOfMonths: 1,
					monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
					monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
					monthStatus: 'Ver otro mes', 
					yearStatus: 'Ver otro año',
					dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
					dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
					dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
					
				});		

				$( "#FH_VENCIMIENTO" ).datepicker(
				{
					format: 'dd/mm/yyyy',
					defaultDate: "+1w",
					changeYear: true,
					changeMonth: true,
					yearRange: '-100:+1',
					numberOfMonths: 1,
					monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
					monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
					monthStatus: 'Ver otro mes', 
					yearStatus: 'Ver otro año',
					dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
					dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
					dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
					
				});				

				$('#vForm').on('submit', function(e) 
				{
					e.preventDefault();
					
					Guardar();
				});
            });
			
			function Guardar()
			{	                					
				
				ID=$("#ID").val();				
				var	COD_CLIENTE=$("#COD_CLIENTE").val();				
				var	ID_TIPO=$("#ID_TIPO").val();				
				var	ID_TIPO_PROVEEDOR=$("#ID_TIPO_PROVEEDOR").val();
				var	DESCRIPCION=$("#DESCRIPCION").val().toUpperCase();
				var	FH_EMISION=$("#FH_EMISION").val();							
				var	FH_VENCIMIENTO=$("#FH_VENCIMIENTO").val();				
				var	ID_MONEDA=$("#ID_MONEDA").val();				
				var	PRECIO=$("#PRECIO").val()
				
			// if(ValidarCorreoRegistro('CORREO', 'CORREO', 1)==0)
			// {
			// 	return;
            // }		
				
			Parametros="ID="+ID+"&COD_CLIENTE="+COD_CLIENTE+"&ID_TIPO="+ID_TIPO+"&ID_TIPO_PROVEEDOR="+ID_TIPO_PROVEEDOR+"&DESCRIPCION="+DESCRIPCION+"&FH_EMISION="+FH_EMISION+"&FH_VENCIMIENTO="+FH_VENCIMIENTO+"&ID_MONEDA="+ID_MONEDA+"&PRECIO="+PRECIO;
				
			//console.log(Parametros);
			//alert('OPERACION NO HABILIDATA POR EL MOMENTO')
			//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Servicios/ScriptModificar.PHP",			
					data: Parametros,	
					beforeSend: function() 
					{
						window.parent.Cargando(1);
					},												
					cache: false,			
					success: function(Resultado)
					{
						//alert(Resultado);
						//console.log(Resultado);
						if(window.parent.ValidarConexionError(Resultado)==1)
						{
							var Arreglo=jQuery.parseJSON(Resultado);
							
							var EXISTE=Arreglo['EXISTE'];
								
							if(EXISTE=="SI")
							{
								window.parent.Cargando(0);
								
								window.parent.MostrarMensaje("Amarillo", "Disculpe, Ya se encuentra registrado!");
								
								$("#NB").focus();
							}
							else
							{		
								window.parent.FiltroConsulta(1);
								
								window.parent.$("#vModal").modal('toggle');			
								
								window.parent.MostrarMensaje("Verde", "Operaci&oacuten realizada exit&oacutesamente!");
							}
						}		
					}						
				});
			}

			function Renovar()
			{	                					
				
				ID=$("#ID").val();												
				var	FH_VENCIMIENTO=$("#FH_VENCIMIENTO").val();			
			
				
			Parametros="ID="+ID+"&FH_VENCIMIENTO="+FH_VENCIMIENTO;
				
			//console.log(Parametros);
			//alert('OPERACION NO HABILIDATA POR EL MOMENTO')
			//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Servicios/ScriptRenovar.PHP",			
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
								
							if(EXISTE=="SI")
							{
								window.parent.Cargando(0);
								
								window.parent.MostrarMensaje("Amarillo", "Disculpe, Ya se encuentra registrado!");
								
								$("#NB").focus();
							}
							else
							{		
								window.parent.FiltroConsulta(1);
								
								window.parent.$("#vModal").modal('toggle');			
								
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

        </script>
    </body>
</html>