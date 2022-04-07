<div class="main-content">
    <section class="section">
        <div class="row ">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Total Data Akun</h5>
                                            <h2 class="mb-3 font-18"><?=$akun?> Akun</h2>
                                            <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/1.png" alt="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15"> Total Transaksi Penjualan</h5>
                                                <h2 class="mb-3 font-18"><?=$transaksi?></h2>
                                            </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>

        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Chart</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart4" class="chartsh"></div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

"use strict";

$(function () {
    chart4();

    // select all on checkbox click
    $("[data-checkboxes]").each(function () {
        var me = $(this),
            group = me.data('checkboxes'),
            role = me.data('checkbox-role');

        me.change(function () {
            var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
                checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
                dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
                total = all.length,
                checked_length = checked.length;

            if (role == 'dad') {
                if (me.is(':checked')) {
                    all.prop('checked', true);
                } else {
                    all.prop('checked', false);
                }
            } else {
                if (checked_length >= total) {
                    dad.prop('checked', true);
                } else {
                    dad.prop('checked', false);
                }
            }
        });
    });



});
function chart4() {
	
    var options = {
        chart: {
            height: 250,
            type: 'area',
            toolbar: {
                show: false
            },

        },
        colors: ['#4CC2B0'], // line color
        fill: {
            colors: ['#4CC2B0'] // fill color
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        markers: {
            colors: ['#4CC2B0'] // marker color
        },
        series: [{
            name: 'Penjualan',
            data:[<?=
                        '' . $penjualan[0][0] . ',' . $penjualan[1][1] . ',' . $penjualan[2][2] . ',
                            ' . $penjualan[3][3] . ',' . $penjualan[4][4] . ',' . $penjualan[5][5] . ',
                            ' . $penjualan[6][6] . ',' . $penjualan[7][7] . ',' . $penjualan[8][8] . ',
                            ' . $penjualan[9][9] . ',' . $penjualan[10][10] . ',' . $penjualan[11][11] . ',';
                        ?>]
        }],
        legend: {
            show: false,
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            labels: {
                style: {
                    colors: "#9aa0ac"
                }
            },
        },
        yaxis: {
            labels: {
                style: {
                    color: "#9aa0ac"
                }
            }
        },
    }

    var chart = new ApexCharts(
        document.querySelector("#chart4"),
        options
    );

    chart.render();

}

</script>

