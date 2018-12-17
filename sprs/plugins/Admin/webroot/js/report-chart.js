$(document).ready(function() {
    $('#filter_to_date').datepicker({
        format: 'dd M yyyy',
        autoclose: true,
        clearBtn: true
    });
    $('#filter_from_date').datepicker({
        format: 'dd M yyyy',
        autoclose: true,
        clearBtn: true
    }).on("changeDate", function(e) {
        if ($('#filter_to_date').datepicker("getDate") < e.date) {
            $('#filter_to_date').datepicker("clearDates");
            $('#filter_to_date').val("");
        }
        $('#filter_to_date').datepicker("setStartDate", e.date);
    });
    $("#type").change(function() {
        typeChange();
        if ($("#type").val() != 4) {
            $("form")[0].submit();
        }
    });
    typeChange();
});
function typeChange() {
    var $this = $("#type");
    var today = moment();
    var fromDate = "";
    var toDate = "";
    $('#filter_from_date').attr("readonly", true);
    $('#filter_to_date').attr("readonly", true);
    if ($this.val() == 1) {
        fromDate = today.format("DD MMM YYYY");
        toDate = today.format("DD MMM YYYY");
    } else if ($this.val() == 2) {
        fromDate = moment().subtract(6, "days").format("DD MMM YYYY");
        toDate = today.format("DD MMM YYYY");
    } else if ($this.val() == 3) {
        fromDate = moment().subtract(30, "days").format("DD MMM YYYY");
        toDate = today.format("DD MMM YYYY");
    } else {
        $('#filter_from_date').attr("readonly", false);
        $('#filter_to_date').attr("readonly", false);
    }

    if (fromDate && toDate) {
        $('#filter_from_date').val(fromDate);
        $('#filter_to_date').val(toDate);
    }

}

function initTurnOverChart(objOrdersXY) {
    Highcharts.chart("chart-turnover", {
        chart: {
            type: 'area'
        },
        title: {
            text: "Turn over"
        },
        xAxis: {
            categories: objOrdersXY.x,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: "Net Turnover"
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">Date : {point.key}</span><table>',
            pointFormat: '<tr>' +
                    '<td style="padding:0"><b>Net Turnover :{point.y} €</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            area: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        return this.y > 0 ? this.y : null;
                    }
                }
            }
        },
        series: [{"name": "Time", "data": objOrdersXY.y}],
        exporting: {
            sourceWidth: 2000,
            sourceHeight: 1000
        }
    });
}

function initNetIncomeChart(objOrdersXY) {
    Highcharts.chart("chart-turnover", {
        chart: {
            type: 'area'
        },
        title: {
            text: "Net Income"
        },
        xAxis: {
            categories: objOrdersXY.x,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: "Net Income (in €)"
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">Date : {point.key}</span><table>',
            pointFormat: '<tr>' +
                    '<td style="padding:0"><b>Net Income :{point.y} €</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            area: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        return this.y > 0 ? this.y : null;
                    }
                }
            }
        },
        series: [{"name": "Time", "data": objOrdersXY.y}],
        exporting: {
            sourceWidth: 2000,
            sourceHeight: 1000
        }
    });
}



function initWorkingHoursChart(objOrdersXY) {
    Highcharts.chart("chart-turnover", {
        chart: {
            type: 'area'
        },
        title: {
            text: "Working Hours"
        },
        xAxis: {
            categories: objOrdersXY.x,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: "Drivers Online"
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">Name : {point.key}</span><table>',
            pointFormat: '<tr>' +
                    '<td style="padding:0"><b>Working Hours : {point.y} min</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            area: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        return this.y > 0 ? this.y : null;
                    }
                }
            }
        },
        series: [{"name": "Time", "data": objOrdersXY.y}],
        exporting: {
            sourceWidth: 2000,
            sourceHeight: 1000
        }
    });
}
function initGrossChart(series, seriesOrders) {
    Highcharts.chart('chart-gross-1', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Total sales vs Expenses'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>${point.y:.2f}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
                name: 'Total Sales vs Expenses',
                colorByPoint: true,
                data: series
            }]
    });
    Highcharts.chart('chart-gross-2', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Total Sales'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>${point.y:.2f}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
                name: 'Total Sales',
                colorByPoint: true,
                data: seriesOrders
            }]
    });
}
function convertToXYArray(dataRes) {
    var arrX = [];
    var arrY = [];
    $.each(dataRes, function(key, value) {
        var length = arrX.length;
        arrX[length] = key;
        arrY[length] = value;
    });
    return {x: arrX, y: arrY};
}