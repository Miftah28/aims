<!DOCTYPE html>
<html lang="en">

@include('layouts.admin.component.head')

<body>

    @include('layouts.admin.component.header')

    @include('layouts.admin.component.sidebar')

    <main id="main" class="main">

        @yield('main-content')

    </main><!-- End #main -->

    @include('layouts.admin.component.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('layouts.admin.component.js')

</body>

</html>
