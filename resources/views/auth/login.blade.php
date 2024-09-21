<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .login-background {
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
            max-width: 600px; /* Tăng chiều rộng tối đa của form */
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Hiệu ứng chuyển tiếp */
        }
        .form-container:hover {
            transform: translateY(-10px); /* Di chuyển lên một chút khi hover */
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3); /* Tăng độ bóng khi hover */
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
<section class="cs_hero cs_style_1 cs_center cs_ripple_activate cs_primary_bg ">
    <div class="login-background  ">
        <div class="overlay"></div>
        <div class="form-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="d-flex flex-row align-items-center justify-content-center mb-4">
                    <p class="lead fw-normal mb-0 me-3 text-dark">Sign in with</p>
                    <button type="button" class="btn btn-primary btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-floating mx-1">
                        <i class="fab fa-linkedin-in"></i>
                    </button>
                </div>

                <div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 text-dark">Login</p>
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

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control form-control-lg"
                        placeholder="Enter a valid email address" value="{{ old('email') }}" required autofocus />
                    <label class="form-label" for="email">Email address</label>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <input type="password" id="password" name="password" class="form-control form-control-lg"
                        placeholder="Enter password" required />
                    <label class="form-label" for="password">Password</label>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" />
                        <label class="form-check-label text-dark" for="remember">Remember me</label>
                    </div>
                    <a href="" class="text-body">Forgot password?</a>
                </div>

                <div class="text-center text-lg-start mt-4">
                    <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                    <p class="small fw-bold mt-2 pt-1 mb-0 text-dark">Don't have an account? <a href="">
                        class="link-danger">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
