var url = $("#url").val();var dataset="";var form = new FormData();
function htmlspecialchars(str) {
  return str.replace('&', '\\&').replace('"', '\\"').replace("'", "\\'").replace('<', '\\<').replace('>', '\\>');
}

var singleReport=false;var get_search_type_id="";
(function($) {
  'use strict';
  $.validator.setDefaults({
    submitHandler: function(e) {
     if(e.id =="saveSystemInfo"){
      saveSystemInfo();
     }
     if(e.id == "AddEventType"){
        AddEventType();
     }
     if(e.id == "AddEvent"){
        AddEvent();
     }
     if(e.id=="AddRole"){
       createRole();
     }
     if(e.id=="AddStaff"){
      AddStaff();
     }
     if(e.id == "saveMarkingScheme"){
      saveMarkingScheme()
     }
     if(e.id=="saveInstitution"){
       AddInstitution();
     }
     if(e.id=="AddMember"){
        AddMember();
     }
     if(e.id=="importFile"){
      importFile();
     }
     if(e.id=="AddPersonality"){
      AddPersonality();
     }
     if(e.id=="AddReport"){
        AddReport();
     }
     if(e.id =="EditPersonality"){
        EditPersonality();
     }
     if(e.id=="AddCourse"){
      AddCourse();
     }
     if(e.id == "AddCareerPath"){
      AddCareerPath();
     }
     if(e.id =="AddSetup"){
        AddSetup();
     }
     if(e.id=="AddQuestion"){
        AddQuestion();
     }
     if(e.id=="AddClient"){
        AddClient();
     }
     if(e.id=="resetPassword"){
        resetPassword();
     }
     if(e.id=="AddTerminalReportSetup"){
        AddTerminalReportSetup();
     }
    }
  });
  
 
  $(function() {
    // validate the comment form when it is submitted
    $("#commentForm").validate({
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#importFile").validate({
      rules: {
        importcsv: "required",
      },
      messages: {
        importcsv: "Please select csv file"
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#saveInstitution").validate({
      rules: {
        region: "required",
        instype : "required",
        name: {
          required: true,
          minlength: 2
        },
        
        district: {
          required: true
        },
        email: "required",
        phone: "required"
      },
      messages: {
        name: {
          required: "Please enter school name",
          minlength: "School name must consist of at least 2 characters"
        },
        instype : "Please select institution type",
        region : "Please select region",
        district : "Please select district",
        gpsaddress: "Please enter school GPS Address",
        pobox: "Please enter school box office",
        logo: "Please upload school logo"
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#AddCourse").validate({
        rules: {
          course:{
            required:true
          }
        },
        message: {
          
        },
        errorPlacement: function(label, element) {
          label.addClass('mt-2 text-danger');
          label.insertAfter(element);
        },
        highlight: function(element, errorClass) {
          $(element).parent().addClass('has-danger')
          $(element).addClass('form-control-danger')
        }
    });
    $("#saveMarkingScheme").validate({
      rules: {
        level:"required",
        class_score: "required",
        exams_score: "required"
      },
      message: {
        level: "Please select level",
        class_score: "Please enter class score",
        exams_score: "Please enter exams score",
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
  });
    $("#saveSystemInfo").validate({
      rules: {
        softwareName:"required",
        softwareShortName: "required",
        name: "required",
        color: "required",
        pobox: "required",
        favicongoid: "required",
        location: {
          required: true,
          minlength: 2
        },
        
        gpsaddress: {
          required: true,
        }
      },
      messages: {
        softwareName: "Please enter software name",
        softwareShortName:"Please enter software short name",
        name: "Please enter organization name",
        color: "Please select organization color",
        favicongoid: "Please upload favicon",
        location: {
          required: "Please enter organization location",
          minlength: "Your organization location must consist of at least 2 characters"
        },
        
        gpsaddress: "Please enter organization GPS address",
        pobox: "Please enter organization box address"
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#AddStaff").validate({
      rules: {
        firstname: "required",
        lastname: "required",
        lastname: {
          required: true,
          minlength: 2
        },
        
        email: {
          required: true,
          email: true
        },
        topic: {
          required: "#newsletter:checked",
          minlength: 2
        },
        agree: "required"
      },
      messages: {
        firstname: "Please enter your firstname",
        lastname: {
          required: "Please enter a lastname",
          minlength: "Your username must consist of at least 2 characters"
        },
        
        email: "Please enter a valid email address",
        agree: "Please accept our policy",
        topic: "Please select at least 2 topics"
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#AddTerminalReportSetup").validate({
      rules: {
        term:"required"
      },
      messages:{
        term:"Please select term"
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#AddMember").validate({
      rules: {
        firstname: "required",
        lastname: "required",
        gender : "required",
        gptype : "required",
        lastname: {
          required: true,
          minlength: 2
        },
        
        gpname: {
          required: true,
        },
        topic: {
          required: "#newsletter:checked",
          minlength: 2
        },
        agree: "required"
      },
      messages: {
        firstname: "Please enter member firstname",
        lastname: {
          required: "Please enter member lastname",
          minlength: "Your username must consist of at least 2 characters"
        },
        gender : "Please select member gender",
        gptype: "Please, select member relationship",
        gpname: "Please enter parent/guardian fullname",
        agree: "Please accept our policy",
        topic: "Please select at least 2 topics"
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#resetPassword").validate({
      rules: {
        oldpassword: {
          required: true,
          minlength: 6
        },
        newpassword: {
          required: true,
          minlength: 6
        },
        confirmpassword: {
          required: true,
          minlength: 6,
          equalTo: "#newpass"
        },
      },
      messages: {
        oldpassword: {
          required: "Please enter your old password",
          minlength: "Your old password must consist of at least 6 characters"
        },
        newpassword: {
          required: "Please enter your old password",
          minlength: "Your new password must consist of at least 6 characters"
        },
        confirmpassword: {
          required: "Please enter your old password",
          minlength: "Your new password must consist of at least 6 characters",
          equalTo: "Your new password must be the same as confirm password!"
        }
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#AddClient").validate({
      rules: {
        firstname: "required",
        lastname: "required",
        lastname: {
          required: true,
          minlength: 2
        },
        
        gpname: {
          required: true,
        },
        topic: {
          required: "#newsletter:checked",
          minlength: 2
        },
        agree: "required"
      },
      messages: {
        firstname: "Please enter client firstname",
        lastname: {
          required: "Please enter client lastname",
          minlength: "Your username must consist of at least 2 characters"
        },
        
        gpname: "Please enter parent/guardian fullname",
        agree: "Please accept our policy",
        topic: "Please select at least 2 topics"
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    //
    $("#AddCareerPath").validate({
      rules: {
        careerpaths: "required",
        alternativeName: "required"
        },
      messages: {
        careerpaths: "Please enter career path name",
        alternativeName: "Please enter alternative name",
        
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#EditPersonality").validate({
      rules: {
        name: "required",
        relatedProgramme: "required",
        successMessage: "required"
        },
      messages: {
        name: "Please enter personality name",
        relatedProgramme: "Please enter personality related programme",
        successMessage: "Please enter personality success message",
        
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#AddPersonality").validate({
      rules: {
        name: "required",
        relatedProgramme: "required",
        successMessage: "required"
        },
      messages: {
        name: "Please enter personality name",
        relatedProgramme: "Please enter personality related programme",
        successMessage: "Please enter personality success message",
        
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
      
    });
    $("#AddReport").validate({
      rules: {
        name: "required",
        start_at: "required",
        end_at: "required"
        },
      messages: {
        name: "Please enter personality name",
        start_at: "Please select start date",
        end_at: "Please select end date",
        
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
      
    });
    $("#AddSetup").validate({
      rules: {
        name: "required",
        },
      messages: {
        name: "Please enter your setup name",
        
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
      
    });
    $("#AddQuestion").validate({
      rules: {
        question: "required",
        career_path_id: "required",
        },
      messages: {
        question: "Please enter question",
        career_path_id: "Please select career path"
        
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
      
    });
    
    $("#AddEventType").validate({
      rules: {
        eventtypename: "required",
        color: "required"
      },
      messages: {
        eventtypename: "Please enter your event type name",
        color: "Please pick event type color"
        
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#AddEvent").validate({
      rules: {
        eventname: "required",
        eventdesc: "required",
        start_at: "required",
        end_at: "required",
        start_time: "required",
        end_time: "required"
      },
      messages: {
        eventname: "Please enter your event name",
        eventdesc: "Please event what the event is about",
        start_at: "Please add event start date",
        end_at: "Please add event end date",
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
    });
    $("#AddRole").validate({
      rules: {
        name: "required",
        },
      messages: {
        name: "Please enter your role name",
        
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
      
    });
  });
  var careeRequest=[];
  $("#AddCareer").submit(function(e){
    e.preventDefault();
    var careers =  $('input[type="text"]').serializeArray();
    careeRequest = [];
      $.each(careers, function(i, field) {
          if (jQuery.inArray(field.value, careeRequest) < 0) {
            if(field.value !=""){
              careeRequest.push(field.value);
            }
          }
      });
      for (var i = 0; i < careeRequest.length; ++i) {
          formdata.append("careers[" + i + "]", careeRequest[i]);
      }
      if(careeRequest.length > 0){
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: url+'personalities/'+$("#cid").val()+'/career/path/'+$("#cpid").val()+"/new",
          type: 'POST',
          data: formdata,
          processData: false,
          contentType: false,
          beforeSend:function(e){
            $("#saveCareer").prop("disabled", true);
            $("#saveCareer").val("Saving.....");
        },
          error: function() {
              $("#saveCareer").val("Save");
              $("#saveCareer").prop("disabled", false);
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
            $("#saveCareer").val("Save");
            $("#saveCareer").prop("disabled", false);
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
                  window.location.assign(url+"personalities/"+$("#cid").val()+"/career/path/"+$("#cpid").val())
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
          text: 'Please enter career name',
          button: {
            text: "OK",
            value: true,
            visible: true,
            className: "btn btn-danger"
          }
        })
      }
  });

 function AddCareerPath(){
      formdata.append("careerpaths",$("#careerpaths").val());formdata.append("alternativeName",$("#alternativeName").val());
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url+'personalities/'+$("#cid").val()+'/career/path/new',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend:function(e){
          $("#saveCareerPath").prop("disabled", true);
          $("#saveCareerPath").val("Saving.....");
      },
        error: function() {
            $("#saveCareerPath").val("Save");
            $("#saveCareerPath").prop("disabled", false);
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
          $("#saveCareerPath").val("Save");
          $("#saveCareerPath").prop("disabled", false);
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
                swal({
                  title: 'Notice',
                  text: "Are you done adding career paths?",
                  icon: 'error',
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
                     window.location.assign(url+"personalities/"+$("#cid").val()+"/career/path");
                  }else{
                    $("#careerpaths").val("");$("#alternativeName").val("");
                    $("#careerpaths").focus();
                  }
                });
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

var setupEmailRequest=[];var setupPhoneRequest=[];
function saveSystemInfo(){
  if($("#inlineFormInputGroup1").val() !="" && $("#inlineFormInputGroup2").val()!=""){
    formdata.append("softwareName",$("#softwareName").val());
    formdata.append("softwareShortName",$("#softwareShortName").val());
    formdata.append("organizationName",$("#organizationName").val());formdata.append("color",$("#color").val());formdata.append("location",$("#location").val());formdata.append("gpsaddress",$("#gpsaddress").val());formdata.append("pobox",$("#pobox").val());
    var homelogo = $('#homepagelogoid')[0].files[0];formdata.append('homepagelogo', homelogo);var headerlogo = $('#headerlogoid')[0].files[0]; 
    formdata.append('headerlogo', headerlogo);var favicon = $('#favicongoid')[0].files[0];formdata.append('favicon', favicon); var organz_logo = $('#organz_logoid')[0].files[0];formdata.append('organz_logo', organz_logo); 
    var setup_email = $('input[type="email"]').serializeArray();
    setupEmailRequest = [];
    $.each(setup_email, function(i, field) {
        if (jQuery.inArray(field.value, setupEmailRequest) < 0) {
          if(field.value !=""){
            setupEmailRequest.push(field.value);
          }
        }
    });
    for (var i = 0; i < setupEmailRequest.length; ++i) {
        formdata.append("email[" + i + "]", setupEmailRequest[i]);
    }
    var setup_phone = $('input[type="tel"]').serializeArray();
    setupPhoneRequest = [];
    $.each(setup_phone, function(i, field) {
        if (jQuery.inArray(field.value, setupPhoneRequest) < 0) {
          if(field.value !=""){
            setupPhoneRequest.push(field.value);
          }
        }
    });
    for (var i = 0; i < setupPhoneRequest.length; ++i) {
        formdata.append("phone[" + i + "]", setupPhoneRequest[i]);
    }
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: url+'system/setup',
      type: 'POST',
      data: formdata,
      processData: false,
      contentType: false,
      beforeSend:function(e){
        $("#btnSaveSystemInfo").prop("disabled", true);
        $("#btnSaveSystemInfo").val("Setting up.....");
    },
      error: function() {
          $("#btnSaveSystemInfo").val("Save Information");
          $("#btnSaveSystemInfo").prop("disabled", false);
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
        $("#btnSaveSystemInfo").val("Save Institution");
        $("#btnSaveSystemInfo").prop("disabled", false);
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
              window.location.assign(url+"system/administrator")
            })
          } else {
            console.log(response);
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
      text: 'All Fields Required',
      button: {
        text: "OK",
        value: true,
        visible: true,
        className: "btn btn-danger"
      }
    })
  }
}
$("#districtid").change(function(){
  load_district_info($(this).val())
  
});
$("#regionid").change(function(){
  var i=0;
  var region_id = $(this).val();
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'region/'+region_id+'/information',
    type: 'GET',
    beforeSend:function(e){
      $('#districtid').empty(); 
      $('#districtid').append('<option selected>Please wait....</option>');
      $('#districtid').selectpicker('refresh');
      $("#gpsaddress").val("");
      $("#gpsaddress").prop("disabled", true);
  },
    error: function() {
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
          $('#districtid').empty(); 
          $('#districtid').append('<option></option>');
          for(i in response.districts){
            $("#districtid").append("<option value="+response.districts[i].id+">"+response.districts[i].name+"</option>");
          }
          $('#districtid').selectpicker('refresh');
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
});
function load_district_info(id){
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'region/district/'+id+"/information",
    type: 'GET',
    beforeSend:function(e){
      $("#gpsaddress").val("please wait...");
      $("#gpsaddress").prop("disabled", true);
  },
    error: function() {
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
          $("#gpsaddress").prop("disabled", false);
          $("#gpsaddress").val(response.code+"-");
          $("#gpsaddress").focus();
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
function saveMarkingScheme(){
  formdata.append("level",$("#level").val());formdata.append("class_score",$("#class_score").val());
  formdata.append("exams_score",$("#exams_score").val());formdata.append("institution",$("#institution").val());


  if($("#level").val() !="" && $("#class_score").val() !="" && $("#exams_score").val() !=""){
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: url+'institution/'+$("#institution").val()+'/marking/scheme/add',
      type: 'POST',
      data: formdata,
      processData: false,
      contentType: false,
      beforeSend:function(e){
        $("#btnSaveMarkingScheme").prop("disabled", true);
        $("#btnSaveMarkingScheme").val("Saving.....");
    },
      error: function() {
          $("#btnSaveMarkingScheme").val("Save Scheme");
          $("#btnSaveMarkingScheme").prop("disabled", false);
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
        $("#btnSaveMarkingScheme").val("Save Institution");
        $("#btnSaveMarkingScheme").prop("disabled", false);
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
              window.location.assign(url+"institution/"+$("#institution").val()+"/profile")
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

  }
  
}
var institutionEmailRequest=[];var institutionPhoneRequest=[];
function AddInstitution(){
  formdata.append("name",$("#name").val());formdata.append("gpsaddress",$("#gpsaddress").val());
  var institution_email = $('input[type="email"]').serializeArray();
  formdata.append("pobox",$("#pobox").val());formdata.append("instypeid",$("#instypeid").val());formdata.append("district",$("#districtid").val());
  var files = $('#logid')[0].files[0]; 
  formdata.append('file', files); 
  institutionEmailRequest = [];
    $.each(institution_email, function(i, field) {
        if (jQuery.inArray(field.value, institutionEmailRequest) < 0) {
          if(field.value !=""){
          institutionEmailRequest.push(field.value);
          }
        }
    });
    for (var i = 0; i < institutionEmailRequest.length; ++i) {
        formdata.append("email[" + i + "]", institutionEmailRequest[i]);
    }
    var institution_phone = $('input[type="tel"]').serializeArray();
    institutionPhoneRequest = [];
    $.each(institution_phone, function(i, field) {
        if (jQuery.inArray(field.value, institutionPhoneRequest) < 0) {
          if(field.value !=""){
          institutionPhoneRequest.push(field.value);
          }
        }
    });
    for (var i = 0; i < institutionPhoneRequest.length; ++i) {
        formdata.append("phone[" + i + "]", institutionPhoneRequest[i]);
    }
    if($("#inlineFormInputGroup1").val() !="" && $("#inlineFormInputGroup2").val()!=""){
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url+'institution/new',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend:function(e){
          $("#btnSaveInstitution").prop("disabled", true);
          $("#btnSaveInstitution").val("Saving.....");
      },
        error: function() {
            $("#btnSaveInstitution").val("Save Institution");
            $("#btnSaveInstitution").prop("disabled", false);
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
          $("#btnSaveInstitution").val("Save Institution");
          $("#btnSaveInstitution").prop("disabled", false);
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
                window.location.assign(url+"institution/"+response.inid+"/profile")
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
        text: 'All Fields Required',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-danger"
        }
      })
    }
}
var courseRequest=[];
function AddCourse(){
  var course = $('input[name="course[]"]').serializeArray();
      courseRequest = [];
    $.each(course, function(i, field) {
        if (jQuery.inArray(field.value, courseRequest) < 0) {
          if(field.value !=""){
          courseRequest.push(field.value);
          }
        }
    });
    for (var i = 0; i < courseRequest.length; ++i) {
        formdata.append("courses[" + i + "]", courseRequest[i]);
    }

    if(courseRequest.length == 2){
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url+'personalities/'+$("#cid").val()+'/courses/new',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend:function(e){
          $("#saveCourse").prop("disabled", true);
          $("#saveCourse").val("Saving.....");
      },
        error: function() {
            $("#saveCourse").val("Save");
            $("#saveCourse").prop("disabled", false);
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
          $("#saveCourse").val("Save");
          $("#saveCourse").prop("disabled", false);
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
                window.location.assign(url+"personalities/"+$("#cid").val()+"/courses")
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
        text: 'Please select 2 personalities to continue',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-danger"
        }
      })
    }
}
function EditPersonality(){
  formdata.append("name",$("#name").val());
  formdata.append("relatedProgramme",$("#relatedProgramme").val());
  formdata.append("successMessage",$("#successMessage").val());
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'personalities/'+$("#pid").val()+'/edit',
    type: 'POST',
    data: formdata,
    processData: false,
    contentType: false,
    beforeSend:function(e){
      $("#savePersonality").prop("disabled", true);
      $("#savePersonality").val("Saving.....");
  },
    error: function() {
        $("#savePersonality").val("Save Personality");
        $("#savePersonality").prop("disabled", false);
        swal({
          title: 'Something went wrong!',
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
      $("#savePersonality").val("Save Personality");
      $("#savePersonality").prop("disabled", false);
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
            window.location.assign(url+"personalities/");
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
function AddEvent(){
  formdata.append("name",$("#eventname").val());formdata.append("desc",$("#eventdesc").val());formdata.append("privacy",$("#privacy").val());
  formdata.append("start_at",$("#start_at").val());
  formdata.append("end_at",$("#end_at").val());
  formdata.append("start_time",$("#set_start_time").val());
  formdata.append("end_time",$("#set_end_time").val());
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'event/new',
    type: 'POST',
    data: formdata,
    processData: false,
    contentType: false,
    beforeSend:function(e){
      $("#saveEvent").prop("disabled", true);
      $("#saveEvent").val("Saving.....");
  },
    error: function() {
        $("#saveEvent").val("Save");
        $("#saveEvent").prop("disabled", false);
        swal({
          title: 'Something went wrong!',
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
      $("#saveEvent").val("Save");
      $("#saveEvent").prop("disabled", false);
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
            swal({
              title: 'Notice',
              text: "Are you done adding event?",
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
                window.location.assign(url+"event/"+response.evtid);
              }else{
                $("#eventname").val("");
                $("#eventname").focus();
              }
            });
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
function AddEventType(){
  formdata.append("name",$("#eventtypename").val());
  formdata.append("color",$("#color").val());
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'event/types/new',
    type: 'POST',
    data: formdata,
    processData: false,
    contentType: false,
    beforeSend:function(e){
      $("#saveEventType").prop("disabled", true);
      $("#saveEventType").val("Saving.....");
  },
    error: function() {
        $("#saveEventType").val("Save");
        $("#saveEventType").prop("disabled", false);
        swal({
          title: 'Something went wrong!',
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
      $("#saveEventType").val("Save");
      $("#saveEventType").prop("disabled", false);
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
            swal({
              title: 'Notice',
              text: "Are you done adding event types?",
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
                window.location.assign(url+"event/types/");
              }else{
                $("#eventtypename").val("");
                $("#name").focus();
              }
            });
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
$("#type").change(function(){
  $("#searchcover").hide();singleReport=false;
  if($(this).val()==1){singleReport=true;get_search_type_id="Member ID";
    $("#searchcover").show();$("#searchType").html("Enter Member ID");
    setTimeout(function(){
      $("#searchText").focus();
    },500);
  }
  if($(this).val()==3){singleReport=true;get_search_type_id="Institution ID";
    $("#searchcover").show();$("#searchType").html("Enter Institution ID");
    setTimeout(function(){
      $("#searchText").focus();
    },500);
  }
  if($(this).val()==5){singleReport=true;get_search_type_id="Guaridan ID";
    $("#searchcover").show();$("#searchType").html("Enter Guaridan ID");
    setTimeout(function(){
      $("#searchText").focus();
    },500);
  }
  if($(this).val()==7){singleReport=true;get_search_type_id="Client ID";
    $("#searchcover").show();$("#searchType").html("Enter Client ID");
    setTimeout(function(){
      $("#searchText").focus();
    },500);
  }
  if($(this).val()==9){singleReport=true;get_search_type_id="Question Setup ID";
    $("#searchcover").show();$("#searchType").html("Enter Question Setup ID");
    setTimeout(function(){
      $("#searchText").focus();
    },500);
  }
});
function AddReport(){
  if(singleReport){
    if($("#searchText").val().length==0){
      swal({
        title: 'Notice!',
        icon: 'error',
        text: get_search_type_id+" required!",
        button: {
          text: "Ok",
          value: true,
          visible: true,
          className: "btn btn-danger"
        }
      }).then(function(){
        $("#searchText").focus();
      })
      return false;
    }
  }
  formdata.append("name",$("#name").val());
  formdata.append("start_at",$("#start_at").val());
  formdata.append("end_at",$("#end_at").val());
  formdata.append("type",$("#type").val());
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'report/setup',
    type: 'POST',
    data: formdata,
    processData: false,
    contentType: false,
    beforeSend:function(e){
      $("#saveReport").prop("disabled", true);
      $("#saveReport").val("Preparing.....");
  },
    error: function() {
        $("#saveReport").val("Continue");
        $("#saveReport").prop("disabled", false);
        swal({
          title: 'Something went wrong!',
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
      $("#saveReport").val("Continue");
      $("#saveReport").prop("disabled", false);
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
            if($("#searchText").val().length==0)
              window.location.assign(url+"report/"+response.rid+"/generated");
            else
              window.location.assign(url+"report/"+response.rid+"/generated/search/"+$("#searchText").val());
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
function AddPersonality(){
  formdata.append("name",$("#name").val());
  formdata.append("relatedProgramme",$("#relatedProgramme").val());
  formdata.append("successMessage",$("#successMessage").val());
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'personality/new',
    type: 'POST',
    data: formdata,
    processData: false,
    contentType: false,
    beforeSend:function(e){
      $("#savePersonality").prop("disabled", true);
      $("#savePersonality").val("Saving.....");
  },
    error: function() {
        $("#savePersonality").val("Save Personality");
        $("#savePersonality").prop("disabled", false);
        swal({
          title: 'Something went wrong!',
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
      $("#savePersonality").val("Save Personality");
      $("#savePersonality").prop("disabled", false);
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
            swal({
              title: 'Notice',
              text: "Are you done adding personality?",
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
                window.location.assign(url+"personalities/");
              }else{
                $("#name").val("");$("#relatedProgramme").val("");$("#successMessage").val("");
                $("#name").focus();
              }
            });
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
function AddSetup(){
  formdata.append("name",$("#setup").val());
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'questions/setup/new',
    type: 'POST',
    data: formdata,
    processData: false,
    contentType: false,
    beforeSend:function(e){
      $("#saveSetup").prop("disabled", true);
      $("#saveSetup").val("Saving.....");
  },
    error: function() {
        $("#saveSetup").val("Save Setup");
        $("#saveSetup").prop("disabled", false);
        swal({
          title: 'Something went wrong!',
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
      $("#saveSetup").val("Save Setup");
        $("#saveSetup").prop("disabled", false);
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
            window.location.assign(url+"questions/setup/"+response.qsid+"/questions")
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
var questionRequest=[];
function AddQuestion(){
  var questions =  $('input[type="text"]').serializeArray();
  formdata.append("career_path_id", $("#career_path_id").val());
  questionRequest = [];
    $.each(questions, function(i, field) {
        if (jQuery.inArray(field.value, questionRequest) < 0) {
          if(field.value !=""){
            questionRequest.push(field.value);
          }
        }
    });
    for (var i = 0; i < questionRequest.length; ++i) {
        formdata.append("questions[" + i + "]", questionRequest[i]);
    }
    if(questionRequest.length > 0){
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url+'questions/setup/'+$("#qstp").val()+'/questions/new',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend:function(e){
          $("#saveQuestion").prop("disabled", true);
          $("#saveQuestion").val("Saving.....");
      },
        error: function() {
            $("#saveQuestion").val("Save Question");
            $("#saveQuestion").prop("disabled", false);
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
          $("#saveQuestion").val("Save");
          $("#saveQuestion").prop("disabled", false);
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
                swal({
                  title: 'Notice',
                  text: "Are you done adding questions?",
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
                    window.location.assign(url+"questions/setup/"+$("#qstp").val()+"/questions/")
                  }else{
                    $("#career_path_id").val("");
                    $("input[name^='careers']").val("");
                  }
                });
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
        text: 'Please enter questions',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-danger"
        }
      })
    }
}
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
        $("#saveRole").val("Saving.....");
    },
      error: function() {
          $("#saveRole").val("Save Role");
          $("#saveRole").prop("disabled", false);
          swal({
            title: 'Something went wrong!',
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
        $("#saveRole").val("Save Role");
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

  var results=[];var csvLength=0;
$("#importcsv").change(function(e){
  var ext = $("#importcsv").val().split(".").pop().toLowerCase();
  if($.inArray(ext, ["csv"]) == -1) {
    return false;
  }
  if (e.target.files != undefined) {
    swal({
      title: 'Extracting '+e.target.files[0]['name'],
      icon: 'info',
      text: "This will take some few seconds....  ",
      closeOnClickOutside: false,
      button: false
    })
    var reader = new FileReader();
    reader.onload = function(e) {
        var lines = e.target.result.split('\r\n');
        csvLength=lines.length;var m=0;
        
        for (var i = 0; i < lines.length; ++i)
        {
           var arraylist = lines[i].split(",");
           
          if(i > 0 && arraylist[0] !=""){
            results[m]=arraylist;
            m++;
          }
        }
        setTimeout(function(){
          swal({
            title: 'Please wait',
            icon: 'info',
            text: "Preparing registration...",
            closeOnClickOutside: false,
            button: false,
            timer: 2000,
          }).then(function(e){
            sendImportRequest(0);
          });
         
        },1000); 
    };
    reader.readAsText(e.target.files.item(0));
    }
    return false; 
});
function sendImportRequest(index){
  if(results.length > 0){
   formdata.append("member_info",results[index]);
   formdata.append("inid",$("#inid").val()); 
  var registered=index+1;
  
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'member/new/import',
    type: 'POST',
    data: formdata,
    processData: false,
    contentType: false,
    beforeSend:function(e){
      swal({
        title: 'Registered '+registered+'/'+results.length,
        icon: 'info',
        text: "Registering "+results[index][0]+' '+results[index][2],
        closeOnClickOutside: false,
        button: false
      });
  },
    error: function() {
        swal({
          title: 'Something went wrong!',
          icon: 'error',
          text: 'if you\'re online, please check your internet connectivity!',
          button: {
            text: "OK",
            value: true,
            visible: true,
            className: "btn btn-danger"
          }
        }).then(function(e){
          if(e){
            sendImportRequest(index);
          }
        });
    },
    success: function(response) {
      $("#saveStaff").val("Save Member");
      $("#saveStaff").prop("disabled", false);
        if (response.success) {
          swal({
            title: 'Congratulations!',
            icon: 'success',
            text: response.message,
            button: false,
          });
          if(index < (results.length-1)){
            setTimeout(function(){sendImportRequest(index+1)},400);
          }else{
            swal({
              title: 'Congratulations!',
              icon: 'success',
              text: "Successfully registered "+results.length+" members!",
              button: {
                text: "Continue",
                value: true,
                visible: true,
                className: "btn btn-primary"
              }
            }).then(function(){
              if($("#inid").val() ==""){
                window.location.assign(url+"members");
              }else{
                window.location.assign(url+"institution/"+$("#inid").val()+"/profile");
              }
            });
          }
            
          
        } else {
          swal({
            title: 'Error!',
            icon: 'error',
            text: response.message,
            button: {
              text: "OK",
              value: true,
              visible: true,
              className: "btn btn-danger"
            }
          });
        }
        

    }
});
}else{
  swal({
    title: 'Error!',
    icon: 'error',
    text: "Please, upload member list to continue!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  });
}
}
function importFile(){
  if(results.length > 0){
    sendImportRequest(0);
  }else{
    swal({
      title: 'Error!',
      icon: 'error',
      text: "Please, upload member list to continue!",
      button: {
        text: "OK",
        value: true,
        visible: true,
        className: "btn btn-danger"
      }
    });
  }
}
function AddMember(){
  var firstname = $("#firstname").val();var midllename = $("#middlename").val();var lastname = $("#lastname").val();var gender = $("#gender").val();
  var member_phone = $('input[type="tel"]').serializeArray();formdata.append("dateOfBirth",$("#dateOfBirth").val());
  formdata.append("firstname",firstname);formdata.append("midllename",midllename);formdata.append("lastname",lastname);formdata.append("gender",gender);
  formdata.append("gpfullname",$("#gpname").val());formdata.append("gptype",$("#gptype").val());formdata.append("inid",$("#inid").val());  
  
  staffPhoneRequest = [];
    $.each(member_phone, function(i, field) {
        if (jQuery.inArray(field.value, staffPhoneRequest) < 0) {
          if(field.value !=""){
          staffPhoneRequest.push(field.value);
          }
        }
    });
    for (var i = 0; i < staffPhoneRequest.length; ++i) {
        formdata.append("phone[" + i + "]", staffPhoneRequest[i]);
    }
    if($("#inlineFormInputGroup2").val()){
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url+'member/new',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend:function(e){
          $("#saveStaff").prop("disabled", true);
          $("#saveStaff").val("Saving.....");
      },
        error: function() {
            $("#saveStaff").val("Save Member");
            $("#saveStaff").prop("disabled", false);
            swal({
              title: 'Notice!',
              icon:'error',
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
          $("#saveStaff").val("Save Member");
          $("#saveStaff").prop("disabled", false);
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
                if($("#inid").val() ==""){
                  window.location.assign(url+"member/"+response.mid+"/profile")
                }else{
                  window.location.assign(url+"institution/"+$("#inid").val()+"/profile");
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
        text: 'Phone Number Required',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-danger"
        }
      })
    }

}
function AddTerminalReportSetup(){
  form.append("level",$("#level").val());
  form.append("term",$("#term").val());
  form.append("classname",$("#classname").val());
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'terminal/report/'+$("#quid").val(),
    type: 'POST',
    data: form,
    processData: false,
    contentType: false,
    beforeSend:function(e){
      $("#saveTRSetup").prop("disabled", true);
      $("#saveTRSetup").val("Saving...");
  },
    error: function() {
        $("#saveTRSetup").val("Continue");
        $("#saveTRSetup").prop("disabled", false);
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
      $("#saveTRSetup").val("Continue");
      $("#saveTRSetup").prop("disabled", false);
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
            window.location.assign(url+"terminal/"+response.trid+"/report/generate")
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
function resetPassword(){
  var oldpass = $("#oldpass").val();var newpass = $("#newpass").val();var confirmpass = $("#confirmpass").val();
  form.append("oldpass",oldpass);form.append("newpass",newpass);form.append("confirmpass",confirmpass);
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'reset/password',
    type: 'POST',
    data: form,
    processData: false,
    contentType: false,
    beforeSend:function(e){
      $("#resetPword").prop("disabled", true);
      $("#resetPword").val("Reseting.....");
  },
    error: function() {
        $("#resetPword").val("Reset");
        $("#resetPword").prop("disabled", false);
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
      $("#resetPword").val("Reset");
      $("#resetPword").prop("disabled", false);
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
            window.location.assign(url+"profile")
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
var clientPhoneRequest=[];
function AddClient(){
  var firstname = $("#firstname").val();var midllename = $("#middlename").val();var lastname = $("#lastname").val();var gender = $("#gender").val();
  var client_phone = $('input[type="tel"]').serializeArray();
  formdata.append("firstname",firstname);formdata.append("midllename",midllename);formdata.append("lastname",lastname);formdata.append("gender",gender);
  clientPhoneRequest = [];
    $.each(client_phone, function(i, field) {
        if (jQuery.inArray(field.value, clientPhoneRequest) < 0) {
          if(field.value !=""){
            clientPhoneRequest.push(field.value);
          }
        }
    });
    for (var i = 0; i < clientPhoneRequest.length; ++i) {
        formdata.append("phone[" + i + "]", clientPhoneRequest[i]);
    }
    if($("#inlineFormInputGroup2").val()){
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url+'client/new',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend:function(e){
          $("#saveClient").prop("disabled", true);
          $("#saveClient").val("Saving.....");
      },
        error: function() {
            $("#saveClient").val("Save Client");
            $("#saveClient").prop("disabled", false);
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
          $("#saveClient").val("Save Member");
          $("#saveClient").prop("disabled", false);
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
                window.location.assign(url+"clients/")
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
        text: 'Phone Number Required',
        icon: 'error',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-danger"
        }
      })
    }
}
var staffEmailRequest = [];var staffPhoneRequest=[];var formdata=new FormData();
  function AddStaff(){
    var url = $("#url").val();
    var firstname = $("#firstname").val();var midllename = $("#middlename").val();var title = $("#title").val();var lastname = $("#lastname").val();var gender = $("#gender").val();
    var staff_email = $('input[type="email"]').serializeArray();
    formdata.append("title",title);formdata.append("is_admin",document.getElementById("spk").innerHTML);
    formdata.append("firstname",firstname);formdata.append("midllename",midllename);formdata.append("lastname",lastname);formdata.append("gender",gender);
    staffEmailRequest = [];
    $.each(staff_email, function(i, field) {
        if (jQuery.inArray(field.value, staffEmailRequest) < 0) {
          if(field.value !=""){
          staffEmailRequest.push(field.value);
          }
        }
    });
    for (var i = 0; i < staffEmailRequest.length; ++i) {
        formdata.append("email[" + i + "]", staffEmailRequest[i]);
    }
    var staff_phone = $('input[type="tel"]').serializeArray();
    staffPhoneRequest = [];
    $.each(staff_phone, function(i, field) {
        if (jQuery.inArray(field.value, staffPhoneRequest) < 0) {
          if(field.value !=""){
          staffPhoneRequest.push(field.value);
          }
        }
    });
    for (var i = 0; i < staffPhoneRequest.length; ++i) {
        formdata.append("phone[" + i + "]", staffPhoneRequest[i]);
    }
   
    if($("#inlineFormInputGroup1").val() !="" && $("#inlineFormInputGroup2").val()!=""){
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url+'staff/new',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend:function(e){
          $("#saveStaff").prop("disabled", true);
          $("#saveStaff").html("Saving.....");
      },
        error: function() {
            $("#saveStaff").html("Save Staff");
            $("#saveStaff").prop("disabled", false);
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
          $("#saveStaff").html("Save Staff");
          $("#saveStaff").prop("disabled", false);
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
                window.location.assign(url+"staff/"+response.sid+"/roles")
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
        text: 'All Fields Required',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-danger"
        }
      })
    }
    
  }
})(jQuery);
