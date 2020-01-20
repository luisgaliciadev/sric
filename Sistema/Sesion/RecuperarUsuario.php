<?php
	session_start();	
	
	$Nivel="../../";
	include($Nivel."Includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	date_default_timezone_set('America/Caracas');
	
	$UsuarioAD=$_POST['LOGIN'];
	
	$Arreglo["NB_USUARIO"]=$UsuarioAD;

	$vSQL="EXEC SP_SESION_RECUPERAR_USUARIO '$UsuarioAD';";	

	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');

	$CONEXION=$ResultadoEjecutar["CONEXION"];

	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$result=$ResultadoEjecutar["RESULTADO"];

	if($CONEXION=="SI" and $ERROR=="NO")
	{
		$RESULTADO=odbc_result($result,"RESULTADO");

		if($RESULTADO==-2)
		{
			$Arreglo["RESULTADO"]=-2;
		}
		else
		{
			if($RESULTADO==-1)
			{
				$Arreglo["RESULTADO"]=-1;
				$COUNT_CLAV_ERRA=odbc_result($result,"COUNT_CLAV_ERRA");
				$Arreglo["COUNT_CLAV_ERRA"]=$COUNT_CLAV_ERRA;
			}
			else
			{
				if($RESULTADO==0)
				{
					$Arreglo["RESULTADO"]=0;
				}
				else
				{
					if($RESULTADO==1)
					{
						$_SESSION[$SISTEMA_SIGLA.'FHUltimoIngreso']=date("Y-m-d h:i:s");
		
						$_SESSION[$SISTEMA_SIGLA.'ID_USUARIO']=odbc_result($result,"ID_USUARIO");					
						$_SESSION[$SISTEMA_SIGLA.'ID_UBICACION']=odbc_result($result,"ID_UBICACION");				
						$_SESSION[$SISTEMA_SIGLA.'ID_ROL']=odbc_result($result,"ID_ROL");				
						$_SESSION[$SISTEMA_SIGLA.'NB_ROL']=odbc_result($result,"NB_ROL");;				
						$_SESSION[$SISTEMA_SIGLA.'CI_USUARIO']=odbc_result($result,"CI_USUARIO");				
						$_SESSION[$SISTEMA_SIGLA.'NB_USUARIO']=odbc_result($result,"NB_USUARIO");	
						$_SESSION[$SISTEMA_SIGLA.'EMAIL']=odbc_result($result,"EMAIL");		
										
						$_SESSION[$SISTEMA_SIGLA.'ID_EMPRESA_USER']=odbc_result($result,"ID_EMPRESA_USER");
						$_SESSION[$SISTEMA_SIGLA.'LOGIN']=odbc_result($result,"LOGIN");		
						$_SESSION[$SISTEMA_SIGLA.'NOMBRE_EMPLE']=odbc_result($result,"NOMBRE_EMPLE");
						$_SESSION[$SISTEMA_SIGLA.'E_MAILU']=odbc_result($result,"E_MAILU");		
						$_SESSION[$SISTEMA_SIGLA.'TELEFU']=odbc_result($result,"TELEFU");
						$_SESSION[$SISTEMA_SIGLA.'FH_REGISTRO']=FechaNormal(odbc_result($result,"FH_REGISTRO"));
						
						
						$_SESSION[$SISTEMA_SIGLA.'ID_EMPRESA']=odbc_result($result,"ID_EMPRESA");
						$_SESSION[$SISTEMA_SIGLA.'RAZON_SOCIAL']=odbc_result($result,"RAZON_SOCIAL");
						$_SESSION[$SISTEMA_SIGLA.'RIF']=odbc_result($result,"RIF");
						$_SESSION[$SISTEMA_SIGLA.'TELEF1']=odbc_result($result,"TELEF1");
						$_SESSION[$SISTEMA_SIGLA.'TELEF2']=odbc_result($result,"TELEF2");
						$_SESSION[$SISTEMA_SIGLA.'E_MAIL1']=odbc_result($result,"E_MAIL1");
						$_SESSION[$SISTEMA_SIGLA.'E_MAIL2']=odbc_result($result,"E_MAIL2");
						
						$_SESSION[$SISTEMA_SIGLA.'BLOQUEADO']='NO';
	
	
						$Arreglo["RESULTADO"]=1;
					}
				}
			}
		}
	}
	else
	{			
		$Arreglo["CONEXION"]="NO";
		$Arreglo["ERROR"]=$ERROR;
		$Arreglo["MSJ_ERROR"]=$ResultadoEjecutar["MSJ_ERROR"];
	}
	
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();
?>