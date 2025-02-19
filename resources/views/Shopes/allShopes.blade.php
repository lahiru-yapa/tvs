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
                <!-- //side bar -->
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
                                <div class="inn-title grid-container">
                                <h4>User Details</h4>
    <a href="{{ route('addshopes') }}" class="btn btn-primary">Add New Shop</a>
</div>

<style>
    .grid-container {
    display: grid;
    grid-template-columns: auto max-content; /* Title takes available space, button adjusts */
    align-items: center; /* Vertically aligns elements */
    gap: 10px; /* Adds spacing between elements */
    padding: 10px;
    border: 1px solid #ddd;
    background-color: #f8f9fa;
    margin-bottom: 10px; /* Adds spacing between sections */
}

</style>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                    <th>Note</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($shops as $shop)
                                                <tr>
                                                   
                                                <td>{{$shop->name}}</td>
                                                    <td>{{$shop->phone}}</td>
                                                    <td>{{$shop->address}}</td>
                                                    <td>{{$shop->note}}</td>
                                                    <td>
                                                    <a href="{{ route('shops.edit', $shop->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>
                                                     <a href="{{ route('shop.delete',$shop->id) }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                               @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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