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
                                    <h4>Product Details</h4>

                                    <!-- Dropdown Structure -->

                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>invoice number</th>
                                                    <th>shop name </th>
                                                    <th>total_amount</th>
                                                    <th>paid_amount</th>
                                                    <th>due_date</th>
                                                    <th>status</th>
                                                    <th>actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($invoices as $item)
                                                <tr>
                                                    <td>{{$item->invoice_number}}</td>
                                                    <td>{{$item->shop->name}}</td>
                                                    <td>{{$item->total_amount}}</td>
                                                    <td>{{$item->paid_amount}}</td>
                                                    <td>{{$item->due_date}}</td>

                                                    <td>{{$item->description}}</td>
                                                    <td>
                                                        <form method="POST" action="{{ route('invoices.stock.action') }}">
                                                            @csrf
                                                            <input type="hidden" name="invoice_id"
                                                                value="{{ $item->id }}">
                                                            <select name="action" onchange="this.form.submit()">
                                                                <option value="">Select Action</option>
                                                                <option value="view">View</option>
                                                                <option value="edit">Edit</option>
                                                                <option value="delete">Delete</option>
                                                            </select>
                                                        </form>
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- Pagination Links -->
                                        <div class="d-flex justify-content-center">
                                            {{ $invoices->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    nav a {
        color: #271f1f !important;
    }

    .flex.items-center.justify-between {
        color: #000000;
        background-color: #f9f9f9
    }
    </style>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const approvalToggles = document.querySelectorAll('.approvalToggle');

    approvalToggles.forEach(function (toggle) {
        toggle.addEventListener('change', function () {
            const invoiceId = this.getAttribute('data-invoice-id');
            const description = this.checked ? 'approved' : 'rejected';

            fetch('/update-invoice-description', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ id: invoiceId, description: description }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Invoice ${description} successfully!`);
                    } else {
                        alert('Failed to update invoice. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        });
    });
});

    </script>
    @include('includes.js')
</body>

</html>