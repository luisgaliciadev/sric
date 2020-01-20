<?php
	$Nivel="../../";
	include($Nivel."Includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	$ID_USER=$_SESSION[$SISTEMA_SIGLA.'ID_USUARIO'];
	
	date_default_timezone_set('America/Caracas');

	$ID=$_POST['ID'];
	$COD_CLIENTE=$_POST['COD_CLIENTE'];
	$NB_EQUIPO=$_POST['NB_EQUIPO'];
	$IP=$_POST['IP'];
	$USUARIO=$_POST['USUARIO'];
	$CONTRASENA=$_POST['CONTRASENA'];
		
			
	$vSQL="EXEC [SP_EQUIPO_UPDATE] $COD_CLIENTE,'$NB_EQUIPO','$IP','$USUARIO','$CONTRASENA',$ID_USER,'$ID'";	


	
	$ResultadoEjecutar=$Conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="NO", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
	
	$CONEXION=$ResultadoEjecutar["CONEXION"];
	$ERROR=$ResultadoEjecutar["ERROR"];
	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
	$result=$ResultadoEjecutar["RESULTADO"];
	
	if($CONEXION=="SI" and $ERROR=="NO")
	{
		$EXISTE=odbc_result($result,"EXISTE");
		
		if($EXISTE)
		{
			$Arreglo["EXISTE"]="SI";
			
			$Arreglo["CONEXION"]=$CONEXION;	
			$Arreglo["ERROR"]=$ERROR;
		}
		else
		{
			$Arreglo["EXISTE"]="NO";
			
			$Arreglo["CONEXION"]=$CONEXION;	
			$Arreglo["ERROR"]=$ERROR;
		}
	}
	else
	{		
		$Arreglo["CONEXION"]=$CONEXION;	
		$Arreglo["ERROR"]=$ERROR;		
		$Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
	}
	
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();
?>