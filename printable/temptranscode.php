<?php 
include '../dbcon.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Customer's Receipt</title>
	<style type="text/css">
		.table1 {
			margin-bottom: 20px;
		}
		*{
			padding: 0px;
			margin: 0px;
			font-family: Arial, sans-serif;
		    font-size: 10px;
		    line-height: 1.2;
		}
		.table{
			border-collapse: collapse;
			width: 80%;

		}
		.header{
			text-align: center;
			margin-bottom: 20px;
			width: 100%;

		}
			.table th{
				padding: 3px;
			}
			.table tbody td{
				padding: 10px;
			}
			.table tfoot td{
				padding: 5px;
			}
			.table td{
				padding: 3px;
			}
		
	@media print {
		.table1 {
			margin-bottom: 20px;
		}
		@page {
		    margin: 0;
		  }
		*{
			padding: 0px;
			margin: 0px;
			font-family: Arial, sans-serif;
		    font-size: 13px;
		    line-height: 1.2;
		}
		.table{
			border-collapse: collapse;
			width: 80%;

		}
		.header{
			text-align: center;
			margin-bottom: 20px;
			width: 100%;

		}
			.table td{
				padding: 3px !important;
			}
			.table th{
				padding: 3px;
			}
			.table tbody td{
				padding: 10px;
			}
			.table tfoot td{
				padding: 5px;
			}
		}
	</style>
</head>
<body onload="window.print()">
	<table class="table ">
	<tr>
		<th><?php echo $ssrow['ss_company'] ?></th> 
	</tr>
	<tr>
		<th align="center"><?php echo $ssrow['ss_address'] ?></th>
	</tr>
	<tr>
		<th align="center">RECIEPT</th>
	</tr>
	<tr>
		<td>Temporary Transaction Code : <br> <i style="font-size:20px"><?php echo strtoupper($tempcode) ?></i></td>
	</tr>
</table>
<script>
  // Detect when the print dialog is closed
  if (window.matchMedia) {
    var mediaQueryList = window.matchMedia('print');
    mediaQueryList.addListener(function(mql) {
      if (!mql.matches) {
        // Close the window when the print dialog is closed
        window.close();
      }
    });
  } else {
    // Fallback for browsers that don't support matchMedia
    window.onafterprint = function() {
      window.close();
    };
  }
</script>
</body>
</html>