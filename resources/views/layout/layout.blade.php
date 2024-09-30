<!DOCTYPE html>
<html class="no-js" lang="en">

<x-head />

<body>

    <x-preloader />

    <!-- Start Header Section -->
    <x-header />

    <x-header_search />
    <!-- End Header Section -->

    @yield('content')
    <!-- Start footer -->
    <x-footer />
    <!-- End footer -->
    <!-- Nút cuộn lên đầu trang (ScrollToTop Component) -->
    <x-scroll-to-top />
    <!-- Script -->
    <x-script />

</body>

</html>
