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
                        <li class="active-bre"><a href="#"> Ui Form</a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Add New Warehouses</h4>
                                </div>
                                <div class="tab-inn">
                                    <form action="{{ route('grns.store') }}" method="POST">
                                        @csrf
                                        <div class="row">

                                            <div class="input-field col s4">
                                                <select name="warehouse_id">
                                                    @foreach ($warehouses as $warehouse)
                                                    <option value="" disabled selected>Select Warehouse</option>
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="input-field col s4">
                                                <input type="date" name="received_date" class="validate">

                                            </div>

                                            <div class="input-field col s4">
                                                <input type="text" name="grn_number" class="validate">
                                                <label for="remarks">Grn Number</label>
                                            </div>

                                        </div>


                                        <div class="row">

                                            <div class="input-field col s6">

                                                <select name="supllier_id" required>
                                                    <option value="" disabled selected>Select Supllier</option>
                                                    @foreach ($supllier as $supllier)
                                                    <option value="{{ $supllier->id }}">{{ $supllier->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="input-field col s6">
                                                <input type="text" name="remarks" class="validate">
                                                <label for="remarks">Remarks</label>
                                            </div>
                                        </div>

                                        <h3>GRN Items</h3>
                                        <div id="items">
    <div class="item">
        <div class="row product-item">
            <div class="input-field col s2">
                <select name="items[0][product_id]" required>
                    <option value="" disabled selected>Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <label>Product</label>
            </div>
            <div class="input-field col s2">
                <input type="number" name="items[0][quantity]" class="validate" required>
                <label>Quantity</label>
            </div>
            <div class="input-field col s2">
                <input type="number" name="items[0][unit_price]" class="validate" required>
                <label>Unit Price</label>
            </div>
            <div class="input-field col s2">
                <input type="text" name="items[0][warranty_period]" class="validate">
                <label>Warranty Period</label>
            </div>
            <div class="input-field col s2">
                <button type="button" class="btn red" onclick="removeItem(this)">Remove</button>
            </div>
        </div>
    </div>
</div>

<!-- Add More Button -->
<div class="row">
    <div class="input-field col s2">
        <button type="button" class="btn green" onclick="addItem()">Add Product</button>
    </div>
</div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button type="submit" class="waves-effect waves-light btn-large">Save
                                                    GRN</button>
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
<!-- JavaScript -->
<script>
let itemIndex = 1;

function getProductOptions() {
    let products = @json($products);
    return products.map(product => `<option value="${product.id}">${product.name}</option>`).join('');
}

function addItem() {
    let html = `
        <div class="item">
            <div class="row">
                <div class="input-field col s2">
                    <select name="items[${itemIndex}][product_id]" required class="browser-default">
                        <option value="" disabled selected>Select Product</option>
                        ${getProductOptions()}
                    </select>
               
                </div>
                <div class="input-field col s2">
                    <input type="number" name="items[${itemIndex}][quantity]" class="validate" required>
                    <label>Quantity</label>
                </div>
                <div class="input-field col s2">
                    <input type="number" name="items[${itemIndex}][unit_price]" class="validate" required>
                    <label>Unit Price</label>
                </div>
                <div class="input-field col s2">
                    <input type="text" name="items[${itemIndex}][warranty_period]" class="validate">
                    <label>Warranty Period</label>
                </div>
                <div class="input-field col s2">
                    <button type="button" class="btn red" onclick="removeItem(this)">Remove</button>
                </div>
            </div>
        </div>`;

    // Insert the new item into the container
    document.getElementById('items').insertAdjacentHTML('beforeend', html);

    // No need for M.FormSelect.init() to be called
    itemIndex++;
}

function removeItem(button) {
    const item = button.closest('.item');
    if (document.querySelectorAll('.item').length > 1) {
        item.remove();
    } else {
        alert('At least one product is required.');
    }
}

    </script>

    @include('includes.js')
</body>

</html>