<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<?php include 'includes/header.php' ?>
<body class="hold-transition layout-top-nav" style="background-color: orange;">
<div class="wrapper" style="background-color:transparent;">

  <!-- Navbar -->
  <?php include  'includes/nav.php'; ?>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color:transparent;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <!-- SLIDER HERE -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
      <?php require_once($content) ?>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <?php if (isset($user_id) && $usertype == 2 && $view != 'mycart'): ?>
      <a href="?q=mycart" id="cartbutton">
      <i class="fa fa-shopping-cart" ></i> Your Cart
    </a>
    <?php endif ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
     Version 1.0.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023d-<?php echo date("Y") ?> <a href="https://charlesm.pro/">CHARLESCODE</a>.</strong> All rights reserved.
  </footer>

</div>
<div class="modal fade" id="My_modal">
  <div id="modalContent"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<?php include 'includes/scripts.php' ?>
</body>
</html>
