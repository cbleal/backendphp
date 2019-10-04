<?php 

require_once '../config.php';

// pegar os parâmetros passados por POST (painel_admin.php)
$dataInicial = $_POST['txtDataInicial'];
$dataFinal 	 = $_POST['txtDataFinal'];
$tipo 	 	 = $_POST['tipo'];

if ( $dataInicial == '' ) {
	$dataInicial = date('Y/m/d');	
} 
if ( $dataFinal == '' ) {
	$dataFinal   = date('Y/m/d');
}

// URL: https://github.com/dompdf/dompdf

// include autoloader
require_once '../dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml(file_get_contents($url."/rel/rel_mov_data.php?dataInicial=".$dataInicial."&dataFinal=".$dataFinal."&tipo=".$tipo));

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream(
	"relatorioMovData.pdf",
	array("Attachment" => false)
);

//Enviar orçamento por email
/*$to = 'cborgesleal@gmail.com';
$subject = 'Systec Orçamento';
$message = file_get_contents("http://localhost... sem id");
$dest = $email;
$headers = 'Content-Type: text/html; charset=utf-8;';
mail($to, $subject, $message, $headers);*/

?>