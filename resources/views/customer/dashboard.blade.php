<!doctype html>
<html lang="en">

<head>
    <title>Customer - Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('partials.header')
</head>

<body>
    @include('partials.navbar')


    <div class="container-fluid p-5">
        <h1>My Dashboard</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    My Total Laundry</div>
                                <div class="h5 mb-0 font-weight-bold text-seondary">{{ $totalLaundryCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-jug-detergent fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-text-dark text-uppercase mb-1">
                                    Pending Laundry ({{ date('m-d-Y') }})</div>
                                <div class="h5 mb-0 font-weight-bold text-secondary">{{ $totalPendingLaundry }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-pause fa-2x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Success Laundry ({{ date('m-d-Y') }})</div>
                                <div class="h5 mb-0 font-weight-bold text-secondary">{{ $totalFinishedLaundry }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
</body>

</html>
