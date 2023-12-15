<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bookings</title>
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
            <h1>Bookings</h1><br>
            <table class="table table-bordered mt-3 shadow-lg" style="background-color: #f8f9fa;">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Laundry Type</th>
                        <th scope="col">Booked Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->laundry_type == '170-180' ? '5 Kilos and Below' : '5 1/2 to 8 Kilos' }}</td>
                            <td>{{ $booking->booked_date }}</td>
                            @if ($booking->status == 0)
                                <td><span class="badge text-bg-secondary">PENDING</span></td>
                            @else
                                <td><span class="badge text-bg-success">APPROVED</span></td>
                            @endif
                            @if ($booking->status == 0)
                                <td>
                                    <form method="POST" action="{{ route('staff.bookings.destroy', $booking->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger col-9" onclick="return confirm('Are you sure you want to delete this booking?')">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                    <button type="button" id="editButton{{ $booking->id }}" class="btn btn-primary mt-1 col-9" data-toggle="modal" data-target="#editBookingModal{{ $booking->id }}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                </td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        <!-- Edit Booking Modal for each booking -->
                        <div class="modal fade" id="editBookingModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="editBookingModalLabel" aria-hidden="true">

                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post" action="{{ route('staff.bookings.update', $booking->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBookingModalLabel">Edit Booking</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Your form content here -->
                                            <label class="mt-2">Select Laundry Type:</label>
                                            <select name="laundry_type" id="laundry_type" class="form-control @error('laundry_type') is-invalid @enderror">
                                                <option value="">---Please Select a Laundry Type</option>
                                                <option value="170-180" @if ($booking->laundry_type == '170-180') selected @endif>5 Kilos and Below</option>
                                                <option value="170-200" @if ($booking->laundry_type == '170-200') selected @endif>5 1/2 to 8 Kilos</option>
                                            </select>
                                            @error('laundry_type')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label class="mt-2">Booking Date</label>
                                            <input type="datetime-local" name="booked_date" id="booked_date" value="{{ $booking->booked_date }}" class="form-select @error('booked_date') is-invalid @enderror" readonly>
                                            @error('booked_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                            <label class="mt-2">Booking Status</label>
                                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                                <option value="">---Please Select a Booking Status</option>
                                                <option value="0" @if ($booking->status == '0') selected @endif>Pending</option>
                                                <option value="1" @if ($booking->status == '1') selected @endif>Approved</option>
                                            </select>
                                            @error('status')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Script block for each booking -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('editButton{{ $booking->id }}').addEventListener('click', function() {
                                    // Manually trigger the modal by its ID
                                    var modal = new bootstrap.Modal(document.getElementById('editBookingModal{{ $booking->id }}'));
                                    modal.show();
                                });
                            });
                        </script>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Bookings Yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mx-3" style="margin-bottom: 5rem;">
            {!! $bookings->links('pagination::simple-bootstrap-5') !!}
        </div>
    </section>
</body>

</html>
