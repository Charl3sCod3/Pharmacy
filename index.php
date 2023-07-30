<?php 
include 'dbcon.php';
$view = (isset($_GET['q']) && $_GET['q'] != '') ? $_GET['q'] : '';
if (isset($user_id)) {
      switch ($view) {
          case 'discounts':
          if ($usertype > 0 && $usertype < 2) {
          $title = "Manage Discounts";
          $content ="page_content/discounts.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          }
          break;
          case 'register':
          if ($usertype > 0 && $usertype < 2) {
          $title = "Register Section";
          $content ="page_content/register.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          }
          break;
          case 'sales_report':
          if ($usertype > 0 && $usertype < 2) {
          $title = "Sales Report Panel";
          $content ="page_content/sales_reportPanel.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          }
          break;
          case 'newUser':
          if ($usertype > 0 && $usertype < 2) {
          $title = "New Users Application";
          $content ="page_content/newUser.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          } 
          break;
          case 'monthlyinventoryrep':
          if ($usertype > 0 && $usertype < 2) {
          $title = "Monthly Inventory Report";
          $content ="page_content/monthlyinventoryrep.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          } 
          break;
           case 'mrbyitem':
          if ($usertype > 0 && $usertype < 2) {
          $title = "Monthly Inventory Report by Item";
          $content ="page_content/mrbyitem.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          } 
          break;
          case 'mrbydeliveryitem':
          if ($usertype > 0 && $usertype < 2) {
          $title = "Monthly Inventory Report by Delivery";
          $content ="page_content/mrbydeliveryitem.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          } 
          break;
          case 'users':
          if ($usertype > 0 && $usertype < 2) {
          $title = "Manage User Section";
          $content ="page_content/users.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          }
          break;
          case 'cashFloat':
          if ($usertype > 0 && $usertype < 2) {
          $title = "Manage Cash Floats";
          $content ="page_content/cashFloat.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          }
          break;
           case 'sub_sales_rep':
          if ($usertype > 0 && $usertype < 2) {
          $title = "Check Submitted Sales";
          $content ="page_content/sub_sales_rep.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          }
          break;
           case 'delivery_records':
          if ($usertype == 1 || $usertype == 3) {
          $title = "Delivery Records";
          $content ="page_content/delivery_records.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          }
          break;
          case 'systemSettings':
          if ($usertype > 0 && $usertype < 2) {
          $title = "System Settings";
          $content ="page_content/systemSettings.php";
          }else{
            $title = "NOT FOUND";
            $content = "page_content/index.php";
          }
          break;

        case 'login':
        $title = "Login Section";
        $content ="page_content/login.php";
        break;
         case 'prod_inventory':
        $title = "Manage Product Inventory";
        $content ="page_content/prod_inventory.php";
        break;
        case 'prod_inventory_report':
        $title = "Manage Product Inventory Report";
        $content ="page_content/prod_inventory_report.php";
        break;
         case 'prod_cat':
        $title = "Manage Product Category";
        $content ="page_content/prod_cat.php";
        break;
        case 'prod_type':
        $title = "Manage Product Type";
        $content ="page_content/prod_type.php";
        break;
        case 'supliers':
        $title = "Manage Suppliers";
        $content ="page_content/supliers.php";
        break;
        case 'newstocks':
        $title = "Manage New Stocks";
        $content ="page_content/newstocks.php";
        break;
        case 'transaction':
        $title = "Transaction Section";
        $content ="page_content/transaction.php";
        break;
        case 'prod_settings':
        $title = "Product Settings";
        $content ="page_content/prod_settings.php";
        break;
        case 'tobuy':
        $title = "Products for re-purchase";
        $content ="page_content/tobuy.php";
        break;
        case 'expired_meds':
        $title = "Expired Products";
        $content ="page_content/expired_meds.php";
        break;
        case 'submit_sales':
        $title = "Submit you're sales report";
        $content ="page_content/submit_sales.php";
        break;
        case 'todaySales':
        $title = "Sales Report Panel";
        $content ="page_content/sales_reportPanel.php";
        break;
        case 'search_transaction':
        $title = "Transaction Search Result";
        $content ="page_content/search_transaction.php";
        break;
        case 'trans_history':
        $title = "Transaction History";
        $content ="page_content/trans_history.php";
        break;
         case 'monthSales':
         $title = "Sales Report Panel";
        $content ="page_content/sales_reportPanel.php";
        break;
        break;
         case 'salesDateRange':
         $title = "Sales Report Panel";
        $content ="page_content/sales_reportPanel.php";
        break;
        break;
         case 'byCashierRange':
         $title = "Sales Report Panel";
        $content ="page_content/sales_reportPanel.php";
        break;
        case 'yearlySales':
        $title = "Sales Report Panel";
        $content ="page_content/sales_reportPanel.php";
        break;
        case 'delivery_history_records':
        $title = "Delivery Items";
        $content ="page_content/delivery_history_records.php";
        break;
        case 'contactus':
        $title = "HELP CENTER";
        $content ="page_content/contactus.php";
        break;
      default:
        $title = "Main Dashboard";
        $content ="page_content/index.php";
        break;
    }
}

require_once($loginstat);
 ?>