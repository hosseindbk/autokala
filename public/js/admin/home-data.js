$(document).ready(function() {
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    [30],
                    [20],
                    [15],
                    [15],
                    [10],
                    [10],
                ],
                backgroundColor: [
                    window.chartColors.grey,
                    window.chartColors.red,
                    window.chartColors.green,
                    window.chartColors.blue,
                    window.chartColors.yellow,
                    window.chartColors.orange,

                ],
                label: 'آژانس تخصصی تبلیغات بستا'
            }],
            labels: [
                "صفحه اصلی",
                "دیجیتال مارکتینگ",
                "طراحی وب سایت",
                "طراحی گرافیک",
                "چاپ و بسته بندی",
                "عکاسی و فیلمبرداری",

            ]
        },
        options: {
            responsive: true,
            legend: {
                labels: {
                    fontFamily:'IranSans',
                }
            },
        }
    };

    var ctx = document.getElementById("chartjs_pie").getContext("2d");
    window.myPie = new Chart(ctx, config);
});

// $(document).ready(function()
// {
//     Chart.defaults.global.defaultFontFamily = 'IranSans'
//     var color = Chart.helpers.color;
//     var barChartData = {
//         labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر"],
//
//         datasets: [{
//             type: 'line',
//             label: 'آژانس تخصصی تبلیغات بستا',
//             backgroundColor: color(window.chartColors.green).alpha(0.2).rgbString(),
//             borderColor: window.chartColors.green,
//
//             data: [
//                 randomScalingFactor(),
//                 randomScalingFactor(),
//                 randomScalingFactor(),
//                 randomScalingFactor(),
//                 randomScalingFactor(),
//                 randomScalingFactor(),
//                 randomScalingFactor(),
//                 randomScalingFactor()
//             ]
//         }]
//     };
//
//     var ctx = document.getElementById("canvas1").getContext("2d");
//     window.myBar = new Chart(ctx, {
//         type: 'bar',
//         data: barChartData,
//         options: {
//             responsive: true,
//             legend: {
//                 labels: {
//                     fontFamily:'IranSans',
//                     fontSize:12
//                 }
//             },
//             title: {
//                 display: true,
//                 text: ''
//             },
//         }
//     });
//
//
// });

//var ctx = document.getElementById('canvas1');
//     var myChart = new Chart(ctx, {
//     type: 'line',
//     data: {
//     labels: [فروردین,اردیبهشت,خرداد,تیر,مرداد,شهریور,مهر,ابان,اذر,دی ,بهمن,اسفند],
//     datasets: [{
//     label: 'آمار بازدید وبسایت',
//         data:
//                [12, 19, 53, 45, 62, 71],
//
//     backgroundColor: [
//     'rgba(141, 199, 1, 1)',
//     'rgba(141, 199, 1, 1)',
//     'rgba(141, 199, 1, 1)',
//     'rgba(141, 199, 1, 1)',
//     'rgba(141, 199, 1, 1)',
//     'rgba(141, 199, 1, 1)'
//     ],
//     borderColor: [
//     'rgba(141, 199, 1, 1)',
//     'rgba(141, 199, 1, 1)',
//     'rgba(141, 199, 1, 1)',
//     'rgba(141, 199, 1, 1)',
//     'rgba(141, 199, 1, 1)',
//     'rgba(141, 199, 1, 1)'
//     ],
//     borderWidth: 1
// }]
// },
//     options: {
//     scales: {
//     yAxes: [{
//     ticks: {
//     beginAtZero: true
// }
// }]
// }
// }
// });
