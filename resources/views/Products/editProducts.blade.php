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
                                    <h4>Edit Product Details</h4>
                                </div>
                                <div class="tab-inn">
                                    <form action="{{ route('product.editProduct') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="Product_id" value="{{ $product->id }}">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="name" name="name" type="text" class="validate"
                                                    value="{{ $product->name }}">
                                                <label for="name">products Name</label>
                                                @error('name')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="sku" name="sku" type="text" class="validate"
                                                    value="{{ $product->sku }}" readonly>
                                                <label for="phone">sku</label>
                                                @error('phone')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="description" name="description" type="text" class="validate"
                                                    value="{{ $product->description }}">
                                                <label for="description">Description</label>
                                                @error('city')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="input-field col s6">
                                                <input id="price" name="price" type="text" class="validate"
                                                    value="{{ $product->price }}">
                                                <label for="price">Price</label>
                                                @error('price')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input id="stock" name="stock" type="text" class="validate"
                                                    value="{{ $product->stock }}">
                                                <label for="stock">Stock</label>
                                                @error('stock')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="category" name="category" type="text" class="validate"
                                                    value="{{ $product->category }}">
                                                <label for="category">Category</label>
                                                @error('category')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="input-field col s6">
                                                <select name="supplier_id">
                                                    <option value="" disabled selected>Choose Category</option>
                                                    @foreach($allSuplliers as $item)
                                                    <option value="{{ $item->id }}" @if(isset($supplier) && $item->id ==
                                                        $supplier->id) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                                <label>Select Category</label>
                                            </div>
                                            <div class="input-field col s6">
                                            <input id="sell_price" name="sell_price" type="text" class="validate"
                                                          value="{{ $product->sell_price }}">
                                                <label for="sell_price">Sell Price</label>
                                                @error('city')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s6">
                                                <label for="photo">Product Image</label><br>

                                                <!-- Display Existing Image -->
                                                @if($product->photo)
                                                <div style="margin-bottom: 10px;">
                                                    <img id="photo-preview" name="photo"
                                                        src="{{ asset('storage/' . $product->photo) }}"
                                                        alt="Product Image"
                                                        style="max-width: 150px; max-height: 150px;">
                                                    <!-- Hidden Field to Pass Existing Image -->
                                                    <input type="hidden" typ="file" name="photo"
                                                        value="{{ $product->photo }}">
                                                </div>
                                                @else
                                                <p>No image uploaded</p>
                                                @endif

                                                <!-- Input Field for New Image Upload -->
                                                <input id="photo" name="photo" type="file" class="validate"
                                                    onchange="previewImage(event)">

                                                <!-- Validation Error -->
                                                @error('photo')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
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

    @include('includes.js')
    <script>
    // Preview the New Image Before Upload
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('photo-preview');
            output.src = reader.result; // Update the preview with the new image
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
</body>

</html>