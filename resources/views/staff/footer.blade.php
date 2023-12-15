<!DOCTYPE html>
<html lang="en">

<head>
    <title>Staff - Footer</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @include('partials.header')
</head>

<body>
    @include('partials.sidebar')
    
 
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="card w-50 p-4 "> 
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
              
         <h1>Shop Information</h1>
            <form action="{{ route('footer.update') }}" method="post">
                @csrf
                @method('put')

                <div class="form-group mb-3"> 
                    <label for="inputFirstName">Shop Name</label>
                    <input class="form-control" name="name" type="text" placeholder="Enter shop name"
                        value="{{ $info->name ?? '' }}">
                </div>

                <div class="form-group mb-3"> 
                    <label for="inputLocation">Location</label>
                    <input class="form-control" name="location" type="text" placeholder="Enter location"
                        value="{{ $info->location ?? '' }}">
                </div>

                <div class="form-group mb-3"> 
                    <label for="inputContactNumber">Contact Number</label>
                    <input class="form-control" name="contact_number" type="number"
                        placeholder="Enter contact number" value="{{ $info->contact_number ?? '' }}">
                </div>

                <div class="form-group mb-3"> 
                    <label for="inputFacebook">Facebook Page</label>
                    <input class="form-control" name="facebook" type="text" placeholder="Enter Facebook page"
                        value="{{ $info->facebook ?? '' }}">
                </div>

                <button class="btn btn-primary mt-4" name="update" type="submit">Save changes</button>
            </form>
        </div>
    </div>

</body>

</html>
