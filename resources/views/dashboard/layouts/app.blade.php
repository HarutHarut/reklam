<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{$page_title ?? ''}} | Oglasi</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('/assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Date picker -->
    <link rel="stylesheet" href="{{asset('/assets/plugins/daterangepicker/daterangepicker.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/css/core.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    @yield('styles')

    @stack('custom-styles')

    <link rel="stylesheet" href="{{asset('/assets/plugins/dropzone/min/dropzone.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/assets/dist/css/AdminLTE.min.css')}}">

    <!-- Date picker -->
    <link rel="stylesheet" href="{{asset('/assets/plugins/daterangepicker/daterangepicker.js')}}">

    <!-- jQuery -->
    <link rel="stylesheet" href="{{asset('/assets/js/jui/jquery-ui.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('/assets/js/jui/jquery-ui.structure.min.css')}}" type="text/css"/>

    <!-- InputMask -->
    <script src="{{asset('/assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('/assets/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="skin-blue sidebar-mini layout-fixed">

<style>
    .filter-options {
        display: none;
    }
</style>


<div class="wrapper">
    @include('dashboard.layouts.header')
    @include('dashboard.layouts.aside')
    @yield('content')
    @include('dashboard.layouts.footer')
</div>

@yield('script')

@stack('custom-scripts')

{{--<script src="https://cdn.tailwindcss.com"></script>--}}

<script src="{{asset('/assets/js/core.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('/assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{asset('/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>


<!-- overlayScrollbars -->
<script src="{{asset('/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<script src="{{asset('/assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/assets/dist/js/demo.js?v=').time()}}"></script>

<!-- Select2 -->
<script src="{{asset('/assets/plugins/select2/js/select2.full.min.js') }}"></script>


<script>
    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 5000);

    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })


</script>
<script>
    $('.form-group .filter_type').change(function () {
        let filterType = $(this).val();
        $.ajax({
            url: '/dashboard/filter/get-type?filter_type=' + filterType,
            type: "GET",
            success: function(response) {
                $('.filter-options').css("display", "none");
                $('.hide-options').css("display", "none");
                $('#' + response).css("display", "block");
                $(`#${response} input`).attr("required");
            },

        });
    })


    $(document).ready(function () {
        $(".add-more").click(function () {
            var html = $(".copy").html();
            $(".after-add-more").after(html);
            console.log($(".copy").length);
        });
        $("body").on("click", ".remove", function () {
            $(this).parents(".control-group").remove();
        });

        getChildeCat($('#parent_category_id').val())
    });

    $('#parent_category_id').change(function () {
        getChildeCat($(this).val())
    });

    function getChildeCat(parent_id){
        let urlParams = new URLSearchParams(window.location.search);
        let cat_id = urlParams.get('child_category_id');
        let html = `<option value="">Child Category</option>`;

        if(parent_id && parent_id !== ''){
            for(let i = 0; i < categories.length; i++ ){
                if(categories[i].parent_id == parent_id){
                    if(cat_id == categories[i].id) {
                        html+=`<option selected value="${categories[i].id}">${categories[i].tip}</option>`
                    } else {
                        html+=`<option value="${categories[i].id}">${categories[i].tip}</option>`
                    }

                }
            }
        }


        $('#child_category_id').empty();
        $('#child_category_id').append(html);
    }



</script>

</body>
</html>
