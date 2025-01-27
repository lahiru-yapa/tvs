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
                <!--== USER INFO ==-->
                <div class="sb2-12">
                    <ul>
                        <li><img src="images/placeholder.jpg" alt="">
                        </li>
                        <li>
                            <h5>Sanjeewa Motors <span> Godakawela</span></h5>
                        </li>
                        <li></li>
                    </ul>
                </div>
                <!--== LEFT MENU ==-->
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
                                    <h4>View Invoice Details</h4>
                                </div>
                                <div class="tab-inn">

                                    <div class="row">
                                        <div class="input-field col s3">
                                            <input id="invoice_number" name="invoice_number" type="text"
                                                class="validate" value="{{ $invoice->invoice_number }}" readonly>
                                            <label for="name">Invoice Number</label>
                                        </div>

                                        <div class="input-field col s3">
                                            <input id="name" name="name" type="text" class="validate"
                                                value="{{$invoice->shop->name }}" readonly>
                                            <label for="name">Shop name</label>
                                        </div>

                                        <div class="input-field col s3">
                                            <input id="address" name="address" type="text" class="validate"
                                                value="{{$invoice->shop->address }}" readonly>
                                            <label for="name">Shop address</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <input id="paid_status" name="paid_status" type="text" class="validate"
                                                value="{{ $invoice->paid_status == 1 ? 'Paid' : 'Unpaid' }}" readonly>
                                            <label for="paid_status">Paid Status</label>
                                        </div>

                                        <div class="input-field col s3">
                                            <input id="paid_amount" name="paid_amount" type="text" class="validate"
                                                value="{{$invoice->paid_amount }}" readonly>
                                            <label for="name">Paid Amount</label>
                                        </div>
                                    </div>
                                    <div class="sb2-2-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="box-inn-sp">
                                                    <div class="inn-title">
                                                        <h4>Invoice Details</h4>

                                                        <!-- Dropdown Structure -->

                                                    </div>
                                                    <div class="tab-inn">
                                                        <div class="table-responsive table-desi">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Product Name</th>
                                                                        <th>Quantity</th>
                                                                        <th>Price</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($invoice->invoiceProducts as $index =>
                                                                    $invoiceProduct)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>{{ $invoiceProduct->product->name }}</td>
                                                                        <td>{{ $invoiceProduct->product->sku }}</td>
                                                                        <td>{{ $invoiceProduct->quantity }}</td>
                                                                        <td>{{ number_format($invoiceProduct->price, 2) }}
                                                                        </td>
                                                                        <td>{{ number_format($invoiceProduct->quantity * $invoiceProduct->price, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="5" class="text-end"><strong>Grand
                                                                                Total:</strong></td>
                                                                        <td>
                                                                            {{ number_format($invoice->invoiceProducts->sum(fn($ip) => $ip->quantity * $ip->price), 2) }}
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.js')
</body>

</html>