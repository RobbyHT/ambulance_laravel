<!-- BEGIN: Vendor CSS-->
{{--<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/vendors.min.css')}}">--}}

@yield('vendor-styles')
<!-- END: Vendor CSS-->
<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}"/>
{{--<link rel="stylesheet" type="text/css" href="{{asset('css/menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/loading/loading.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/sweetalert2.min.css')}}">--}}
{{--
<!-- BEGIN: Page CSS-->
@if($configData['mainLayoutType'] == 'horizontal-menu')
<link rel="stylesheet" type="text/css" href="{{asset('css/core/menu/menu-types/horizontal-menu.css')}}">
@else
<link rel="stylesheet" type="text/css" href="{{asset('css/core/menu/menu-types/vertical-menu.css')}}">
@endif
@yield('page-styles')
<!-- END: Page CSS-->
<!-- BEGIN: Custom CSS-->
@if($configData['direction'] === 'ltr')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
@else
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style-rtl.css')}}">
@endif--}}
<!-- END: Custom CSS-->
