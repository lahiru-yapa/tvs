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

                <!-- Modal Structure -->
<div id="returnProductModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h4>Return Product</h4>
        <form id="returnProductForm">
        @csrf
        <input type="hidden" id="invoice-id" name="invoice_id">

            <div class="row">
                <div class="input-field col s12">
                    <label for="product-name">Product Name</label>
                    <input type="text" id="product-name" name="product_name" readonly>
                    <input type="hidden" id="productId" name="productId" readonly>
                </div>

                <div class="input-field col s12">
                                                <select name="salable_status" id="salable_status">
                                                    <option value="" disabled selected>-</option>
                                                    <option value="salable">Salable</option>
                                                    <option value="not_salable">Not Salable</option>                                      
                                                </select>
                                                <label>Select Shop</label>
                                            </div>

                <div class="input-field col s12">
                    <label for="return-quantity">Return Quantity</label>
                    <input type="number" id="return-quantity" name="return_quantity" required min="1">
                </div>
                <div class="input-field col s12">
                    <label for="return-reason">Reason for Return</label>
                    <textarea id="return-reason" name="return_reason" class="materialize-textarea" required></textarea>
                </div>
            </div>
            <button type="submit" class="btn waves-effect waves-light">Submit</button>
            <button type="button" class="btn modal-close red">Cancel</button>
        </form>
    </div>
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
                                        </div>
                                        <div class="row">
    <div class="col-md-12">
        <h5>Purchased Products for Selected Invoice</h5>
        <table class="table table-bordered" id="product-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="text-center">No products to display</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button type="submit"
                                                    class="waves-effect waves-light btn-large">Submit</button>
                                            </div>
                                        </div>
                                    </form>

 <table id="returned-products-table" class="table">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Salable Status</th>
            <th>Reason</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

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

    $j(document).ready(function () {
    var invoices = @json($invoice->mapWithKeys(function ($item) {
        return [$item->invoice_number => ['id' => $item->id, 'shop_name' => $item->shop->name]];
    }));

    $j("#invoice-input").autocomplete({
        source: Object.keys(invoices),
        select: function (event, ui) {
            var selectedInvoice = invoices[ui.item.value];
            $j("#shop-name").val(selectedInvoice.shop_name);
            $j("#invoice-id").val(selectedInvoice.id);
            
            // Fetch and display product details
            fetchInvoiceProducts(selectedInvoice.id);
            fetchReturnedProducts(selectedInvoice.id);
        }
    });

    function fetchInvoiceProducts(invoiceId) {
        $j.ajax({
            url: '/get-invoice-products',  // Laravel route to fetch product details
            method: 'GET',
            data: { invoice_id: invoiceId },
            success: function (response) {
                renderProductList(response.products);
            },
            error: function () {
                alert('Failed to fetch products. Please try again.');
            }
        });
    }


    function fetchReturnedProducts(invoiceId) {
        $j.ajax({
            url: '/get-returned-products',  // Laravel route to fetch returned products
            method: 'GET',
            data: { invoice_id: invoiceId },
            success: function (response) {
                renderReturnedProducts(response.returned_products);
            },
            error: function () {
                alert('Failed to fetch returned products. Please try again.');
            }
        });
    }

    function renderReturnedProducts(returnedProducts) {
        var tableBody = $j("#returned-products-table tbody");
        tableBody.empty(); // Clear previous rows

        if (returnedProducts.length === 0) {
            tableBody.append('<tr><td colspan="5" class="text-center">No returned products for this invoice.</td></tr>');
            return;
        }

       returnedProducts.forEach(function (product) {
        if (product.return_items && product.return_items.length > 0) {
            product.return_items.forEach(function (item) {
                tableBody.append(`
                    <tr>
                        <td>${item.product.name}</td>
                        <td>${item.quantity}</td>
                        <td>${item.salable_status}</td>
                        <td>${item.reason || 'N/A'}</td>
                        <td>${item.return_amount}</td>
                    </tr>
                `);
            });
        }
    });
    }


    function renderProductList(products) {
    var tableBody = $j("#product-table tbody");
    tableBody.empty(); // Clear previous rows

    if (products.length === 0) {
        tableBody.append('<tr><td colspan="4" class="text-center">No products found for this invoice.</td></tr>');
        return;
    }

    products.forEach(function (product) {
        var total = product.quantity * product.price;
        tableBody.append(`
            <tr>
                <td>${product.product ? product.product.name : 'N/A'}</td>
                <td>${product.quantity}</td>
                   <td>${product.price}</td>
                <td>${total.toFixed(2)}</td>
                 <td>
                    <button class="btn btn-info btn-sm edit-product" data-id="${product.product_id}">Return</button>
                </td>
            </tr>
        `);
    });
}



$j(document).ready(function() {
    // Initialize the modal (if you're using jQuery UI)
    $j("#returnProductModal").dialog({ autoOpen: false, modal: true, width: 500 });

    // Handle click event for Return button
    $j(document).on('click', '.edit-product', function(e) {
        e.preventDefault();  // Prevent default action (page reload)

        var productId = $j(this).data('id');
        var productName = $j(this).closest('tr').find('td:first').text(); // Get product name from table

        // Populate modal fields
        $j("#product-name").val(productName);
        $j("#productId").val(productId);
        $j("#returnProductModal").dialog("open");
    });

    // Handle form submission inside the modal
    $j("#returnProductForm").on('submit', function(e) {
        e.preventDefault(); // Prevent form submission from refreshing the page

        var formData = $j(this).serialize();
        console.log('Form Data:', formData); // Debugging

        // AJAX request to submit return data
        $j.ajax({
            url: '/return-product',  // Change to your actual route
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log('Return submitted successfully', response);
                $j("#returnProductModal").dialog("close");
                renderReturnedProducts(response.returned_products);
            },
            error: function(error) {
                console.error('Error submitting return:', error);
                alert('Failed to process the return. Please try again.');
            }
        });
    });
});


});

</script>


    @include('includes.js')
</body>

</html>