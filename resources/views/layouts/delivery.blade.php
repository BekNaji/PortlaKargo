<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 offset-sm-4">
                    <br>
                    @yield('content')
                </div>
            </div>
        </div>
        <script type="text/javascript">
        @if(session('success'))
        Swal.fire(
        '{{session('success')}}',
        '',
        'success'
        );
        @elseif(session('error'))
        Swal.fire(
        '{{session('error')}}',
        '',
        'warning'
        );
        @endif
        </script>
    </body>
</html>