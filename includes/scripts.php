
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>



<!-- <script src="plugins/datatables/jquery.dataTables.min.js"></script> -->
<!-- <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script> -->
<!-- <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> -->
<!-- <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->


<script src="dist/js/demo.js"></script> 
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>

<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script> 
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>


        <script src="datatable_tars/datatables/jquery.dataTables.min.js"></script>
        <script src="datatable_tars/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="datatable_tars/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="datatable_tars/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="datatable_tars/jszip/jszip.min.js"></script>
        <script src="datatable_tars/pdfmake/pdfmake.min.js"></script>
        <script src="datatable_tars/pdfmake/vfs_fonts.js"></script>
        <script src="datatable_tars/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="datatable_tars/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="datatable_tars/datatables-buttons/js/buttons.colVis.min.js"></script>

<script async type="text/javascript" src="includes/generalScripts.js"></script>
<script async type="text/javascript" src="includes/users.js"></script>
<script async type="text/javascript" src="includes/inventory.js"></script>
<script async type="text/javascript" src="includes/transaction.js"></script>
<script async type="text/javascript" src="includes/report.js"></script>

<?php if ($view == 'transaction'): ?>
	<script type="text/javascript">
		$(document).on('keydown', '#product_code', function(event) {
			  if (event.key === 'Enter') {
			  	prodcode = $(this).val();
			   	$.ajax({
			   		url:'ajax/transProductCode.php',
			   		type:'GET',
			   		data:{product_code:prodcode},
			   		dataType:'html'
			   	}).done(function(data){
			   		console.log(data)
			   		$datax = data.split("||");
			   		$("#product_name").html($datax[0]);
					$("#trans_price").val($datax[1]);
					$("#trans_qtty").focus();
			   	});
			  }
			});
	</script>
<?php endif ?>
<?php if ($view=='newstocks'): ?>
	<script type="text/javascript">
		$(document).ready(function() {
  $('#product_code').on('change', function() {
    var inputVal = $(this).val();
    $.ajax({
      url: 'ajax/check_product.php',
      type: 'POST',
      data:{product_code:inputVal},
      dataType:'html'
    }).done(function(data){
      newdata = data.split("||");
      if (newdata[0] == 0) {
        addnewProduct(newdata[1]);
      }else{
        $("#product_name").html(newdata[1]);
      }
    })
  });
});
	</script>
<?php else: ?>
<script type="text/javascript">
	$(document).ready(function() {
  $('#product_code').on('change', function() {
    var inputVal = $(this).val();
    $.ajax({
      url: 'ajax/check_product.php',
      type: 'POST',
      data:{product_code:inputVal},
      dataType:'html'
    }).done(function(data){
      newdata = data.split("|");
      if (newdata[0] == 0) {
        // addnewProduct(newdata[1]);
        Swal.fire({            
                  title: 'Invalid Product Code',
                  text: "Double Check the code",
                  icon: 'warning',
                  timer: 3000
             }).then((result) => {
               $('#product_code').focus();
         	   $('#product_code').val('');
             });
      }else{
        $("#product_name").html(newdata[1]);
      }
    })
  });
});
</script>
<?php endif ?>
<script type="text/javascript">
  $(document).ready(function() {
  var productCodeElement = $('#product_code');
  var productCodeElement1 = $('#product_codeis');
  if (productCodeElement.length > 0 || productCodeElement1 > 0 ) {
      function getCostPname(that){
          $.ajax({
            url:'ajax/ccpname.php',
            type:'GET',
            data:{p_id:that},
            dataType:'html'
          }).done(function(data){
            console.log(data);
            datax = data.split("||");
            $("#CC_product_code").val(datax[0]);
            $("#result_content").html(datax[1]);
          });
        }
      window.addEventListener('load', function() {
        document.getElementById('product_code').focus();
        document.getElementById('product_codeis').focus();
      });
  }
});
</script>


<?php if (isset($user_id) && !isset($q) && $usertype ==1): ?>
  <script>
  $(function () {

  // Use the JSON string in JavaScript
var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
var pieData        = <?php echo $json; ?>;
var pieOptions     = {
    maintainAspectRatio : false,
    responsive : true,
}
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
var pieChart = new Chart(pieChartCanvas, {
    type: 'pie',
    data: pieData,
    options: pieOptions
});


// Use the JSON string in JavaScript
var piebycat = $('#bycat').get(0).getContext('2d');
var piebycatdata        = <?php echo $bycat; ?>;
var piebycatop     = {
    maintainAspectRatio : false,
    responsive : true,
}
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
var pieChart = new Chart(piebycat, {
    type: 'pie',
    data: piebycatdata,
    options: piebycatop
});
    });
</script>
<script type="text/javascript">
  $(function () {

  var areaChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: <?php echo generate_sales_data_line_chart() ?>
};
     var areaChartOptions = {
  maintainAspectRatio: true,
  responsive: true,
  legend: {
    display: true,
    position: 'top',
    labels: {
      fontSize: 14,
      fontColor: '#333'
    }
  },
  scales: {
    xAxes: [{
      gridLines: {
        display: true,
        color: '#eee',
        drawBorder: false,
        zeroLineColor: '#eee'
      },
      ticks: {
        fontSize: 14,
        fontColor: '#333'
      }
    }],
    yAxes: [{
      gridLines: {
        display: true,
        color: '#eee',
        drawBorder: false,
        zeroLineColor: '#eee'
      },
      ticks: {
        fontSize: 14,
        fontColor: '#333'
      }
    }]
  },
  tooltips: {
    backgroundColor: '#fff',
    borderColor: '#ddd',
    borderWidth: 1,
    titleFontColor: '#333',
    titleFontSize: 14,
    bodyFontColor: '#666',
    bodyFontSize: 14,
    displayColors: false,
    callbacks: {
      label: function(tooltipItem, data) {
        return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.yLabel;
      }
    }
  }
}



    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = true

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    });
  });

</script>
<?php endif ?>

<script type="text/javascript">
$('.onlyNumbers').on('keyup', function() {
                const regex = /^[0-9]+(\.[0-9]{0,2})?$/; // regular expression to check for valid input
                const input = $(this).val();
                if (!regex.test(input)) {
                  $(this).val(input.substring(0, input.length - 1)); // remove the last character from the input
                }
              });
</script> 

<?php if (isset($user_id)): ?>
  <script type="text/javascript">
    $(document).keydown(function(event) {
  // Check if the event key is 't' and the Alt key is pressed simultaneously
  if (event.key === 't' && event.altKey) {
    // Redirect the page to '?q=transaction'
    window.location.href = '?q=transaction';
  }
  if (event.key === 's' && event.altKey) {
    // Redirect the page to '?q=transaction'
    window.location.href = '?q=submit_sales';
  }
});
  </script>
<?php endif ?>