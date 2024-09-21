<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .register-background {
            background-image: url('https://image.kkday.com/v2/image/get/h_650%2Cc_fit/s1.kkday.com/product_115174/20210111040009_p0lTl/jpg');
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-position: center;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .form-container {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
            z-index: 2;
            width: 100%;
            max-width: 600px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .form-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        .btn-primary {
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="register-background">
    <div class="overlay"></div>
    <div class="form-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0 text-dark">Register</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Name input -->
            <div class="form-outline mb-4">
                <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Enter your name" value="{{ old('name') }}" required autofocus />
                <label class="form-label" for="name">Full Name</label>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter a valid email address" value="{{ old('email') }}" required />
                <label class="form-label" for="email">Email address</label>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-outline mb-4">
                <input type="phone" id="phone" name="phone" class="form-control form-control-lg" placeholder="Enter a valid phone number" value="{{ old('phone') }}" required />
                <label class="form-label" for="phone">Phone number</label>
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter password" required />
                <label class="form-label" for="password">Password</label>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" placeholder="Confirm password" required />
                <label class="form-label" for="password_confirmation">Confirm Password</label>
            </div>

            <!-- Driver License Number input -->
            <div class="form-outline mb-4">
                <input type="text" id="driver_license_number" name="driver_license_number" class="form-control form-control-lg" placeholder="Enter driver license number" value="{{ old('driver_license_number') }}" />
                <label class="form-label" for="driver_license_number">Driver License Number</label>
                @error('driver_license_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center text-lg-start mt-4">
                <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                <p class="small fw-bold mt-2 pt-1 mb-0 text-dark">Already have an account? <a href="{{ route('login') }}" class="link-danger">Login</a></p>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
