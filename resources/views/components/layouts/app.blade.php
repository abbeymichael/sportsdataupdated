<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Justify Football</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <link rel="stylesheet" href="{{ asset('assets/vendor/flatpickr/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/simple-datatables/style.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    @livewireStyles

</head>

<body>
    <!-- ======= Header ======= -->
    @include('layouts.admin.header')

    <!-- ======= Sidebar ======= -->

    @include('layouts.admin.sidebar')
    <!-- End Sidebar -->

    <main id="main" class="main">
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="toast" class="toast align-items-center text-bg-primary border-0" role="alert"
                aria-live="assertive" aria-atomic="true" style="display: none;">
                <div class="d-flex">
                    <div class="toast-body">
                        <span id="toast-message"></span>
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column ">

                {{ $slot }}
            </div>
        </div>

    </main><!-- End #main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = new bootstrap.Toast(document.getElementById('toast'));

            @if (session('success'))
                document.getElementById('toast-message').innerText = "{{ session('success') }}";
                toast.show();
            @elseif (session('error'))
                document.getElementById('toast-message').innerText = "{{ session('error') }}";
                toast.show();
            @endif
        });
    </script>

    <script src="{{ asset('assets/vendor/popper/core/dist/umd/popper.min.js') }}" referrerpolicy="origin">
    </script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/tinymce-config.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}" referrerpolicy="origin">
    </script>
    <script src="{{ asset('assets/js/main.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/vendor/flatpickr/flatpickr.min.js') }}" referrerpolicy="origin"></script>

    @livewireScripts

    <script>
        window.addEventListener('close-modal', event => {
        $('#clubModal').modal('hide');
        $('#deleteModal').modal('hide');
    });
    </script>

</body>

</html>
