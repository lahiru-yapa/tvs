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
                                <div class="inn-title">

                                </div>

                                <div class="inn-title grid-container">
                                    <h4 class="mb-0">Warehouse Details</h4>
                                    <a href="{{ route('warehouses.create') }}" class="btn btn-primary">Add New Warehouse</a>
                                </div>
                                <style>
                                .grid-container {
                                    display: grid;
                                    grid-template-columns: auto max-content;
                                    /* Title takes available space, button adjusts */
                                    align-items: center;
                                    /* Vertically aligns elements */
                                    gap: 10px;
                                    /* Adds spacing between elements */
                                    padding: 10px;
                                    border: 1px solid #ddd;
                                    background-color: #f8f9fa;
                                    margin-bottom: 10px;
                                    /* Adds spacing between sections */
                                }
                                </style>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>name</th>
                                                    <th>address</th>
                                                    <th>Description</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($warehouses as $warehouse)
                                                <tr>
                                                    <td>{{ $warehouse->name }}
                                                    </td>
                                                    <td>{{ $warehouse->location }}
                                                    </td>
                                                    <td>{{ $warehouse->description }}</td>

                                                    <td>
                                                        <a href="{{ route('warehouses.edit', $warehouse->id) }}"><i
                                                                class="fa fa-pencil-square-o"
                                                                aria-hidden="true"></i></a>
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