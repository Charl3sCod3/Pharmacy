$("#fetchSalesByDate").submit(function(e){
e.preventDefault();
Themonth = $("#Themonthis").val();
 Swal.fire({
          title: "Fetch Sales Report?",
          text: "Are you sure?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: "Cancel",
          confirmButtonText: 'Yes'
     }).then((result) => {
      if (result.value == true) {
        window.location.href="?q=todaySales&themonthis="+Themonth;
        }
      });
});
$("#fetchSalesByDateRange").submit(function(e){
e.preventDefault();
Themonth = $("#Themonthis").val();
Theyear = $("#theyearis").val();
 Swal.fire({
          title: "Fetch Sales Report?",
          text: "Are you sure?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: "Cancel",
          confirmButtonText: 'Yes'
     }).then((result) => {
      if (result.value == true) {
        window.location.href="?q=salesDateRange&themonthis="+Themonth+"&theyearis="+Theyear;
        }
      });
});

$("#fetchSalesByDateRangeCashier").submit(function(e){
e.preventDefault();
Themonth = $("#Themonthis").val();
Theyear = $("#theyearis").val();
cashieris = $("#thecashieris").val();
 Swal.fire({
          title: "Fetch Sales Report?",
          text: "Are you sure?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: "Cancel",
          confirmButtonText: 'Yes'
     }).then((result) => {
      if (result.value == true) {
        window.location.href="?q=byCashierRange&themonthis="+Themonth+"&theyearis="+Theyear+"&cashieris="+cashieris;
        }
      });
});
$("#fetchSalesMonths").submit(function(e){
e.preventDefault();
Theyear = $("#yearis").val();
Themonth = $("#monthis").val();
 Swal.fire({
          title: "Fetch Sales Report?",
          text: "Are you sure?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: "Cancel",
          confirmButtonText: 'Yes'
     }).then((result) => {
      if (result.value == true) {
        window.location.href="?q=monthSales&themonthis="+Themonth+"&theyearis="+Theyear;
        }
      });
});
$("#fetchSalesYear").submit(function(e){
e.preventDefault();
Theyear = $("#yearis").val();
 Swal.fire({
          title: "Fetch Sales Report?",
          text: "Are you sure?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: "Cancel",
          confirmButtonText: 'Yes'
     }).then((result) => {
      if (result.value == true) {
        window.location.href="?q=yearlySales&theyearis="+Theyear;
        }
      });
});