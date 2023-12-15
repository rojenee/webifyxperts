<!doctype html>
<html lang="en">

<head>
    <title>Create a Laundry</title>
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
                    <form method="post" action="{{ route('customer.laundries.store') }}">
                        @csrf
                        <div class="card-header">
                            <h1>Place your Laundry</h1>
                        </div>
                        <div class="card-body">
                            <label class="mt-2">Laundry Name</label>
                            <input type="text" name="laundry_name" id="laundry_name"
                                value="{{ old('laundry_name') }}" placeholder="Laundry Name"
                                class="form-control @error('laundry_name') is-invalid @enderror">
                            @error('laundry_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <label class="mt-2">Weight of Laundry</label>
                            <input type="text" name="weight_laundry" id="weight_laundry"
                                value="{{ old('weight_laundry') }}" placeholder="Enter your weight of laundry here"
                                class="form-control @error('weight_laundry') is-invalid @enderror">
                            @error('weight_laundry')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <label class="mt-2">Base Price</label>
                            <input type="text" name="base_price" id="base_price"
                                value="{{ number_format(70, 2, '.', '') }}" placeholder="Base Price"
                                class="form-control @error('base_price') is-invalid @enderror" readonly>
                            @error('base_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <label class="mt-2">Total Laundry Price</label>
                            <input type="text" name="total_laundry_price" id="total_laundry_price"
                                placeholder="Total Laundry Price"
                                class="form-control @error('total_laundry_price') is-invalid @enderror" readonly>
                            @error('total_laundry_price')
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
                'Place Laundry',
                "{{ Session::get('success') }}",
                'success'
            ).then(() => {
                location.href = "{{ route('customer.laundries.index') }}";
            })
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#weight_laundry').keyup(function(e) {
                let weight_laundry = $(this).val();
                let base_price = $('#base_price').val();
                if ($('#weight_laundry').val().length > 0) {
                    let total = weight_laundry * base_price;
                    $('#total_laundry_price').val(total.toFixed(2));
                } else {
                    total = 0
                    $('#total_laundry_price').val(total.toFixed(2));
                }
            });
        });
    </script>

    @include('partials.footer')
</body>

</html>
