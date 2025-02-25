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

                                <div class="inn-title flex-container">
                                    <h4 class="mb-0">GRN Details</h4>
                                    <a href="{{ route('grns.create') }}" class="btn btn-success">Add New GRN</a>
<a href="{{ route('export_admin') }}" class="btn btn-primary">Export to Excel</a>

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
                                .btn.btn-success{
                                    background-color:green;
                                }
                                </style>

                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table>
                                            <tr>
                                                <th>GRN Number</th>
                                                <th>Warehouse</th>
                                                <th>Supplier</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                            @foreach ($grns as $grn)
                                            <tr>
                                           
                                                <td>{{ $grn->grn_number }}</td>
                                                <td>{{ $grn->warehouse->name }}</td>
                                                <td>{{ $grn->supplier->name }}</td>
                                                <td>{{ $grn->received_date }}</td>
                                                <td>
                                                    <a href="{{ route('grns.edit', $grn->id) }}"><i
                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('grns.show',$grn->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                                <td>
    <!-- Delete (Trash) Icon -->
    <form action="{{ route('grns.destroy', $grn->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?');" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" style="border: none; background: none; cursor: pointer; color: red; font-size: 18px;">
    <i class="fa fa-trash" aria-hidden="true"></i>
</button>

    </form>
</td>

                                            </tr>
                                            @endforeach
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