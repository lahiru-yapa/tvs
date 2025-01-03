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
                        <li class="active-bre"><a href="#">Supplier</a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Add New Suppliers </h4>
                                 </div>
                                <div class="tab-inn">
                                <form action="{{ route('suppliers.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="input-field col s6">
            <input id="first_name" name="first_name" type="text" class="validate" value="{{ old('first_name') }}">
            <label for="first_name">Suppliers Name</label>
            @error('first_name')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-field col s6">
            <input id="phone" name="phone" type="number" class="validate" value="{{ old('phone') }}">
            <label for="phone">Mobile</label>
            @error('phone')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <input id="city" name="city" type="text" class="validate" value="{{ old('city') }}">
            <label for="city">Address</label>
            @error('city')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-field col s6">
            <input id="city" name="credit_limit" type="text" class="validate" value="{{ old('credit_limit') }}">
            <label for="credit_limit">Credit Limit</label>
            @error('city')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <input id="credit" name="contact_person" type="text" class="validate" value="{{ old('contact_person') }}">
            <label for="credit">Contact person</label>
            @error('credit_limit')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-field col s6">
            <input id="note" name="note" type="text" class="validate" value="{{ old('note') }}">
            <label for="note">Note</label>
            @error('note')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <button type="submit" class="waves-effect waves-light btn-large">Submit</button>
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