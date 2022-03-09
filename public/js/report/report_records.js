$.fn.dataTable.ext.errMode = 'none';
dataset = $('#members').on( 'error.dt', function ( e, settings, techNote, message ) {
    swal({
      title: 'Notice!',
      icon: 'error',
      text: "We were not able to load members!",
      button: {
        text: "OK",
        value: true,
        visible: true,
        className: "btn btn-danger"
      }
    })
  } ).DataTable( {
    "ajax": "vacancies/list",
    "columns": [
        { "data": "firstName" },
        { "data": "middleName" },
        { "data": "lastName" },
        { "data": "member_id" },
        { "data": "dateOfBirth" },
        { "data": "gender" },
        {
            "mData": null,
            "bSortable": false,
            "mRender": function(data, type, datainfo) {
              return '<a href="'+url+'member/'+datainfo.member_id+'/profile" target="_blank" class="btn btn-outline-primary py-2"><i class="mdi mdi-account"></i></a>';
            }
        }
    ],
   
} );
dataset = $('#institutions').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load institution!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
  "ajax": url+"report/"+$("#rid").val()+"/institutions/list",
  "columns": [
    { "data": "name" },
    {
        "mData": null,
        "bSortable": false,
        "mRender": function(data, type, datainfo) {
          return '<img src="data:image/png;base64,'+datainfo.logo+'" />';
        }
    },
    { "data": "institution_id" },
    { "data": "location" },
    { "data": "GPS_address" },
    { "data": "institution_type_id" },
    {
      "mData": null,
      "bSortable": false,
      "mRender": function(data, type, datainfo) {
        return '<a href="'+url+"institution/"+datainfo.institution_id+'/profile" class="btn btn-outline-primary py-2"><i class="mdi mdi-eye"></i></div>';
      }
    }
],
 
} );

dataset = $('#guardians').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load institution!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
  "ajax": url+"report/"+$("#rid").val()+"/guardians/list",
  "columns": [
    { "data": "fullName" },
    { "data": "type" },
    { "data": "created_at" },
    {
      "mData": null,
      "bSortable": false,
      "mRender": function(data, type, datainfo) {
        return '<a href="'+url+"guardian/"+datainfo.id+'/profile" class="btn btn-outline-primary py-2"><i class="mdi mdi-eye"></i></div>';
      }
    }
],
 
} );
dataset = $('#question_setups').on( 'error.dt', function ( e, settings, techNote, message ) {
  swal({
    title: 'Notice!',
    icon: 'error',
    text: "We were not able to load question setup!",
    button: {
      text: "OK",
      value: true,
      visible: true,
      className: "btn btn-danger"
    }
  })
} ).DataTable( {
  "ajax": url+"report/"+$("#rid").val()+"/question/setup/list",
  "columns": [
    { "data": "name" },
    { "data": "strong_dislike" },
    { "data": "dislike" },
    { "data": "not_sure" },
    { "data": "like" },
    { "data": "strongly_like" },
],
 
} );