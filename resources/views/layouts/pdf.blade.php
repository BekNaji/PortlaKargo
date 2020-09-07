<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="author" content="" />
        <title>
        @if(View::hasSection('title'))
        @yield('title')
        @else
        {{ config('app.name') }}
        @endif
        </title>
        <link href="{{ asset('assets') }}/css/styles.css" rel="stylesheet" />
        <link href="{{ asset('assets') }}/css/bootstrap-select.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
        <style>@page { size: A5 }</style>
    </head>
    <body class="A5" >
        <div class="container-fluid" >
            @yield('content')
        </div>
      
        
        
      
    </body>
</html>