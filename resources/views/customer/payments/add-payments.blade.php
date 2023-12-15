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
                    <form method="post" action="{{ route('customer.storePayment') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h1>Place your Payment</h1>
                        </div>
                        <div class="card-body">
                            <label class="mt-2">Select Your Laundry To Pay:</label>
                            <select name="laundry" id="laundry"
                                class="form-control @error('laundry') is-invalid @enderror">
                                <option value="">---Please Select Your Laundry To Pay</option>
                                @foreach ($laundries as $laundry)
                                    <option value="{{ $laundry->id }}">{{ $laundry->laundry_name }} -
                                        {{ number_format($laundry->total_laundry_price, 2) }}</option>
                                @endforeach
                            </select>
                            @error('laundry')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <label class="mt-2">Proof of Payment</label>
                            <input type="file" name="screenshot" id="screenshot"
                                class="form-control @error('screenshot') is-invalid @enderror">
                            @error('screenshot')
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
                location.href = "{{ route('customer.viewPayment') }}";
            })
        </script>
    @endif

    @include('partials.footer')
</body>

</html>
