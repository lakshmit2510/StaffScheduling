<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Forgot Your Password | Staff Scheduling System</title>
  <!-- Favicon -->

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="<?=base_url()?>assets/v2/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="<?=base_url()?>assets/v2/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="<?=base_url()?>assets/v2/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="index.html">
          <img src="<?=base_url()?>assets/img/EZLogo.png" />
          <span class="text-white" style="font-size: 20px;">Elizabeth-Zion Asia Pacific Pte Ltd</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="index.html">
                  <img src="<?=base_url()?>assets/img/EZLogo.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon"  href="<?=base_url('Login/Signup')?>">
                <i class="ni ni-circle-08"></i>
                <span class="nav-link-inner--text">Register</span>
              </a>
            </li>
            <li class="nav-item" style="display:none;">
              <a class="nav-link nav-link-icon"  href="<?=base_url()?>">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-inner--text">Login</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-5">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Staff Scheduling System <br> Forgot Your Password</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Don't worry, we'll send you an email to your login details. Enter your registered email address here.</small>
              </div>
              <?php if($this->session->flashdata('error')==1) { ?>
                <div role="alert" class="alert alert-danger alert-dismissible">
                  <div class="message">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="fa fa-close"></span></button>Your Email not <b>Registered</b> in our system.

                  </div>
              </div>
              <?php } if($this->session->flashdata('done')==1) { ?>
                <div role="alert" class="alert alert-success alert-dismissible">
                  <div class="message">
                    <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="fa fa-check"></span></button> Your Password susscessfully updated. Please try to login with new password.
                  </div>
              </div>
              <?php } ?>

              <form role="form"  action="<?php echo base_url('Login/resetpassword');?>" method="post">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control"  placeholder="Your Email" name="Email" type="text">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                    </div>
                    <input type="password" id="pass" required="" placeholder="New Password" name="Password" class="form-control">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                    </div>
                    <input type="password" required="" data-parsley-equalto="#pass" placeholder="Confirm Password" name="NPassword" class="form-control">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary px-5 my-4">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="<?php echo base_url('Login')?>" class="text-light"><small>Go back to Login Page?</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--   Core   -->
  <script src="<?=base_url()?>assets/v2/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/v2/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="<?=base_url()?>assets/v2/js/argon-dashboard.min.js?v=1.1.0"></script>

</body>

</html>
