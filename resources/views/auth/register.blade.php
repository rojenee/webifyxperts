<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
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
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center mt-2">
            <div class="col-md-12 mt-5">
                <div class="card shadow-lg">
                    <div class="row g-0">
                        <!-- Left side with the image -->
                        <div class="col-md-6 text-center mt-5">
                            <img src="uploads/register.png" alt="Logo" class="img-fluid">
                        </div>
                        <!-- Right side with the form -->
                        <div class="col-md-6">
                            <div class="card-header"><b>Register</b></div>
                            <form action="{{ route('auth.register') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Name -->
                                            <label for="name" class="mt-2">Name: </label>
                                            <input type="text" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                placeholder="Enter your name">
                                            @error('name')
                                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Email -->
                                            <label for="email" class="mt-2">Email: </label>
                                            <input type="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                placeholder="Enter your email">
                                            @error('email')
                                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Phone Number -->
                                            <label for="phone" class="mt-2">Phone Number: </label>
                                            <input type="text" value="{{ old('phone') }}"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                placeholder="Enter your phone number">
                                            @error('phone')
                                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Address -->
                                            <label for="address" class="mt-2">Address: </label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter your address"
                                                rows="2">{{ old('address') }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Password -->
                                            <label for="password" class="">Password: </label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" placeholder="Enter your password (min of 8 characters)">
                                            @error('password')
                                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Confirm Password -->
                                            <label for="confirm_password" class="mt-2">Confirm Password: </label>
                                            <input type="password"
                                                class="form-control @error('confirm_password') is-invalid @enderror"
                                                name="confirm_password" placeholder="Confirm Password">
                                            @error('confirm_password')
                                                <div class="invalid-feedback mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="card-footer mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                    <div class="register-link">
                                        <h6>Have already an account? <a href="login">Login </a>now </h6>
                                    </div>
                            </form>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Rest of your content... -->

</body>

</html>
