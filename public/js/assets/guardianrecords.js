$.fn.dataTable.ext.errMode = 'none';
dataset = $('#example').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load guardians!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
    "ajax": url+"guardian/list",
    "columns": [
        { "data": "fullName" },
        { "data": "id" },
        { "data": "type" },
        { "data": "created_at" },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+"guardian/"+datainfo.id+'/profile" class="btn btn-outline-primary py-2"><i class="mdi mdi-account"></i></div>';
          }
        }
    ],
   
} );