<!DOCTYPE html>
<html lang="en">
	<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>

    <!-- Title -->
    <title> Valex -  Premium dashboard ui bootstrap rwd admin html5 template </title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/x-icon"/>

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!-- Bootstrap css -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!--  Custom Scroll bar-->
    <link href="{{ asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet"/>

    <!--  Sidebar css -->
    <link href="{{ asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

    <!--- Internal Morris css-->
    <link href="{{ asset('assets/plugins/morris.js/morris.css') }}" rel="stylesheet">

    <!--- Style css --->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/boxed.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/dark-boxed.css') }}" rel="stylesheet">

    <!--- Dark-mode css --->
    <link href="{{ asset('assets/css/style-dark.css') }}" rel="stylesheet">

    <!---Skinmodes css-->
    <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />
    @stack('header')
    <style>
        .form-control[type='file']{
            height:35px!important;
        }
    </style>

	</head>

<body class="main-body " id="bodyID">

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

	@yield('content')
	<!-- Back-to-top -->
	<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

	<!-- custom js -->

    <!-- Page -->
    <div class="horizontalMenucontainer">
        <div class="page">
            <!-- main-content -->
            @include('includes.topnav')
            @include('includes.navbar')
            <div class="main-content horizontal-content">
                @yield('content-app')
            </div>
            @include('includes.footer')

            <!-- Message Modal -->
            <div class="modal fade" id="chatmodel" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-dialog-right chatbox" role="document">
                    <div class="modal-content chat border-0">
                        <div class="card overflow-hidden mb-0 border-0">
                            <!-- action-header -->
                            <div class="action-header clearfix">
                                <div class="float-start hidden-xs d-flex ms-2">
                                    <div class="img_cont me-3">
                                        <img src="../{{asset('ets/img/faces/6.jpg" class="rounded-circle user_img"')}} alt="img">
                                    </div>
                                    <div class="align-items-center mt-2">
                                        <h4 class="text-white mb-0 fw-semibold">Daneil Scott</h4>
                                        <span class="dot-label bg-success"></span><span class="me-3 text-white">online</span>
                                    </div>
                                </div>
                                <ul class="ah-actions actions align-items-center">
                                    <li class="call-icon">
                                        <a href="" class="d-done d-md-block phone-button" data-bs-toggle="modal" data-bs-target="#audiomodal">
                                            <i class="si si-phone"></i>
                                        </a>
                                    </li>
                                    <li class="video-icon">
                                        <a href="" class="d-done d-md-block phone-button" data-bs-toggle="modal" data-bs-target="#videomodal">
                                            <i class="si si-camrecorder"></i>
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="si si-options-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><i class="fa fa-user-circle"></i> View profile</li>
                                            <li><i class="fa fa-users"></i>Add friends</li>
                                            <li><i class="fa fa-plus"></i> Add to group</li>
                                            <li><i class="fa fa-ban"></i> Block</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href=""  class="" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="si si-close text-white"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- action-header end -->

                            <!-- msg_card_body -->
                            <div class="card-body msg_card_body">
                                <div class="chat-box-single-line">
                                    <abbr class="timestamp">February 1st, 2019</abbr>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <div class="img_cont_msg">
                                        <img src="../{{asset('ets/img/faces/6.jpg" class="rounded-circle user_img_msg"')}} alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        Hi, how are you Jenna Side?
                                        <span class="msg_time">8:40 AM, Today</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end ">
                                    <div class="msg_cotainer_send">
                                        Hi Connor Paige i am good tnx how about you?
                                        <span class="msg_time_send">8:55 AM, Today</span>
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="../{{asset('ets/img/faces/9.jpg" class="rounded-circle user_img_msg"')}} alt="img">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start ">
                                    <div class="img_cont_msg">
                                        <img src="../{{asset('ets/img/faces/6.jpg" class="rounded-circle user_img_msg"')}} alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        I am good too, thank you for your chat template
                                        <span class="msg_time">9:00 AM, Today</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end ">
                                    <div class="msg_cotainer_send">
                                        You welcome Connor Paige
                                        <span class="msg_time_send">9:05 AM, Today</span>
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="../{{asset('ets/img/faces/9.jpg" class="rounded-circle user_img_msg"')}} alt="img">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start ">
                                    <div class="img_cont_msg">
                                        <img src="../{{asset('ets/img/faces/6.jpg" class="rounded-circle user_img_msg"')}} alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        Yo, Can you update Views?
                                        <span class="msg_time">9:07 AM, Today</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="msg_cotainer_send">
                                        But I must explain to you how all this mistaken  born and I will give
                                        <span class="msg_time_send">9:10 AM, Today</span>
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="../{{asset('ets/img/faces/9.jpg" class="rounded-circle user_img_msg"')}} alt="img">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start ">
                                    <div class="img_cont_msg">
                                        <img src="../{{asset('ets/img/faces/6.jpg" class="rounded-circle user_img_msg"')}} alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        Yo, Can you update Views?
                                        <span class="msg_time">9:07 AM, Today</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="msg_cotainer_send">
                                        But I must explain to you how all this mistaken  born and I will give
                                        <span class="msg_time_send">9:10 AM, Today</span>
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="../{{asset('ets/img/faces/9.jpg" class="rounded-circle user_img_msg"')}} alt="img">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start ">
                                    <div class="img_cont_msg">
                                        <img src="../{{asset('ets/img/faces/6.jpg" class="rounded-circle user_img_msg"')}} alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        Yo, Can you update Views?
                                        <span class="msg_time">9:07 AM, Today</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="msg_cotainer_send">
                                        But I must explain to you how all this mistaken  born and I will give
                                        <span class="msg_time_send">9:10 AM, Today</span>
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="../../assets/img/faces/9.jpg" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <div class="img_cont_msg">
                                        <img src="../../assets/img/faces/6.jpg" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        Okay Bye, text you later..
                                        <span class="msg_time">9:12 AM, Today</span>
                                    </div>
                                </div>
                            </div>
                            <!-- msg_card_body end -->
                            <!-- card-footer -->
                            <div class="card-footer">
                                <div class="msb-reply d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control " placeholder="Typing....">
                                        <div class="input-group-text ">
                                            <button type="button" class="btn btn-primary ">
                                                <i class="far fa-paper-plane" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- card-footer end -->
                        </div>
                    </div>
                </div>
            </div>

            <!--Video Modal -->
            <div id="videomodal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark border-0 text-white">
                        <div class="modal-body mx-auto text-center p-7">
                            <h5>Valex Video call</h5>
                            <img src="../../assets/img/faces/6.jpg" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3" alt="img">
                            <h4 class="mb-1 fw-semibold">Daneil Scott</h4>
                            <h6>Calling...</h6>
                            <div class="mt-5">
                                <div class="row">
                                    <div class="col-4">
                                        <a class="icon icon-shape rounded-circle mb-0 me-3" href="#">
                                            <i class="fas fa-video-slash"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="icon icon-shape rounded-circle text-white mb-0 me-3" href="#" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-phone bg-danger text-white"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="icon icon-shape rounded-circle mb-0 me-3" href="#">
                                            <i class="fas fa-microphone-slash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- modal-body -->
                    </div>
                </div><!-- modal-dialog -->
            </div><!-- modal -->

            <!-- Audio Modal -->
            <div id="audiomodal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content border-0">
                        <div class="modal-body mx-auto text-center p-7">
                            <h5>Valex Voice call</h5>
                            <img src="../../assets/img/faces/6.jpg" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3" alt="img">
                            <h4 class="mb-1  fw-semibold">Daneil Scott</h4>
                            <h6>Calling...</h6>
                            <div class="mt-5">
                                <div class="row">
                                    <div class="col-4">
                                        <a class="icon icon-shape rounded-circle mb-0 me-3" href="#">
                                            <i class="fas fa-volume-up bg-light text-dark"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="icon icon-shape rounded-circle text-white mb-0 me-3" href="#" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-phone text-white bg-success"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="icon icon-shape  rounded-circle mb-0 me-3" href="#">
                                            <i class="fas fa-microphone-slash bg-light text-dark"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- modal-body -->
                    </div>
                </div><!-- modal-dialog -->
            </div><!-- modal -->
        </div>
    </div>
</body>
<!-- JQuery min js -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Bundle js -->
<script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Ionicons js -->
<script src="{{asset('assets/plugins/ionicons/ionicons.js')}}"></script>

<!-- Moment js -->
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>

<!--Internal Sparkline js -->
<script src="{{asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Moment js -->
<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>

<!-- Internal Piety js -->
<script src="{{asset('assets/plugins/peity/jquery.peity.min.js')}}"></script>

<!-- Rating js-->
<script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{asset('assets/plugins/rating/jquery.barrating.js')}}"></script>

<!-- P-scroll js -->
<script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>

<!-- Sidemenu js-->
<script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>
<script src="{{asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>

<!-- Eva-icons js -->
<script src="{{asset('assets/js/eva-icons.min.js')}}"></script>

<!--Internal Apexchart js-->
<script src="{{asset('assets/js/apexcharts.js')}}"></script>

<!-- Horizontalmenu js-->
<script src="{{asset('assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js')}}"></script>

<!-- Sticky js -->
<script src="{{asset('assets/js/sticky.js')}}"></script>

<!-- Internal Map -->
<script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>

<!-- Internal Chart js -->
<script src="{{asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

<!--Internal  index js -->
<script src="{{asset('assets/js/index.js')}}"></script>
<script src="{{asset('assets/js/jquery.vmap.sampledata.js')}}"></script>

<!-- custom js -->
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
@stack('script')
</html>
