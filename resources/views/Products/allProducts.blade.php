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
    <h4 class="mb-0">Product Details</h4>
    <a href="{{ route('addproduct') }}" class="btn btn-primary">Add New Product</a>
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
}

</style>


                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Sku</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                    <th>Sell price</th>
                                                    <th>Category</th>
                                                    <th>Edit</th>
                                                    <th>View</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $product)
                                                <tr>
                                               
                                                <td>{{$product->name}}</td>
                                                    <td>{{$product->sku}}</td>
                                                    <td>{{$product->description}}</td>
                                                    <td>{{$product->price}}</td>
                                                    <td>{{$product->sell_price}}</td>
                                                    <td>{{$product->category}}</td>
                                                    <td>
                                                    <a href="{{ route('product.edit', $product->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>
                                                    <a href="{{ route('product.view', $product->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>
                                                     <a href="{{ route('product.delete',$product->id) }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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