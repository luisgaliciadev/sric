<?php
	$Nivel="../../";
	include($Nivel."Includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	date_default_timezone_set('America/Caracas');
	
	$ID_USER=$_SESSION[$SISTEMA_SIGLA.'ID_USUARIO'];
	$COD_CLIENTE=$_POST['COD_CLIENTE'];
	$ID_TIPO=$_POST['ID_TIPO'];
	$ID_TIPO_PROVEEDOR=$_POST['ID_TIPO_PROVEEDOR'];
	$DESCRIPCION=$_POST['DESCRIPCION'];
	$FH_EMISION=$_POST['FH_EMISION'];	
	$FH_VENCIMIENTO=$_POST['FH_VENCIMIENTO'];
	$ID_MONEDA=$_POST['ID_MONEDA'];	
	$PRECIO=$_POST['PRECIO'];		

	$vSQL= "EXEC [SP_SERVICIOS_INSERT]  $COD_CLIENTE,$ID_TIPO,$ID_TIPO_PROVEEDOR,'$DESCRIPCION','$FH_EMISION','$FH_VENCIMIENTO',$ID_MONEDA,$PRECIO,$ID_USER";	
	
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
			$ID=odbc_result($result,"ID");
						
			$Arreglo["ID"]=$ID;
			$Arreglo["EXISTE"]="NO";			
			$Arreglo["CONEXION"]=$CONEXION;	
			$Arreglo["ERROR"]=$ERROR;
			$Arreglo["MENSAJE"]=$MENSAJE;
			$Arreglo["vSQL"]=$vSQL;
			
		}
	}
	else
	{		
		$Arreglo["CONEXION"]=$CONEXION;	
		$Arreglo["ERROR"]=$ERROR;		
		$Arreglo["MSJ_ERROR"]=$MSJ_ERROR;
		$Arreglo["vSQL"]=$vSQL;
	}
	
	echo json_encode($Arreglo);
	
	$Conector->Cerrar();
?>