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
                        <li class="active-bre"><a href="#">Finance</a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Finance Details</h4>
                                    <a href="{{ route('addfinancial') }}" class="btn btn-primary">Add New Expense</a>
                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                    <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Expense type</th>
                                                    <th>Amount</th>
                                                    <th>Paid By</th>
                                                    <th>expense_date</th>
                                                 
                                                    <th>Edit</th>
                                                    <th>View</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($expenses as $expense)
                                                <tr>
                                               
                                                <td>{{$expense->expense_type}}</td>
                                                <td>{{$expense->amount}}</td>
                                                <td>{{$expense->paid_by}}</td>
                                                <td>{{$expense->expense_date}}</td>
                                                    <td>
                                                    <a href="{{ route('financial.edit', $expense->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>
                                                    <a href="{{ route('financial.view', $expense->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td>
                                                     <a href="{{ route('financial.delete',$expense->id) }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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