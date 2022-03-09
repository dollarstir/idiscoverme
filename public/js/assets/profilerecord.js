var instutions="";
$.fn.dataTable.ext.errMode = 'none';
var sid = $("#sid").val();
var ques_url = url+"question/"+sid+"/answered";
var inst_url = url+""+sid+"/institutions/list";
var remove_account_url = url+""+sid+"/remove/account";
if($("#rid").val().length > 0){
  ques_url=url+"question/"+sid+"/answered/report/"+$("#rid").val();
  inst_url = url+""+sid+"/institutions/report/"+$("#rid").val();
}
var clipboard = new ClipboardJS('.btn');
  clipboard.on('success', function(e) {
    swal({
      title: 'success!',
      icon: 'success',
      text: "Token key copied",
      button: {
        text: "OK",
        value: true,
        visible: true,
        className: "btn btn-danger"
      }
    })
  });
  clipboard.on('error', function(e) {
    console.log(e);
  });
instutions = $('#institutions').on( 'error.dt', function ( e, settings, techNote, message ) {
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
    "ajax": inst_url,
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
            return '<a href="#" class="btn btn-outline-info py-2 token" onclick="token(event,\''+datainfo.name+'\',\''+datainfo.institution_id+'\')"><i class="mdi mdi-barcode-scan "></i></div>';
          }
        },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+"institution/"+datainfo.institution_id+'/profile" class="btn btn-outline-danger py-2"><i class="mdi mdi-delete"></i></div>';
          }
        }
    ],
   
} );

var questionreport = $('#questionreport').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load questions answered!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
    "ajax": ques_url,
    "columns": [
        { "data": "question_setup_id" },
        { "data": "created_at" },
        { 
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+'member/'+datainfo.member_member_id+'/question/set/'+datainfo.question_setup_id+'" class="btn btn-outline-primary py-2"><i class="mdi mdi-book-open"></i></a>';
          }
         },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+'member/'+datainfo.member_member_id+'/question/'+datainfo.id+'/terminal/report" class="btn btn-outline-danger py-2"><i class="mdi mdi-book-open-page-variant"></i></a>';
          }
        }
    ],
   
} );
$(".editprofile").click(function(e){

  e.preventDefault();
  swal({
    title: 'Edit Profile',
    icon: "info",
    content: {
      element: "input",
      attributes: {
        placeholder: "Enter firstname middlename lastname",
        type: "text",
        class: 'form-control',
        id: "editrole",
        value: document.getElementById("profilename").innerHTML
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
});
function token(e,name,inid){
  e.preventDefault();
  swal({
    title: 'Genereate New Token?',
    text: "Do you want to generate new token for "+name+"?",
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
        form.append("institution_id",inid);
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: url+'member/'+sid+'/token',
          type: 'POST',
          data: form,
          processData: false,
          contentType: false,
          beforeSend:function(e){
        },
          error: function() {
            $("#"+e.id).html('<i class="mdi mdi-delete"></i>');
              swal({
                title: 'Notice!',
                icon: 'error',
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
                swal({
                  title: 'Congratulations!',
                  text: response.message,
                  icon: 'success',
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
                      text: "Copy Token",
                      value: true,
                      visible: true,
                      className: "btn btn-primary",
                      closeModal: true
                    }
                  }
                }).then(function(e){
                  if(e){
                    $("#copytoken").attr('data-clipboard-text', response.token_key);
                    $("#copytoken").click();
                  }
                });
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
$("#deleteMemberAccount").click(function(e){
  e.preventDefault();
  deleteMemberAccount()
});
function deleteMemberAccount(){
    swal({
          title: 'Are you sure?',
          text: "You won't be able to remove "+document.getElementById("profilename").innerHTML+"!",
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
              url:  remove_account_url,
              type: 'GET',
              beforeSend:function(e){
               // $(id).html('deleting...');
            },
              error: function() {
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
                    window.location.assign(url+"members");
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
