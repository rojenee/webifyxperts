<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Bookings</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('partials.header')
</head>

<body>
    @include('partials.navbar')

    <div class="container-fluid p-5">
        <h1 class="d-inline">My Bookings</h1>
        <a class="btn btn-success d-inline mb-3 float-end" href="{{ route('customer.bookings.create') }}">Add Laundry</a>

        <table class="table table-bordered mt-3">
            <thead>
                <!-- Table header columns -->
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $booking->user->name }}</td>
                        <!-- Other table row content -->
                        <td>
                            @if ($booking->status == 0)
                                <form method="POST" action="{{ route('customer.bookings.destroy', $booking->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this booking?')">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                    
                                </form>
                                <a class="btn btn-primary w-100 mt-3" href="{{ route('customer.bookings.edit', $booking->id) }}">
                                    <i class="fa-solid fa-pencil"></i> Edit
                                </a>
                            @else
                                <span class="badge text-bg-success">Booked Approved Already</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <!-- No bookings message -->
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mx-3" style="margin-bottom: 5rem;">
        {!! $bookings->links('pagination::simple-bootstrap-5') !!}
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
