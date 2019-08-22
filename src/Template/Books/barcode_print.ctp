<?php
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
?>
<html>
<head>
<title>Barcode</title>
<style>
    body {
        margin: 0;
        padding: 0;
    }
	
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
      }
	
	.page{
	width:100%;
	height:100%;
	margin:0 auto;
	}
	
	.left {
	float: left;
	width: 25%;
	height: 10%;
	margin:0 auto;
	text-align:center;
 	line-height:65% !important;
	padding-top:3.6% !important;
	}
	
    @page {
        size: A4;
        margin: 0;
    }
	
    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
        }
    }
</style>
<style media="print">
  .brk
  {
	  page-break-after:always;
  }
</style>
</head>
<body>
	<div class="page">
	<?php
		foreach ($books as $book) 
		{
			?>
			<div class="left">
		      	<span>
		          	<font style="font-family:Verdana, Geneva, sans-serif; font-size:10px;">
		          		<strong>Alok School</strong><br />
		          		<font style="font-family:Verdana, Geneva, sans-serif; font-size:10px;">
		          			<strong><?php// echo $class_no; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $book_no; ?></strong>
		          		</font>
		          	</font><br />
		          	<?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($book->id, $generator::TYPE_CODE_39,1.2,'20')) . '" style="width:100px;height:25px">'; ?><br /><br />
		          	<font style="font-family:Verdana, Geneva, sans-serif; font-size:10px;">
		          		<strong><?php echo $book->id; ?></strong>
		          	</font>
		      	</span>
		       		
		    </div>
		    <?php
		}

	?>


	</div>
</body>
</html>
			