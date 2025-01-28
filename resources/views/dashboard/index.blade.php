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
  
    <canvas id="invoiceChart" width="400" height="200"></canvas>
    <h4>Invoice Details</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('invoiceChart').getContext('2d');

        // Get months and total amounts from the controller
        const labels = {!! json_encode($months) !!}; // X-axis labels (months)
        const data = {!! json_encode($totalAmount) !!}; // Y-axis values (total amounts)

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Invoice Amount ($)',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, 
                plugins: {
                    title: {
                        display: true,
                        text: 'Invoice Amount Over Time', // Title of the chart
                        font: {
                            size: 18, // Font size for the title
                            weight: 'bold' // Font weight
                        },
                      
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Months'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Invoice Amount ($)'
                        }
                    }
                }
            }
        });
    });
</script>


            @include('includes.js')
</body>

</html>