<!DOCTYPE html>
<html lang="en">

@include('includes.header')

<body>
    <!--== MAIN CONTRAINER ==-->
    @include('includes.topBar')

    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
            <div class="sb2-1">
                <!-- //side bar -->
                @include('includes.sidebar')
            </div>
            <div class="sb2-2">
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li class="active-bre"><a href="#">Dashboard</a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <div class="container">
                                        <div id="salesChart"></div>
                                        <div class="row">
    <div class="col-12 col-md-6 mb-2 mb-md-0" style="text-align: center;padding: 10px;">
        <button type="button" class="btn btn-light w-100" onclick="window.location='{{ route('refinvoice.index') }}'">
            All Invoice
        </button>
    </div>

    <div class="col-12 col-md-6" style="text-align: center;padding: 10px;">
        <button type="button" class="btn btn-light w-100" onclick="window.location='{{ route('ref.addinvoice') }}'">
            Add Invoice
        </button>
    </div>
</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <style>
    #salesChart {
        width: 100%;
        max-width: 100%;
        height: 400px; /* Adjust as needed */
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        Highcharts.chart('salesChart', {
            chart: {
                type: 'line',
                height: '50%' // Adjusts height dynamically
            },
            title: {
                text: 'Daily Sales for Last 3 Months'
            },
            xAxis: {
                categories: Array.from({length: 31}, (_, i) => i + 1),
                title: {
                    text: 'Days of the Month'
                },
                labels: {
                    rotation: -45, // Rotate labels for better readability
                    step: window.innerWidth < 768 ? 3 : 1 // Reduce labels on small screens
                }
            },
            yAxis: {
                title: {
                    text: 'Sales Amount'
                }
            },
            series: [
                {
                    name: '{{ now()->format("F Y") }}',
                    data: @json(array_values($chartData['currentMonth'])),
                    color: '#FF5733'
                },
                {
                    name: '{{ now()->subMonth()->format("F Y") }}',
                    data: @json(array_values($chartData['lastMonth'])),
                    color: '#33FF57'
                },
                {
                    name: '{{ now()->subMonths(2)->format("F Y") }}',
                    data: @json(array_values($chartData['twoMonthsAgo'])),
                    color: '#3380FF'
                }
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 768
                    },
                    chartOptions: {
                        chart: {
                            height: 300
                        },
                        xAxis: {
                            labels: {
                                step: 3
                            }
                        }
                    }
                }]
            }
        });
    });
</script>

            @include('includes.js')
</body>

</html>