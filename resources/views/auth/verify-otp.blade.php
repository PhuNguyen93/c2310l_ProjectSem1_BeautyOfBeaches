@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header text-center">
                <h2 class="mb-0">Verify OTP</h2>
            </div>
            <div class="card-body">
                @if ($errors->has('otp'))
                    <div class="alert alert-danger">
                        {{ $errors->first('otp') }}
                    </div>
                @endif

                <form action="{{ route('verify.otp') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="otp">Enter OTP:</label>
                        <input type="text" class="form-control" id="otp" name="otp" required placeholder="Enter your 4-digit OTP" maxlength="4" style="border: 2px solid #007bff; border-radius: 5px; padding: 10px; font-size: 16px; transition: border-color 0.3s;">                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg" id="verify-btn">Verify OTP</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #f0f2f5; /* Màu nền nhẹ nhàng */
        }

        .card {
            border-radius: 10px; /* Bo góc cho card */
            border: none; /* Bỏ viền cho card */
            margin: 20px; /* Thêm khoảng cách cho card */
        }

        .card-header {
            background-color: #007bff; /* Màu nền cho header */
            color: white; /* Màu chữ */
            border-top-left-radius: 10px; /* Bo góc cho góc trên bên trái */
            border-top-right-radius: 10px; /* Bo góc cho góc trên bên phải */
        }

        .btn-primary {
            background-color: #007bff; /* Màu nền cho nút */
            border-color: #007bff; /* Màu viền cho nút */
            transition: background-color 0.3s, transform 0.3s; /* Hiệu ứng chuyển động cho nút */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Thay đổi màu khi hover */
            transform: scale(1.05); /* Phóng to nút khi hover */
        }

        .form-control:focus {
            border-color: #060606; /* Thay đổi màu viền khi focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Thêm bóng khi focus */
        }

        .alert {
            border-radius: 5px; /* Bo góc cho alert */
        }
    </style>

    <script>
        document.getElementById('verify-btn').addEventListener('click', function() {
            // Hiệu ứng khi nhấn nút
            this.innerHTML = 'Verifying...'; // Thay đổi nội dung nút
            // this.disabled = true; // Vô hiệu hóa nút để ngăn nhấn nhiều lần
        });
    </script>
@endsection
