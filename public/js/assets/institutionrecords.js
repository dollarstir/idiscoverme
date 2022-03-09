$.fn.dataTable.ext.errMode = 'none';
dataset = $('#example').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load institutions!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
    "ajax": url+"institutions/list",
    "columns": [
        { "data": "name" },
        {
            "mData": null,
            "bSortable": false,
            "mRender": function(data, type, datainfo) {
              return '<img src="data:image/png;base64,'+datainfo.logo+'" />';
            }
        },
        { "data": "institution_type" },
        { "data": "district" },
        { "data": "GPS_address" },
        { "data": "POBox" },
        { "data": "created_at" },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+"institution/"+datainfo.institution_id+'/profile" class="btn btn-outline-primary py-2"><i class="mdi mdi-eye"></i></div>';
          }
        },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<div id="a'+datainfo.id+'" data-name="'+datainfo.name+'" data-inst_id="'+datainfo.institution_id+'" class="btn btn-outline-danger py-2" onclick="delete_institution(this,'+datainfo.id+')"><i class="mdi mdi-delete"></i></div>';
          }
        }
    ],
   
} );

function delete_institution(e,id){
  var webappData = document.getElementById("a"+id);
  var name = webappData.dataset.name;
  var inst_id = webappData.dataset.inst_id;
  swal({
        title: 'Are you sure?',
        text: "You won't be able to delete "+name+"!",
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
            url: url+'institution/'+inst_id+'/delete',
            type: 'GET',
            beforeSend:function(e){
              $("a"+id).html('deleting...');
          },
            error: function() {
              $("a"+id).html('<i class="mdi mdi-delete"></i>');
                swal({
                  icon: 'error',
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
                  $("a"+id).html('<i class="mdi mdi-delete"></i>');

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