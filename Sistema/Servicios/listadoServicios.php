<?php
$Nivel = "../../";
include($Nivel."includes/PHP/funciones.php");
session_start();
header("Content-type: text/html; charset=utf8");
$conector=Conectar();

require_once 'PHPExcel/PHPExcel.php';
//PARAMETROS
$BUSQUEDA=$_GET["BUSQUEDA"];
//$BUSQUEDA="AUDI";
//$rangofecha = $_GET["RangoFecha"];

//$fechas = explode("-",$rangofecha);

$objPHPExcel = new PHPExcel();

$tituloReporte = "LISTA DE PRODUCTOS";

$titulosColumnas = array ('ITEM','DESCRIPCION','TIPO','CLIENTE', 'FECHA VENCIMIENTO','ESTATUS');

$objPHPExcel->setActiveSheetIndex(0)
->mergeCells('A1:F1');

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1'  ,$tituloReporte);

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A3',  $titulosColumnas[0])
->setCellValue('B3',  $titulosColumnas[1])
->setCellValue('C3',  $titulosColumnas[2])
->setCellValue('D3',  $titulosColumnas[3])
->setCellValue('E3',  $titulosColumnas[4])
->setCellValue('F3',  $titulosColumnas[5]);
//->setCellValue('T3',  $titulosColumnas[20]);


$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
            'color'     => array(
                'rgb' => '000000'
            )
    ),
    'fill' => array(
        'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
        'color'	=> array('argb' => '3399FF')
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE                    
        )
    ), 
    'alignment' =>  array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'rotation'   => 0,
            'wrap'          => TRUE
    )
);

$estiloTituloColumnas = array(
    'font' => array(
        'name'      => 'Arial',
        'bold'      => true,
		'size' =>9,                         
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' 	=> array(
        'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'rotation'   => 90,
        'startcolor' => array(
            'rgb' => '3399FF'
        ),
        'endcolor'   => array(
            'argb' => 'bdbdbd'
        )
    )
    
);

//$vSQL = "SELECT * FROM VIEW_DOMINIOS_HOST WHERE NB_CLIENTE = $BUSQUEDA AND FG_ACTIVO = 1 ORDER BY NB_CLIENTE"; 
        
    $vSQL = "SELECT * FROM VIEW_DOMINIOS_HOST WHERE (NB_CLIENTE LIKE '%$BUSQUEDA%') AND
    FG_ACTIVO = 1 ORDER BY NB_CLIENTE"; 

// $vSQL = "SELECT * FROM VIEW_DOMINIOS_HOST WHERE  WHERE (NB_CLIENTE LIKE '%$BUSQUEDA%') OR
// (DS_EQUIPO LIKE '%audi%') OR (DESCRIPCION LIKE '%audi%') OR (NB_PROVEEDOR_SERVICIO LIKE '%audi%') OR
// (FH_VENCIMIENTO LIKE '%audi%') OR (ESTADO LIKE '%audi%') 
// FG_ACTIVO = 1 ORDER BY NB_CLIENTE"; 

   $ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
    $i = 4; 
    $j = 1;
    $CONEXION=$ResultadoEjecutar["CONEXION"];						
    $ERROR=$ResultadoEjecutar["ERROR"];
    $MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
    $resul=$ResultadoEjecutar["RESULTADO"]; 

    if($CONEXION=="SI" and $ERROR=="NO")
 
    {    
        while ($registro=odbc_fetch_array($resul))
		{ 
           
            $objPHPExcel->setActiveSheetIndex(0)
            
            ->setCellValue('A'.$i, $j)
            ->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'DESCRIPCION')))
			->setCellValue('C'.$i, utf8_encode(odbc_result($resul,'DS_EQUIPO')))
            ->setCellValue('D'.$i, utf8_encode(odbc_result($resul,'NB_CLIENTE')))
            ->setCellValue('E'.$i, utf8_encode(odbc_result($resul,'FH_VENCIMIENTO')))
            ->setCellValue('F'.$i, utf8_encode(odbc_result($resul,'ESTADO')));			
            $i ++;
            $j ++;
		}
		
		 // CONSULTAR RESUMEN 
		// 	$vSQL = "SELECT * FROM VIEW_DOMINIOS_HOST WHERE FG_ACTIVO = 1";  
		//    $ResultadoEjecutar=$conector->Ejecutar($vSQL, $INSERT_MAYUSCULA="SI", $SP_BITACORA='NO', $SP_ACCION='', $SP_NB_TABLA='', $SP_VALOR_CAMPO_ID='');
		// 	$i= $i+2;
		// 	$j= 1;
		// 	$CONEXION=$ResultadoEjecutar["CONEXION"];						
		// 	$ERROR=$ResultadoEjecutar["ERROR"];
		// 	$MSJ_ERROR=$ResultadoEjecutar["MSJ_ERROR"];
		// 	$resul=$ResultadoEjecutar["RESULTADO"];
		
		    // if($CONEXION=="SI" and $ERROR=="NO") 
 
			// {    
			// 	while ($registro=odbc_fetch_array($resul)) 
			// 	{ 

			// 		$objPHPExcel->setActiveSheetIndex(0)
			// 		->setCellValue('A'.$i, $j)
			// 		->setCellValue('B'.$i, utf8_encode(odbc_result($resul,'NB_RESUMEN')))
			// 		->setCellValue('C'.$i, (odbc_result($resul,'VALUE_RESUMEN')));
					
			// 		$i ++;
			// 		$j ++;
			// 	}
			// }
    }
	
	

else{

    }
    
    $estiloInformacion = new PHPExcel_Style();
	
    $estiloInformacion->applyFromArray
    (array(
			'font' => array(
			'name'      => 'Arial',               
			'color'     => array(
				'rgb' => 'bdbdbd'
			)
		),
		'fill' 	=> array(
			'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
			'color'		=> array('argb' => 'bdbdbd')
		),
		'borders' => array(
			'left'     => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN ,
				'color' => array(
					'rgb' => 'ffffff'
				)
			)             
		)
    ));
    
    $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($estiloTituloColumnas);
      
    for($i = 'A'; $i <= 'F'; $i++)
    {
        $objPHPExcel->setActiveSheetIndex(0)			
            ->getColumnDimension($i)->setAutoSize(TRUE);
    }

    $objPHPExcel->getActiveSheet()->setTitle('LISTADO DE PRODUCTOS');

    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
    
    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="LISTADO.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    ob_end_clean();
    ob_start();
    $objWriter->save('php://output');
    exit;
   
?>