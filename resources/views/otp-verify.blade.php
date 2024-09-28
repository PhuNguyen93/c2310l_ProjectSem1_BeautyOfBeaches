@extends('layouts.master-without-nav')

@section('title')
    Verify OTP
@endsection

@section('content')

<form action="{{ route('otp.verify') }}" method="POST">
    @csrf
    <label for="otp">Enter OTP:</label>
    <input type="text" name="otp" id="otp" required>
    <button type="submit">Verify</button>
</form>

@endsection
