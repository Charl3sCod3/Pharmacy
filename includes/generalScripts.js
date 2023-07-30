$(document).ready(function() {
  $('#filterable').DataTable({
    paging: false,
    lengthChange: true,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true
  });
});
$(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

$("#example8").DataTable({
  "responsive": false,
  "paging": false,
  "autoWidth": false,
  "ordering": false,
  "order": [[0, 'asc']], // Sort by first column (numbering) in ascending order
  "buttons": [
    {
      extend: 'excel',
     
      title: $('#reptitle').text(),
      text: 'Export to Excel',
      exportOptions: {
        modifier: {
          page: 'all'
        }
      }
    },
    {
      extend: 'pdf',
       title: $('#reptitle').text(),
      text: 'Export to PDF',
      exportOptions: {
        modifier: {
          page: 'all'
        }
      },

    },
    {
      extend: 'print',
       title: $('#reptitle').text(),
      text: 'Print',
    }
  ]
}).buttons().container().appendTo('#example8_wrapper .col-md-6:eq(0)');
    $("#example4").DataTable({
    "responsive": true,
    "paging": false,
    "autoWidth": true,
    "buttons": [
        {
            extend: 'excel',
            text: 'Export to Excel',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            },
            customize: function (xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                $('row:last-of-type', sheet).after('<row><c></c><c>Footer Column 1</c><c>Footer Column 2</c><c>Footer Column 3</c></row>');
            }
        },
        { 
            extend: 'pdf',
            text: 'Export to PDF', 
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            },
            customize: function (doc) {
                var table = doc.content[1].table;
                table.footer = [];
                $(table.footer).push($('#example4 tfoot tr th').map(function(){
                  return $(this).text();
                }).get());
            }
        },
        {
            extend: 'print',
            text: 'Print',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            },
            customize: function (win) {
                $(win.document.body).find('table').append($('#example4 tfoot').clone());
            }
        }
    ]
            }).buttons().container().appendTo('.card-tools');

    $("#delivery_records").DataTable({
    "responsive": true,
    "paging": true,
    "autoWidth": true,
    "ordering": false,
    "buttons": [
        {
            extend: 'excel',
             title: $('#reptitle').text(),
            text: 'Export to Excel',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            },
            customize: function (xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                $('row:last-of-type', sheet).after('<row><c></c><c>Footer Column 1</c><c>Footer Column 2</c><c>Footer Column 3</c></row>');
            }
        },
        { 
            extend: 'pdf',
             title: $('#reptitle').text(),
            text: 'Export to PDF', 
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            },
            customize: function (doc) {
                var table = doc.content[1].table;
                table.footer = [];
                $(table.footer).push($('#delivery_records tfoot tr th').map(function(){
                  return $(this).text();
                }).get());
            }
        },
        {
            extend: 'print',
             title: $('#reptitle').text(),
            text: 'Print',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            },
            customize: function (win) {
                $(win.document.body).find('table').append($('#delivery_records tfoot').clone());
            }
        }
    ]
            }).buttons().container().appendTo('.card-tools');

      $("#tarsisnot").DataTable({
              "responsive": true, "lengthChange": true, "autoWidth": true,
              "buttons": ["excel", "pdf", "print",]
            }).buttons().container().appendTo('#example8_wrapper .col-md-6:eq(0)');

        const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
         $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  });
  document.addEventListener('keydown', function(event) {
  // Check if Control and F2 keys were pressed simultaneously
  if (event.ctrlKey && event.key === "F2") {
    // Execute your desired code here
    $.ajax({
            url:'modal_content/checkCost.php',
            type:'GET',
            dataType:'html',
        }).done(function(data){
            $('#modalContent').html('');
            $('#modalContent').html(data);
            $("#My_modal").modal('show');
            $(".selectnew").select2();
            $("#checkCost").submit(function(e){
                             e.preventDefault();
                             $.ajax({  url:' ajax/ccpcode.php',
                                      type: "POST",
                                      data: new FormData(this),
                                      contentType: false,
                                      cache: false,
                                      processData:false,
                                      success: function(data){
                                        datax = data.split("||");
                                         $("#CC_product_name").html(datax[0]);
                                          $("#result_content").html(datax[1]);
                                      }
                                   });
  
          });
          });
  }
});
  
function openPopUp(that){
  var url = that;
  var windowName = 'Print Window';
  // Calculate the center position of the screen
    var leftPosition = (window.screen.width - 1000) / 2; // 595px is the width of A4 paper
    var topPosition = (window.screen.height - 842) / 2; // 842px is the height of A4 paper

    // Set the size and position of the window
    var windowFeatures = 'width=1000,height=3508,left=' + leftPosition + ',top=' + topPosition;

    window.open(url, windowName, windowFeatures);
}
function openPopUp1(that){
  var url = that;
  var windowName = 'Print Window';
  // Calculate the center position of the screen
    var leftPosition = (window.screen.width - 500) / 2; // 595px is the width of A4 paper
    var topPosition = (window.screen.height - 842) / 2; // 842px is the height of A4 paper

    // Set the size and position of the window
    var windowFeatures = 'width=500,height=3508,left=' + leftPosition + ',top=' + topPosition;

    window.open(url, windowName, windowFeatures);
}
function moneyFormat(NumberS){
    Convert = new Intl.NumberFormat('en-PH', {
            style:'currency',
            currency: 'PHP',
            minimumFractionDigits: 2        
        }).format(NumberS);
    return Convert;
  }

$("#InsertForm").submit(function(e){
                 const Toast = Swal.mixin({
                              toast: true,
                              position: 'top-end',
                              showConfirmButton: false,
                              timer: 3000
                            });
                 e.preventDefault();
                  Swal.fire({
                      title: 'Insert new data?',
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
                              console.log(data);
                              if (data > 0 && data < 2) 
                              {
                                
                                Swal.fire({
                                  
                                          title: 'Data Successully Inserted.',
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
                                          
                                       }
                                     });
                              }
                            }
                         });
                  }
                 });
});
function AddPettycash(that){

   $.ajax({
        url:'modal_content/AddPettycash.php',
        type:'GET',
        data:{uuser:that},
        dataType:'html',
    }).done(function(data){
        $('#modalContent').html('');
        $('#modalContent').html(data);
        $("#My_modal").modal('show');
        $("#cashfloat").submit(function(e){
                         const Toast = Swal.mixin({
                                      toast: true,
                                      position: 'top-end',
                                      showConfirmButton: false,
                                      timer: 3000
                                    });
                         e.preventDefault();
                          Swal.fire({
                              title: "You're about to give cash float.",
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
                                      data = data.replace(/\s/g, '');
                                      console.log(data);
                                      if (data > 0 && data < 2) 
                                      {
                                        
                                        Swal.fire({
                                          
                                                  title: 'Successfully alloted cash float!',
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
      });
}
function editSupplier(that){
   $.ajax({
        url:'modal_content/editSuppliers.php',
        type:'GET',
        data:{sup_id:that},
        dataType:'html',
    }).done(function(data){
        $('#modalContent').html('');
        $('#modalContent').html(data);
        $("#My_modal").modal('show');
        $("#editSuppliers").submit(function(e){
                         const Toast = Swal.mixin({
                                      toast: true,
                                      position: 'top-end',
                                      showConfirmButton: false,
                                      timer: 3000
                                    });
                         e.preventDefault();
                          Swal.fire({
                              title: 'Edit Supplier Data?',
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
                                      if (data > 0 && data < 2) 
                                      {
                                        
                                        Swal.fire({
                                          
                                                  title: 'Supplier Data Updated!.',
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
      });
}
function delSupplier(that){
     Swal.fire({
                title: "You're about to delete Supplier Data",
                text: "Supplier with delivery records cannot be deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "Cancel",
                confirmButtonText: 'Yes'
           }).then((result) => {
            if (result.value == true) {
               $.ajax({
                        url:'ajax/delete_supplier.php',
                        type:'GET',
                        data:{pc_id:that},
                        dataType:'html',
                    }).done(function(data){ 
                      console.log(data)
                      if (data > 0) {
                        Swal.fire({
                                      
                                              title: 'Supplier Deleted Successully',
                                              text: "Welcome session Started",
                                              icon: 'success',
                                         }).then((result) => {
                                           if (result.value == true) {
                                                window.location.reload();
                                           }
                                         });  
                      }else{
                        Swal.fire({
                                              title: 'Encountered a problem.',
                                              text: "or failed to connect to database!",
                                              icon: 'warning',
                                         }).then((result) => {
                                           if (result.value == true) {
                                           }
                                         });      
                      }
                    });
            }
          });

  }
$("#AddNewDiscount").submit(function(e){
                   const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                              });
                   e.preventDefault();
                     const formData  = new FormData(this);
                      formData.append('addnewDiscount', 'true');
                    Swal.fire({
                        title: "You're about to add new discount.",
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
                              data: formData,
                              contentType: false,
                              cache: false,
                              processData:false,
                              success: function(data){
                                if (data > 0 && data < 2) 
                                {
                                  
                                  Swal.fire({
                                    
                                            title: 'Supplier Data Updated!.',
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

$(window).on('load', function() {
    var today = new Date();
    var isFirstDayOfMonth = today.getDate() === 1;
    if (isFirstDayOfMonth == false) {
    var isFirstDayOfMonth = today.getDate() === 2;     
    }
    if (isFirstDayOfMonth == false) {
    var isFirstDayOfMonth = today.getDate() === 3;     
    }
    if (isFirstDayOfMonth) {
      console.log("Today is the first day of the month!");
       $.ajax({
                url:'ajax/checkmrep.php',
                type: 'GET',
                dataType: 'html',
              }).done(function(ddta){
                if (ddta >= 1) {

                }else{
       $.ajax({
              url: 'modal_content/loadingscreen.php',
              type: 'GET',
              dataType: 'html',
            }).done(function(data) {
              $('#modalContent').html(data);
              $("#My_modal").modal({
                backdrop: 'static',
                keyboard: false
              });

                    setInterval(function() {
                          $.ajax({
                            url:'ajax/backupMonthlyInventory.php',
                            type: 'GET',
                            dataType: 'html',
                          }).done(function(dta){
                            if (dta > 0) {
                                 Swal.fire({
                                            title: 'Monthly Report Successully Generated!.',
                                            text: "The data was saved to database!",
                                            icon: 'success',
                                            timer: 4000
                                       }).then((result) => {
                                          $("#My_modal").modal('hide')
                                       });     
                            }else{

                            }
                          });
                          }, 5000);
            

            });
        }
      });

    } else {
      // console.log("Today is not the first day of the month.");
      

    }
    
});

function newStockValidation(){
    // alert("haha")
      $.ajax({
            url:'ajax/newStockValidation.php',
            type: 'GET',
            data:{
                delornumber:$("#DelOrNumber").val(),
                delamout:$("#delamout").val(),
                 deldateInsert:$("#date_delivered_insert").val()
            },
            dataType: 'html',
          }).done(function(ddta){
            if (ddta > 0) {
                $("#insertnewStocks").attr('disabled', true);
            }else{
                 $("#insertnewStocks").attr('disabled', false);
            }

          });


}