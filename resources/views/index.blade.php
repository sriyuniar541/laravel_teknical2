<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Todo App - @yield('title')</title>

        {{-- link css export table laporan --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

        {{-- link css  bootstrap--}}
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
      
         {{-- cdn export table laporan --}}
         <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
         <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
         <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
         <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    </head>

    <style>
        /* icon */
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
    </style>
    
    <body>
        <div class="container">

            <!-- navbar -->
            <div class="row shadow-lg p-3 mb-2 bg-body-tertiary rounded d-flex">
                <ul class="nav">

                    {{-- link home --}}
                    <li class="nav-item">
                        <a
                            class="nav-link active fs-4 border rounded"
                            aria-current="page"
                            href="/transaksi"
                            >
                            <i class="bi bi-houses"></i>
                        </a>                      
                    </li>
                  
                    {{-- Kategori --}}
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            aria-current="page"
                            href="{{ url('/kategori') }}"
                            >Kategori</a
                        >
                    </li>

                        {{-- coa --}}
                        <li class="nav-item">
                        <a
                            class="nav-link active"
                            aria-current="page"
                            href="{{ url('/coa') }}"
                            >COA</a
                        >
                    </li>

                        {{-- transaksi --}}
                        <li class="nav-item">
                        <a
                            class="nav-link active"
                            aria-current="page"
                            href="{{ url('/transaksi') }}"
                            >Transaksi</a
                        >
                    </li>

                        {{-- laporan --}}
                        <li class="nav-item">
                        <a
                            class="nav-link active"
                            aria-current="page"
                            href="{{ url('/laporan') }}"
                            >Laporan</a
                        >
                    </li>                    
                </ul>
            </div>
            <!-- akhir navbar -->

        @yield('content')
        </div>

        {{-- cdn bootstrap --}}
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"
        ></script>

        {{-- sweet Allert --}}
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        @include('sweetalert::alert')

        <script>
            $(document).ready(function() {
                $('#table_laporan').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                });
            });
        </script>
       
    </body>
</html>