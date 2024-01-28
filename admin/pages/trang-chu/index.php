<?php
require_once '../model/TruyenModel.php';
require_once '../model/TheloaiModel.php';
require_once '../model/CommonModel.php';

$truyen = new TruyenModel();
$theLoai = new TheLoaiModel();
$cm = new CommonModel();

$truyen__Get_All = $truyen->Truyen__Get_All();
$truyen__Get_Top_View = $truyen->Truyen__Get_Top_View_Chart();
$theLoai__Get_Top_View = $theLoai->Theloai__Get_Top_View_Chart();
?>

<div id="main-container">
    <div class="main-title">
        <h3>Thống kê Truyện Cover</h3>
        <ul class="breadcrumb">
            <li>
                <a href="#">Thống kê Truyện Cover</a>
            </li>
        </ul>
    </div>

    <div class="row section-container">
        <div class="col-9">
            <div class="main-chart">
                <canvas id="barChart"></canvas>
            </div>
            <div class="main-data">
                <h3 class="section-title">Top lượt xem theo truyện</h3>
                <div class="table-responsive">
                    <table id="" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Top</th>
                                <th>Tên truyện</th>
                                <th>Lượt xem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0 ?>
                            <?php foreach ($truyen__Get_Top_View as $item) : ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= $item->truyen_ten ?></td>
                                <td><?= $cm->formatThousand($item->truyen_luot_xem) ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="main-chart">
                <canvas id="pieChart"></canvas>
            </div>
            <div class="main-data">
                <h3 class="section-title">Top lượt xem theo thể loại</h3>
                <div class="table-responsive">
                    <table id="" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Top</th>
                                <th>Thể loại</th>
                                <th>Tổng lượt xem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0 ?>
                            <?php foreach ($theLoai__Get_Top_View as $item) : ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= $item->the_loai_ten ?></td>
                                <td><?= $cm->formatThousand($item->tong_luot_xem) ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/vendor/chart-js-v4.4.1.js"></script>

<script>
// Bar Chart
var barChartCanvas = document.getElementById("barChart").getContext('2d');

var truyenTen = <?php echo json_encode(array_column($truyen__Get_Top_View, 'truyen_ten')); ?>;
var truyenLuotXem = <?php echo json_encode(array_column($truyen__Get_Top_View, 'truyen_luot_xem')); ?>;
var barChartColors = ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF5733'];

var barChartData = {
    labels: truyenTen,
    datasets: [{
        label: 'Top View',
        data: truyenLuotXem,
        backgroundColor: barChartColors,
        borderColor: 'white',
        borderWidth: 1
    }]
};

var barChartOptions = {
    scales: {
        y: {
            beginAtZero: true
        },
        x: {
            display: false // Hide the x-axis labels
        }
    },
    plugins: {
        legend: {
            display: false
        }
    },
    responsive: true,
    maintainAspectRatio: false
};

var myBarChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions,
    plugins: [{
        afterDraw: function(chart) {
            var ctx = chart.ctx;
            var xAxis = chart.scales.x;

            chart.data.labels.forEach(function(label, index) {
                var x = xAxis.getPixelForValue(index);
                var y = chart.scales.y.getPixelForValue(chart.data.datasets[0].data[index]);
                var barWidth = chart.width / truyenTen.length;

                var text = "Top " + (index + 1);
                var fontSize = 14;
                ctx.fillStyle = 'black';
                ctx.font = fontSize + 'px Roboto';
                ctx.textAlign = 'center';
                ctx.fillText(text, x - barWidth / 2 + barWidth / 2, y + 10);
            });
        }
    }]
});

// Pie Chart

var theLoaiTen = <?php echo json_encode(array_column($theLoai__Get_Top_View, 'the_loai_ten')); ?>;
var tongLuotXem = <?php echo json_encode(array_column($theLoai__Get_Top_View, 'tong_luot_xem')); ?>;

var pieChartColors = ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF5733'];

var pieChartCanvas = document.getElementById("pieChart").getContext('2d');
var pieChartData = {
    labels: theLoaiTen,
    datasets: [{
        data: tongLuotXem,
        backgroundColor: pieChartColors,
        borderColor: 'white',
        borderWidth: 2
    }]
};
var pieChartOptions = {
    responsive: true,
    legend: {
        position: 'right'
    }
};
var myPieChart = new Chart(pieChartCanvas, {
    type: 'pie',
    data: pieChartData,
    options: pieChartOptions
});
</script>