<!doctype html>
<html lang="en">

<head>
    <title>Place Laundries</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('partials.header')
</head>

<body>
    @include('partials.navbar')

    <div class="container-fluid p-5">
        <h1 class="d-inline">My Orders</h1>

        <table class="table table-bordered mt-3">
            <thead>
                <tr class="table-primary">
                    <th scope="col">Owner</th>
                    <th scope="col">Laundry Name</th>
                    <th scope="col">Total Laundry Price</th>
                    <th scope="col">Place Date</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    @forelse ($order->laundries as $laundry)
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $laundry->laundry_name }}</td>
                            <td>{{ number_format($laundry->total_laundry_price, 2) }}</td>
                            <td>{{ $order->created_at }}</td>
                            @if ($order->status == $status::PENDING)
                                <td><span class="badge text-bg-secondary">PENDING</span></td>
                            @elseif($order->status == $status::ONGOING)
                                <td><span class="badge text-bg-warning">ONGOING</span></td>
                            @elseif($order->status == $status::FINISHED)
                                <td><span class="badge text-bg-success">FINISHED</span></td>
                            @elseif($order->status == $status::CANCELLED)
                                <td><span class="badge text-bg-danger">CANCELLED</span></td>
                            @else
                                <td><span class="badge text-bg-danger">INVALID STATUS</span></td>
                            @endif

                            <td>
                                @if ($order->status == $status::PENDING)
                                    <form method="POST" action="{{ route('customer.updateOrder', $order->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="3">
                                        <button type="submit" class="btn btn-danger w-100">Cancel</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Orders Yet</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mx-3" style="margin-bottom: 5rem;">
        {!! $orders->links('pagination::simple-bootstrap-5') !!}
    </div>

    @if (Session::has('success'))
        <script>
            Swal.fire(
                'Success',
                "{{ Session::get('success') }}",
                'success'
            )
        </script>
    @endif

    @include('partials.footer')
</body>

</html>
