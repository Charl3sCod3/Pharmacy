<?php 
include '../dbcon.php';
	$getC = "SELECT * FROM `customers` WHERE `c_id`='$c_id' ";
	$cquery = $con->query($getC);
	$crow = $cquery->fetch_array();
	$d_id = $crow['d_id'];
	$drow = getSpDiscounts($d_id)->fetch_array();

	$gc = getSpUser($crow['user_id'])->fetch_array();
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
	* {
    padding: 0;
    margin: 0;
    font-size: 8px;
    font-weight: 600;
    font-family: tahoma;
}

table {
    table-layout: fixed;
    width: 100%;
    border-collapse: collapse;
}

table thead th {
    width: 25% !important;
}

.rContent {
    margin-bottom: 20px;
}

#rContent {
    border-top: 1px dotted black;
}

#rContent tfoot {
    border-top: 1px dotted black;
}
#companynameis{
	font-size: 14px;
	font-weight: 600;
}
p{
	text-align: center;
}

@media print {
    @page {
        size: 43.5mm;
        margin: 1mm;
    }
    body {
        width: 43.5mm;
        margin: 1mm;
    }
    #companynameis{
	font-size: 14px;
	font-weight: 600;
}

}
	</style>
</head>
<body onload="window.print()">
<table >
	<tr>
		<th id="companynameis"><?php echo $ssrow['ss_company'] ?></th> 
	</tr>
	<tr>
		<th align="center" id="att"><?php echo $ssrow['ss_address'] ?></th>
	</tr>
	<tr>
		<th align="center" id="att">TIN :<?php echo strtoupper($ssrow['ss_tin_id']) ?></th>
	</tr>
	<tr>
		<th align="center" id="att">PERMIT: <?php echo strtoupper($ssrow['ss_permit']) ?></th>
	</tr>
	<tr>
		<th align="center">RECIEPT</th>
	</tr>
	<tr>
		<th align="center">&nbsp</th>
	</tr>
	<tr>
		<td>CASHIER : <?php echo strtoupper($gc['user_fullname']) ?></td>
	</tr>
	<tr>
		<td>DATE : <?php echo strtoupper(date("F d, Y", strtotime($crow['transaction_date']))) ?></td>
	</tr>
	<tr>
		<td>CODE : <?php echo $crow['transaction_code'] ?></td>
	</tr>
</table>
<br>
<table id="rContent" class="rContent" >
<!-- 	<thead>
		<tr>
			<th width="40%" >ITEM</th>
			<th >QTTY</th>
			<th >PRICE</th>
			<th >AMOUNT</th>
		</tr>
	</thead> -->
	<tbody style="border-bottom: solid black 1px;border-top: solid black 1px;padding-top: 0px;padding-bottom: 0px;">
		<tr>
			<td>&nbsp</td>
		</tr>
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
		$gpbc = getSpProduct($itemr['p_id'])->fetch_array();
		$gppc = getSpProdCat($idr['pc_id'])->fetch_array();
		$gpt = getSpProdType($idr['pct_id'])->fetch_array();
 ?>
 <tr>
 	<td></td>
 	<td align="center"><?php echo $fckr['newqtty']; ?></td>
 	<td align="right"><?php echo number_format($itemr['sale_price'],2) ?></td>
 	<td align="right"><?php echo number_format($total,2) ?></td>
 </tr>
 <tr>
 	<td colspan="4">Barcode: <?php echo $gpbc['product_code'] ?></td>
 </tr>
 <tr>
 		<td class="RpName" colspan="4"><?php echo strtoupper($idr['p_name']) ?> (<?php echo $gpt['pct_name'] ?>) "<?php echo $gppc['pc_name'] ?>"</td>
 </tr>
 <tr>
 	<td>&nbsp</td>
 </tr>
 
<?php } ?>
	<tr>
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
<p>
	Received Merchandise In Good Condition
	Sa <?php echo $ssrow['ss_company'] ?> Nakasisigurong Gamot
	ay Laging Bago!!
	Maraming Salamat Po...
	<br>&nbsp <br>&nbsp
</p>
<hr>
<br>
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