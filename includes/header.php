<head>
	<title>CHARLESCODE</title>
  <meta charset="UTF-8">
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"> -->
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- <link rel="stylesheet" href="datatable_tars/datatables-bs4/css/dataTables.bootstrap4.min.css"> -->
    <link rel="stylesheet" href="datatable_tars/Css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="datatable_tars/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">


  <style type="text/css">
    body{
      font-family: lucida sans-serif !important;
    }
.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 40px;
    user-select: none;
    -webkit-user-select: none;
}
   #adminSideNav{
    list-style: none;
    width: 100%;
    position: relative;
    /*height: 90vh;*/
    background-color: white;
    padding: 0px;
    border:lightgrey solid 1px;
    padding-bottom: 1em;
   }
   #adminSideNav .adNavItem{
    padding: 10px;
    background-color: lightgray;
    color:black;
    margin:5px;
    cursor: pointer;
   }
   #adminSideNav .adNavItem a {
    text-decoration: none;
    color:black;
    font-weight: 500;
   }
   #adminSideNav .adNavItem:hover{
    background-color: grey;
   }
   #adminSideNav .adNavItem:hover a{
    color:white;
   }
   #adminSideNav .sideNavTitle{
    font-weight: 800;
    text-align: center;
   }
   .product_cont{
    padding: 10px;
    background-color:#efefef;
   }
   .product_cont .product_inner_cont .image_cont{
    height: 200px;
    overflow: hidden;
   }
   .product_cont:hover{
    background-color: lightgrey;
    cursor: pointer;
   }
   #cartbutton{
    font-size:50;padding: 20px;background-color: lightblue;position: fixed;right:0px;bottom: 2em;color:gray;border-radius: 20px;cursor: pointer;
   }
   #cartbutton:hover{
    background-color: blue;
    color:white;
   }
   #cartNav{
    list-style: none;
    padding: 0px;
    margin:0px;
   }
   #cartNav li{
    background-color:grey;
    padding:8px;
    margin:5px; 
    color:white;
    cursor: pointer;
    font-weight: 600;
   }
   #cartNav li:hover{
    background-color: lightgrey;
    color:black;
   }
   .customerSection{
    background-color: #6c757d;
    font-family: tahoma;
    padding: 5px;
    color: white;
    text-indent: 20px;

   }
   .transaction p{
    margin-bottom: 5px;
   }
   .trans_items{
    padding: 20px;
    font-size: 14px;
    background-color:#ffffff;
   }
   .boxwarning{
        height: 40px;
        width: 40px;
        border-radius: 5px;
        display: flex;
        cursor: pointer;
   }
   .boxwarning i{
    margin: auto;
   }
   .col-sm-4
   .description-block
   .description-header{
    font-size: 40px;
   }
   #dash h3{
    font-size: 40px;
    margin-bottom: 0px;
    
   }
   #dash p{
    margin-bottom: 0px;
   }
   tbody tr:hover{
    background-color: lightgrey;
   }
   form p{
    margin-bottom: 3px;
   }
   .legends{
    list-style: none;
    display: flex;
    gap: 5px;
   }
   .legends li{
    padding: 5px;
    text-align: right;
   }
   .navbar-nav .active{
    background-color:grey;
   }
   .navbar-nav .active a{
    color:white !important;
   }
   .nav-treeview{
    background-color:#007bff !important;
   }
   #dashboardboard .widget-user-username{
    font-size:40px;
   }
   #report_1template th,#report_1template td{
    padding: 5px;
   }
   .table td {
    padding: 4px;
   }
   .typewriter {
  display: inline-block;
  overflow: hidden;
  animation: typing 3s steps(30, end), blink-caret .5s step-end infinite;
}

/* The typing animation */
@keyframes typing {
  from { width: 0 }
  to { width: 100% }
}

/* The caret blinking animation */
@keyframes blink-caret {
  from, to { border-color: transparent }
  50% { border-color: orange }
}

/* Style the caret */
.typewriter::after {
  content: "|";
  margin-left: 5px;
  border-right: .15em solid orange;
  animation: blink-caret .5s step-end infinite;
}
.widget-user .widget-user-image {
    left: 66%;
    margin-left: 1px;
    position: absolute;
    top: -13px;
    border: s;
}
.buttons-html5{
  margin-left: 2px;
  margin-right: 2px;
  border-radius: 10px;
}
.tars-navigation{
  list-style: none;
  padding-left: 0px;
}
.tars-navigation li{
  padding: 10px;
  background-color:lightgrey;
  margin:4px;
  cursor: pointer;
}
.tars-navigation li:hover{
  background-color:grey;
  color:white;
  font-weight: bold;
}



  </style>

  <style>

svg {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 150px;
  width: 150px;
}
    .lodinganimation {
      color: white;
      margin-top: 60%;
      text-align: center;
      overflow: hidden;
      white-space: nowrap;
      animation: typewriter 4s steps(40) infinite;
    }

    @keyframes typewriter {
      from {
        width: 0;
      }
      to {
        width: 100%;
      }
    }


</style>
</head>