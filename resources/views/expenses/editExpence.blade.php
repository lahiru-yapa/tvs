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
                        <li class="active-bre"><a href="#">Expence</a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Add New Expence </h4>
                                </div>
                                <div class="tab-inn">
                                    <form action="{{ route('financial.update', $expense->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT') 
                                        <div class="row">
                                        <div class="input-field col s6">
    <select name="expense_type">
        <option value="">Select Expense Type</option>
        <option value="Rent" {{ (old('expense_type', $expense->expense_type ?? '') == 'Rent') ? 'selected' : '' }}>Rent</option>
        <option value="Employee Salary" {{ (old('expense_type', $expense->expense_type ?? '') == 'Employee Salary') ? 'selected' : '' }}>Employee Salary</option>
        <option value="Utility Bill" {{ (old('expense_type', $expense->expense_type ?? '') == 'Utility Bill') ? 'selected' : '' }}>Utility Bill</option>
        <option value="Supplier Payment" {{ (old('expense_type', $expense->expense_type ?? '') == 'Supplier Payment') ? 'selected' : '' }}>Supplier Payment</option>
        <option value="Miscellaneous" {{ (old('expense_type', $expense->expense_type ?? '') == 'Miscellaneous') ? 'selected' : '' }}>Miscellaneous</option>
    </select>
    <label>Expense Type</label>
</div>


                                            <div class="input-field col s6">
                                                <label for="amount" class="form-label">Amount</label>
                                                <input type="number" value="{{ old('expense', $expense->amount ?? '') }}" name="amount" class="form-control" step="0.01"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="date" name="expense_date" value="{{ old('expense', $expense->expense_date ?? '') }}" class="form-control" required>

                                            </div>


                                            <div class="input-field col s6">
                                            <input type="text" value="{{ $expense->user->name ?? '' }}" class="form-control" readonly>
<input type="hidden" name="category" value="{{ $expense->user->id ?? '' }}">

                                              
                                                <label>Paid By</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" class="form-control">{{ old('expense', $expense->description ?? '') }}</textarea>

                                            </div>

                                            <div class="input-field col s6">
                                                <label for="paid_for" class="form-label">Paid For Whom</label>
                                                <input type="text" name="paid_by" class="form-control"
                                                    placeholder="e.g., Supplier, Employee" value="{{ old('expense', $expense->paid_by ?? '') }}">
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