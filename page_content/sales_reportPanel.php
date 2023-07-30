<div class="row">
	<div class="col-3">
		<div class="card card-secondary" style="">
			<div class="card-header">
				Sales Reports
			</div>
			<div class="card-body" style="padding: 3px;">
				<ul class="tars-navigation">
					<li onclick="window.location.href='?q=salesDateRange'" class="tars-nav-links"><i class="fa fa-coins"></i> By Date Range</li>
					<li onclick="window.location.href='?q=byCashierRange'" class="tars-nav-links"><i class="fa fa-coins"></i> By Cahier Date Range</li>
					<li onclick="window.location.href='?q=todaySales'" class="tars-nav-links"><i class="fa fa-coins"></i> Specific Date Sales</li>
					<li onclick="window.location.href='?q=monthSales'" class="tars-nav-links"><i class="fa fa-coins"></i> Monthly Sales</li>
					<li onclick="window.location.href='?q=yearlySales'" class="tars-nav-links"><i class="fa fa-coins"></i> Yearly Sales</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-9">
		<?php
			switch ($view) {
				case 'salesDateRange':
		        $sales_content ="page_content/salesDateRange.php";
		        break;
		        case 'byCashierRange':
		        $sales_content ="page_content/byCashierRange.php";
		        break;
				case 'todaySales':
		        $sales_content ="page_content/todaySales.php";
		        break;
        		case 'monthSales':
        		$sales_content ="page_content/monthSales.php";
		        break;
				case 'yearlySales':
		        $sales_content ="page_content/yearlySales.php";
		        break;
				default:
		       		$sales_content ="page_content/todaySales.php";
					break;
			}
			require_once($sales_content);
		 ?>
	</div>
</div>