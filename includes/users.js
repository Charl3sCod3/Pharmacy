function approveuser(that){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
       $.ajax({
            url:'includes/queries.php',
            type:'GET',
            data:{u_id:that,approveUser:'true'},
            dataType:'html',
        }).done(function(data){
          if (data == 1) {
          Swal.fire({
                                      
            title: 'New User is Approved!.',
            text: "The data was Updated!",
            icon: 'success',
       }).then((result) => {
                     if (result.value == true) {
                         window.location.reload();
                     }
                   });
          }
          });
  }
  function disapprove(that){
       $.ajax({
            url:'includes/queries.php',
            type:'GET',
            data:{u_id:that,disapproveUser:'true'},
            dataType:'html',
        }).done(function(data){
          if (data > 1) {
            Swal.fire({
                                      
              title: 'User Disapproved!',
              text: "The data was Updated!",
              icon: 'warning',
         }).then((result) => {
                     if (result.value == true) {
                         window.location.reload();
                     }
                   });
          } 
          });
  }
function ViewUserApplication(that){
       $.ajax({
            url:'modal_content/ViewUserApplication.php',
            type:'GET',
            data:{ur_id:that},
            dataType:'html',
        }).done(function(data){
            $('#modalContent').html('');
            $('#modalContent').html(data);
            $("#My_modal").modal('show');
          });
  }
  function diactivateUser(that){
    Swal.fire({
      title:'You are about to Diactivate a User!',
      text: "Are you sure?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: "Cancel",
      confirmButtonText: 'Yes'
    }).then((result)=>{
      $.ajax({  url:'includes/queries.php',
          type:'GET',
          data:{ur_id:that,diactivateUser:'true'},
          dataType:'html',
          success: function(data){
            if (data > 0) 
            {
              
              Swal.fire({
                
                        title: 'User Data Successully Updated!.',
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
                
                        title: 'Failed to User Information!',
                        text: "Encountered a problem",
                        icon: 'warning',
                        timer: 3000
                   }).then((result) => {
                     if (result.value == true) {
                         
                     }
                   });
            }
          }
       });
    });
  }
  function activateUser(that){
    Swal.fire({
      title:'You are about to Activate a User!',
      text: "Are you sure?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: "Cancel",
      confirmButtonText: 'Yes'
    }).then((result)=>{
      $.ajax({  url:'includes/queries.php',
          type:'GET',
          data:{ur_id:that,activateUser:'true'},
          dataType:'html',
          success: function(data){
            if (data > 0) 
            {
              
              Swal.fire({
                
                        title: 'User Data Successully Updated!.',
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
                
                        title: 'Failed to User Information!',
                        text: "Encountered a problem",
                        icon: 'warning',
                        timer: 3000
                   }).then((result) => {
                     if (result.value == true) {
                         
                     }
                   });
            }
          }
       });
    });
  }
  function editUserData1(that){
       $.ajax({
            url:'modal_content/editUserData1.php',
            type:'GET',
            data:{ur_id:that},
            dataType:'html',
        }).done(function(data){
            $('#modalContent').html('');
            $('#modalContent').html(data);
            $("#My_modal").modal('show');
            $("#edituserdataForm").submit(function(e){
              e.preventDefault();
                 Swal.fire({
                          title: 'You are about to make changes on User Data?',
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
                                  if (data > 0) 
                                  {
                                    
                                    Swal.fire({
                                      
                                              title: 'User Data Successully Updated!.',
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
                                      
                                              title: 'Failed to User Information!',
                                              text: "Encountered a problem",
                                              icon: 'warning',
                                              timer: 3000
                                         }).then((result) => {
                                           if (result.value == true) {
                                               
                                           }
                                         });
                                  }
                                }
                             });
                       } else {

                       }
                     });
                    
              });

          });
  }
  function editUserData(that){
       $.ajax({
            url:'modal_content/editUserData.php',
            type:'GET',
            data:{ur_id:that},
            dataType:'html',
        }).done(function(data){
            $('#modalContent').html('');
            $('#modalContent').html(data);
            $("#My_modal").modal('show');
            $("#edituserdataForm").submit(function(e){
              e.preventDefault();
                 Swal.fire({
                          title: 'You are about to make changes on User Data?',
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
                                  if (data > 0) 
                                  {
                                    
                                    Swal.fire({
                                      
                                              title: 'User Data Successully Updated!.',
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
                                      
                                              title: 'Failed to User Information!',
                                              text: "Encountered a problem",
                                              icon: 'warning',
                                              timer: 3000
                                         }).then((result) => {
                                           if (result.value == true) {
                                               
                                           }
                                         });
                                  }
                                }
                             });
                       } else {

                       }
                     });
                    
              });

          });
  }
  $("#resgisterForm").submit(function(e){
                     const Toast = Swal.mixin({
                                  toast: true,
                                  position: 'top-end',
                                  showConfirmButton: false,
                                  timer: 3000
                                });
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
                                      
                                              title: 'Zone Data Successully Updated!.',
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
                                      
                                              title: 'Failed to submit application!',
                                              text: "Username / password already Exist",
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