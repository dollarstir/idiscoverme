$.fn.dataTable.ext.errMode = 'none';
dataset = $('#member_list').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load clients!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
  "ajax": url+"clients/list",
  "columns": [
      { "data": "firstName" },
      { "data": "lastName" },
      { "data": "id" },
      { "data": "gender" },
      { "data": "created_at" },
      {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+'client/'+datainfo.id +'/profile" class="btn btn-outline-primary py-2"><i class="mdi mdi-account"></i></a>';
          }
      }
  ],
 
} );