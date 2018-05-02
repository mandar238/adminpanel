<script type="text/javascript">
    $("#caloriesChart").hide();
    var dynamic_chart = function () {
        var user_id=$("#user_id").val();
        var fromDate=$("#fdate").val();
        var toDate=$("#todate").val();
        var dates=[];
        var values=[];
        $.ajax({  
            type: 'POST',  
            dataType: 'json',
            url: '<?php echo base_url();?>index.php/reports/getcaloriesData', 
            data: {user_id:user_id, fromDate:fromDate, toDate:toDate},
            success: function(response) {
                    if(response.success){
                      "use strict";
                      $('#calories_chart').highcharts({
                          title: {
                                text: 'Calories Balance Report'
                            },
                            xAxis: {
                                title: {
                                    text: 'Dates'
                                },
                                categories: response.mdates
                            },
                            yAxis: {
                                title: {
                                    text: '(cal)'
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle'
                            },

                            series: [{
                                name: 'Calories Gained',
                                data: response.mvalues,
                                color: '#1E90FF',
                            }, {
                                name: 'Calories Burnt',
                                data: response.avalues,
                                color: '#FF0000',
                            }],

                            responsive: {
                                rules: [{
                                    condition: {
                                        maxWidth: 500
                                    },
                                    chartOptions: {
                                        legend: {
                                            layout: 'horizontal',
                                            align: 'center',
                                            verticalAlign: 'bottom'
                                        }
                                    }
                                }]
                            }

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
    $("#showcalChart").click(function () {
        $("#caloriesChart").show();
        ChartHigh.init();
    });

    $("#printdata").click(function(){
      setTimeout(function(){ $("#printdata").show(); }, 2000);
      $("#printdata").hide();

      window.print();
    })
</script>