$.fn.dataTable.ext.errMode = 'none';
dataset = $('#example').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load roles!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
    "ajax": url+"roles/list",
    "columns": [
        { "data": "name" },
        { "data": "created_at" },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+'role/'+data.id+'/permissions" class="btn btn-outline-primary py-2"><i class="mdi mdi-account-key"></i></a>';
        }
         },
        { 
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<div class="btn btn-outline-primary py-2" onclick="editrole(this,'+datainfo.id+',\''+datainfo.name+'\')"><i class="mdi mdi-pencil"></i></div>';
          }
         },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<div id="'+datainfo.id+'" class="btn btn-outline-danger py-2" onclick="delete_role(this,'+datainfo.id+')"><i class="mdi mdi-delete"></i></div>';
          }
        }
    ],
   
} );

var permissionRequest = [];
  $("#AddPermission").submit(function(e){
    var formdata = new FormData();
      e.preventDefault();
      var permission = $('input[name="permission[]"]').serializeArray();
      permissionRequest = [];
    $.each(permission, function(i, field) {
        if (jQuery.inArray(field.value, permissionRequest) < 0) {
          permissionRequest.push(field.value);
        }
    });
    for (var i = 0; i < permissionRequest.length; ++i) {
        formdata.append("permissions[" + i + "]", permissionRequest[i]);
    }
   
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url+'role/'+$("#pid").val()+'/permissions',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend:function(e){
          $("#savePermission").prop("disabled", true);
          $("#savePermission").html("Saving.....");
      },
        error: function() {
            $("#savePermission").html("Save Permission");
            $("#savePermission").prop("disabled", false);
            swal({
              title: 'Warning!',
              text: 'Something went wrong!',
              button: {
                text: "OK",
                value: true,
                visible: true,
                className: "btn btn-danger"
              }
            })
        },
        success: function(response) {
          $("#savePermission").html("Save Permission");
          $("#savePermission").prop("disabled", false);
            if (response.success) {
              swal({
                title: 'Congratulations!',
                icon: 'success',
                text: response.message,
                button: {
                  text: "Continue",
                  value: true,
                  visible: true,
                  className: "btn btn-primary"
                }
              }).then(function(){
                window.location.assign(url+"roles/")
              })
            } else {
              swal({
                title: 'Warning!',
                text: response.message,
                button: {
                  text: "OK",
                  value: true,
                  visible: true,
                  className: "btn btn-danger"
                }
              })
            }
            
  
        }
    });
  });
  function createRole(){
    formdata.append("role",$("#role").val());
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: url+'roles/new',
      type: 'POST',
      data: formdata,
      processData: false,
      contentType: false,
      beforeSend:function(e){
        $("#saveRole").prop("disabled", true);
        $("#saveRole").html("Saving.....");
    },
      error: function() {
          $("#saveRole").html("Save Role");
          $("#saveRole").prop("disabled", false);
          swal({
            title: 'Warning!',
            text: 'Something went wrong!',
            button: {
              text: "OK",
              value: true,
              visible: true,
              className: "btn btn-danger"
            }
          })
      },
      success: function(response) {
        $("#saveRole").html("Save Role");
        $("#saveRole").prop("disabled", false);
          if (response.success) {
            swal({
              title: 'Congratulations!',
              icon: 'success',
              text: response.message,
              button: {
                text: "Continue",
                value: true,
                visible: true,
                className: "btn btn-primary"
              }
            }).then(function(){
              window.location.assign(url+"role/"+response.rid+"/permissions")
            })
          } else {
            swal({
              title: 'Warning!',
              text: response.message,
              button: {
                text: "OK",
                value: true,
                visible: true,
                className: "btn btn-danger"
              }
            })
          }
          

      }
  });
  }
  function editrole(e,id,name){
    swal({
      title: 'Edit Role',
      content: {
        element: "input",
        attributes: {
          placeholder: "Enter new role name",
          type: "text",
          class: 'form-control',
          id: "editrole",
          value: name
        },
      },
      button: {
        text: "OK",
        value: true,
        visible: true,
        className: "btn btn-primary"
      }
    }).then(function(e){
        if(e){
          
          form.append("rolename",$("#editrole").val());
          form.append("roleid",id)
         $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url+'role/edit',
            type: 'POST',
            data: form,
            processData: false,
            contentType: false,
            beforeSend:function(e){
              $(id).html('deleting...');
          },
            error: function() {
              $(id).html('<i class="mdi mdi-delete"></i>');
                swal({
                  title: 'Warning!',
                  text: 'Something went wrong!',
                  button: {
                    text: "OK",
                    value: true,
                    visible: true,
                    className: "btn btn-danger"
                  }
                })
            },
            success: function(response) {
                if (response.success) {
                  dataset.ajax.reload();
                  $(id).html('<i class="mdi mdi-pencil"></i>');
  
                  swal({
                    title: 'Congratulations!',
                    icon: 'success',
                    text: response.message,
                    button: {
                      text: "Continue",
                      value: true,
                      visible: true,
                      className: "btn btn-primary"
                    }
                  })
                } else {
                  swal({
                    title: 'Warning!',
                    text: response.message,
                    button: {
                      text: "OK",
                      value: true,
                      visible: true,
                      className: "btn btn-danger"
                    }
                  })
                }
                
    
            }
        });
        }
    });
  }
  function delete_role(id,e){
    form = new FormData();
    form.append("roleid",e);
    swal({
          title: 'Are you sure?',
          text: "You won't be able to delete this role!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3f51b5',
          cancelButtonColor: '#ff4081',
          confirmButtonText: 'Great ',
          buttons: {
            cancel: {
              text: "Cancel",
              value: null,
              visible: true,
              className: "btn btn-danger",
              closeModal: true,
            },
            confirm: {
              text: "OK",
              value: true,
              visible: true,
              className: "btn btn-primary",
              closeModal: true
            }
          }
        }).then(function(e){
          if(e){
            $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: url+'role/delete',
              type: 'POST',
              data: form,
              processData: false,
              contentType: false,
              beforeSend:function(e){
                $(id).html('deleting...');
            },
              error: function() {
                $(id).html('<i class="mdi mdi-delete"></i>');
                  swal({
                    title: 'Warning!',
                    text: 'Something went wrong!',
                    button: {
                      text: "OK",
                      value: true,
                      visible: true,
                      className: "btn btn-danger"
                    }
                  })
              },
              success: function(response) {
                  if (response.success) {
                    dataset.ajax.reload();
                    $(id).html('<i class="mdi mdi-delete"></i>');
  
                    swal({
                      title: 'Congratulations!',
                      icon: 'success',
                      text: response.message,
                      button: {
                        text: "Continue",
                        value: true,
                        visible: true,
                        className: "btn btn-primary"
                      }
                    })
                  } else {
                    swal({
                      title: 'Warning!',
                      text: response.message,
                      button: {
                        text: "OK",
                        value: true,
                        visible: true,
                        className: "btn btn-danger"
                      }
                    })
                  }
                  
      
              }
          });
          }
        });
  }