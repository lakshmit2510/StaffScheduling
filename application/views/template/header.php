<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/logo-fav.png"> -->
  <title><?php echo $Title; ?> | Staff Scheduling System</title>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Jquery timepicker css -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <!-- Icons -->
  <link href="<?= base_url() ?>assets/v2/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/v2/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />

  <!-- Library -->
  <link href="<?= base_url() ?>assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>assets/lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

  <!-- CSS Files -->
  <link href="<?= base_url() ?>assets/v2/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/v2/css/custom.css" rel="stylesheet" />
  <!-- Ag grid -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/ag-grid/ag-grid.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/ag-grid/ag-theme-balham.css">
  <style>
    .ui-timepicker-container {
      z-index: 10000 !important;
      background-color: #e8e8e8;
      border-radius: 5px;
    }

    /* .ui-menu-item {
      width: 150px !important;
    } */
    .ui-state-hover {
      background-color: #5e72e4 !important;
    }
  </style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="<?= base_url() ?>">
        <img src="<?= base_url() ?>assets/img/EZLogo.png" class="navbar-brand-img" alt="...">
        <h3><b>Staff Scheduling System</b></h3>
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="<?= base_url() ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="<?= base_url() ?>assets/v2/img/theme/team-1-800x800.jpg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="<?= base_url() ?>" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="<?= base_url() ?>" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="<?= base_url() ?>" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>
            <a href="<?= base_url() ?>" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url('Login/logout'); ?>" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="<?= base_url() ?>">
                <img src="<?= base_url() ?>assets/v2/img/brand/logo-black.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>

        <!-- Navigation -->
        <?php
        $role = $this->session->userdata('Role');

        $navigations[] = ['text' => 'Dashboard', "url" => base_url('Dashboard'), 'icon' => 'ni ni-tv-2', 'title' => 'Dashboard', 'color' => "#5e72e4"];

        if (in_array($role, [1])) {
          // $subs = array();

          // $subs[] = ['text' => "Today's Shift Details", "url" => base_url('Booking/Today'), 'icon' => 'fa fa-calendar', 'title' => "Today's Shift Details"];

          // $subs[] = ['text' => 'Upcoming Shift Details', "url" => base_url('Booking/Upcoming'), 'icon' => 'fa fa-calendar', 'title' => 'Upcoming Shipments'];

          $navigations[] = ['text' => 'Booking Details', "url" => base_url('Booking'), 'icon' => 'fa fa-plus-square', 'title' => 'Booking details', 'color' => "#2dce89"];
        }

        if (in_array($role, [1])) {

          $navigations[] = ['text' => 'Shift Details', "url" => base_url('Shifts'), 'icon' => 'fa fa-clock', 'title' => 'Shift details', 'color' => "#795548"];
        }

        if (in_array($role, [1, 2])) {
          $subs = array();

          if (!in_array($role, array(5, 6))) {
            $subs[] = ['text' => 'Update IC Details', "url" => base_url('IC_Details/update'), 'icon' => 'fa fa-edit', 'title' => 'Update IC Information'];
          }
          $subs[] = ['text' => 'Add IC Number', "url" => base_url('IC_Details/add'), 'icon' => 'fa fa-plus', 'title' => 'Add IC'];

          $navigations[] = ['text' => 'IC Details', "url" => base_url('IC_Details'), 'icon' => 'fa fa-truck', 'title' => 'IC Details', 'color' => "#089db8", 'sub' => $subs];
        }

        if (in_array($role, [1, 2])) {
          $subs = array();
          $subs[] = ['text' => 'Update Airport pass details', "url" => base_url('AirportPass/update'), 'icon' => 'fa fa-edit', 'title' => 'Update Airport pass Information'];
          $subs[] = ['text' => 'Add Airport Pass', "url" => base_url('AirportPass/add'), 'icon' => 'fa fa-plus', 'title' => 'Add New Airport pass'];

          $navigations[] = ['text' => 'Airport Pass Details', "url" => base_url('AirportPass'), 'icon' => 'fa fa-user-friends', 'title' => 'Airport Pass Details', 'color' => "#fb6340", 'sub' => $subs];
        }

        if (in_array($role, [1])) {

          $navigations[] = ['text' => 'Projects List', "url" => base_url('Projects'), 'icon' => 'fa fa-building', 'title' => 'Project details', 'color' => "#019486"];
        }

        // if (in_array($role, [1, 3])) {
        //   $subs = array();
        //   if ($role == 1) {
        //     $subs[] = ['text' => 'Supplier Groups', "url" => base_url('Supplier/Groups'), 'icon' => 'fa fa-users', 'title' => 'Supplier Groups'];
        //   }

        //   $navigations[] = ['text' => 'My Suppliers', "url" => base_url('Supplier'), 'icon' => 'fa fa-users', 'title' => 'List of Users', 'color' => "#fb6340", 'sub' => $subs];
        // }
        if (in_array($role, [1])) {

        $navigations[] = ['text' => 'KPI Details', "url" => base_url('KPI_Details'), 'icon' => 'fa fa-list', 'title' => 'KPI Details', 'color' => "#5e72e4"];
        }
        
        if (!in_array($role, array(5, 2, 6))) {
          $subs = array();
          if ($role == 1) {
            $subs[] = ['text' => 'Update Company Details', "url" => base_url('Company'), 'icon' => 'fa fa-building', 'title' => 'Company'];
            $subs[] = ['text' => 'Update Staff Details', "url" => base_url('Users/Update'), 'icon' => 'fa fa-building', 'title' => 'Staff Details'];
            $subs[] = ['text' => 'Approvals Pending', "url" => base_url('Users/Approval'), 'icon' => 'fa fa-building', 'title' => 'Approvals Pending'];
          }

          $navigations[] = ['text' => 'Admin', "url" => base_url('Company'), 'icon' => 'fa fa-user-lock', 'title' => 'Admin', 'color' => "#812388", 'sub' => $subs];
        }

        // if (in_array($role, array(2))) {
        //   $navigations[] = ['text' => 'Statistics & Reports', "url" => base_url('Reports'), 'icon' => 'fa fa-chart-pie', 'title' => 'Reports', 'color' => "#D9AA11"];
        // } else {
        //   $navigations[] = ['text' => 'Help', "url" => base_url('Dashboard/Help'), 'icon' => 'fa fa-question-circle', 'title' => 'Help', 'color' => "#55AAFA"];
        // }


        ?>

        <ul class="navbar-nav">
          <?php
          foreach ($navigations as $nav) {
          ?>
            <li class="nav-item <?= $Title == $nav['title'] ? ' active' : '' ?>">
              <a class="nav-link" href="<?= $nav['url'] ?>">
                <i class="<?= $nav['icon'] ?>" style="color:<?= $nav['color'] ?>"></i> <?= $nav['text'] ?>


                <?php
                if (isset($nav['sub']) && count($nav['sub']) > 0) {
                ?>

                  <i class="fa fa-angle-down subdown-arrow"></i>

                <?php
                }
                ?>

              </a>
              <?php
              if (isset($nav['sub']) && count($nav['sub']) > 0) {
              ?>

                <ul class="navbar-subnav">
                  <?php
                  foreach ($nav['sub'] as $sub) {
                  ?>
                    <li class="sub-nav-item <?= $Title == $sub['title'] ? ' active' : '' ?>">
                      <a class="sub-nav-link" href="<?= $sub['url'] ?>">
                        <i class="<?= $sub['icon'] ?>"></i> <?= $sub['text'] ?>
                      </a>
                    </li>
                  <?php
                  }
                  ?>
                </ul>
              <?php
              }
              ?>
            </li>
          <?php
          }
          ?>

        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="<?= base_url() ?>">Home</a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="<?= base_url() ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="<?= base_url() ?>assets/v2/img/theme/team-4-800x800.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?= ucfirst($this->session->userdata('UserName')) ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="<?= base_url() ?>" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="<?= base_url() ?>" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('Login/logout') ?>" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header header-bg pt-4 pt-md-6">
      <div class="container-fluid">
        <div class="header-body">