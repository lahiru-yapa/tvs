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
                                    <h4>Add New User</h4>
                                    <p>Stock Main Where Houses The Right Way To Start A Short Break Holiday</p>
                                </div>
                                <div class="tab-inn">
                                <form action="{{ route('user.store') }}" method="POST">
                                @csrf
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input name="first_name" type="text" class="validate">
                                                <label for="first_name">First Name</label>
                                            </div>
                                         
                                            <div class="input-field col s6">
                                                <input name="role" type="text" class="validate">
                                                <label for="role">role</label>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input name="phone" type="number" class="validate">
                                                <label for="phone">Mobile</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input name="email" type="email" class="validate">
                                                <label for="email">email</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input name="city" type="text" class="validate">
                                                <label for="city">address </label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input name="credit_limit" type="text" class="validate">
                                                <label for="city">credit_limit </label>
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

    <!--== BOTTOM FLOAT ICON ==-->
    <section>
        <div class="fixed-action-btn vertical">
            <a class="btn-floating btn-large red pulse">
                <i class="large material-icons">mode_edit</i>
            </a>
            <ul>
                <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a>
                </li>
                <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a>
                </li>
                <li><a class="btn-floating green"><i class="material-icons">publish</i></a>
                </li>
                <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a>
                </li>
            </ul>
        </div>
    </section>

    @include('includes.js')
</body>

</html>