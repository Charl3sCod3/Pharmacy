function transaction_product(that){

	$.ajax({
		 url:'ajax/getProductByProduct.php',
        type:'GET',
        data:{p_id:that}, 
        dataType:'html'
	}).done(function(data){
		$datax = data.split("|");
		$("#product_code").val($datax[0]);
		$("#trans_price").val($datax[1]); 
    $("#trans_qtty").focus();
	})

}
function AddDiscount(total,that){
  $.ajax({
    url:'ajax/getDiscount.php',
    type:'GET',
    data:{d_id:that},
    dataType:'html'
  }).done(function(data){
    datax = data.replace(/\s+/g, '');
    decimal = datax / 100;
     console.log(decimal);
    discounted = total - (total * decimal);
    $('#vb_total').html(discounted);
    $('#customer_cash').attr('totalamount', discounted);
    $('#customer_cash').attr('discount_id', datax);
  })
}
function setThisCustomer(that){

	$.ajax({
		 url:'ajax/setThisCustomer.php',
        type:'GET',
        data:{c_id:that},
        dataType:'html'
	}).done(function(data){
		window.location.reload();
	})

}
function setThisCustomerModal(C_id){
   $.ajax({
        url:'modal_content/setThisCustomerModal.php',
        type:'GET',
        data:{c_id:C_id},
        dataType:'html',
    }).done(function(data){
        $('#modalContent').html('');
        $('#modalContent').html(data);
        $("#My_modal").modal('show');
        $("#updateCustomerData").submit(function(e){
                         const Toast = Swal.mixin({
                                      toast: true,
                                      position: 'top-end',
                                      showConfirmButton: false,
                                      timer: 3000
                                    });
                         e.preventDefault();
                          Swal.fire({
                              title: "You're About to Update Customer Information",
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
                                               window.location.reload();
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
function removeTransactionItem(that){
  Swal.fire({
        title: "You're About to remove an Item!",
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
        url:'includes/queries.php',
        type:'GET',
        data:{co_id:that,removeTransactionItem:'true'},
        dataType:'html'
      }).done(function(data){
        if (data > 0) {
               Swal.fire({     
                    title: 'Successfully removed an item!',
                    text: "Database is updated!",
                    icon: 'success',
                    timer: 500,
                     showConfirmButton: false
               }).then((result) => {
                 window.location.reload();
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

// function addnewCustomer(){
//   Swal.fire({
//         title: "You want to add new Customer",
//         text: "Are you sure?",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         cancelButtonText: "No",
//         confirmButtonText: 'Yes'
//    }).then((result) => {
//     if (result.value == true) {
//       $.ajax({
//         url:'includes/queries.php',
//         type:'GET',
//         data:{AddnewCustomer:'true'},
//         dataType:'html'
//       }).done(function(data){
//         console.log(data);
//         if (data > 0) {
//                Swal.fire({     
//                     title: 'Successfully Added new Customer!',
//                     text: "The data was saved to database!",
//                     icon: 'success',
//                     timer: 3000
//                }).then((result) => {
//                  if (result.value == true) {
//                      window.location.reload();
//                  }
//                });       
//             }else{
//               Swal.fire({                          
//                   title: 'Failed to detele!',
//                   text: "Encountered an Error! / Tryagain Later",
//                   icon: 'warning',
//                   timer: 3000
//              }).then((result) => {
//                if (result.value == true) {
                 
//                }
//              });      
//             }
//       });
//     }
//   });
// }
function addnewCustomer(){
  $.ajax({
        url:'includes/queries.php',
        type:'GET',
        data:{AddnewCustomer:'true'},
        dataType:'html'
      }).done(function(data){
        window.location.reload();
      });
}
function removeActiveCustomer(that){
  $.ajax({
        url:'includes/queries.php',
        type:'GET',
        data:{c_id:that,remove_cutomer:'true'},
        dataType:'html'
      }).done(function(data){
        window.location.reload();
      });
}
function checkTransQtty(that){
	PID = $("#product_name").val();
	$.ajax({
		url:'ajax/checkTransQtty.php',
		type:'GET',
		data:{p_id:PID,trans_qtty:that},
		dataType:'html'
	}).done(function(data){
    datax = data.split("|");
		if (datax[0] > 0) {
			 userInput = Number($("#trans_qtty").val()); // get user input as a number
					if (!userInput) { // check if user input is empty or zero
					 $("#trans_submit").attr('disabled', true);
					} else if (userInput < 0) { // check if user input is less than zero
					  $("#trans_submit").attr('disabled', true);
					} else {
					 $("#trans_submit").attr('disabled', false);
           $("#trans_price").val(datax[1]);
					}

		}else{
			$("#trans_submit").attr('disabled', true);
			Swal.fire({                          
                  title: 'The Quantity Entered is Greater Than Available',
                  text: "Thank you!",
                  icon: 'warning',
                  timer: 3000
             }).then((result) => {
               if (result.value == true) {
                 
               }
             });
		}

	});
}
$("#prodcode_submit").submit(function(e){
   e.preventDefault();
	$.ajax({  url:'ajax/transProductCode.php',
	        type: "POST",
	        data: new FormData(this),
	        contentType: false,
	        cache: false,
	        processData:false,
	        success: function(data){
          $datax = data.split("||");
          $("#product_name").html($datax[0]);
          $("#trans_price").val($datax[1]);
          $("#trans_qtty").focus();
	        }
	     });
      });
$("#addTransItem").submit(function(e){
               const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                          });
               e.preventDefault();
               const formData  = new FormData(this);
               formData.append('addTransItem', 'true');
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
                                
                                        title: 'New Product Added',
                                        text: "The data was saved to database!",
                                        icon: 'success',
                                        timer: 700,
                                         showConfirmButton: false
                                   }).then((result) => {
                                     window.location.reload();
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

});
function paytime(that){
  Swal.fire({
        title: "Check out the Purchase!",
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
        url:'includes/queries.php',
        type:'GET',
        data:{c_id:that,paytime:'true'},
        dataType:'html'
      }).done(function(data){
        if (data > 0) {
               Swal.fire({     
                    title: 'Successfully Added new Customer!',
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
function getthechangeis(){
  cash = $("#customer_cash").val();
  amount = $("#customer_cash").attr('totalamount');
  changeis = parseFloat(cash) - parseFloat(amount);
  if (parseFloat(changeis) < 0) {

  }else{

  }
  $("#thechangehere").html('&nbsp'+moneyFormat(changeis));
}
function viewtotalBill(C_id){
   $.ajax({
        url:'modal_content/viewtotalBill.php',
        type:'GET',
        data:{c_id:C_id},
        dataType:'html',
    }).done(function(data){
        $('#modalContent').html('');
        $('#modalContent').html(data);
        $("#My_modal").modal('show');
          $('#customer_cash').on('focus', function() {
              $(this).select();
              });
        $("#paynowbutton").submit(function(e){
                         const Toast = Swal.mixin({
                                      toast: true,
                                      position: 'top-end',
                                      showConfirmButton: false,
                                      timer: 3000
                                    });
                      convert  = $("#customer_cash").val();
                      convert1 = $("#customer_cash").attr('totalamount');
                      customer_id = $("#customer_cash").attr('customer_id');
                      discount_id = $("#customer_cash").attr('discount_id');
                      const difference = convert - convert1;
                      $("#customer_cash").val(moneyFormat(convert));
                      changeis = moneyFormat(difference);
                      e.preventDefault();
                  if (parseInt(convert) >= parseInt(convert1)) {
                      newform =  new FormData(this);
                      newform.append('thechange',difference);
                      newform.append('topay',convert1);
                      newform.append('themoney',convert);
                      newform.append('paytimeNow','true');
                      newform.append('customer_id', customer_id);
                      newform.append('discount_id', discount_id);
                          Swal.fire({
                              title: changeis,
                              text: "Above is the customers Change",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              cancelButtonText: "cancel",
                              confirmButtonText: 'Pay'
                         }).then((result) => {
                          if (result.value == true) {
                            thats = 'printable/receipt.php?c_id='+C_id;
                            $.ajax({  url:'includes/queries.php',
                                    type: "POST",
                                    data: newform,
                                    contentType: false,
                                    cache: false,
                                    processData:false,
                                    success: function(data){
                                      console.log(discount_id);
                                      if (data > 0 && data < 2) 
                                      {
                                        
                                        Swal.fire({
                                          
                                                  title: 'New Product Added',
                                                  text: "The data was saved to database!",
                                                  icon: 'success',
                                                  timer: 3000
                                             }).then((result) => {
                                              openPopUp1(thats);
                                                window.location.reload();
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

                       }else{
                        Swal.fire({
                                          
                                                  title: 'The cash entered is less than amount to pay!',
                                                  text: "Please check",
                                                  icon: 'warning',
                                                  timer: 3000
                                             }).then((result) => {
                                              if (result.value == true) {
                                                $("#customer_cash").focus();
                                              }
                                             });
                       }
      });
      });
}


$("#search_transaction").submit(function(e){
               e.preventDefault();
                window.location.href = '?q=search_transaction&search_request='+$("#search_request").val();

});
$("#salesCDForm").submit(function(e){
e.preventDefault();
 Swal.fire({
          title: "Submit you're Sales Report for today?",
          text: "Are you Sure?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: "No",
          confirmButtonText: 'Yes'
     }).then((result) => {
      if (result.value == true) {
      $.ajax({  url:'ajax/submitCDtoday.php',
          type: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
              if (data > 0 && data < 2) {
                 Swal.fire({                                         
                          title: 'Successfully Submitted Sales Report!',
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
                                          
                            title: 'Failed Or Encountered a problem!',
                            text: "Contact Developer",
                            icon: 'warning',
                            timer: 3000
                       }).then((result) => {
                       });
                }                        
          }
       });
      }
      });
  });
$("#fetch_salesReport").submit(function(e){
e.preventDefault();
theuser = $("#stheuseris").val();
thedate = $("#sthedate").val();
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
        window.location.href="?q=sub_sales_rep&theuseris="+theuser+"&thedate="+thedate;
        }
      });
});

function payshorted(User_id,Today,Amount){
 Swal.fire({
          title: "Cashier Pay Shortage?",
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
             url:'ajax/payshorted.php',
             type:'GET',
             data:{uid:User_id,todate:Today,amount:Amount},
             dataType:'html'
          }).done(function(data){
            console.log(data);
                  if (data > 0 && data < 2) {
                                   Swal.fire({
                                                            
                                            title: 'Cashier Payment Updated!',
                                            text: "The data was saved to database!",
                                            icon: 'success',
                                            timer: 3000
                                       }).then((result) => {
                                          window.location.reload();
                                       });         
                                  }else{
                                      Swal.fire({
                                                            
                                              title: 'Failed Or Encountered a problem!',
                                              text: "Contact Developer",
                                              icon: 'warning',
                                              timer: 3000
                                         }).then((result) => {
                                         });
                                  } 
          })
        }
      });
}
function updateQttyOrder(that){
 $.ajax({
        url:'modal_content/changeqttytransaction.php',
        type:'GET',
        data:{or_id:that},
        dataType:'html',
    }).done(function(data){
        $('#modalContent').html('');
        $('#modalContent').html(data);
        $("#My_modal").modal('show');
        $("#changetransqtty").submit(function(e){
                         const Toast = Swal.mixin({
                                      toast: true,
                                      position: 'top-end',
                                      showConfirmButton: false,
                                      timer: 3000
                                    });
                         e.preventDefault();
                          Swal.fire({
                              title: "Update the quantity?",
                              text: "Are you sure?",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              cancelButtonText: "cancel",
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
                                          
                                                  title: 'Successfully Updated data',
                                                  text: "The data was saved to database!",
                                                  icon: 'success',
                                                  timer: 3000
                                             }).then((result) => {
                                                window.location.reload();
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
function openSettings(){
  $.ajax({
        url:'modal_content/openSettings.php',
        type:'GET',
        dataType:'html',
    }).done(function(data){
        $('#modalContent').html('');
        $('#modalContent').html(data);
        $("#My_modal").modal('show');
        $("#openSettingsUpdate").submit(function(e){
                         const Toast = Swal.mixin({
                                      toast: true,
                                      position: 'top-end',
                                      showConfirmButton: false,
                                      timer: 3000
                                    });
                         e.preventDefault();
                          Swal.fire({
                              title: "Update System Settings!",
                              text: "Are you sure?",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              cancelButtonText: "cancel",
                              confirmButtonText: 'Yes'
                         }).then((result) => {
                          if (result.value == true) {
                            const fileInput = document.getElementById("file_input");
                            const formData  = new FormData(this);
                            formData.append('openSettingsUpdate', 'true');
                            formData.append("image", fileInput.files[0]);
                            $.ajax({  url:'includes/queries.php',
                                    type: "POST",
                                    data: formData,
                                    contentType: false,
                                    cache: false,
                                    processData:false,
                                    success: function(data){
                                      console.log(data);
                                      if (data > 0 && data < 2) 
                                      {
                                        
                                        Swal.fire({
                                          
                                                  title: 'Successfully Updated data',
                                                  text: "The data was saved to database!",
                                                  icon: 'success',
                                                  timer: 3000
                                             }).then((result) => {
                                                window.location.reload();
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
$("#returnitemquery").submit(function(e){
                 const Toast = Swal.mixin({
                              toast: true,
                              position: 'top-end',
                              showConfirmButton: false,
                              timer: 3000
                            });
                 e.preventDefault();
                  Swal.fire({
                      title: "You're about to return an item!",
                      text: "Are you sure?",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      cancelButtonText: "cancel",
                      confirmButtonText: 'Yes'
                 }).then((result) => {
                  if (result.value == true) {
                    const formData  = new FormData(this);
                    formData.append('returnanitem', 'true');
                    $.ajax({  url:'includes/queries.php',
                            type: "POST",
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                            success: function(data){
                              console.log(data);

                                Swal.fire({
                                  
                                          title: 'Returned Amount is '+ data,
                                          text: "This is the total Amount of returned item",
                                          icon: 'success',
                                          timer: 3000
                                     }).then((result) => {
                                        window.location.reload();
                                     });           
                            
                            }
                         });
                  }
                 });
});


$(document).ready(function() {
    $('#trans_price').on('dblclick', function() {
      Swal.fire({
                title: "Set Custom Price?",
                text: "Are you sure?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "No",
                confirmButtonText: 'Yes'
           }).then((result) => {
            if (result.value == true) {

    $(this).attr('name', 'newpricing');
    $(this).prop('readonly', false);
    }
    });

    });
  });
$(document).ready(function() {
  // Initialize the button state based on whether any checkboxes are checked
  updateButtonState();

  $('input[name="return[]"]').on('change', function() {
    // Update the button state whenever any checkbox changes
    updateButtonState();
  });

  function updateButtonState() {
    var anyChecked = false;
    // Check if any checkbox is checked
    $('input[name="return[]"]:checked').each(function() {
      anyChecked = true;
    });
    // Enable or disable the button based on whether any checkboxes are checked
    $('#btn-return').prop('disabled', !anyChecked);
  }
});
function editDiscount(that){
   $.ajax({
        url:'modal_content/editDiscount.php',
        type:'GET',
        data:{pt_id:that},
        dataType:'html',
    }).done(function(data){
        $('#modalContent').html('');
        $('#modalContent').html(data);
        $("#My_modal").modal('show');
        $("#editDiscount").submit(function(e){
                         const Toast = Swal.mixin({
                                      toast: true,
                                      position: 'top-end',
                                      showConfirmButton: false,
                                      timer: 3000
                                    });
                         e.preventDefault();
                          Swal.fire({
                              title: "You're About to make changes",
                              text: "Are you sure? please double check",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              cancelButtonText: "double check",
                              confirmButtonText: 'Yes'
                         }).then((result) => {
                          if (result.value == true) {
                              const formData  = new FormData(this);
                              formData.append('editdiscount', 'true');
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
                                          
                                                  title: 'Successfully Updated data',
                                                  text: "The data was saved to database!",
                                                  icon: 'success',
                                                  timer: 3000,
                                                  showConfirmButton: false
                                             }).then((result) => {
                                               window.location.reload();
                                             });           
                                      }
                                      if (data > 1) {
                                        Swal.fire({
                                          
                                                  title: 'Failed Or Encountered a problem!',
                                                  text: "Contact Developer",
                                                  icon: 'warning',
                                                  timer: 3000,
                                                  showConfirmButton: false
                                             })
                                      }
                                    }
                                 });
                          }
                         });
      });
      });
}