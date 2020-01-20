<?php 
	$Nivel="../../";
	include($Nivel."Includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	ValidarSesion($Nivel);
	
	$ID=$_GET['ID'];

	$vSQL="SELECT * FROM VIEW_CLIENTE_LISTADO WHERE COD_CLIENTE=$ID";

	$ArregloResultado=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ArregloResultado["CONEXION"];
	
	if($CONEXION=="SI")
	{
		$ERROR=$ArregloResultado["ERROR"];
		
		if($ERROR=="NO")
		{
			$result=$ArregloResultado["RESULTADO"];
			
			$RUC_CLIENTE=odbc_result($result,"RUC_CLIENTE");		
			$NB_CLIENTE=odbc_result($result,"NB_CLIENTE");
			$DIRECCION_FISCAL=odbc_result($result,"DIRECCION_FISCAL");
			$TELEFONO=odbc_result($result,"TELEFONO");
			$CORREO=odbc_result($result,"CORREO");
			
		
			
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
                <label>Razon Social:</label>
                <input id="NB_CLIENTE" type="text" class="form-control" required value="<?php echo $NB_CLIENTE;?>">
            </div>
			
			<div class="form-group">
                <label>RUC:</label>
                <input id="RUC" type="text" class="form-control" required value="<?php echo $RUC_CLIENTE;?>" readonly>
            </div>

			<div class="form-group">
                <label>DIRECCION FISCAL:</label>
                <input id="DIRECCION" type="text" class="form-control" required value="<?php echo $DIRECCION_FISCAL;?>">
            </div>

			<div class="form-group">
                <label>TELEFONO:</label>
                <input id="TELEFONO" type="number" class="form-control" value="<?php echo $TELEFONO;?>">
            </div>

			<div class="form-group">
				<label>Correo:</label>
                <input type="text" class="form-control" placeholder="CORREO" required name="CORREO" id="CORREO" value="<?php echo $CORREO;?>"  autocomplete="off">
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
				$('#vForm').on('submit', function(e) 
				{
					e.preventDefault();
					
					Guardar();
				});
            });
			
			function Guardar()
			{	                					
				
				var	ID=$("#ID").val();
				
				var	RUC_CLIENTE=$("#RUC").val();
				var	NB_CLIENTE=$("#NB_CLIENTE").val();
				var	DIRECCION_FISCAL=$("#DIRECCION").val();
				var	TELEFONO=$("#TELEFONO").val();
				var	CORREO=$("#CORREO").val();	
				//console.log(CORREO);
				
			// if(ValidarCorreoRegistro('CORREO', 'CORREO', 1)==0)
			// {
			// 	return;
            // }		
				
				Parametros="ID="+ID+"&RUC_CLIENTE="+RUC_CLIENTE+"&NB_CLIENTE="+NB_CLIENTE+"&DIRECCION_FISCAL="+DIRECCION_FISCAL+"&TELEFONO="+TELEFONO+"&CORREO="+CORREO;
				
				//alert(Parametros);
				//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/clientes/ScriptModificar.PHP",			
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

        </script>
    </body>
</html>