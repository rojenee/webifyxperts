<!DOCTYPE html>
<html lang="en">

<head>
    <title>Staff - Profile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    @include('partials.header')
</head>

<body>
    @include('partials.sidebar')
    <br><br>

    <section class="content">
       
        <div class="container">
            <div class="container-xl px-4 ">
                 <h1>My Profile</h1><br><br>
                <form action="{{ route('staff.update-profile') }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="blue-strip"></div> <!-- Blue color strip -->
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    @if (auth()->user()->image == null)
                                        <img class="img-account-profile rounded-circle mb-2"
                                            src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                    @else
                                        <img class="img-account-profile rounded-circle mb-2"
                                            src="{{ asset('uploads') }}/{{ auth()->user()->image }}" alt="">
                                    @endif
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                    <!-- Profile picture upload button-->
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" id="image" accept="image/png, image/jpeg">
                                    @error('image')
                                        <div class="invalid-feedback mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="blue-strip"></div> <!-- Blue color strip -->
                                <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('error') }}
                                        </div>
                                    @endif

                                    @if (session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif

                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (first name)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">Full Name</label>
                                            <input class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="name" type="text"
                                                placeholder="Enter your first name" value="{{ auth()->user()->name }}">
                                            @error('name')
                                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Form Group (last name)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputLastName">Email</label>
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" type="email"
                                                placeholder="Enter your email" value="{{ auth()->user()->email }}">
                                            @error('email')
                                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Form Group (Old and New Password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="Old Password">Old Password</label>
                                        <input class="form-control @error('old_password') is-invalid @enderror"
                                            name="old_password" id="old_password" type="password"
                                            placeholder="Enter your old password">
                                        @error('old_password')
                                            <div class="invalid-feedback mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="New Password">New Password</label>
                                        <input class="form-control @error('new_password') is-invalid @enderror"
                                            name="new_password" id="new_password" type="password"
                                            placeholder="Enter your new password">
                                        @error('new_password')
                                            <div class="invalid-feedback mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Save changes button-->
                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <style>
        .blue-strip {
            height: 5px;
            background-color: rgb(5, 131, 210);
            margin-bottom: 10px;
        }
    </style>

</body>

</html>
