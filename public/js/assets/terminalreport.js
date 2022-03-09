var mscheme_class = document.getElementById("mscheme_class").innerHTML;
var mscheme_exams = document.getElementById("mscheme_exams").innerHTML;var posarray=[];
$(".classcore").on('change',function(e){
  var index = $(".classcore").index(this);
    if(Number($(this).val()) || $(this).val()=="0"){
      if(Number($(this).val()) <= Number(mscheme_class)){
        $(".totalscore:eq("+index+")").val(Number($(this).val())+Number($(".examsscore:eq("+index+")").val()));
      }else{
        swal({
          title: 'Notice!',
          icon: 'error',
          text: "Please, class score must less than or equal to "+mscheme_class,
          button: {
            text: "OK",
            value: true,
            visible: true,
            className: "btn btn-danger"
          }
        }).then(function(){
          $(".classcore:eq("+index+")").focus();
          $(".classcore:eq("+index+")").val("");
        });
      }
    }else{
        if(Number($(".examsscore:eq("+index+")").val()) || $(".examsscore:eq("+index+")").val() =="0"){
          $(".totalscore:eq("+index+")").val( $(".examsscore:eq("+index+")").val());
        }else{
          $(".totalscore:eq("+index+")").val("");
          $(".position:eq("+index+")").val("");
        }
      
    }
});
$(".examsscore").on('change',function(e){
  var index = $(".examsscore").index(this);
    if(Number($(this).val()) || $(this).val() =="0"){
      if(Number($(this).val()) <= Number(mscheme_exams)){
        $(".totalscore:eq("+index+")").val(Number($(this).val())+Number($(".classcore:eq("+index+")").val()));
      }else{
        swal({
          title: 'Notice!',
          icon: 'error',
          text: "Please, exams score must less than or equal to "+mscheme_exams,
          button: {
            text: "OK",
            value: true,
            visible: true,
            className: "btn btn-danger"
          }
        }).then(function(){
          $(".examsscore:eq("+index+")").focus();
          $(".examsscore:eq("+index+")").val("");
        });
      }
    }else{
      if(Number($(".classcore:eq("+index+")").val()) || $(".classcore:eq("+index+")").val()=="0"){
        $(".totalscore:eq("+index+")").val( $(".classcore:eq("+index+")").val());
      }else{
        $(".totalscore:eq("+index+")").val("");
        $(".position:eq("+index+")").val("");
      }
    }
});
var cnt=0;pos=0;
$("#AddTerminalReport").submit(function(e){
  e.preventDefault();cnt=0;pos=0;posarray=[];
  if(isScoreNotEmpty() >=4){
    if(pos != cnt){
      swal({
        title: 'Notice!',
        icon: 'error',
        text: "Please, enter position for the scores you have entered!",
        button: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-danger"
        }
      }).then(function(){
        if(posarray.length==0){
          $(".position:eq(0)").focus();
        }else{
          var new_pos = posarray[pos];
          $(".position:eq("+new_pos+")").focus();
        }
      });
      return false;
    }
    form.append("count",cnt);
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url+'terminal/'+$("#trid").val()+"/report/save",
    type: 'POST',
    data: form,
    processData: false,
    contentType: false,
    beforeSend:function(e){
      $("#saveTR").prop("disabled", true);
      $("#saveTR").val("Saving...");
  },
    error: function() {
        $("#saveTR").val("Continue");
        $("#saveTR").prop("disabled", false);
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
      $("#saveTR").val("Continue");
      $("#saveTR").prop("disabled", false);
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
            window.location.assign(url+"member/"+response.mid+"/question/"+response.quid+"/terminal/report")
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
      text: "Please, enter scores for at least subjects!",
      button: {
        text: "OK",
        value: true,
        visible: true,
        className: "btn btn-danger"
      }
    })
  }
});
function isScoreNotEmpty(){
  $("#AddTerminalReport input[name=totalscore]").each(function() {
    if(Number(this.value) || this.value=="0") {
      var index = $(".totalscore").index(this);
      if($(".position:eq("+index+")").val() !=""){
        pos++;
      }
      form.append("class_score"+cnt,$(".classcore:eq("+index+")").val());
      form.append("examsscore"+cnt,$(".examsscore:eq("+index+")").val());
      form.append("totalscore"+cnt,$(".totalscore:eq("+index+")").val());
      form.append("position"+cnt,$(".position:eq("+index+")").val());
      form.append("subject"+cnt,$(".subject:eq("+index+")").val());
      posarray[cnt]=index;
      cnt++;
      
    }
  });
    return cnt;
}
