<!doctype html>
<html lang="en">

<head>
    <title>Sales Report</title>
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
            <h1>Sales Report</h1>
            <div class="col-md-4">
                <form method="get" action="{{ route('staff.report-view') }}">
                    <input type="text" name="userSearch" class="form-control" placeholder="Search Customer Name" required>
                    <button class="btn btn-primary mt-3" type="submit">Search</button>
                    <button onclick="exportReportToExcel(this)" class="btn btn-success mt-3">Download
                        Excel</button>
                </form>
            </div>
            <table class="table table-bordered mt-3 shadow-m" style="background-color: white">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Customer</th>
                        <th scope="col">Laundry Name</th>
                        <th scope="col">Weight of Laundry</th>
                        <th scope="col">Total Laundry Price</th>
                        <th scope="col">Date Made</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                        @foreach ($report->orders as $order)
                            <tr>
                                <th scope="row">{{ $report->user->name }}</th>
                                <td>{{ $report->laundry_name }}</td>
                                <td>{{ number_format($report->weight_laundry, 1) }} KG</td>
                                <td>{{ number_format($report->total_laundry_price, 2) }}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Reports Yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mx-3" style="margin-bottom: 5rem;">
                {!! $reports->links('pagination::simple-bootstrap-5') !!}
            </div>
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

    <script>
        function exportReportToExcel() {
            let table = document.getElementsByTagName(
                "table"); 
            TableToExcel.convert(table[
                0], { 
                name: `salesReport-${new Date(Date.now()).toLocaleString().split(',')[0]}.xlsx`, 
                sheet: {
                    name: 'Sheet 1'
                }
            });
        }
    </script>

</body>

</html>
