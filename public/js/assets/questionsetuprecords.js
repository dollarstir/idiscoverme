$.fn.dataTable.ext.errMode = 'none';
dataset = $('#questionsetups').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load question setups!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
    "ajax": url+"questions/setup/list",
    "columns": [
        { "data": "name" },
        { "data": "created_at" },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+'questions/setup/'+data.id+'/questions" class="btn btn-outline-primary py-2"><i class="mdi mdi-menu"></i></a>';
        }
         },
         {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<div onclick="edit(this,'+datainfo.id+',\''+htmlspecialchars(datainfo.name)+'\')" class="btn btn-outline-primary py-2" style="cursor:pointer"><i class="mdi mdi-pencil"></i></div>';
        }
         },
         {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<div id="'+datainfo.id+'id" class="btn btn-outline-danger py-2" onclick="delete_c(this,'+datainfo.id+',\''+htmlspecialchars(datainfo.name)+'\')"><i class="mdi mdi-delete"></i></div>';
        }
         }
        
    ],
   
} );

function edit(e,id,name){
  swal({
    title: 'Edit Question Setup Name',
    icon: 'info',
    content: {
      element: "input",
      attributes: {
        placeholder: "Enter question setup name",
        type: "text",
        class: 'form-control',
        id: "editquestionsetup",
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
        form.append("name",$("#editquestionsetup").val());
       $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: url+'questions/setup/'+id+'/edit',
          type: 'POST',
          data: form,
          processData: false,
          contentType: false,
          beforeSend:function(e){
        },
          error: function() {
            $(id).html('<i class="mdi mdi-pencil"></i>');
              swal({
                title: 'Notice!',
                icon: 'error',
                text: 'if your\'re online, please check your internet connectivity and try again!',
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
                swal({
                  title: 'Congratulations!',
                  icon: 'success',
                  text: response.message,
                  button: {
                    text: "Ok!",
                    value: true,
                    visible: true,
                    className: "btn btn-primary"
                  }
                })
              } else {
                swal({
                  title: 'Notice!',
                  icon: 'error',
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

function delete_c(e,id,name){
  swal({
    title: 'Are you sure?',
    text: "You want to delete "+name+"? This will delete all questions and score under this setup",
    icon: 'warning',
    showCancelButton: true,
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
        text: "Yes",
        value: true,
        visible: true,
        className: "btn btn-primary",
        closeModal: true
      }
    }
  }).then(function(ed){
      if(ed){
        
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: url+'question/setup/'+id+'/delete',
          type: 'POST',
          data: form,
          processData: false,
          contentType: false,
          beforeSend:function(e){
            $("#"+e.id).html('deleting...');
        },
          error: function() {
            $("#"+e.id).html('<i class="mdi mdi-delete"></i>');
              swal({
                title: 'Notice!',
                icon: 'error',
                text: 'if your\'re online, please check your internet connectivity and try again!',
                button: {
                  text: "OK",
                  value: true,
                  visible: true,
                  className: "btn btn-danger"
                }
              })
          },
          success: function(response) {
                $("#"+e.id).html('<i class="mdi mdi-delete"></i>');
              if (response.success) {
                dataset.ajax.reload();
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
                  title: 'Notice!',
                  icon: 'error',
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
  })
}

