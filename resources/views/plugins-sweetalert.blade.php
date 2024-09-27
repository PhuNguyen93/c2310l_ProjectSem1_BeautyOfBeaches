@extends('layouts.master')

@section('title')
    {{ __('Sweetalert') }}
@endsection

@section('content')
    <x-page-title title="Sweetalert" pagetitle="Plugins" />

    <div>
        <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-4 text-15">Authentication successful!</h6>
                    <button id="sa-success" type="button"
                        class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"
                        onclick="window.location='{{ route('login') }}'">Back to Login</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Sweetalert logic (nếu có)
</script>
@endpush
