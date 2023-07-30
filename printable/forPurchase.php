<?php 
include '../dbcon.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		html{
			font-family: tahoma;
		}
		.table{
			width: 100%;
			border-collapse: collapse;
			margin-top: 4rem;
		}
		.table thead{
			text-align: center;
			background-color: darkblue;
			color:white;
		}
		.table thead th{
			font-size:20px;
			padding: 5px;
		}
		.table tbody td{
			font-size:17px;
			padding: 5px;
		}
		h1,h6,h5,h4{
			text-align: center;
			font-family: tahoma;
			margin-bottom: 5px;
			margin-top: 5px;
		}
	</style>
</head>
<body onload="window.print();" >
		<h1>Product for Repurchase</h1>
		<h6>System Generated Report</h6>
		<h5>Date Generated <?php echo date("D F d, Y") ?></h5>
		<table border="1px" id="example1" class="table table-bordered">
			<thead style="text-align:center;">
				<tr>
					<th>#</th>
					<th>Product Code</th>
					<th>Product Desc</th>
					<th>Category</th>
					<th>Type</th>
					<th>Stock</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$gp = getProductTrans1();
					$i=0;
					while ($gr = $gp->fetch_array()) {
						$pcat = getSpProdCat($gr['pc_id'])->fetch_array();
						$pct = getSpProdType($gr['pct_id'])->fetch_array();
						$stock = getProductStock($gr[0]);
						$checkqtty = checktheqtty($gr[0],$gr['cap_qtty']);
						if ($checkqtty > 0) {
							$i++;
				 ?>
				 <tr>
				 	<td align="center"><?php echo $i ?></td>
				 	<td align="center"><?php echo $gr['product_code'] ?></td>
				 	<td><?php echo $gr['p_name'] ?></td>
				 	<td align="center"><?php echo $pcat[1] ?></td>
				 	<td align="center"><?php echo $pct[1] ?></td>
				 	<td align="right"><?php echo number_format($stock) ?></td>
				 </tr>
				<?php  }}  ?>
			</tbody>
			<tfoot>
				<tr>
					<td></td>
				</tr>
			</tfoot>
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