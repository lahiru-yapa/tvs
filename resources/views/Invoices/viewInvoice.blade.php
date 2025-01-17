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
                        <li class="active-bre"><a href="#"> Ui Form</a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Product Details</h4>

                                    <!-- Dropdown Structure -->

                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>invoice number</th>
                                                    <th>shop name </th>
                                                    <th>total_amount</th>
                                                    <th>paid_amount</th>
                                                    <th>due_date</th>
                                                    <th>paid_status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($invoices as $item)
                                                <tr>
                                                    <td>{{$item->invoice_number}}</td>
                                                    <td>{{$item->shop->name}}</td>
                                                    <td>{{$item->total_amount}}</td>
                                                    <td>{{$item->paid_amount}}</td>
                                                    <td>{{$item->due_date}}</td>
                                                    <td>
                                                        @if ($item->paid_status === 1)
                                                        Paid
                                                        @elseif ($item->paid_status === 0)
                                                        Unpaid
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('includes.js')
</body>

</html>