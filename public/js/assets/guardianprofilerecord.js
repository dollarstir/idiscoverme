var wards;var wards_url=url+"guardian/"+$("#gid").val()+"/wards";
$.fn.dataTable.ext.errMode = 'none';
wards = $('#wards').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load wards!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
    "ajax": wards_url,
    "columns": [
        { "data": "firstName" },
        { "data": "lastName" },
        { "data": "member_id" },
        { "data": "gender" },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+"member/"+datainfo.member_id+'/profile" title="View '+datainfo.firstName+' profile" class="btn btn-outline-primary py-2"><i class="mdi mdi-account"></i></div>';
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
        id: "editprofile",
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
        var stfullname = $("#editprofile").val();
        form.append("fullname",stfullname);
       $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: url+'guardian/'+$("#gid").val()+'/edit',
          type: 'POST',
          data: form,
          processData: false,
          contentType: false,
          beforeSend:function(e){
            
        },
          error: function() {
              swal({
                title: 'Warning!',
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
                swal({
                  title: 'Notice!',
                  icon:'error',
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