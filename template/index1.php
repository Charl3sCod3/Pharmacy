<!DOCTYPE html>
<html>
<?php 

if( (isset($q) && $q=='prod_settings') || (isset($q) && $q=='prod_inventory')){
  include 'includes/header2.php';

}else{
  include 'includes/header.php';
}
 ?>
<body class=" <?php echo $y = ($usertype == 1 || $usertype==3 ) ? "hold-transition sidebar-mini" : "layout-top-nav"; ?>">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
<?php include 'includes/nav.php' ?>
  <!-- Main Sidebar Container -->
  <?php if ($usertype == 1 || $usertype==3): ?>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CHARLESCODE</span>
    </a>
    <?php include 'includes/sidebar.php' ?>
  </aside>
  <?php endif ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="background-color: #343a40;margin-bottom: 10px;padding:4px;color:white;">
      <div class="container-fluid">
        <div class="row" style="margin-top: 10px;">
          <div class="col-sm-8">
            <h1 style="font-family:Bernard MT Condensed;letter-spacing: 2px;text-indent: 20px;">-<?php echo strtoupper($title) ?>-</h1>
          </div>
          <div class="col-sm-4">
            <form id="search_transaction">
                <div class="form-group">
                   <input type="text" name="search" class="form-control" placeholder="Search Transaction Here | Y-mm-dd " id="search_request">
               </div>
            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <?php require_once($content) ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.4
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://charlesm.pro/">CHARLESCODE</a>.</strong> All rights
    reserved.
  </footer> -->
  <div class="modal fade" id="My_modal">
  <div id="modalContent"></div>
</div>
<?php
if( (isset($q) && $q=='prod_settings') || (isset($q) && $q=='prod_inventory')) {
  include 'includes/scripts2.php';
}else{
   include 'includes/scripts.php';
}


 ?>
</body>
</html>
