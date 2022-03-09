
$.fn.dataTable.ext.errMode = 'none';
var inst_url = url+"institution/"+$("#inid").val()+"/members";
if($("#rid").val() !=""){
  inst_url = url+"institution/"+$("#inid").val()+"/members/report/"+$("#rid").val();
}
dataset = $('#example').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load institution members!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
    "ajax": inst_url,
    "columns": [
        { "data": "firstName" },
        { "data": "middleName" },
        { "data": "lastName" },
        { "data": "member_id" },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+"member/"+datainfo.member_id+'/profile" class="btn btn-outline-primary py-2"><i class="mdi mdi-account"></i></div>';
          }
        },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            var fullname = datainfo.firstName+" "+datainfo.middleName+" "+datainfo.lastName
            return '<div class="btn btn-outline-danger py-2"id="'+datainfo.member_id+'" style="cursor:pointer" onclick="removeMember(\''+datainfo.member_id+'\',\''+fullname+'\')"><i class="mdi mdi-delete"></i></div>';
          }
        }
    ],
   
} );
var makingscheme = $('#makingscheme').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load marking scheme!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
    "ajax": url+"institution/"+$("#inid").val()+"/marking/scheme",
    "columns": [
        { "data": "level" },
        { "data": "class_score" },
        { "data": "exams_score" },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            var level_name = ""
            return '<div class="btn btn-outline-danger py-2"id="'+datainfo.id+'" style="cursor:pointer" onclick="removeMarkingScheme(\''+datainfo.id+'\',\''+level_name+'\')"><i class="mdi mdi-delete"></i></div>';
          }
        }
    ],
   
} );
function removeMarkingScheme(id,name){

}
$("#institution_token").click(function(e){
  e.preventDefault();
  generateInstToken();
});
function generateInstToken(){
    swal({
          title: 'Are you sure?',
          text: "Want to generate new token for members!",
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
              url:  url+"institution/"+$("#inid").val()+"/generate/token",
              type: 'POST',
              data: form,
              processData: false,
              contentType: false,
              beforeSend:function(e){
                $("#istoken").html('Generating...');
            },
              error: function() {
                $("#istoken").html('Generate Token');
                  swal({
                    icon: 'error',
                    title: 'error!',
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
                $("#istoken").html('Generate Token');
                  if (response.success) {
                    swal({
                      title: 'Congratulations!',
                      icon: 'success',
                      text: response.message,
                      button: {
                        text: "Download",
                        value: true,
                        visible: true,
                        className: "btn btn-primary"
                      }
                    }).then(function(){
                      window.location.assign(url+"institution/"+$("#inid").val()+"/token/download");
                    })
                  } else {
                    swal({
                      icon: 'error',
                      title: 'Error!',
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
function removeMember(id,fullname){
  form = new FormData();
    form.append("member_id",id);
    swal({
          title: 'Are you sure?',
          text: "You won't be able to remove "+fullname+"!",
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
              url:  url+"institution/"+$("#inid").val()+"/member/remove",
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
                    icon: 'error',
                    title: 'error!',
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
                      icon: 'error',
                      title: 'Error!',
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
var errormgs =function(){
  alert('fd');
}