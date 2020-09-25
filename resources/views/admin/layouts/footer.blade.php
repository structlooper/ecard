
<!-- base:js -->
<script src="{{asset('public/admin/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{{asset('public/admin/vendors/chart.js/Chart.min.js')}}"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{asset('public/admin/js/off-canvas.js')}}"></script>
<script src="{{asset('public/admin/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('public/admin/js/template.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="{{asset('public/admin/js/dashboard.js')}}"></script>
<script>
    function logout(){
        $('body').append(`
            <form action="{{route('logout')}}" method="post" id="thisForm">
            @csrf
        </form>
`);
        $('#thisForm').submit();
    }
</script>
@yield('js')
<!-- End custom js for this page-->
</body>

</html>
