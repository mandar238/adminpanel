<script type="text/javascript">
    $("#bslChart").hide();
    var dynamic_chart = function () {
        var user_id=$("#user_id").val();
        var fromDate=$("#fdate").val();
        var toDate=$("#todate").val();
        var stime=$("#time").val();
        var dates=[];
        var values=[];
        $.ajax({  
            type: 'POST',  
            dataType: 'json',
            url: '<?php echo base_url();?>index.php/bslestimation/getreportData', 
            data: {user_id:user_id, fromDate:fromDate, toDate:toDate, stime:stime},
            success: function(response) {
                    if(response.success){
                      "use strict";
                      // var chart = Highcharts.chart('dynamic_update', {

                      //     title: {
                      //         text: 'Bsl Estimation Report'
                      //     },

                      //     chart: {
                      //         height: "380px"
                      //     },

                      //     subtitle: {
                      //         text: ''
                      //     },

                      //     xAxis: {
                      //         categories: response.dates
                      //     },

                      //     series: [ {
                      //         type        : 'column',
                      //         colorByPoint: true,
                      //         data        : response.values,
                      //         showInLegend: false,
                      //         name : "BSL value"
                      //     } ]
                      // });
                      
                      $('#dynamic_update').highcharts({
                          title: {
                              text: 'BSL Report',
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
                                  text: 'BSL (mg%)'
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
                              name: 'BSL (mg%)',
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
    $("#showbslChart").click(function () {
        $("#bslChart").show();
        ChartHigh.init();
    });

    $("#printdata").click(function(){
      setTimeout(function(){ $("#printdata").show(); }, 2000);
      $("#printdata").hide();

      window.print();
    })
</script>