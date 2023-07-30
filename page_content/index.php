<?php 
 if ($usertype > 0 && $usertype < 2):
 ?>
<div class="row" style="margin-left:10%;margin-right: 10%;">
  <div class="col-4">
    <div id="dash" class="small-box bg-primary">
        <div class="inner">
            <h3>₱ <?php echo number_format(getInStockNetValue(),2) ?></h3>

            <p>In-Stocks Net Value</p>
        </div>
        <div class="icon">
          <i class="fas fa-coins"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">
          View List <i class="fas fa-arrow-circle-right"></i>
        </a> -->
    </div>
  </div>
  <div class="col-4">
    <div id="dash" class="small-box bg-success">
        <div class="inner">
            <h3>₱ <?php echo number_format(getInStockCostValue(),2) ?></h3>

            <p>In-Stocks Cost Value</p>
        </div>
        <div class="icon">
          <i class="fas fa-coins"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">
          View List <i class="fas fa-arrow-circle-right"></i>
        </a> -->
    </div>
  </div>
  <div class="col-4">
    <div id="dash" class="small-box bg-danger">
        <div class="inner">
            <h3>₱ <?php 
            $elo = getInStockNetValue()-getInStockCostValue();
            echo number_format($elo,2) ?></h3>

            <p>In-Stocks Profit</p>
        </div>
        <div class="icon">
          <i class="fas fa-coins"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">
          View List <i class="fas fa-arrow-circle-right"></i>
        </a> -->
    </div>
  </div>
</div>
<?php endif ?>
<div id="dashboardboard" class="card card-widget widget-user" style="margin-left: 30px;margin-right: 30px;">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-info" style="background-color:#343a40 !important;">
      <h3 class="widget-user-username" style="text-align:left;">
        <?php if ($ssnrow > 0): ?>
          <?php echo $ssrow['ss_company'] ?> <small style="float: right;font-size: 30px;font-family: roboto;line-height: 23px;"><u>CHARLESCODE</u> <br> <i style="font-size: 20px !important;text-align: center;">POS - System</i></small>
        <?php else: ?>
          PLEASE SET SYSTEM SETTINGS <small style="float: right;font-size: 30px;font-family: roboto;line-height: 23px;"><u>CHARLESCODE</u> <br> <i style="font-size: 20px !important;text-align: center;">POS - System</i></small>
        <?php endif ?>
      </h3>
      <h5 class="widget-user-desc" style="text-align:left;"><?php echo $ssrow['ss_address'] ?></h5>
    </div>
    <div class="widget-user-image" style="height:160px; width:160px;">
      <img class="img-circle elevation-2" style="object-fit: cover;width: 100%;height: 100%;border: #343a40 solid 17px;" src="images/<?php echo $user['user_img'] ?>" alt="User Avatar">
    </div>
    <div class="card-footer">
      <?php 
      $pt_date = date("Y-m-d"); 
      $cashfloat = getCashfloat($user_id,$pt_date)->fetch_array();
       ?>
      <div class="row">
        <div class="col-sm-4 border-right">
          <div class="description-block">
            <h5 class="description-header">₱ <?php echo number_format($cashfloat['pt_cash'],2) ?></h5>
            <span class="description-text">Cash Float</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 border-right">
           <?php if ($usertype != 2 && $usertype != 4): ?>
            <div class="description-block">
            <h5 class="description-header">
              <?php echo '₱ '.number_format(getTodayGrandtotalSales($user_id),2) ?>
            </h5>
            <span class="description-text">You're Sales</span>
          </div>
           <?php else: ?>
          <div class="description-block">
            <h5 class="description-header" style="font-size:50px;">
              <?php 
                $totalTranstoday = getTodayTrans($user_id)->num_rows;
                echo $totalTranstoday;
               ?>
                <i class="fa fa-users"></i>
            </h5>
            <span class="description-text">CUSTOMER</span>
          </div>
        <?php endif ?>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
          <div class="description-block">
            <h5 class="description-header">
              ₱ <?php echo number_format(gettotalTodaysales(),2) ?>
            </h5>
            <span class="description-text">Today Sales</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?php if ($usertype != 2 && $usertype != 4): ?>
        <div class="row">
        <div class="col-12" >
          <div class="description-block">
            <h5 class="description-header" style="font-size:50px;">
              <?php 
                $totalTranstoday = getTodayTrans($user_id)->num_rows;
                echo $totalTranstoday;
               ?>
                <i class="fa fa-users"></i>
            </h5>
            <span class="description-text">CUSTOMER</span>
          </div>
        </div>
      </div>
      <?php endif ?>
    </div>
  </div>
<div class="row" style="margin-left:40px;margin-right: 40px;">
  <div class="col-3 border-right">
      <div id="dash" class="small-box bg-primary">
        <div class="inner">
          <?php 
            $gap = getAllProduct();
            $gapnr = $gap->num_rows;
           ?>
            <h3><?php echo $gapnr ?> <i class="fas fa-prescription-bottle-alt"></i></h3>

            <p>Number of Products</p>
        </div>
        <div class="icon">
          <i class="fas fa-box"></i>
        </div>
        <a href="?q=prod_inventory" class="small-box-footer">
          View List <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
  </div>
  <div class="col-3 border-right">
      <div id="dash" class="small-box bg-danger">
        <div class="inner">
            <h3><?php echo number_format(getExpiredMeds()); ?> <i class="fas fa-times-circle"></i></h3>

            <p>Expired Products</p>
        </div>
        <div class="icon">
          <i class="fas fa-trash"></i>
        </div>
        <a href="?q=expired_meds" class="small-box-footer">
          View List <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
  </div>
  <div class="col-3">
      <div id="dash" class="small-box bg-warning">
        <div class="inner">
          <h3><?php echo AlmostExpired() ?> <i class="fas fa-first-aid"></i></h3>

          <p>Products For Re-Purchase</p>
        </div>
        <div class="icon">
          <i class="fas fa-exclamation-triangle"></i>
        </div>
        <a href="?q=tobuy" class="small-box-footer">
          View List <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
  </div>
  <div class="col-3">
      <div id="dash" class="small-box bg-success">
        <div class="inner">
          <?php $gau = getAllUsers(); 
                $gaunr = $gau->num_rows;
          ?>
          <h3><?php echo $gaunr ?> <i class="fa fa-users"></i></h3>

          <p>Number Of system Users</p>
        </div>
        <div class="icon">
          <i class="fas fa-users fa-plus"></i>
        </div>
        <a href="#" class="small-box-footer">
          &nbsp 
        </a>
    </div>
  </div>

</div>
<?php 
 if ($usertype > 0 && $usertype < 2):
 ?>
<div class="row" style="margin-left: 30px;margin-right: 30px;">
  <div class="col-6">
    <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Number of Products base on Category</h3>
<!--                 <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div> -->
              </div>
              <div class="card-body">
                <canvas id="bycat" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>
  <div class="col-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Current And Previous Year Sales Graph</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
  </div>
</div>
<div class="row">
    <div class="col-12">
    <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Top 10 Selling Products</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>
</div>
<?php endif ?>
<?php 
  // Call the function to get the top selling products
$data = getTopSellingProducts();

// Extract the product names and total quantity sold as separate arrays
$labels = array();
$values = array();
foreach ($data as $item) {
    $labels[] = $item['p_name'];
    $values[] = $item['total_quantity_sold'];
}

// Create the data array for Chart.js
$data = array(
    'labels' => $labels,
    'datasets' => array(
        array(
            'data' => $values,
            'backgroundColor' => array(
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#8DFF3F',
                '#FF3F3F',
                '#3F81FF',
                '#8D3FFF',
                '#FF9F3F',
                '#3FFFAD',
                '#D53FFF',
            )
        )
    )
);

// Convert the data array to a JSON string
$json = json_encode($data);

  // Call the function to get the top selling products
$bycatdata = getTop20ProductCategories();

// Extract the product names and total quantity sold as separate arrays
$bycatlabels = array();
$bycatvalues = array();
foreach ($bycatdata as $bycatitem) {
    $bycatlabels[] = $bycatitem['pc_name'];
    $bycatvalues[] = $bycatitem['num_products'];
}

// Create the data array for Chart.js
$bycatdata = array(
    'labels' => $bycatlabels,
    'datasets' => array(
        array(
            'data' => $bycatvalues,
            'backgroundColor' => array(
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#8DFF3F',
                '#FF3F3F',
                '#3F81FF',
                '#8D3FFF',
                '#FF9F3F',
                '#3FFFAD',
                '#D53FFF',
            )
        )
    )
);

// Convert the data array to a JSON string
$bycat = json_encode($bycatdata);
 ?>