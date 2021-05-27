
<script src="{{asset('admin')}}/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{asset('admin')}}/assets/js/bootstrap.bundle.min.js"></script>

<script src="{{asset('admin')}}/assets/js/main.js"></script>

<script src="{{ asset('assets') }}/js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('admin') }}/assets/js/extensions/sweetalert2.js"></script>
<script src="{{ asset('admin') }}/assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

<script>
@if(session('success'))
    Swal.fire({
        icon: "success",
        title: "{{session('success')}}"
    });
@endif
</script>
@yield('js')
</body>

</html>