<nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> 

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <button style=" background: transparent;border: transparent;" onclick="history.back();" class="btn btn-warning btn-md"><i class="fas fa-arrow-left"></i></button>
          </li>
          <li class="nav-item">
              <button style=" background: transparent;border: transparent;" onclick="location.reload();" class="btn btn-warning btn-md"><i class="fas fa-sync-alt"></i></button>
          </li>
          <li class="nav-item">
            <button style=" background: transparent;border: transparent;" onclick="history.forward();" class="btn btn-warning btn-md"><i class="fas fa-arrow-right"></i></button>
          </li>
          <?php if (isset($user_id)): ?>
            <?php if ($usertype == 1 || $usertype == 2 || $usertype == 4): ?>
              <?php if ($usertype == 2 || $usertype == 4): ?>
                 <li class="nav-item <?php echo $y = ( !isset($q) ) ? "active" : ""; ?>">
                <a href="../pharmacy/" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
              </li>
              <?php endif ?>
             <li class="nav-item <?php echo checkNavActivity('transaction',$view) ?>">
                <a href="?q=transaction" class="nav-link"><i class="fa fa-shopping-cart"></i> Transaction (ALT+T)</a>
              </li>
              <?php if ($usertype == 1 || $usertype == 2): ?>
              <li class="nav-item <?php echo checkNavActivity('submit_sales',$view) ?>">
                <a href="?q=submit_sales" class="nav-link"><i class="fas fa-coins"></i> Submit Sales (ALT+S)</a>
              </li>
            <?php endif ?>
            <?php endif ?>
             <?php if ($usertype == 1 || $usertype == 3): ?>
                <li class="nav-item dropdown <?php if ($view =='todaySales' OR $view=='tobuy' OR $view=='expired_meds' OR $view=='monthSales' OR $view=='yearlySales'): ?>
              show
            <?php endif ?>">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
              <i class="fa fa-coins"></i>
            System Reports</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow <?php if ($view =='todaySales' OR $view=='tobuy' OR $view=='expired_meds' OR $view=='monthSales' OR $view=='yearlySales'): ?>
             
            <?php endif ?>" style="left: 0px; right: inherit;">
              <li><a href="?q=tobuy" class="dropdown-item"><i class="nav-icon fa fa-list"></i>  Almost-out-of Stock </a></li>
              <li><a href="?q=expired_meds" class="dropdown-item"><i class="fa fa-trash nav-icon"></i> Expired meds</a></li>
              <?php if ($usertype == 1): ?>
                <li class="dropdown-divider"></li>
              <!-- End Level two -->
                <li><a href="?q=monthlyinventoryrep" class="dropdown-item"><i class="nav-icon fa fa-box"></i> Monthly Inventory Report</a></li>
                <li class="dropdown-divider"></li>
              <!-- End Level two -->
                <li><a href="?q=sales_report" class="dropdown-item"><i class="nav-icon fa fa-chart-line"></i> Sales Reports</a></li>
              <?php endif ?>
            </ul>
          </li>
             <?php endif ?>
          <?php endif ?>
              <?php 
                if (isset($user_id) && $usertype == 2) { ?>
                  <li class="nav-item <?php echo checkNavActivity('contactus',$view) ?>">
                    <a href="?q=prod_inventory" class="nav-link">Product Inventory <i class="fa fa-box"></i></a>
                  </li>
                <?php } ?>
        </ul>

     </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <?php if (isset($user_id) && $usertype > 0 && $usertype < 2): ?>
                <li class="nav-item ">
                  <a href="#" onclick="openSettings()" class="nav-link"><i class="fas fa-cog"></i></a>
                </li>
              <?php endif ?>
        <?php if (!isset($user_id)): ?>

          <li class="nav-item">
            <a href="?q=login" class="nav-link"><i class="fa fa-sign-in"></i>login</a>
          </li>
        <?php else: ?>
          <li class="nav-item <?php echo checkNavActivity('contactus',$view) ?>">
                <a href="?q=contactus" class="nav-link"><i class="fa fa-phone"></i></a>
              </li>
          <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
           <img src="images/<?php echo $user['user_img'] ?>" class="img-circle elevation-2" alt="User Image" style="width: 28px;height:28px;margin-right: 10px;">
                  <?php echo $user['user_fullname'] ?>
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" >

          <div class="dropdown-divider"></div>
          <a onclick="editUserData('<?php echo $user_id ?>')" href="#" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> View Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="includes/queries.php?logout=true" class="dropdown-item">
            <i class="fas fa-door-open mr-2"></i> Logout
          </a>
        </div>
      </li>
        <?php endif ?>
      </ul>
  </nav>