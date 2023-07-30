
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>

<script>
  $(function () {
     $("#filterable").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example100').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
        const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
  });

  $("#newproductNoqqty").submit(function(e){
           const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                      });
           e.preventDefault();
            Swal.fire({
                title: 'ADD NEW PRODUCT?',
                text: "Are you sure?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "Cancel",
                confirmButtonText: 'Yes'
           }).then((result) => {
            if (result.value == true) {
              const formData  = new FormData(this);
               formData.append('AddnewProductNoQtty', 'true');
              $.ajax({  url:'includes/queries.php', 
                      type: "POST",
                      data: formData,
                      contentType: false,
                      cache: false,
                      processData:false,
                      success: function(data){
                        console.log(data)
                        if (data > 0 && data < 2) 
                        {
                          
                          Swal.fire({
                            
                                    title: 'Product Quantity Cap Updated.',
                                    text: "The data was saved to database!",
                                    icon: 'success',
                                    timer: 3000
                               }).then((result) => {
                                 if (result.value == true) {
                                     window.location.reload();
                                 }
                               });           
                        }
                        if (data > 1) {
                          Swal.fire({
                            
                                    title: 'Failed Or Encountered a problem!',
                                    text: "Contact Developer",
                                    icon: 'warning',
                                    timer: 3000
                               }).then((result) => {
                                 if (result.value == true) {
                                     window.location.reload();
                                 }
                               });
                        }
                      } 
                   });
            }
           });
});
$(document).ready(function() {
  // Initialize DataTables plugin
  var table = $('#filterable').DataTable();

 $('#product_codeis').on('keyup change', function() {
  var inputVal = $(this).val().toLowerCase();
  // Filter the datatable based on the input value
  var newInputVal = inputVal.split(' ');
  
  // Check the length of newInputVal array
  var arrayLength = newInputVal.length;
  console.log("Number of elements in newInputVal: " + arrayLength);
  
  // Use the desired logic based on the number of elements in newInputVal
  if (arrayLength > 1) {
    var finalval = newInputVal[0];
  } else {
    var finalval = inputVal;
  }
  
  table.search(finalval).draw();
});

  // Capture user input on keyup or change event for product name
  $('#product_name').on('keyup change', function() {
    var inputVal = $(this).val().toLowerCase();
    // Filter the datatable based on the input value
    table.search(inputVal).draw();
  });
});
  function editprodcap(that){
 $.ajax({
        url:'modal_content/editprodcap.php',
        type:'GET',
        data:{p_id:that},
        dataType:'html',
    }).done(function(data){
        $('#modalContent').html('');
        $('#modalContent').html(data);
        $("#My_modal").modal('show');
        $(".selectnew").select2();
        $("#editprodcap").submit(function(e){
          e.preventDefault();
                         const Toast = Swal.mixin({
                                      toast: true,
                                      position: 'top-end',
                                      showConfirmButton: false,
                                      timer: 3000
                                    });
                          Swal.fire({
                              title: 'Edit Product Type?',
                              text: "Are you sure?",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              cancelButtonText: "Cancel",
                              confirmButtonText: 'Yes'
                         }).then((result) => {
                          if (result.value == true) {
                            $.ajax({  url:'includes/queries.php',
                                    type: "POST",
                                    data: new FormData(this),
                                    contentType: false,
                                    cache: false,
                                    processData:false,
                                    success: function(data){
                                      console.log(data)
                                      if (data > 0 && data < 2) 
                                      {
                                        
                                        Swal.fire({
                                          
                                                  title: 'Product Quantity Cap Updated.',
                                                  text: "The data was saved to database!",
                                                  icon: 'success',
                                                  timer: 3000
                                             }).then((result) => {
                                               if (result.value == true) {
                                                   window.location.reload();
                                               }
                                             });           
                                      }
                                      if (data > 1) {
                                        Swal.fire({
                                          
                                                  title: 'Failed Or Encountered a problem!',
                                                  text: "Contact Developer",
                                                  icon: 'warning',
                                                  timer: 3000
                                             }).then((result) => {
                                               if (result.value == true) {
                                                   // window.location.reload();
                                               }
                                             });
                                      }
                                    }
                                 });
                          }
                         });
      });
      });
}
</script>