<?php 
include '../dbcon.php';
	$getC = "SELECT * FROM `customers` WHERE `c_id`='$c_id' ";
	$cquery = $con->query($getC);
	$crow = $cquery->fetch_array();
	$d_id = $crow['d_id'];
	$drow = getSpDiscounts($d_id)->fetch_array();
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
			font-family: courier new, sans-serif;
		    font-size: 8px;
		    font-weight: 900;
		    line-height: 1.2;
		    box-sizing: border-box;
		}
		.table{
			border-collapse: collapse;
			width: 45mm;

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
				padding: 8px;
			}
			.table tfoot td{
				padding: 5px;
			}
			.table td{
				padding: 3px;
			}
		
		hr{
			width: 50mm;
		}
		#atayss th{
			font-size: 11px !important;
		}
		#atayss #att{
			font-size:7px !important;
		}
	@media print {

		hr{
			width: 45mm;
		}
		.table1 {
			margin-bottom: 20px;
		}
		@page {
		    margin: 0;
		  }
		*{
			padding: 0px;
			margin: 0px;
			font-family: courier new, sans-serif;
		    font-size: 8px;
		    font-weight: 900;
		    line-height: 1.2;
		}
		.table{
			border-collapse: collapse;
			width: 45mm;

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
			.table1 tbody td{
				padding: 8px;
			}
			.table tfoot td{
				padding: 5px;
			}
			#atayss th{
			font-size: 11px !important;
		}
		#atayss #att{
			font-size:7px !important;
		}
		}
	</style>
</head>
<body 

>
<table class="table" id="atayss">
	<tr>
		<th><?php echo $ssrow['ss_company'] ?></th> 
	</tr>
	<tr>
		<th align="center" id="att"><?php echo $ssrow['ss_address'] ?></th>
	</tr>
	<tr>
		<th align="center">RECIEPT</th>
	</tr>
	
	<tr>
		<td>DATE : <?php echo strtoupper(date("F d, Y", strtotime($crow['transaction_date']))) ?></td>
	</tr>
	<tr>
		<td>TRANSACTION CODE : <?php echo $crow['transaction_code'] ?></td>
	</tr>
</table>
<!-- <hr> -->
<table class="table1 table" >
	<thead>
		<tr>
			<th width="10%">#</th>
			<th width="40%">NAME</th>
			<th width="20%">PRICE</th>
			<th width="30">TOTAL</th>
		</tr>
	</thead>
	<tbody style="border-bottom: solid black 1px;border-top: solid black 1px;padding-top: 0px;padding-bottom: 0px;">
		
<?php 
	$grandtotal = 0;
	$itemlist = "SELECT * FROM `sales_report` WHERE `c_id`='$c_id'  GROUP BY `p_id` ";
	$itemquery = $con->query($itemlist);
	$i=0;
	while ($itemr = $itemquery->fetch_array()) {
		$i++;
		$p_id = $itemr['p_id'];
		$fck = "SELECT *, SUM(sale_qtty) as newqtty FROM `sales_report` WHERE `c_id`='$c_id' AND `p_id`='$p_id' ";
		$fckq = $con->query($fck);
		$fckr = $fckq->fetch_array();
		$getitemdata = "SELECT * FROM `product` WHERE `p_id`='$p_id' ";
		$itemdataq = $con->query($getitemdata);
		$idr = $itemdataq->fetch_array();
		$total = $itemr['sale_price'] * $fckr['newqtty'];
		$grandtotal = $grandtotal + $total;
 ?>
 <tr>
 	<td><?php echo $fckr['newqtty']; ?></td>
 	<td><?php echo $idr['p_name'] ?></td>
 	<td align="right"><?php echo number_format($itemr['sale_price'],2) ?></td>
 	<td align="right"><?php echo number_format($total,2) ?></td>
 </tr>
 
<?php } ?>
	<tr>
		<td></td>
		 	<td>&nbsp</td>
		 	<td></td>
		 	<td></td>
		 </tr>

</tbody>
<tfoot>
	<tr>
		<td align="right" colspan="2"><b>Number of items:</b></td>
		<td colspan="2"><b><?php echo $i ?></b></td>
	</tr>
	<tr>
		<td align="right" colspan="2"><b>Discount Availed</b></td>
		<td colspan="2"><b><?php echo $drow[2] ?></b></td>
	</tr>
	<tr>
		<td align="right" colspan="2"><b>Total Amount:</b></td>
		<td colspan="2"><b><?php echo '₱ '.number_format($grandtotal,2) ?></b></td>
	</tr>
	<tr>
		<td align="right" colspan="2"><b>Cash:</b></td>
		<td colspan="2"><b><?php echo '₱ '.number_format($crow['c_cash'],2) ?></b></td>
	</tr>
	<tr>
		<td align="right" colspan="2"><b>Change:</b></td>
		<td colspan="2"><b><?php echo '₱ '.number_format($crow['c_change'],2) ?></b></td>
	</tr>

</tfoot>
</table>
<hr>
<!-- <script>
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
</script> -->
</body>
</html>