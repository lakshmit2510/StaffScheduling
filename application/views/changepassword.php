<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login - Employee Recruitment</title>
  <!-- Favicon -->

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="<?= base_url() ?>assets/v2/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/v2/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="<?= base_url() ?>assets/v2/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />

  <style>
    img {

      width: 100px;
      height: 100px !important;
    }

    @media only screen and (max-width: 600px) {
      .navbar-top .navbar-brand {
        display: flex;
        flex-direction: column;
      }

      .navbar-top .text-white {
        font-size: 12px !important;

      }

    }
  </style>
</head>

<div class="mt-5"></div>
<?php $this->load->view('template/card-head'); ?>


<div class="be-content">
  <div class="main-content container-fluid">
    <!-- Navbar -->
    <!-- <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="index.html">
          <img src="<?= base_url() ?>assets/img/EZLogo.png" />
          <span class="text-white" style="font-size: 20px;">Elizabeth-Zion Asia Pacific Pte Ltd</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          Collapse header
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="index.html">
                  <img src="<?= base_url() ?>assets/img/EZLogo.png">
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
        </div>
      </div>
    </nav> -->
    <!-- Header -->
    <!-- <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-5">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6" style="padding-top: 60px;">
              <h1 class="text-white">Welcome to Staff Scheduling System!</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div> -->
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <?php if ($this->session->flashdata('type') == 'done') { ?>
          <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
            <div class="icon"><span class="mdi mdi-check"></span></div>
            <div class="message">
              <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>.
              <span>Please <a href="<?php echo base_url('Login/logout'); ?>">Re-Login</a> here</span>
            </div>
          </div>
        <?php } else if ($this->session->flashdata('type') == 'error') { ?>
          <div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible">
            <div class="icon"><span class="mdi mdi-check"></span></div>
            <div class="message">
              <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Error!</strong> <?php echo $this->session->flashdata('msg'); ?>.
            </div>
          </div>
        <?php } ?>
        <div class="panel panel-default panel-border-color panel-border-color-primary be-loading">
          <h1 class="panel-heading panel-heading-divider"><i class="icon mdi mdi-key"></i> <?php echo $Title; ?></h1>
          <hr />
          <div class="panel-body">
            <form action="<?php echo base_url('Users/updatepassword'); ?>" class="form-horizontal" method="post">
              <div class="form-group">
                <label class="col-sm-3 control-label">Current Password </label>
                <div class="col-sm-8">
                  <input type="password" required="" placeholder="Current Password" name="Current" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">New Password</label>
                <div class="col-sm-8">
                  <input type="password" id="pass" required="" placeholder="New Password" name="Password" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Confirm Password</label>
                <div class="col-sm-8">
                  <input type="password" required="" data-parsley-equalto="#pass" placeholder="Confirm Password" name="NPassword" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-space btn-primary">Submit</button>
                  <a href="<?php echo base_url('Dashboard/'); ?>" class="btn btn-space btn-default">Cancel</a>
                </div>
              </div>
            </form>
          </div>
          <div class="be-spinner">
            <svg width="50px" height="50px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
              <circle fill="none" stroke-width="5" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
            </svg>
          </div>
        </div>
      </div>
    </div>
      <?php $this->load->view('template/card-foot'); ?>

      <!--   Core   -->
      <script src="<?= base_url() ?>assets/v2/js/plugins/jquery/dist/jquery.min.js"></script>
      <script src="<?= base_url() ?>assets/v2/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!--   Optional JS   -->
      <!--   Argon JS   -->
      <script src="<?= base_url() ?>assets/v2/js/argon-dashboard.min.js?v=1.1.0"></script>
      <script src="<?php echo base_url(); ?>assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $('form').parsley();

          $('select').select2();

          $('form').submit(function() {
            $('.be-loading').addClass('be-loading-active');
          });

        });
      </script>