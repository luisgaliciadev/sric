<?php 
	$Nivel="../../";
	include($Nivel."Includes/PHP/funciones.php");
	
	$Conector=Conectar();
	
	session_start();	
	
	$SISTEMA_SIGLA=$_SESSION['SISTEMA_SIGLA'];
	
	$RIF=$_SESSION[$SISTEMA_SIGLA."RIF"];
	
	ValidarSesion($Nivel);
	
	$vNB_MODULO=$_POST["vNB_MODULO"];	
?>
<!DOCTYPE html>
<html >
	<head>
        <script>	
        </script>
	</head>
	<body>	
            
    <input type="hidden" id="MODULO" value="vID_MODULO"/>
    <input type="hidden" id="AscDesc" value="DESC"/>
    
    <!-- Content Header (Page header) -->
    
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2><?php echo $vNB_MODULO;?></h2>
			<?php echo construirBreadcrumbs(substr($_POST["vID_MODULO"], 6, strlen($_POST["vID_MODULO"])));?>
		</div>
	</div>   
    
    <!-- Modal -->
    <div class="modal fade" id="vModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="vModalTitulo"></h4>
                </div>
                <div class="modal-body" id="vModalContenido">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Diccionario -->
    <div class="modal fade" id="vModalDiccionario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:95% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="vModalTituloDiccionario"></h4>
                </div>
                <div class="modal-body" id="vModalContenidoDiccionario">
                </div>
            </div>
        </div>
    </div>	
    
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
					<div class="ibox-content">					
						<div id="FiltroConsulta">
						</div> 
                    </div>
                </div>
            </div>
		</div>
	</div>
     
		<script>		
			$(document).ready(function(e) 
			{
				window.parent.parent.Cargando(0);

				FiltroConsulta(1);
            });

			function FiltroConsulta(PagActual)
			{				
				var Parametros="";
				
				$.ajax(
				{
					type: "POST",
					dataType:"html",
					url: "Sistema/Servicios/FiltroConsulta.PHP",			
					data: Parametros,
					beforeSend: function() 
					{
						window.parent.parent.Cargando(1);
					},												
					cache: false,			
					success: function(Resultado)
					{
						window.parent.parent.Cargando(0);
						$("#FiltroConsulta").html(Resultado);

						//$('#tablaClientes').DataTable();						
				
						table = $('#tablaServicios').DataTable(
						{
							"paging": true,
							"lengthChange": true,
							"searching": true,
							"ordering": true,
							"info": true,
							"autoWidth": true,
							"language":
							{
								"sProcessing":     "Procesando...",
								"sLengthMenu":     "Mostrar _MENU_ registros",
								"sZeroRecords":    "No se encontraron resultados",
								"sEmptyTable":     "Ning??n dato disponible en esta tabla",
								"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
								"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
								"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
								"sInfoPostFix":    "",
								"sSearch":         "Buscar:",
								"sUrl":            "",
								"sInfoThousands":  ",",
								"sLoadingRecords": "Cargando...",
								"oPaginate": {
									"sFirst":    "Primero",
									"sLast":     "??ltimo",
									"sNext":     "Siguiente",
									"sPrevious": "Anterior"
								},
								"oAria": {
									"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
									"sSortDescending": ": Activar para ordenar la columna de manera descendente"
								}
							},
							"aaSorting":[[0,"asc"]]
						});
					}						
				});
			}

			function VER_ARCHIVO(){		
				//table.search( 'audi' ).draw();	
				//console.log(table.search());	
				//var Parametros=$("tablaServicios.searching").val();
				//var Parametros=table.search();
				//var Parametros="BUSQUEDA="+table.search()
				//var	FH_VENCIMIENTO=$("#FH_VENCIMIENTO").val();	
				//console.log(Parametros);
				//return;
				var Parametros="BUSQUEDA="+table.search();
				//console.log("Sistema/Servicios/listadoServicios.php"+"?"+Parametros);				
				//return;				
				window.parent.$("#Loading").css("display","");			
				window.open("Sistema/Servicios/listadoServicios.php"+"?"+Parametros);			
						
			}
			
			function callFormRegistrar(){
				window.parent.parent.Cargando(1);
				
				vModal('Sistema/Servicios/FormNuevo.php', 'Registrar Equipo');
			}
			
			function callFormModificar(ID){
				window.parent.parent.Cargando(1);

				vModal('Sistema/Servicios/formModificar.php?&ID='+ID, 'Modificar Equipo');
			}	

			function anular(ID) {
				swal({
					title: "??Estas seguro?",
					text: "Est&aacute seguro de anular este Equipo!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Aceptar",
					cancelButtonText: "Cancelar",
					closeOnConfirm: true
				}, function () {
					var parametros = '&ID='+ID;
						
					$.ajax({
						type: "POST",
						dataType:"html",
						url: "Sistema/Servicios/ScriptAnular.php",			
						data: parametros,
						beforeSend: function(){
							window.parent.parent.Cargando(1);
						},							
						success: function(Resultado){
							if(window.parent.ValidarConexionError(Resultado)==1){							
								Arreglo=jQuery.parseJSON(Resultado);

								FiltroConsulta(1);

								window.parent.MostrarMensaje ("Verde", "Operaci&oacuten realizada exit&oacutesamente.");
							}
						}						
					});					
				});
			}

			function activar(ID) {
				swal({
					title: "??Estas seguro?",
					text: "Est&aacute seguro de activar este cliente!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Aceptar",
					cancelButtonText: "Cancelar",
					closeOnConfirm: true
				}, function () {
					var parametros = '&ID='+ID;
						
					$.ajax({
						type: "POST",
						dataType:"html",
						url: "Sistema/Servicios/ScriptActivar.php",			
						data: parametros,
						beforeSend: function(){
							window.parent.parent.Cargando(1);
						},							
						success: function(Resultado){
							if(window.parent.ValidarConexionError(Resultado)==1){							
								Arreglo=jQuery.parseJSON(Resultado);

								FiltroConsulta(1);

								window.parent.MostrarMensaje ("Verde", "Operaci&oacuten realizada exit&oacutesamente.");
							}
						}						
					});					
				});
			}
			
			function vModal(URl, Titulo)
			{
				$("#vModalTitulo").html("");
				$("#vModalContenido").html("");
				
				$("#vModalTitulo").html(Titulo);
				$("#vModalContenido").load(URl);
				$("#vModal").modal();
			}
        </script>
	</body>
</html>
