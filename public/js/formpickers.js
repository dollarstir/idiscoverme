(function($) {
  'use strict';

    $('#start_time').datetimepicker({
      format: 'HH:mm'
    });
    $('#end_time').datetimepicker({
      format: 'HH:mm'
    });
  if ($(".color-picker").length) {
    $('.color-picker').asColorPicker();
  }
  $('#datepicker-popup').datepicker({
    format: 'yyyy-mm-dd',
    endDate	: new Date(),
    enableOnReadonly: true,
    todayHighlight: true,
  });
  if ($("#inline-datepicker").length) {
    $('#inline-datepicker').datepicker({
      enableOnReadonly: true,
      todayHighlight: true,
    });
  }
  if ($(".datepicker-autoclose").length) {
    $('.datepicker-autoclose').datepicker({
      autoclose: true
    });
  }
  if($('.input-daterange').length) {
    $('.input-daterange input').each(function(e) {
      if($("#rid").val()!=""){
        $(this).datepicker({
          endDate	: new Date(),
          format: 'yyyy-mm-dd',
        });
      }else{
        $(this).datepicker({
          startDate	: new Date(),
          format: 'yyyy-mm-dd',
        });
      }
      
    });
    $('.input-daterange').datepicker({});
  }

})(jQuery);