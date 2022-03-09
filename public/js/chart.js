var labels=[];var datas=[];var memberdata=[];var guardian_data=[];var quesitiondata=[];
var options = {
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      }
    }]
  },
  legend: {
    display: false
  },
  elements: {
    point: {
      radius: 0
    }
  }
};
$.ajax({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: url+'report/'+$("#rid").val()+'/statistics/list',
  type: 'GET',
  beforeSend:function(e){
    
},
  error: function() {
      swal({
        title: 'Notice!',
        icon: 'error',
        text: 'if your\'re online, please check your internet connectivity and try again!',
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
            labels = [];
            for(var i=0;i<response.institution_type.length;i++){
              labels.push(response.institution_type[i].name);
              datas.push(response.institution_type[i].total);
            }
            memberdata=[];
            memberdata.push(response.members[0].male);
            memberdata.push(response.members[0].female);

            guardian_data=[];
            guardian_data.push(response.guardians[0].mother);
            guardian_data.push(response.guardians[0].father);
            guardian_data.push(response.guardians[0].guardian);
            
            quesitiondata=[];
            for(var i=0;i<response.question_setup_data.length;i++){
              quesitiondata.push(response.question_setup_data[i]);
            }
            console.log(quesitiondata);
            run_bar();
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
function run_bar(){
  var data = {
    labels: labels,
    datasets: [{
      label: '# of Votes',
      data: datas,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  var questionanswereddata = {
    labels: ["Strongly Dislike","Dislike","Not Sure","Like","Strongly Like"],
    datasets: [{
      label: '',
      data: quesitiondata,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };
  var doughnutPieData = {
    datasets: [{
      data: memberdata,
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.5)',
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
      ],
    }],
    labels: [
      'Male',
      'Female',
    ]
  };
  var guaridanPieData = {
    datasets: [{
      data: guardian_data,
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.5)',
        'rgba(255, 206, 86, 0.5)',
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 0.5)',
      ],
    }],
    labels: [
      'Mother',
      'Father',
      'Guardian'
    ]
  };
  var doughnutPieOptions = {
    responsive: true,
    animation: {
      animateScale: true,
      animateRotate: true
    }
  };
  if ($("#pieChart").length) {
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: doughnutPieData,
      options: doughnutPieOptions
    });
  }
  if ($("#guardianChart").length) {
    var pieChartCanvas = $("#guardianChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: guaridanPieData,
      options: doughnutPieOptions
    });
  }

  if ($("#barChart").length) {
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: data,
      options: options
    });
  }

  if ($("#questionAnsweredScoreChart").length) {
    var barChartCanvas = $("#questionAnsweredScoreChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: questionanswereddata,
      options: options
    });
  }
}