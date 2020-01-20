<?php 
	$Nivel="../../";
	include($Nivel."Includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	ValidarSesion($Nivel);
	
	$ID=$_GET['ID'];

	$vSQL="SELECT * FROM VIEW_EQUIPOS_PC_LISTADO WHERE ID='$ID'";

	$ArregloResultado=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ArregloResultado["CONEXION"];
	
	if($CONEXION=="SI")
	{
		$ERROR=$ArregloResultado["ERROR"];
		
		if($ERROR=="NO")
		{
			$result=$ArregloResultado["RESULTADO"];
			
			$COD_CLIENTE=odbc_result($result,"COD_CLIENTE");		
			$NB_EQUIPO=odbc_result($result,"NB_EQUIPO");
			$IP=odbc_result($result,"IP");
			$USUARIO=odbc_result($result,"USUARIO");
			$CONTRASENA=odbc_result($result,"CONTRASENA");
			
		
			
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
                <label>NOMBRE:</label>
                <input id="NB_EQUIPO" type="text" class="form-control" maxlength="250" value="<?php echo $NB_EQUIPO;?>">
            </div>

			 <div class="form-group">
                <label>IP:</label>
                <input id="IP" type="text" class="form-control" maxlength="250" required value="<?php echo $IP;?>">
            </div>
			
			<div class="form-group">
                <label>USUARIO:</label>
                <input id="USUARIO" type="text" class="form-control" maxlength="250" required value="<?php echo $USUARIO;?>">
            </div>

			<div class="form-group">
                <label>CONTRASEÑA:</label>
                <input id="CONTRASENA" type="text" class="form-control" maxlength="250" required value="<?php echo $CONTRASENA;?>">
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
				var	COD_CLIENTE=$("#COD_CLIENTE").val();				
				var	NB_EQUIPO=$("#NB_EQUIPO").val().toUpperCase();
				var	IP=$("#IP").val();
				var	USUARIO=$("#USUARIO").val();
				var	CONTRASENA=$("#CONTRASENA").val();	
				
			// if(ValidarCorreoRegistro('CORREO', 'CORREO', 1)==0)
			// {
			// 	return;
            // }		
				
				Parametros="ID="+ID+"&COD_CLIENTE="+COD_CLIENTE+"&NB_EQUIPO="+NB_EQUIPO+"&IP="+IP+"&USUARIO="+USUARIO+"&CONTRASENA="+CONTRASENA;
				
			//	alert(Parametros);
			//return
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Equipos/ScriptModificar.PHP",			
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