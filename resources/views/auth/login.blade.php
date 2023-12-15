<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('partials.header')
</head>
<style>
        .card-footer {
        text-align: right;
    }
</style>
<body>
    {{-- @include('partials.navbar') --}}
    <div class="home" style="margin-left:40px">
        <h6 class=""><br><br><a href="homepage">Back to Homepage</a></h6>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center" style="min-height: 100vh;">
            <div class="col-md-9">
                <div class="card shadow-lg">
                    <div class="card-header text-center"><b>Login</b></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <!-- Image left side -->
                                <img src="uploads/login.png" alt="Logo" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <!-- Form right side   -->
                                <form action="{{ route('auth.login') }}" method="post" class="mt-3">
                                    @csrf
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('error') }}
                                        </div>
                                    @endif

                                    <label for="email">Email:</label>
                                    <input type="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        placeholder="Enter your email">
                                    @error('email')
                                        <div class="invalid-feedback mt-2">{{ $message }}</div>
                                    @enderror
                                    <label for="password" class="mt-2">Password:</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" placeholder="Enter your password (min of 8 characters)">
                                    @error('password')
                                        <div class="invalid-feedback mt-2">{{ $message }}</div>
                                    @enderror

                                    <div class="card-footer mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                    <br>
                                    <div class="register-link">
                                        <h6>Don't have an existing account? <a href="register">Register </a>now </h6>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('partials.footer') --}}
</body>

</html>
