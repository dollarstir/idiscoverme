var form = new FormData();var id=$("#sid").val();var stname = document.getElementById("profilename").innerHTML;

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
        id: "editstaff",
        value: stname
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
        var stfullname = $("#editstaff").val();
        form.append("flname",stfullname);
       $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: url+'staff/'+id+'/edit',
          type: 'POST',
          data: form,
          processData: false,
          contentType: false,
          beforeSend:function(e){
            $("#profilename").html('editing...');
        },
          error: function() {
            $("#profilename").html(stname);
              swal({
                title: 'Warning!',
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
                $("#profilename").html(stfullname);
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
                $("#profilename").html(stname);
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
});
$(".editphone").click(function(e){

  e.preventDefault();
  var c_id = $(this).attr("id");  
  var webappData = document.getElementById(c_id);
	var phoneNumber = webappData.dataset.phone;
	var phoneid = webappData.dataset.id;
  swal({
    title: 'Edit Phone Number',
    icon: "info",
    content: {
      element: "input",
      attributes: {
        placeholder: "Enter phone number",
        type: "text",
        class: 'form-control',
        id: "editphone",
        value: phoneNumber
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
        var stphone = $("#editphone").val();
        form.append("phone",stphone);
       $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: url+'staff/phone/'+phoneid+'/edit',
          type: 'POST',
          data: form,
          processData: false,
          contentType: false,
          beforeSend:function(e){
        },
          error: function() {
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
                $("#phe"+phoneid).html(stphone);
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
  });
});

$(".deletephone").click(function(e){
  e.preventDefault();
  if($(".deletephone").length > 1){
    var c_id = $(this).attr("id");  
    var webappData = document.getElementById(c_id);
    var phoneNumber = webappData.dataset.phone;
    var phoneid = webappData.dataset.id;
    form.append("phone",phoneNumber);
    swal({
      title: 'Are you sure?',
      text: "You want to delete "+phoneNumber,
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
          url: url+'staff/phone/'+phoneid+'/delete',
          type: 'POST',
          data: form,
          processData: false,
          contentType: false,
          beforeSend:function(e){
        },
          error: function() {
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
                $("#con"+phoneid).remove();
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
  }else{
    swal({
      title: 'Notice!',
      icon: 'error',
      text: "You cannot delete this phone number",
      button: {
        text: "OK",
        value: true,
        visible: true,
        className: "btn btn-danger"
      }
    })
  }
});

$(".addphone").click(function(e){
  e.preventDefault();
  swal({
    title: 'Add Phone Number',
    icon: "info",
    content: {
      element: "input",
      attributes: {
        placeholder: "Enter phone number",
        type: "tel",
        class: 'form-control',
        id: "addphone",
        value: ""
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
        var newphone = $("#addphone").val();
        var regex = newphone.replace(/[^0-9]/g,'');
        if(regex.length == 10){
            form.append("phone",regex);
            $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: url+'staff/'+id+'/phone/new',
              type: 'POST',
              data: form,
              processData: false,
              contentType: false,
              beforeSend:function(e){
            },
              error: function() {
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
                    $('.phone:last').append('<span class="float-right text-muted"><a href="tel:'+regex+'">'+regex+'</a> <a href="#" data-id="'+response.info+'" class="editphone" id="ph'+response.info+'" data-phone="'+regex+'"><i class="mdi mdi-pencil"></i></a> <a href="#" data-id="'+response.info+'" class="deletephone" id="del'+response.info+'" data-phone="'+newphone+'"><i class="mdi mdi-delete"></i></a></span><br />');
  
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
        }else{
          swal({
            title: 'Notice!',
            icon: 'error',
            text: "Please enter valid phone number",
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
$(".addmail").click(function(e){
  e.preventDefault();
 swal({
    title: 'Add New Email Address',
    icon: "info",
    content: {
      element: "input",
      attributes: {
        placeholder: "Enter email address",
        type: "email",
        class: 'form-control',
        id: "addmail",
        value: ""
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
        var newmail = $("#addmail").val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(regex.test(newmail) && newmail.length > 0){
            form.append("mail",newmail);
            $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: url+'staff/'+id+'/email/new',
              type: 'POST',
              data: form,
              processData: false,
              contentType: false,
              beforeSend:function(e){
            },
              error: function() {
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
                    $('.mail:last').append('<span class="float-right text-muted"><a href="mailto:'+newmail+'">'+newmail+'</a> <a href="#" data-id="'+response.info+'" class="editmail" id="em'+response.info+'" data-mail="'+newmail+'"><i class="mdi mdi-pencil"></i></a> <a href="#" data-id="'+response.info+'" class="deletemail" id="em'+response.info+'" data-mail="'+newmail+'"><i class="mdi mdi-delete"></i></a></span><br />');
  
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
        }else{
          swal({
            title: 'Notice!',
            icon: 'error',
            text: "Please enter valid email address",
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
$(".deletemail").click(function(e){
  e.preventDefault();
  if($(".deletemail").length > 1){
    var c_id = $(this).attr("id");  
    var webappData = document.getElementById(c_id);
    var mailaddress = webappData.dataset.mail;
    var mailid = webappData.dataset.id;
    form.append("mail",mailaddress);
    swal({
      title: 'Are you sure?',
      text: "You want to delete "+mailaddress,
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
          url: url+'staff/email/'+mailid+'/delete',
          type: 'POST',
          data: form,
          processData: false,
          contentType: false,
          beforeSend:function(e){
        },
          error: function() {
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
                $("#ml"+mailid).remove();
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
    });
  }else{
    swal({
      title: 'Notice!',
      icon: 'error',
      text: "You cannot delete this email address",
      button: {
        text: "OK",
        value: true,
        visible: true,
        className: "btn btn-danger"
      }
    })
  }
});