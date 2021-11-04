// line graph for new user by months
$(document).ready(function() {



    $.ajax({
        method: 'GET',
        url: 'usage/user_line_chart',
        success: function (data) {
           console.log("user data"+data);
           data = JSON.parse(data);
           list_month=[];
           list_counts=[];
    
                    data.forEach(function(element) {
                        list_month.push(element[0]);
                        list_counts.push(element[1]);
                    });
    
           $(function(){
                   chart = new Highcharts.chart('user-line-chart', {
                        title: {
                            text: 'New User Records - ' + new Date().getFullYear()
                        },
                        subtitle: {
                            text: 'Source: Asisantrade.com'
                        },
                        xAxis: {
                            categories: list_month
                        },
                        yAxis: {
                            title: {
                                text: 'Number of Users'
                            }
                        },
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        },
                        plotOptions: {
                            series: {
                                allowPointSelect: true
                            }
                        },
                        series: [{
                            name: 'New Users',
                            data: list_counts
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
          });
        
        },
        error: function (error) {
            console.log('error');
        }
    });

// line chart for new posts by month in current year

$.ajax({
    method: 'GET',
    url: 'usage/post_line_chart',
    success: function (data) {
       console.log("post data"+data);
       data = JSON.parse(data);
       list_month=[];
       list_counts=[];

    //    data.array.forEach(element => {
    //        list_month.push(element[0]);
    //        list_counts.push(element[1]);
           
    //    });
                data.forEach(function(element) {
                    list_month.push(element[0]);
                    list_counts.push(element[1]);
                });

       $(function(){
               chart3 = new Highcharts.chart('post-line-chart', {
                    title: {
                        text: 'New Post Records - '+ new Date().getFullYear()
                    },
                    subtitle: {
                        text: 'Source: Asiantrade.com'
                    },
                    xAxis: {
                        categories: list_month
                    },
                    yAxis: {
                        title: {
                            text: 'Number of New Posts'
                        }
                    },
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    },
                    plotOptions: {
                        series: {
                            allowPointSelect: true
                        }
                    },
                    series: [{
                        name: 'New Posts',
                        data: list_counts
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
      });
    
    },
    error: function (error) {
        console.log('error');
    }
});

//Pie chart for posts by categories
$.ajax({
    method: 'GET',
    url: 'usage/pie_chart',
    success: function (data) {
       console.log("AAA"+data);
       data = JSON.parse(data);

    
        chart2= new Highcharts.chart('pie-chart', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Posts by Category'
            },
            subtitle: {
                text: 'Source: Asiantrade.com'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Categories',
                colorByPoint: true,
                data: data
            }]
        });
    
    },
    error: function (error) {
        console.log('error');
    }
})



//Pie chart for posts by categories
$.ajax({
    method: 'GET',
    url: 'usage/pie_chart_delete',
    success: function (data) {
       console.log("AAA"+data);
       data = JSON.parse(data);

    
        chart2= new Highcharts.chart('pie-chart-delete', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Delete by Reason'
            },
            subtitle: {
                text: 'Source: Asiantrade.com'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Categories',
                colorByPoint: true,
                data: data
            }]
        });
    
    },
    error: function (error) {
        console.log('error');
    }
})



//Chart3 

//Pie chart for posts by categories
$.ajax({
    method: 'GET',
    url: 'usage/pie_chart_delete_reason',
    success: function (data) {
       console.log("AAA"+data);
       data = JSON.parse(data);

    
        chart2= new Highcharts.chart('pie-chart-delete', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Posts by Category'
            },
            subtitle: {
                text: 'Source: Asiantrade.com'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Categories',
                colorByPoint: true,
                data: data
            }]
        });
    
    },
    error: function (error) {
        console.log('error');
    }
})

});