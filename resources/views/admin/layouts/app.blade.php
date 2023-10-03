<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Dodoma</title>

  <!-- theme meta -->
  <meta name="theme-name" content="mono" />

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="/dashboardAssets/plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="/dashboardAssets/plugins/simplebar/simplebar.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="/dashboardAssets/plugins/nprogress/nprogress.css" rel="stylesheet" />




  <link href="/dashboardAssets/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet" />



  <link href="/dashboardAssets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />



  <link href="/dashboardAssets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />



  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">



  <link href="/dashboardAssets/plugins/toaster/toastr.min.css" rel="stylesheet" />


  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="/dashboardAssets/css/style.css" />




  <!-- FAVICON -->
  <link href="images/favicon.png" rel="shortcut icon" />

  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="/dashboardAssets/plugins/nprogress/nprogress.js"></script>
</head>


<body class="navbar-fixed sidebar-fixed" id="body">
  <script>
    NProgress.configure({ showSpinner: false });
      NProgress.start();
  </script>


  <div id="toaster"></div>


  <!-- ====================================
    ——— WRAPPER
    ===================================== -->
  <div class="wrapper">


    <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
    <aside class="left-sidebar" id="left-sidebar">
      <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
          <a href="#">
            <span class="brand-name">ADMIN</span>
          </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-left" data-simplebar style="height: 100%;">
          <!-- sidebar menu -->
          <ul class="nav sidebar-inner" id="sidebar-menu">



            <li class="active">
              <a class="sidenav-item-link" href="{{route('admin.home')}}">
                <i class="mdi mdi-briefcase-account-outline"></i>
                <span class="nav-text">Dashboard</span>
              </a>
            </li>





            <li class="section-title">
              Users
            </li>
            <li class="has-sub">
              <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#users"
                aria-expanded="false" aria-controls="email">
                <i class="mdi mdi-account-group"></i>
                <span class="nav-text">users</span> <b class="caret"></b>
              </a>
              <ul class="collapse" id="users" data-parent="#sidebar-menu">
                <div class="sub-menu">
                  <li>
                    <a class="sidenav-item-link" href="{{route('admin.users.index')}}">
                      <span class="nav-text">Users List</span>

                    </a>
                  </li>
                  <li>
                    <a class="sidenav-item-link" href="{{route('admin.users.create')}}">
                      <span class="nav-text">New User</span>

                    </a>
                  </li>
                </div>
              </ul>
            </li>
            <li class="has-sub">
              <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#products"
                aria-expanded="false" aria-controls="email">
                <i class="mdi mdi-database"></i>
                <span class="nav-text">products</span> <b class="caret"></b>
              </a>
              <ul class="collapse" id="products" data-parent="#sidebar-menu">
                <div class="sub-menu">
                  <li>
                    <a class="sidenav-item-link" href="{{route('admin.products.index')}}">
                      <span class="nav-text">Products List</span>

                    </a>
                  </li>
                  <li>
                    <a class="sidenav-item-link" href="{{route('admin.products.create')}}">
                      <span class="nav-text">New Product</span>
                    </a>
                  </li>
                </div>
              </ul>
            </li>
            <li class="has-sub">
              <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#orders"
                aria-expanded="false" aria-controls="email">
                <i class="mdi mdi-cart"></i>
                <span class="nav-text">orders</span> <b class="caret"></b>
              </a>
              <ul class="collapse" id="orders" data-parent="#sidebar-menu">
                <div class="sub-menu">
                  <li>
                    <a class="sidenav-item-link" href="{{route('admin.orders.index')}}">
                      <span class="nav-text">Orders List</span>

                    </a>
                  </li>
                </div>
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </aside>



    <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
    <div class="page-wrapper">

      <!-- Header -->
      <header class="main-header" id="header">
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
          <!-- Sidebar toggle button -->
          <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
          </button>

          <span class="page-title">
            @yield('pageTitle')
          </span>

          <div class="navbar-right ">

            <!-- search form -->

            <ul class="nav navbar-nav">
              <!-- User Account -->
              <li class="dropdown user-menu">
                <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <span class="d-none d-lg-inline-block">{{Auth::user()->names}}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                    <a class="" href="">
                      <i class="mdi mdi-account-outline"></i>
                      <span class="nav-text">My Profile</span>
                    </a>
                  </li>

                  <li class="dropdown-footer">
                    <a class="dropdown-link-item" href="#" onclick="document.getElementById('logoutForm').submit();"> <i
                        class="mdi mdi-logout"></i>Logout</a>
                    <form action="{{route('auth.logout')}}" method="POST" style="display: none" id="logoutForm">
                      @csrf
                    </form>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>


      </header>

      <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
      @yield('content')

    </div>
  </div>


  </div>
  </div>





  <script src="/dashboardAssets/plugins/jquery/jquery.min.js"></script>
  <script src="/dashboardAssets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/dashboardAssets/plugins/simplebar/simplebar.min.js"></script>
  <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>



  <script src="/dashboardAssets/plugins/apexcharts/apexcharts.js"></script>



  <script src="/dashboardAssets/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>



  <script src="/dashboardAssets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
  <script src="/dashboardAssets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
  <script src="/dashboardAssets/plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>



  <script src="/dashboardAssets/plugins/daterangepicker/moment.min.js"></script>
  <script src="/dashboardAssets/plugins/daterangepicker/daterangepicker.js"></script>
  <script>
    jQuery(document).ready(function() {
                        jQuery('input[name="dateRange"]').daterangepicker({
                        autoUpdateInput: false,
                        singleDatePicker: true,
                        locale: {
                          cancelLabel: 'Clear'
                        }
                      });
                        jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
                          jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
                        });
                        jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
                          jQuery(this).val('');
                        });
                      });
  </script>



  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>



  <script src="/dashboardAssets/plugins/toaster/toastr.min.js"></script>



  <script src="/dashboardAssets/js/mono.js"></script>
  <script src="/dashboardAssets/js/chart.js"></script>
  <script src="/dashboardAssets/js/map.js"></script>
  <script src="/dashboardAssets/js/custom.js"></script>




</body>

</html>