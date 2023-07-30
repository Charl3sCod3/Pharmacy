$("#addDeliveryToInventory").submit(function(e){
  dlt = $("#DLT").val();
  delamout = $("#delamout").val();
             // if (parseFloat(dlt) < parseFloat(delamout)) {

             // }else{

             // }
  const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end', 
                          showConfirmButton: false, 
                          timer: 3000
                        });
             e.preventDefault();  
              Swal.fire({
                  title: "Add delivery to inventory?!",
                  text: "Are you sure? please double check",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  cancelButtonText: "double check",
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
                              
                                      title: 'Delivery successfully added to inventory',
                                      text: "The data was saved to database!",
                                      icon: 'success',
                                      timer: 3000
                                 }).then((result) => {
                                   if (result.value == true) {
                                       window.location.reload();
                                   }
                                 });           
                          }
                          if (data < 1) {
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
function updateDrQtty(that,Dr_id){
  Swal.fire({
        title: "You're about to change Delivery item Quantity",
        text: "Are you sure?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "No",
        confirmButtonText: 'Yes'
   }).then((result) => {
    if (result.value == true) {
      $.ajax({
        url:'ajax/updateDrQtty.php',
        type:'GET',
        data:{value:that,dr_id:Dr_id},
        dataType:'html'
      }).done(function(data){
        if (data > 0) {
               Swal.fire({     
                    title: 'Delivery Item successfully updated Quantity',
                    text: "The data was saved to database!",
                    icon: 'success',
                    timer: 3000
               }).then((result) => {
                 if (result.value == true) {
                     window.location.reload();
                 }
               });       
            }else{
              Swal.fire({                          
                  title: 'Failed to detele!',
                  text: "Encountered an Error! / Tryagain Later",
                  icon: 'warning',
                  timer: 3000
             }).then((result) => {
               if (result.value == true) {
                 
               }
             });      
            }
      });
    }
  });
}
function expCheckDate(that,Dr_id,Inputdate){
    const day = (new Date(that)).getDate();
    const mon = (new Date(that)).getMonth();
    const yer = (new Date(that)).getFullYear();
    da = new Date().getDate();
    mo = new Date().getMonth()+2;
    ye = new Date().getFullYear();

    if(parseInt(mon) <= parseInt(mo) && parseInt(yer) <= parseInt(ye))
    {
      Swal.fire({          
              title: 'You can enter an almost expired product',
              text: "Please check!",
              icon: 'warning',
              timer: 3000
         }).then((result) => {
           if (result.value == true) {
              
           }
         });
         $(".input_date"+Inputdate).val("");

    }else{
         $.ajax({
              url:'ajax/UpdateExp.php',
              type:'GET',
              data:{dr_id:Dr_id,expdate:that},
              dataType:'html',
          }).done(function(data){
            
          });
    }

}
function removeDrItem(that){
  Swal.fire({
        title: "Delete delivery item?",
        text: "Are you sure? please double check",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "double check",
        confirmButtonText: 'Yes'
   }).then((result) => {
    if (result.value == true) {
      $.ajax({
            url:'ajax/deleteDRitem.php',
            type:'GET',
            data:{dr_id:that},
            dataType:'html',
        }).done(function(data){
            if (data > 0) {
               Swal.fire({     
                    title: 'Successfully deleted data!',
                    text: "Database updated",
                    icon: 'success',
                    timer: 3000
               }).then((result) => {
                 if (result.value == true) {
                     window.location.reload();
                 }
               });       
            }else{
              Swal.fire({                          
                  title: 'Deletion was stop!',
                  text: "Can't delete data with dependencies!",
                  icon: 'warning',
                  timer: 3000
             }).then((result) => {
               if (result.value == true) {
                 
               }
             });      
            }
        })
    }
  });
}
function addnewProduct(Product_code){
       $.ajax({
            url:'modal_content/addnewProduct.php',
            type:'GET',
            data:{product_code:Product_code},
            dataType:'html',
        }).done(function(data){
            $('#modalContent').html('');
            $('#modalContent').html(data);
            $("#My_modal").modal('show');
            $(".selectnew").select2();
             $('.onlyNumbers').on('keyup', function() {
                const regex = /^[0-9]+(\.[0-9]{0,2})?$/; // regular expression to check for valid input
                const input = $(this).val();
                if (!regex.test(input)) {
                  $(this).val(input.substring(0, input.length - 1)); // remove the last character from the input
                }
              });
            $("#addnewProduct").submit(function(e){
                             const Toast = Swal.mixin({
                                          toast: true,
                                          position: 'top-end',
                                          showConfirmButton: false,
                                          timer: 3000
                                        });
                             e.preventDefault();
                              Swal.fire({
                                  title: "You're about to add new product!",
                                  text: "Are you sure? please double check",
                                  icon: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  cancelButtonText: "double check",
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
                                              
                                                      title: 'New Product Added',
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
$("#addProductQuantity").submit(function(e){
                   const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                              });
                   e.preventDefault();
                    Swal.fire({
                        title: "You're about to add product inventory!",
                        text: "Are you sure? please double check",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: "double check",
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
                                    
                                            title: 'Product inventory Updated',
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

function setsupplier(that){
$.ajax({
            url:'ajax/setsupplier.php',
            type:'GET',
            data:{sup_id:that},
            dataType:'html',
        }).done(function(data){
          window.location.reload();
        });
}
function editpcat(that){
       $.ajax({
            url:'modal_content/editPcat.php',
            type:'GET',
            data:{pc_id:that},
            dataType:'html',
        }).done(function(data){
            $('#modalContent').html('');
            $('#modalContent').html(data);
            $("#My_modal").modal('show');
            $("#editpcdata").submit(function(e){
                             const Toast = Swal.mixin({
                                          toast: true,
                                          position: 'top-end',
                                          showConfirmButton: false,
                                          timer: 3000
                                        });
                             e.preventDefault();
                              Swal.fire({
                                  title: 'Edit Product Category?',
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
                                              
                                                      title: 'Product Category Updated!.',
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
  function editptype(that){
       $.ajax({
            url:'modal_content/editptype.php',
            type:'GET',
            data:{pct_id:that},
            dataType:'html',
        }).done(function(data){
            $('#modalContent').html('');
            $('#modalContent').html(data);
            $("#My_modal").modal('show');
            $("#editptype").submit(function(e){
                             const Toast = Swal.mixin({
                                          toast: true,
                                          position: 'top-end',
                                          showConfirmButton: false,
                                          timer: 3000
                                        });
                             e.preventDefault();
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
                                          if (data > 0 && data < 2) 
                                          {
                                            
                                            Swal.fire({
                                              
                                                      title: 'Product Type Updated!.',
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
  $("#addNewCat").submit(function(e){
                     const Toast = Swal.mixin({
                                  toast: true,
                                  position: 'top-end',
                                  showConfirmButton: false,
                                  timer: 3000
                                });
                     e.preventDefault();
                      Swal.fire({
                          title: 'Insert New Product Category?',
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
                                      
                                              title: 'New Product Category Inserted!.',
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
  $("#addNewPtype").submit(function(e){
                     const Toast = Swal.mixin({
                                  toast: true,
                                  position: 'top-end',
                                  showConfirmButton: false,
                                  timer: 3000
                                });
                     e.preventDefault();
                      Swal.fire({
                          title: 'Insert New Product Type?',
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
                                      
                                              title: 'New Product Type Inserted!.',
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
  $("#loginForm").submit(function(e){
                     e.preventDefault();
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
                                      
                                              title: 'Login Successfull',
                                              text: "Welcome session Started",
                                              icon: 'success',
                                         }).then((result) => {
                                           if (result.value == true) {
                                                window.location.reload();
                                           }
                                         });           
                                  }else{
                                    Swal.fire({
                                              title: 'Account not yet approved or',
                                              text: "Invalid username / password",
                                              icon: 'warning',
                                         }).then((result) => {
                                           if (result.value == true) {
                                           }
                                         });          
                                  }
                                  if (data > 1) {
                                    Swal.fire({
                                              title: "You're Account is deactivated by the management!",
                                              text: "Please proceed to management.",
                                              icon: 'warning',
                                         }).then((result) => {
                                           if (result.value == true) {
                                           }
                                         });   
                                  }
                                }
                             });
                    

  });
  function delpcat(that){
     Swal.fire({
                title: "You're about to delete product category",
                text: "Are you sure?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "Cancel",
                confirmButtonText: 'Yes'
           }).then((result) => {
            if (result.value == true) {
               $.ajax({
                        url:'ajax/deleteProductCat.php',
                        type:'GET',
                        data:{pc_id:that},
                        dataType:'html',
                    }).done(function(data){ 
                      console.log(data)
                      if (data > 0) {
                        Swal.fire({
                                      
                                              title: 'Successfully deleted data!',
                                              text: "Database updated",
                                              icon: 'success',
                                         }).then((result) => {
                                           if (result.value == true) {
                                                // window.location.reload();
                                           }
                                         });  
                      }else{
                        Swal.fire({
                                              title: 'Deletion was stop!',
                                              text: "Can't delete data with dependencies!",
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
  function delptype(that){
     Swal.fire({
                title: "You're about to delete product type",
                text: "Are you sure?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "Cancel",
                confirmButtonText: 'Yes'
           }).then((result) => {
            if (result.value == true) {
               $.ajax({
                        url:'ajax/deleteProducttype.php',
                        type:'GET',
                        data:{pct_id:that},
                        dataType:'html',
                    }).done(function(data){ 
                      console.log(data)
                      if (data > 0) {
                        Swal.fire({
                                      
                                              title: 'Successfully deleted data!',
                                              text: "Database updated",
                                              icon: 'success',
                                         }).then((result) => {
                                           if (result.value == true) {
                                                window.location.reload();
                                           }
                                         });  
                      }else{
                        Swal.fire({
                                              title: 'Deletion was stop!',
                                              text: "Can't delete data with dependencies!",
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
      $(document).ready(function () {
    var t = $('#prod_cat-table').DataTable({
      
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
            },
        ],
        order: [[1, 'asc']],
    });
 
    t.on('order.dt search.dt', function () {
        let i = 1;
 
        t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
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
                         const Toast = Swal.mixin({
                                      toast: true,
                                      position: 'top-end',
                                      showConfirmButton: false,
                                      timer: 3000
                                    });
                         e.preventDefault();
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
  

  // Capture user input on keyup or change event
$('#product_codeis').on('keyup change', function() {
  var inputVal = $(this).val().toLowerCase();
  $.ajax({
    url:'ajax/product_code_filtertable.php',
    type:'GET',
    data:{product_code:inputVal},
    dataType:'html'
  }).done(function(data){
    alert(data)
  // table.search(data).draw();
  });
});
  $('#product_name').on('keyup change', function() {
    var inputVal = $(this).val().toLowerCase();
    // Filter the datatable based on the input value
    table.search(inputVal).draw();
  });
});