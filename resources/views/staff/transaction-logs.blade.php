<!DOCTYPE html>
<html lang="en">

<head>
    <title>Transaction Logs</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @include('partials.header')
</head>
<style>
   

</style>
<body>
    @include('partials.sidebar')

    <section class="content">
        <div class="container-fluid p-5">
            <h1>Transaction Logs</h1>
            <div class="col-md-4">
                <form method="get" action="{{ route('staff.transaction-logs') }}">
                    <input type="text" name="userSearch" class="form-control"
                        placeholder="Search User You Want to See Transaction Here" required>
                    <button class="btn btn-primary mt-3" type="submit">Search</button>
                </form>
            </div>
            <table class="custom-table table table-bordered mt-3 shadow-lg">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Action By</th>
                        <th scope="col">Transaction</th>
                        <th scope="col">Date Made</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $transaction->name }}</td>
                            <td>{{ $transaction->transaction_log }}</td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Transaction Logs Yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mx-3" style="margin-bottom: 5rem;">
            {!! $transactions->links('pagination::simple-bootstrap-5') !!}
        </div>
    </section>

    @if (Session::has('success'))
        <script>
            Swal.fire(
                'Deleted',
                "{{ Session::get('success') }}",
                'success'
            )
        </script>
    @endif

</body>

</html>
