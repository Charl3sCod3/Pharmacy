<!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="../pharmacy" class="nav-link <?php if (!isset($q)): ?>
              <?php echo "active"; ?>
            <?php endif ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

<!--           <?php if ($usertype == 1 || $usertype == 2 || $usertype == 4): ?>
               <li class="nav-item">
                  <a href="?q=transaction" class="nav-link <?php echo checkNavActivity('transaction',$view) ?>">
                    <i class="nav-icon fa fa-shopping-cart"></i>
                    <p>
                     Transaction
                    </p>
                  </a>
                </li>
              <?php if ($usertype == 1 || $usertype == 2): ?>
              <li class="nav-item">
                <a href="?q=submit_sales" class="nav-link <?php echo checkNavActivity('submit_sales',$view) ?>">
                 <i class="nav-icon fas fa-coins"></i>
                  <p>
                    Submit Sales
                  </p>
                </a>
              </li>
              <?php endif ?>
          <?php endif ?> -->

          <?php if ($user_id == 1): ?>
            <li class="nav-item">
            <a href="?q=sub_sales_rep" class="nav-link <?php echo checkNavActivity('sub_sales_rep',$view) ?>">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Submitted Sales Report
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="?q=discounts" class="nav-link <?php echo checkNavActivity('discounts',$view) ?>">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Discounts
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?q=cashFloat" class="nav-link <?php echo checkNavActivity('cashFloat',$view) ?>">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Cash Floats
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if ($view =='users' OR $view=='register'): ?>
              menu-open
            <?php endif ?>">
            <a href="#" class="nav-link <?php if ($view =='users' OR $view=='register'): ?>
              active
            <?php endif ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?q=register" class="nav-link <?php echo checkNavActivity('register',$view) ?>">
                  <i class="nav-icon fa fa-user"></i>
                  <p>
                    New User
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?q=users" class="nav-link <?php echo checkNavActivity('users',$view) ?>">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    Manage Users
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif ?>
          <?php if ($usertype ==1 || $usertype ==3): ?>
            <li class="nav-header">Product Management</li>
              <li class="nav-item">
                <a href="?q=newstocks" class="nav-link <?php echo checkNavActivity('newstocks',$view) ?>">
                  <i class="fa fa-cubes nav-icon"></i>
                  <p>New Stocks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?q=prod_cat" class="nav-link <?php echo checkNavActivity('prod_cat',$view) ?>">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Product Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?q=prod_type" class="nav-link <?php echo checkNavActivity('prod_type',$view) ?>">
                  <i class="fa fa-puzzle-piece nav-icon"></i>
                  <p>Product Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?q=prod_settings" class="nav-link <?php echo checkNavActivity('prod_settings',$view) ?>">
                  <i class="fas fa-cog nav-icon"></i>
                  <p>Product Settings</p>
                </a>
              </li>
              <?php endif ?>
              <?php if ($usertype ==1 || $usertype ==3 || $usertype ==2): ?>
              <li class="nav-item">
                <a href="?q=prod_inventory" class="nav-link <?php echo checkNavActivity('prod_inventory',$view) ?>">
                  <i class="fa fa-box nav-icon"></i>
                  <p>Product Inventory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?q=prod_inventory_report" class="nav-link <?php echo checkNavActivity('prod_inventory_report',$view) ?>">
                  <i class="fa fa-box nav-icon"></i>
                  <p>Product Inventory Report</p>
                </a>
              </li>
              <?php endif ?>
                <?php if ($usertype ==1 || $usertype ==3): ?>
              <li class="nav-header">Suppliers</li>
              <li class="nav-item">
                <a href="?q=supliers" class="nav-link <?php echo checkNavActivity('supliers',$view) ?>">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Manage Supliers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?q=delivery_records" class="nav-link <?php echo checkNavActivity('delivery_records',$view) ?>">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Delivery Records</p>
                </a>
              </li>
          <?php endif ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>