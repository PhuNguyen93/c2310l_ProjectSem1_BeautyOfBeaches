@extends('layouts.master')

@section('content')
<body
class="flex items-center justify-center min-h-screen px-4 py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark dark:text-zink-100 font-public">

<div class="mb-0 border-none shadow-none xl:w-2/3 card bg-white/70 dark:bg-zink-500/70">
    <div class="grid grid-cols-1 gap-0 lg:grid-cols-12">
        <div class="lg:col-span-5">
            <div class="!px-12 !py-12 card-body h-full flex flex-col">

                <div class="my-auto">
                    <div class="text-center">
                        <h4 class="mb-2 text-custom-500 dark:text-custom-500">Verify Email</h4>
                        <p class="mb-8 text-slate-500 dark:text-zink-200">Please enter the <b
                                class="font-medium">4</b> digit code sent to <b
                                class="font-medium">{{ session('email') }}</b></p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->has('otp'))
                        <div class="alert alert-danger">
                            {{ $errors->first('otp') }}
                        </div>
                    @endif

                    <form autocomplete="off" action="{{ route('verify.otp') }}" method="POST" id="otpForm">
                        @csrf
                        <input type="hidden" name="otp" id="otp" value="">

                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-4">
                            <div>
                                <label for="digit1-input" class="hidden">Digit 1</label>
                                <input type="text"
                                    class="text-lg text-center form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                    required placeholder="0" onkeyup="moveToNext(1, event)" maxlength="1"
                                    id="digit1-input">
                            </div>
                            <div>
                                <label for="digit2-input" class="hidden">Digit 2</label>
                                <input type="text"
                                    class="text-lg text-center form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                    required placeholder="0" onkeyup="moveToNext(2, event)" maxlength="1"
                                    id="digit2-input">
                            </div>

                            <div>
                                <label for="digit3-input" class="hidden">Digit 3</label>
                                <input type="text"
                                    class="text-lg text-center form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                    required placeholder="0" onkeyup="moveToNext(3, event)" maxlength="1"
                                    id="digit3-input">
                            </div>

                            <div>
                                <label for="digit4-input" class="hidden">Digit 4</label>
                                <input type="text"
                                    class="text-lg text-center form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                    required placeholder="0" onkeyup="moveToNext(4, event)" maxlength="1"
                                    id="digit4-input">
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit"
                                class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mx-2 mt-2 mb-2 border-none shadow-none lg:col-span-7 card bg-white/60 dark:bg-zink-500/60">
            <div class="!px-10 !pt-10 h-full !pb-0 card-body flex flex-col">
                <div class="flex items-center justify-between gap-3">
                    <div class="grow">
                        <a href="index">
                            <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" class="hidden h-6 dark:block">
                            <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" class="block h-6 dark:hidden">
                        </a>
                    </div>
                </div>
                <div class="mt-auto">
                    <img src="{{ URL::asset('build/images/auth/img-01.png') }}" alt="" class="md:max-w-[32rem] mx-auto">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Hàm di chuyển giữa các trường khi nhập OTP
    function moveToNext(currentDigit, event) {
        let currentInput = document.getElementById('digit' + currentDigit + '-input');
        let nextInput = document.getElementById('digit' + (currentDigit + 1) + '-input');
        let prevInput = document.getElementById('digit' + (currentDigit - 1) + '-input');

        // Di chuyển đến ô tiếp theo khi nhập xong
        if (currentInput.value.length === 1 && nextInput) {
            nextInput.focus();
        }

        // Quay lại ô trước nếu nhấn phím Backspace
        if (event.key === 'Backspace' && currentInput.value.length === 0 && prevInput) {
            prevInput.focus();
        }

        // Hợp nhất các giá trị từ các trường thành một chuỗi
        updateOtp();
    }

    // Hợp nhất mã OTP từ 4 trường
    function updateOtp() {
        let otp = '';
        for (let i = 1; i <= 4; i++) {
            otp += document.getElementById('digit' + i + '-input').value;
        }
        document.getElementById('otp').value = otp;
    }

    // Gọi hàm hợp nhất OTP khi submit form
    document.getElementById('otpForm').addEventListener('submit', function () {
        updateOtp();
    });
</script>

@endsection

@push('scripts')
    <script src="{{ URL::asset('build/js/pages/auth-two-steps.init.js') }}"></script>
@endpush
