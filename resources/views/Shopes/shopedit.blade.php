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
                                    <h4>Edit User Details</h4>
                                    <p>Stock Main Where Houses The Right Way To Start A Short Break Holiday</p>
                                </div>
                                <div class="tab-inn">
                                <form action="{{ route('shop.editStore') }}" method="POST">
    @csrf
    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
    <div class="row">
        <div class="input-field col s6">
            <input id="first_name" name="first_name" type="text" class="validate" value="{{ $shop->name }}">
            <label for="first_name">Shop Name</label>
            @error('first_name')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-field col s6">
            <input id="phone" name="phone" type="number" class="validate" value="{{ $shop->phone }}">
            <label for="phone">Mobile</label>
            @error('phone')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input id="city" name="city" type="text" class="validate" value="{{ $shop->address }}">
            <label for="city">Address</label>
            @error('city')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <input id="credit" name="credit_limit" type="text" class="validate" value="{{ $shop->credit_limit }}">
            <label for="credit">Credit Limit</label>
            @error('credit_limit')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-field col s6">
            <input id="note" name="note" type="text" class="validate" value="{{$shop->note}}">
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

    @include('includes.js')
</body>

</html>