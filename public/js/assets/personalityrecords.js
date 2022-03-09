
$.fn.dataTable.ext.errMode = 'none';
dataset = $('#example').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load personalities!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
    "ajax": url+"personalities/list",
    "columns": [
        { "data": "name" },
        { "data": "related_programme" },
        { "data": "success_message" },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+'personalities/'+data.id+'/courses" class="btn btn-outline-primary py-2"><i class="mdi mdi-menu"></i></a>';
        }
         },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+'personalities/'+data.id+'/career/path" class="btn btn-outline-primary py-2"><i class="mdi mdi-menu"></i></a>';
        }
         },
        { 
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<a href="'+url+'personalities/'+datainfo.id+'/edit" class="btn btn-outline-primary py-2"><i class="mdi mdi-pencil"></i></div>';
          }
         },
        {
          "mData": null,
          "bSortable": false,
          "mRender": function(data, type, datainfo) {
            return '<div id="'+datainfo.id+'" class="btn btn-outline-danger py-2" onclick="delete_role(this,'+datainfo.id+')"><i class="mdi mdi-delete"></i></div>';
          }
        }
    ],
   
} );

