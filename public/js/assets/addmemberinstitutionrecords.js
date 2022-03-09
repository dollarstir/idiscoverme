$.fn.dataTable.ext.errMode = 'none';
dataset = $('#addmembers').on( 'error.dt', function ( e, settings, techNote, message ) {
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
    "ajax": url+"member/"+$("#mid").val()+"/institutions/add/list",
    "columns": [
          {
            "mData": null,
            "bSortable": false,
            "mRender": function(data, type, datainfo) {
              return '<input type="checkbox" class="selected" name="institution_id[]" value="'+datainfo.institution_id+'"/>';
            }
        },
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
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+"institution/"+datainfo.institution_id+'/profile" class="btn btn-outline-primary py-2"><i class="mdi mdi-eye"></i></div>';
          }
        }
    ],
   
} );
var isRunning=false;
$(".select_all").change(function(e){
  var c = this.checked;
  $('.selected').prop('checked',c);
});
var selectRequest=[];
$(".add_institution").click(function(e){
  e.preventDefault();
  var check_id = [];
      $.each($("input[class='selected']:checked"), function(){  
         check_id.push($(this).val());
     });
     for (var i = 0; i < check_id.length; ++i) {
        form.append("institutions[" + i + "]", check_id[i]);
     }
     if(check_id.length > 0){
       if(!isRunning){isRunning=true;
            $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: url+'member/'+$("#mid").val()+'/institutions/add',
              type: 'POST',
              data: form,
              processData: false,
              contentType: false,
              beforeSend:function(e){
                $(".add_institution").html('Please wait...');
            },
              error: function() {
                isRunning=false;
                $(".add_institution").html('Add Institutions');
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
                isRunning=false;$(".add_institution").html('Add Institutions');
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
                    }).then(function(){
                      window.location.assign(url+"member/"+$("#mid").val()+'/profile');
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
        }else{
          swal({
            title: 'Notice!',
            icon: 'error',
            text: 'Please system is busy! ',
            button: {
              text: "OK",
              value: true,
              visible: true,
              className: "btn btn-danger"
            }
          })
        }
     }else{
      swal({
        title: 'Notice!',
        icon: 'error',
        text: 'Please select at least one institution ',
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-danger"
        }
      })
     }
});