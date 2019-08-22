<?php 
require_once(ROOT . DS  .'vendor' . DS  . 'autoload.php');
use Dompdf\Dompdf;
use Dompdf\Options;

// instantiate and use the dompdf class
$options = new Options();
$options->set('defaultFont', 'Times-Roman');
$dompdf = new Dompdf($options);
$dompdf->set_option('isHtml5ParserEnabled', true);
$html='<html>
		    <head>
		        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		        <title>'.$head_title.'</title>
		        <link rel="shortcut icon"  type="image/x-icon" href="'.$this->Url->build('/img/favicon.png').'"/>
			</head>
			<style>
			thead{
	            background-color: #f1f1f1;
	        }
			.lead {

			    font-size: 21px;

			}
			.lead {
			    margin-bottom: 20px;
			    font-size: 16px;
			    font-weight: 200;
			    line-height: 1.4;

			}
			@page { margin: 0.2in; }
			body{font-size:13px; border: 1px thin solid #c3b7b7; pedding:10mm;}
			.page-header {
			    padding-bottom: 9px;
			    margin: 40px 0 20px;
			    border-bottom: 1px thin solid #c3b7b7;
			}
			.table-striped > tbody > tr:nth-child(odd) > td,
			.table-striped > tbody > tr:nth-child(odd) > th {
			  background-color: #f3f4f54d;
			}
			.table-bordered {
			    border: 1px solid #ddd;
			}
			.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
			    border: 1px solid #ddd;
			}
			.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
			    padding: 4px;
			    line-height: 1.2;
			    vertical-align: top;
			    border-top: 1px solid #ddd;
			}

			.table {
			    width: 100%;
			}
			table {
			    max-width: 100%;
			    background-color: transparent;
			}
			table {
			    border-collapse: collapse;
			    border-spacing: 0;
			}
			#content_data{
				padding: 10px 10px 10px 10px;
			}
			
			</style>

			<body>';
				$html.=$this->fetch('content');
	$html.='</body>
		</html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($name,array('Attachment'=>0));
exit;
?>