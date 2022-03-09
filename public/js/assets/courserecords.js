
$.fn.dataTable.ext.errMode = 'none';
dataset = $('#coureses').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load personality courses!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
    "ajax": url+"personalities/"+$("#psid").val()+"/courses/list",
    "columns": [
        { "data": "name" },
        { "data": "created_at" },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+'personalities/'+data.id+'/courses/new" class="btn btn-outline-primary py-2"><i class="mdi mdi-pencil"></i></a>';
        }
         },
        
    ],
   
} );


