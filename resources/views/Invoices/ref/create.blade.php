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
            @if (session('returnerror'))
            <div class="alert alert-danger" style="text-align: center">
                {{ session('returnerror') }}
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
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
                                    <h4>Add New invoice</h4>
                                    <span id="average-days-display" style="font-weight: bold;">About Customer</span>
                                </div>



                                <div class="tab-inn">
                                <form action="{{ route('ref.invoice.storeInvoice') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            <label>Select Shop</label>
            <select class="form-control" name="shop_id" id="shop-select">
                <option value="" disabled selected>-</option>
                @foreach($shops as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <div id="credit-limit-container" style="display: none;">
                <input type="text" class="form-control mt-2" id="credit-limit" readonly>
            </div>
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <label>Select Warehouse</label>
            <select class="form-control" name="warehouse" id="warehouse">
                <option value="" disabled selected>-</option>
                @foreach($warehouse as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <label>Select Product</label>
            <select class="form-control" name="product_name2" id="product_name2">
                <option value="" disabled selected>-</option>
            </select>
        </div>
    </div>

    <input type="hidden" id="totalAmountInput" name="totalAmount" value="0.00">
    <div class="row mt-3">
        <div class="table-responsive">
            <table class="table table-bordered" id="product-details-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Stock</th>
                        <th>Count</th>
                        <th>WhereHouse</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="selected-products-body">
                </tbody>
            </table>
            <div class="total-amount mt-2">
                <strong>Total Amount: $<span id="total-amount">0.00</span></strong>
            </div>
        </div>
    </div>

    <input type="hidden" id="selected-products" name="selected_products">

    <input type="hidden" id="selected-products2" name="selected_products2">
    <div class="row mt-3">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </div>
    </div>
</form>


                                    <!-- Add the responsive styles -->
                                    <style>
                                    .input-field {
                                        margin-bottom: 20px;
                                    }

                                    .input-field select,
                                    .input-field input {
                                        width: 100%;
                                        padding: 10px;
                                        font-size: 14px;
                                    }

                                    table {
                                        width: 100%;
                                        margin-top: 20px;
                                        border-collapse: collapse;
                                    }

                                    table th,
                                    table td {
                                        padding: 10px;
                                        text-align: left;
                                    }

                                    table th {
                                        background-color: #f1f1f1;
                                    }

                                    #product-details-table {
                                        display: none;
                                    }

                                    @media (max-width: 768px) {
                                        .input-field.col.s12.m4.l3 {
                                            width: 100%;
                                            margin-bottom: 15px;
                                        }

                                        table th,
                                        table td {
                                            font-size: 12px;
                                            padding: 8px;
                                        }

                                        .input-field.col.s12 {
                                            text-align: center;
                                        }
                                    }

                                    /* Container for table to handle horizontal scrolling */
                                    .table-container {
                                        overflow-x: auto;
                                        /* Enable horizontal scrolling */
                                        -webkit-overflow-scrolling: touch;
                                        /* For smoother scrolling on mobile devices */
                                        margin-top: 20px;
                                    }

                                    /* Table Styles */
                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                        table-layout: auto;
                                        /* Let content dictate the table width */
                                    }

                                    table th,
                                    table td {
                                        padding: 10px;
                                        text-align: left;
                                        word-wrap: break-word;
                                        /* Prevent text from overflowing */
                                    }

                                    /* Header styles */
                                    table th {
                                        background-color: #f1f1f1;
                                    }

                                    /* Responsive adjustments for small screens */
                                    @media (max-width: 768px) {

                                        table th,
                                        table td {
                                            font-size: 12px;
                                            /* Smaller text size for mobile */
                                            padding: 8px;
                                        }

                                        .input-field.col.s12 {
                                            text-align: center;
                                        }

                                        /* Make the table row content more compact on small screens */
                                        .table-container {
                                            margin-top: 10px;
                                            /* Adjust spacing */
                                        }
                                    }

                                    /* Mobile view (default) - Full width */
                                    @media (max-width: 768px) {
                                        .input-field.col.s12 {
                                            width: 100%;
                                        }
                                    }

                                    /* Desktop view - 1/3 width */
                                    @media (min-width: 769px) {
                                        .input-field.col.s4 {
                                            width: 33.33%;
                                        }
                                    }

                                   
                                    /* Make sure the select and options are visible */
#product_name2 {
    visibility: visible !important;
    display: block !important;
}






                                    </style>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--== BOTTOM FLOAT ICON ==-->


    @include('includes.js2')

    <script>
 $(document).ready(function () {
    $('#warehouse').change(function () {
        let warehouseId = $(this).val();

        if (warehouseId) {
            $.ajax({
                url: "{{ url('get-products-by-warehouse') }}/" + warehouseId,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    var products = response.data; // Array of product objects with name and stock
                    console.log("products", products);

                    // Clear previous options
                    var productSelect = $('#product_name2');
                    productSelect.empty();

                    // Add a default placeholder option
                    productSelect.append('<option value="" disabled selected>select product</option>');

                    // Loop through products and add them as options
                    $.each(products, function (index, item) {
                        productSelect.append('<option value="' + item.id + '">' + item.name + ' (' + item.stock + ')</option>');
                    });

   
                    // Force reflow and refresh the select dropdown
                    productSelect.prop('selectedIndex', 0);
                    productSelect.trigger('change');
                },
                error: function () {
                    console.log("Error fetching products.");
                }
            });
        }
    });
});

</script>

    <script>
    $(document).ready(function() {
        // Hide the credit limit container on page load
        $('#credit-limit-container').hide();

        // Show the container and populate credit limit after shop selection
        $('#shop-select').change(function() {
            const shopId = $(this).val();
            if (shopId) {
                $.ajax({
                    url: "{{ route('shops.creditLimit') }}",
                    type: 'GET',
                    data: {
                        shop_id: shopId
                    },
                    success: function(response) {
                        if (response.credit_limit !== undefined) {
                            $('#credit-limit-container').html('Credit Limit: ' + response
                                .credit_limit);
                            $('#credit-limit-container').fadeIn(); // Show the container
                        } else {
                            $('#credit-limit').val('');
                            $('#credit-limit-container').fadeOut(); // Hide the container
                        }
                    },
                    error: function() {
                        alert('An error occurred while fetching the credit limit.');
                        $('#credit-limit').val('');
                        $('#credit-limit-container')
                            .fadeOut(); // Hide the container on error
                    }
                });
            } else {
                $('#credit-limit').val('');
                $('#credit-limit-container').fadeOut(); // Hide the container if no shop is selected
            }
        });
    });

    $(document).ready(function() {
       

        // Handle when user selects a product
        $('#product_name2').on('change', function() {
            var selectedProductName = $(this).val(); // Get the selected product name
            var selectedWarehouse = $('#warehouse').val(); // Get the selected warehouse ID

if (!selectedWarehouse) {
    alert("Please select a warehouse first.");
    return;
}
            // Fetch product details via AJAX
            $.ajax({
                url: "{{ route('products.details') }}", // Your route to fetch product details
                method: 'GET',
                data: {
                    product_name: selectedProductName
                },
                success: function(response) {

                    if (response.image && response.amount) {
                        // Show the product details table
                        $('#product-details-table').fadeIn();

                        // Add the selected product to the table
                        var productRow = `
                        <tr>
                            <td><img src="${response.image}" alt="Product Image" style="width: 100px;"></td>
                            <td>${response.name}</td>
                            <td>${response.amount}</td>
                                <td>${response.stock}</td>
                                 <td>
                           <input type="number" name="counts[${response.id}]" class="form-control count-input" value="1" min="1" max="${Math.max(0, response.stock - 2)}"/>

                           </td>
                           <td>${$('#warehouse option:selected').text()}</td> 
                            <td><button type="button" class="remove-product-btn">Remove</button></td>
                        </tr>
                    `;
                        $('#selected-products-body').append(productRow);

                        // Add product to the hidden input array
                        var selectedProducts = $('#selected-products').val() ? JSON.parse($(
                            '#selected-products').val()) : [];
                        selectedProducts.push({
                            id: response.id,
                            name: response.name,
                            amount: response.amount,
                            image: response.image,
                            warehouse_id: selectedWarehouse,
                        });
                        $('#selected-products').val(JSON.stringify(selectedProducts));
                    }
                }
            });
        });


 // Handle when user selects a return product
 $('#product_name3').on('change', function() {
            var selectedProductName = $(this).val(); // Get the selected product name

            // Fetch product details via AJAX
            $.ajax({
                url: "{{ route('products.details') }}", // Your route to fetch product details
                method: 'GET',
                data: {
                    product_name: selectedProductName
                },
                success: function(response) {

                    if (response.image && response.amount) {
                        // Show the product details table
                        $('#product-details-table2').fadeIn();

                        // Add the selected product to the table
                        var productRow = `
                        <tr>
                            <td><img src="${response.image}" alt="Product Image" style="width: 100px;"></td>
                            <td>${response.name}</td>
                            <td>${response.amount}</td>
                                <td>${response.stock}</td>
                                 <td>
                           <input type="number" name="counts[${response.id}]" class="form-control count-input" value="1" min="1" max="${Math.max(0, response.stock - 2)}"/>

                           </td>
                            <td><button type="button" class="remove-product-btn">Remove</button></td>
                        </tr>
                    `;
                        $('#selected-products-body2').append(productRow);

                        // Add product to the hidden input array
                        var selectedProducts = $('#selected-products2').val() ? JSON.parse($(
                            '#selected-products2').val()) : [];
                        selectedProducts.push({
                            id: response.id,
                            name: response.name,
                            amount: response.amount,
                            image: response.image
                        });
                        $('#selected-products2').val(JSON.stringify(selectedProducts));
                    }
                }
            });
        });

        // Remove a product from the table when the remove button is clicked
        $('#selected-products-body,#selected-products-body2').on('click', '.remove-product-btn', function() {
            $(this).closest('tr').remove(); // Remove product row

            // Update the hidden input with the remaining selected products
            var selectedProducts = [];
            var selectedProducts2 = [];
            $('#selected-products-body tr').each(function() {
                var productName = $(this).find('td').eq(1).text();
                var productAmount = $(this).find('td').eq(2).text();
                var productImage = $(this).find('img').attr('src');

                selectedProducts.push({
                    id: response.id,
                    name: productName,
                    amount: productAmount,
                    image: productImage
                });
            });

            $('#selected-products-body2 tr').each(function() {
                var productName2 = $(this).find('td').eq(1).text();
                var productAmount2 = $(this).find('td').eq(2).text();
                var productImage2 = $(this).find('img').attr('src');

                selectedProducts.push({
                    id: response.id,
                    name: productName2,
                    amount: productAmount2,
                    image: productImage2
                });
            });
            $('#selected-products').val(JSON.stringify(selectedProducts));
            $('#selected-products2').val(JSON.stringify(selectedProducts2));
        });
    });

    $(document).ready(function() {
        $('#shop-select').on('change', function() {
            const shopId = $(this).val();
            const averageDaysDisplay = $('#average-days-display');

            if (shopId) {
                // Reset the span content and style
                averageDaysDisplay.text('--').css('color', 'black');

                // Make the AJAX request
                $.ajax({
                    url: '/get-average-days', // Backend route
                    type: 'GET',
                    data: {
                        shop_id: shopId
                    },
                    success: function(response) {
                        if (response.averageDaysDifference !== undefined) {
                            const daysDifference = response.averageDaysDifference;

                            // Set the text and color based on the value
                            averageDaysDisplay.text(daysDifference);

                            if (daysDifference <= 10) {
                                averageDaysDisplay.css('color', 'green').text(
                                    'Good Customer');
                            } else if (daysDifference <= 20) {
                                averageDaysDisplay.css('color', 'red').text('Bad Customer');
                            } else {
                                averageDaysDisplay.css('color', 'black').text('N/A');
                            }
                        } else {
                            averageDaysDisplay.text('N/A').css('color', 'black');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        averageDaysDisplay.text('Error').css('color', 'black');
                    }
                });
            }
        });
    });

    $(document).ready(function() {

        // Function to calculate the total amount
        function calculateTotalAmount() {
            let totalAmount = 0;
            let totalAmount2 = 0;
            // Iterate through each row in the table
            $('#selected-products-body tr').each(function() {
                const amount = parseFloat($(this).find('td').eq(2).text()) || 0; // Amount column
                const qty = parseInt($(this).find('.count-input').val()) || 0; // Quantity input

                if (!isNaN(amount) && !isNaN(qty)) {
                    totalAmount += amount * qty;
                }
            });

             // Iterate through each row in the table
             $('#selected-products-body2 tr').each(function() {
                const amount2 = parseFloat($(this).find('td').eq(2).text()) || 0; // Amount column
                const qty2 = parseInt($(this).find('.count-input').val()) || 0; // Quantity input

                if (!isNaN(amount2) && !isNaN(qty2)) {
                    totalAmount2 += amount2 * qty2;
                }
            });

            // Update the total amount display
            $('#total-amount').text(totalAmount.toFixed(2));
            $('#total-amount2').text(totalAmount2.toFixed(2));
            // Update the hidden input field
            $('#totalAmountInput').val(totalAmount.toFixed(2));
            $('#totalAmountInput2').val(totalAmount2.toFixed(2));
        }

        // Recalculate total amount on quantity input change
        $('#selected-products-body').on('input', '.count-input', function() {
            calculateTotalAmount();
        });


        $('#selected-products-body2').on('input', '.count-input', function() {
            calculateTotalAmount();
        });
        // Observe changes in the table body for row addition/removal
        const tableBody = document.getElementById('selected-products-body');
        const tableBody2 = document.getElementById('selected-products-body2');
        const observer = new MutationObserver(function(mutationsList) {
            for (const mutation of mutationsList) {
                if (mutation.type === 'childList') {
                    calculateTotalAmount();
                }
            }
        });


        const observer2 = new MutationObserver(function(mutationsList2) {
            for (const mutation of mutationsList2) {
                if (mutation.type === 'childList') {
                    calculateTotalAmount();
                }
            }
        });

        // Configure the observer to watch for child nodes
        observer.observe(tableBody, {
            childList: true
        });

         // Configure the observer to watch for child nodes
         observer.observe(tableBody2, {
            childList2: true
        });
        // Initialize total amount calculation on page load
        calculateTotalAmount();
    });

    </script>
</body>

</html>