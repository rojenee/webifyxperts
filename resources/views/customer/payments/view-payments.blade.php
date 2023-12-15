<!doctype html>
<html lang="en">

<head>
    <title>My Payments</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('partials.header')
    <style>
        .cover {
            object-fit: cover;
            width: 100%;
            /*height: 300px;  optional, you can remove it, but in my case it was good */
        }
    </style>
</head>

<body>
    @include('partials.navbar')

    <div class="container-fluid p-5">
        <h1 class="d-inline">My Payments</h1>
        <a class="btn btn-success d-inline mb-3 float-end" href="{{ route('customer.createPayment') }}">Pay Here</a>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Laundry</th>
                    <th scope="col">Proof of Payment</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $payment->user->name }}</td>
                        <td>{{ $payment->laundry->laundry_name }}</td>
                        <td><img class="cover" src="{{ asset('payments') }}/{{ $payment->screenshot }}" height="300"
                                width="300">
                        </td>
                        <td>{{ number_format($payment->laundry->total_laundry_price, 2) }}</td>
                        @if ($payment->status == 0)
                            <td><span class="badge text-bg-secondary">PENDING</span></td>
                        @else
                            <td><span class="badge text-bg-success">APPROVED</span></td>
                        @endif
                        <td>
                            @if ($payment->status == 0)
                                <form method="POST" action="{{ route('customer.destroyPayment', $payment->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger w-100"><i class="fa-solid fa-trash" onclick="return confirm('Are you sure you want to delete this payment?')"></i>
                                        Delete</button>
                                </form>
                            @elseif($payment->status == 1)
                                <span class="badge text-bg-success">Payment Already Settled</span>
                            @else
                                <span class="badge text-bg-danger">Invalid Payment</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Payments Yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mx-3" style="margin-bottom: 5rem;">
        {!! $payments->links('pagination::simple-bootstrap-5') !!}
    </div>

    @if (Session::has('success'))
        <script>
            Swal.fire(
                'Deleted',
                "{{ Session::get('success') }}",
                'success'
            )
        </script>
    @endif

    @include('partials.footer')
</body>

</html>
