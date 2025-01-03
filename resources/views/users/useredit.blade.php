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
                                <form action="{{ route('user.editStore') }}" method="POST">
                                @csrf

                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input name="first_name" type="text" class="validate" value="{{$user->name}}">
                                                <label for="first_name">First Name</label>
                                            </div>
                                         
                                            <div class="input-field col s6">
                                                <input name="role" type="text" class="validate" value="{{$user->role}}">
                                                <label for="role">role</label>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input name="phone" type="number" class="validate" value="{{$user->phone}}">
                                                <label for="phone">Mobile</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input name="email" type="email" class="validate" value="{{$user->email}}">
                                                <label for="email">email</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input name="city" type="text" class="validate" value="{{$user->address}}">
                                                <label for="city">address </label>
                                            </div>
                                        
                                            
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input name="password" type="password" class="validate">
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input name="password1" type="password" class="validate">
                                                <label for="password1">Confirm Password</label>
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