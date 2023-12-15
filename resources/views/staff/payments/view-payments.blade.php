<!doctype html>
<html lang="en">

<head>
    <title>Payments</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @include('partials.header')
    <style>
        .cover {
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>

<body>
    @include('partials.sidebar')

  <section class="content">
    <div class="container-fluid p-5">
        <h1 class="d-inline">Payments</h1>

        <table class="table table-bordered mt-3 shadow-lg" style="background-color: white;">
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
                        <td><img class="cover" src="{{ asset('payments') }}/{{ $payment->screenshot }}" height="200"
                                width="200">
                        </td>
                        <td>{{ number_format($payment->laundry->total_laundry_price, 2) }}</td>
                        @if ($payment->status == 0)
                            <td><span class="badge text-bg-secondary">PENDING</span></td>
                        @else
                            <td><span class="badge text-bg-success">APPROVED</span></td>
                        @endif
                        <td>
                            @if ($payment->status == 0)
                                <form method="POST" action="{{ route('staff.updatePaymentStatus', $payment->id) }}">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" value="1" name="status" id="status">
                                    <button class="btn btn-success w-100">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('staff.destroyPayment', $payment->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger w-100 mt-2"><i class="fa-solid fa-trash" onclick="return confirm('Are you sure you want to delete this payment?')"></i>
                                        Delete</button>
                                </form>
                            @elseif($payment->status == 1)
                                <form method="POST" action="{{ route('staff.updatePaymentStatus', $payment->id) }}">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" value="0" name="status" id="status">
                                    <button class="btn btn-secondary w-100" readonly>Approved</button>
                                </form>
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
  </section>

    @if (Session::has('success'))
        <script>
            Swal.fire(
                'Success',
                "{{ Session::get('success') }}",
                'success'
            )
        </script>
    @endif


</body>

</html>
