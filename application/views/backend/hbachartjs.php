<script type="text/javascript">
    $("#hbaChart").hide();
    var dynamic_chart = function () {
        var user_id=$("#user_id").val();
        var fromDate=$("#fdate").val();
        var toDate=$("#todate").val();
        var dates=[];
        var values=[];
        $.ajax({  
            type: 'POST',  
            dataType: 'json',
            url: '<?php echo base_url();?>index.php/hbaestimation/getreportData', 
            data: {user_id:user_id, fromDate:fromDate, toDate:toDate},
            success: function(response) {
                    if(response.success){
                      "use strict";
                      $('#dynamic_update').highcharts({
                          title: {
                              text: 'HBA1c Report',
                              //x: -20 //center
                          },
                          xAxis: {
                              title: {
                                  text: 'Dates'
                              },
                              categories: response.dates
                          },
                          yAxis: {
                              title: {
                                  text: 'HbA1c %'
                              },
                              plotLines: [{
                                  value: 0,
                                  width: 1,
                                  color: '#808080'
                              }]
                          },
                          legend: {
                              layout: 'vertical',
                              align: 'right',
                              verticalAlign: 'middle',
                              borderWidth: 0
                          },
                          series: [{
                              name: 'HbA1c %',
                              data: response.values
                          }]
                      });
                  }
             }
        });
    };
    var ChartHigh = function () {
        "use strict";
        return {
            init: function () {
                dynamic_chart();
            }
        }
    }();
    $("#showhbaChart").click(function () {
        $("#hbaChart").show();
        ChartHigh.init();
    });
    $("#printdata").click(function(){
      setTimeout(function(){ $("#printdata").show(); }, 2000);
      $("#printdata").hide();
      window.print();
    })
</script>