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
                                                <input id="phone" name="name" type="text" class="validate"
                                                    value="{{ old('name') }}">
                                                <label for="phone">Name</label>
                                                @error('phone')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="input-field col s6">
                                                <select name="supplier_id">
                                                    <option value="" disabled selected>Choose Supplier</option>
                                                    @foreach($supllier as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <label>Select Category</label>
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
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <div class="file-field">
                                                    <div class="btn">
                                                        <span>File</span>
                                                        <input type="file" name="photo" accept="image/*" required>
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text"
                                                            placeholder="Upload Blog Banner">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="input-field col s6">
                                                <input id="city" name="price" type="text" class="validate"
                                                    value="{{ old('price') }}">
                                                <label for="price">Price</label>
                                                @error('city')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <select name="category">
                                                    <option value="" disabled selected>Choose Category</option>
                                                    <option value="1">Main Where Houses</option>
                                                    <option value="2">Educations</option>
                                                    <option value="3">Medical</option>
                                                    <option value="3">Health</option>
                                                    <option value="3">Fitness</option>
                                                    <option value="3">Tution</option>
                                                    <option value="3">Software</option>
                                                </select>
                                                <label>Select Category</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="stock" name="stock" type="text" class="validate"
                                                    value="{{ old('stock') }}">
                                                <label for="stock">Stock</label>
                                                @error('stock')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="input-field col s6">
                                                <input id="sell_price" name="sell_price" type="text" class="validate"
                                                    value="{{ old('sell_price') }}">
                                                <label for="sell_price">Sell Price</label>
                                                @error('city')
                                                <span class="red-text">{{ $message }}</span>
                                                @enderror
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

    <!--== BOTTOM FLOAT ICON ==-->


    @include('includes.js')
</body>

</html>