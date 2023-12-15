<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage Laundries</title>
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
            <h1>Manage Laundries</h1><br>
            <table class="table table-bordered mt-3 shadow-lg" style="background-color: #f8f9fa;">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Laundry Name</th>
                        <th scope="col">Weight Laundry</th>
                        <th scope="col">Base Price Per Weight</th>
                        <th scope="col">Total Laundry Price</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laundries as $laundry)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $laundry->user->name }}</td>
                            <td>{{ $laundry->laundry_name }}</td>
                            <td>{{ number_format($laundry->weight_laundry, 1) }} kg</td>
                            <td>{{ number_format($laundry->base_price_per_weight, 2) }}</td>
                            <td>{{ number_format($laundry->total_laundry_price, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('staff.laundries.destroy', $laundry->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger col-14 btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this laundry?')"><i
                                            class="fa-solid fa-trash"></i> Delete</button>
                                </form>
                                <button type="button" class="btn btn-primary col-14 mt-1 btn-sm" data-toggle="modal"
                                    data-target="#editLaundryModal{{ $laundry->id }}">
                                    <i class="fa-solid fa-pencil"></i> Edit
                                </button>
                            </td>
                        </tr>
                        <!-- Edit Laundry Modal for each laundry -->
                        <div class="modal fade" id="editLaundryModal{{ $laundry->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="editLaundryModalLabel{{ $laundry->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post"
                                        action="{{ route('staff.laundries.update', $laundry->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="editLaundryModalLabel{{ $laundry->id }}">Edit Laundry Details</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Your form content here -->
                                            <label class="mt-2">Laundry Name</label>
                                            <input type="text" name="laundry_name" id="laundry_name"
                                                value="{{ $laundry->laundry_name }}" placeholder="Laundry Name"
                                                class="form-control @error('laundry_name') is-invalid @enderror">
                                            @error('laundry_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label class="mt-2">Weight of Laundry</label>
                                            <input type="text" name="weight_laundry" id="weight_laundry"
                                                value="{{ number_format($laundry->weight_laundry, 1, '.', '') }}"
                                                placeholder="Enter your weight of laundry here"
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
                                                value="{{ number_format($laundry->total_laundry_price, 2, '.', '') }}"
                                                placeholder="Total Laundry Price"
                                                class="form-control @error('total_laundry_price') is-invalid @enderror"
                                                readonly>
                                            @error('total_laundry_price')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Owned Laundries Yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
    <div class="d-flex justify-content-center mx-3" style="margin-bottom: 5rem;">
        {!! $laundries->links('pagination::simple-bootstrap-5') !!}
    </div>

    @if (Session::has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Updated Details',
                text: "{{ Session::get('success') }}",
                icon: 'success'
            }).then((result) => {
                if (result.isConfirmed || result.isDismissed) {
                    window.location.href = "{{ route('staff.laundries.index') }}";
                }
            });
        });
    </script>
@endif

    <script>
        $(document).ready(function () {
            // Attach a click event to the "Edit" button to show the modal
            $('[data-toggle="modal"]').click(function () {
                var targetModalId = $(this).data('target');
                $(targetModalId).modal('show');
            });
        });
    </script>
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

</body>

</html>
