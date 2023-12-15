<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Laundries</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('partials.header')
</head>

<body>
    @include('partials.navbar')

    <div class="container-fluid p-5">
        <h1 class="d-inline">My Laundries</h1>
        <button type="button" class="btn btn-success d-inline mb-3 float-end" data-bs-toggle="modal"
            data-bs-target="#addLaundryModal">Add Laundry</button>


        <div class="row mt-3">
            @forelse ($owned_laundries as $laundry)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-lg">
                        <div class="card-header table-primary d-flex justify-content-between align-items-center">
                            <h5 class="card-title fw-bold">{{ $laundry->laundry_name }}</h5>
                            <div class="d-flex">
                                <a href="{{ route('customer.laundries.edit', $laundry->id) }}"><i
                                        class="fa-solid fa-pencil me-2"></i></a>
                                <form method="POST" action="{{ route('customer.laundries.destroy', $laundry->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <i class="fa-solid fa-trash" style="color:red"
                                        onclick="return confirm('Are you sure you want to delete this laundry?')"></i>
                                </form>
                                <form method="POST" action="{{ route('customer.placeOrder', $laundry->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success ml-2">Place Laundry</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Owner: {{ auth()->user()->name }}</p>
                            <p class="card-text">Weight Laundry: {{ number_format($laundry->weight_laundry, 1) }} kg</p>
                            <p class="card-text">Base Price Per Weight:
                                {{ number_format($laundry->base_price_per_weight, 2) }}</p>
                            <p class="card-text fw-bold">Total Laundry Price:
                                {{ number_format($laundry->total_laundry_price, 2) }}</p>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-md-12 text-center">
                    <p>No Owned Laundries Yet</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="d-flex justify-content-center mx-3" style="margin-bottom: 5rem;">
        {!! $owned_laundries->links('pagination::simple-bootstrap-5') !!}
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

    <!-- Modal for Add Laundry -->
    <div class="modal fade" id="addLaundryModal" tabindex="-1" aria-labelledby="addLaundryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLaundryModalLabel">Add Laundry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your form for adding a laundry here -->
                    <form method="POST" action="{{ route('customer.laundries.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="mt-2">Laundry Name</label>
                            <input type="text" name="laundry_name" id="laundry_name"
                                value="{{ old('laundry_name') }}" placeholder="Laundry Name"
                                class="form-control @error('laundry_name') is-invalid @enderror">
                            @error('laundry_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mt-2">Weight of Laundry</label>
                            <input type="text" name="weight_laundry" id="weight_laundry"
                                value="{{ old('weight_laundry') }}" placeholder="Enter your weight of laundry here"
                                class="form-control @error('weight_laundry') is-invalid @enderror">
                            @error('weight_laundry')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mt-2">Base Price</label>
                            <input type="text" name="base_price" id="base_price"
                                value="{{ number_format(70, 2, '.', '') }}" placeholder="Base Price"
                                class="form-control @error('base_price') is-invalid @enderror" readonly>
                            @error('base_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="mt-2">Total Laundry Price</label>
                            <input type="text" name="total_laundry_price" id="total_laundry_price"
                                placeholder="Total Laundry Price"
                                class="form-control @error('total_laundry_price') is-invalid @enderror" readonly>
                            @error('total_laundry_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <!-- Add other form fields as needed -->

                        <div class="right">
                            <button type="submit" class="btn btn-primary">Add Laundry</button>
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
