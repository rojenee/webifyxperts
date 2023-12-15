<!doctype html>
<html lang="en">

<head>
    <title>Create a Booking</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('partials.header')
</head>

<body>
    @include('partials.navbar')

    <div class="container" style="margin-bottom: 5rem;">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <form method="post" action="{{ route('customer.bookings.store') }}">
                        @csrf
                        <div class="card-header">
                            <h1>Place your Booking</h1>
                        </div>
                        <div class="card-body">
                            <label class="mt-2">Select Laundry Type:</label>
                            <select name="laundry_type" id="laundry_type"
                                class="form-control @error('laundry_type') is-invalid @enderror">
                                <option value="">---Please Select a Laundry Type</option>
                                <option value="170-180">5 Kilos and Below</option>
                                <option value="170-200">5 1/2 to 8 Kilos</option>
                            </select>
                            @error('laundry_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <label class="mt-2">Booking Date</label>
                            <input type="datetime-local" name="booked_date" id="booked_date"
                                class="form-select @error('booked_date') is-invalid @enderror">
                            @error('booked_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Place</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('success'))
        <script>
            Swal.fire(
                'Booked Placed',
                "{{ Session::get('success') }}",
                'success'
            ).then(() => {
                location.href = "{{ route('customer.bookings.index') }}";
            })
        </script>
    @endif

    @include('partials.footer')
</body>

</html>
