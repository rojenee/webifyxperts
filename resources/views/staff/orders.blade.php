<!doctype html>
<html lang="en">

<head>
    <title>Laundries Placed</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @include('partials.header')
</head>

<body>
    @include('partials.sidebar')

   <section class="content">
    <div class="container-fluid p-5">
        <h1 class="d-inline">All Placed Laundries</h1>

        <table class="table table-bordered mt-3 shadow-lf" style="background-color: #f2f2f2;">
            <thead>
                <tr class="table-primary">
                    <th scope="col">Owner</th>
                    <th scope="col">Laundry Name</th>
                    <th scope="col">Total Laundry Price</th>
                    <th scope="col">Place Date</th>
                    <th>Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    @foreach ($order->laundries as $laundry)
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
                                    <form method="POST" action="{{ route('staff.updateOrder', $order->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="status" value="3">
                                        <button type="submit" class="btn btn-danger w-100">Cancel</button>
                                    </form>
                                    <form method="POST" action="{{ route('staff.updateOrder', $order->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-warning w-100 mt-2">In Progress</button>
                                    </form>
                                @elseif($order->status == $status::ONGOING)
                                    <form method="POST" action="{{ route('staff.updateOrder', $order->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="status" value="0">
                                        <button type="submit" class="btn btn-secondary w-100">Pending</button>
                                    </form>
                                    <form method="POST" action="{{ route('staff.updateOrder', $order->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn btn-success w-100 mt-2">Finish</button>
                                    </form>
                                @elseif($order->status == $status::FINISHED)
                                    <span class="text text-success fw-bold">Laundry is already delivered</span>
                                @elseif($order->status == $status::CANCELLED)
                                    <span class="text text-danger fw-bold">Laundry already cancelled</span>
                                @else
                                    <span class="text text-danger fw-bold">Laundry status invalid</span>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Orders Yet</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mx-3" style="margin-bottom: 5rem;">
        {!! $orders->links('pagination::simple-bootstrap-5') !!}
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
