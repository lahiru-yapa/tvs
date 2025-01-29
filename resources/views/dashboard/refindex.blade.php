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
</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    
        Highcharts.chart('salesChart', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Daily Sales for Last 3 Months'
            },
            xAxis: {
                categories: Array.from({length: 31}, (_, i) => i + 1),
                title: {
                    text: 'Days of the Month'
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
            ]
        });
    });
</script>

            @include('includes.js')
</body>

</html>