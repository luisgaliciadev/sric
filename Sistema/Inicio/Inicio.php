<?php 
	$Nivel="../../";
	include($Nivel."Includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	ValidarSesion($Nivel);
	
	$vNB_MODULO=$_POST["vNB_MODULO"];	
	
	$Nivel="";
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	$RIF=$_SESSION[$SISTEMA_SIGLA.'RIF'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Inicio</title>
    <style type="text/css">
    .wrapper.wrapper-content.animated.fadeInRight .row .col-lg-12 .ibox.float-e-margins .ibox-title h5 {
	font-weight: bold;
	font-size: 18px;
}
    .wrapper.wrapper-content.animated.fadeInRight .row .col-lg-12 .ibox.float-e-margins .ibox-content {
	font-size: 18px;
	text-align: justify;
}
    </style>
	</head>
	<body>    
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-10">
				<h2><?php echo $vNB_MODULO;?></h2>
				<ol class="breadcrumb">
					<li>
						<a href="./">
							<i class="fa fa-home"></i> 
							<strong>Inicio</strong>
						</a>
					</li>
				</ol>
			</div>
		</div>
		   
		
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="col-lg-12">
					<div class="ibox float-e-margins">				
						<div class="ibox-content">
							<div class="row">
								<div class="col-lg-12" >
                                <H1 align="left"> Sistema de Registro de Informacion de Clientes - SRIC </H1>
									
									<table class="table">
                       <div class="col-lg-6">
                        <tbody>
                        <tr>
                            <td>
                                <div class="col-xs-10 col-lg-12" >
                                <button type="button" class="btn btn-w-m btn-success m-r-sm"><i class="fa fa  fa-address-card-o fa-5x"></i></button>
                               Información Centralizada de Clientes
                                </div>
                            </td>
							  
                       
                        </tr>
                        <tr>
								 <td>
									 <div class="col-xs-10 col-lg-12" >
									<button type="button" class="btn btn-w-m btn-success m-r-sm"> <i class="fa fa  fa-desktop fa-5x"></i></button>Información Centralizada de Equipos y Dispositivos
									</div>
								</td>
                        </tr>

						<tr>
								 <td>
									 <div class="col-xs-10 col-lg-12" >
									<button type="button" class="btn btn-w-m btn-success m-r-sm"> <i class="fa fa  fa-database fa-5x"></i></button>Información y Vigencia de Productos y Servicios
									</div>
								</td>
                        </tr>
                       
                            </tbody>
                            </div>
                    </table>
									
					
								</div>
							</div>						
						</div>
					</div>
				</div> 
			</div>
		</div>
        <script>
			$(document).ready(function(e) 
			{
				window.parent.Cargando(0);	
			
            });			
        </script>
	</body>
</html>
