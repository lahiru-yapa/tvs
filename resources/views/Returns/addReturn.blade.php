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
                @include('includes.sidebar')
            </div>
            <div class="sb2-2">
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li class="active-bre"><a href="#">Product</a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Add New Product </h4>
                                </div>
                                <div class="tab-inn">
                                <form action="{{ route('product.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                       
                                        <div class="input-field col s6">
    <label for="invoice-input">Search Invoice Number</label>
    <input type="text" id="invoice-input" name="supplier_id" placeholder="Type to search invoice number">
</div>
<div class="input-field col s6">
    <label for="shop-name">Shop Name</label>
    <input type="text" id="shop-name" placeholder="Shop name will be displayed here" readonly>
</div>

                                            <div class="input-field col s6">
                                                <input id="phone" name="name" type="text" class="validate"
                                                    value="{{ old('name') }}">
                                                <label for="phone">Name</label>
                                                @error('phone')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="phone" name="description" type="text" class="validate"
                                                    value="{{ old('description') }}">
                                                <label for="phone">Description</label>
                                                @error('phone')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>total_amount</th>
                                                    <th>paid_amount</th>
                                                    <th>due_date</th>
                                                    <th>status</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                            </tbody>
                                        </table>
                                        <!-- Pagination Links -->
                                        <div class="d-flex justify-content-center">
                                 
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button type="submit"
                                                    class="waves-effect waves-light btn-large">Submit</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- jQuery -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">


<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        var invoices = @json($invoice->pluck('invoice_number', 'id'));

        $j("#invoice-input").autocomplete({
            source: Object.values(invoices),
            select: function(event, ui) {
                var selectedInvoice = Object.keys(invoices).find(key => invoices[key] === ui.item.value);
                console.log("Selected Invoice ID: " + selectedInvoice);
                
                $j('<input>').attr({
                    type: 'hidden',
                    name: 'supplier_id',
                    value: selectedInvoice
                }).appendTo('form');
            }
        });
    });
</script>


<script>
    $j(document).ready(function() {
        var invoices = @json($invoice->mapWithKeys(function($item) {
            return [$item->invoice_number => ['id' => $item->id, 'shop_name' => $item->shop->name]];
        }));

        $j("#invoice-input").autocomplete({
            source: Object.keys(invoices),
            select: function(event, ui) {
                var selectedInvoice = invoices[ui.item.value];
                console.log("Invoice ID: " + selectedInvoice.id);
                console.log("Shop Name: " + selectedInvoice.shop_name);

                // Display the shop name in the input field
                $("#shop-name").val(selectedInvoice.shop_name);

                // Optionally store the invoice ID in a hidden input
                $('<input>').attr({
                    type: 'hidden',
                    name: 'supplier_id',
                    value: selectedInvoice.id
                }).appendTo('form');
            }
        });
    });
</script>


    @include('includes.js')
</body>

</html>