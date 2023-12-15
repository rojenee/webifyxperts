<!doctype html>
<html lang="en">

<head>
    <title>My Transaction Logs</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('partials.header')
</head>

<body>
    @include('partials.navbar')

    <div class="container-fluid p-5">
        <h1>My Transaction Logs</h1>
        <table class="table table-bordered mt-3">
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
