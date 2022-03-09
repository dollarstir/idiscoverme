$.fn.dataTable.ext.errMode = 'none';
dataset = $('#example').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load staffs!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
    "ajax": url+"staff/list",
    "columns": [
        { "data": "firstName" },
        { "data": "middleName" },
        { "data": "lastName" },
        { "data": "id" },
        { "data": "gender" },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+"staff/"+datainfo.id+'/profile" class="btn btn-outline-primary py-2"><i class="mdi mdi-account"></i></div>';
          }
        }
    ],
   
} );
var roleRequest=[];
$("#AssignRole").submit(function(e){
    e.preventDefault();
    var role = $('input[name="role[]"]').serializeArray();
      roleRequest = [];
    $.each(role, function(i, field) {
        if (jQuery.inArray(field.value, roleRequest) < 0) {
            roleRequest.push(field.value);
        }
    });
    for (var i = 0; i < roleRequest.length; ++i) {
        formdata.append("role[" + i + "]", roleRequest[i]);
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url+'staff/'+$("#sid").val()+'/roles',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend:function(e){
          $("#savePermission").prop("disabled", true);
          $("#savePermission").val("Saving.....");
      },
        error: function() {
            $("#savePermission").val("Save Role");
            $("#savePermission").prop("disabled", false);
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
                window.location.assign(url+"staffs/")
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
});
var staffEmailRequest = [];var staffPhoneRequest=[];var formdata=new FormData();
  function AddStaff(){
    var url = $("#url").val();
    var firstname = $("#firstname").val();var midllename = $("#middlename").val();var title = $("#title").val();var lastname = $("#lastname").val();var gender = $("#gender").val();
    var staff_email = $('input[type="email"]').serializeArray();
    formdata.append("title",title)
    formdata.append("firstname",firstname);formdata.append("midllename",middlename);formdata.append("lastname",lastname);formdata.append("gender",gender);
    staffEmailRequest = [];
    $.each(staff_email, function(i, field) {
        if (jQuery.inArray(field.value, staffEmailRequest) < 0) {
          staffEmailRequest.push(field.value);
        }
    });
    for (var i = 0; i < staffEmailRequest.length; ++i) {
        formdata.append("email[" + i + "]", staffEmailRequest[i]);
    }
    var staff_phone = $('input[type="tel"]').serializeArray();
    staffPhoneRequest = [];
    $.each(staff_phone, function(i, field) {
        if (jQuery.inArray(field.value, staffPhoneRequest) < 0) {
          staffPhoneRequest.push(field.value);
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
          $("#saveStaff").val("Saving.....");
      },
        error: function() {
            $("#saveStaff").val("Save Staff");
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
          $("#saveStaff").val("Save Staff");
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