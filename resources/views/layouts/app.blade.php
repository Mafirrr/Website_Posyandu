<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('template') }}/assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/styles.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.navigation')
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                @yield('main')

            </div>
        </div>
    </div>
    <script src="{{ asset('template') }}/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('template') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template') }}/assets/js/sidebarmenu.js"></script>
    <script src="{{ asset('template') }}/assets/js/app.min.js"></script>
    <script src="{{ asset('template') }}/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="{{ asset('template') }}/assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="{{ asset('template') }}/assets/js/dashboard.js"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        let table = new DataTable('.datatable');
    </script>
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Yakin ingin menghapus data ini?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-delete-' + id).submit();
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
