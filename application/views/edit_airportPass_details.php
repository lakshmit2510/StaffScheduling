<?php $this->load->view('template/header'); ?>

<div class="mt-5"></div>
<?php $this->load->view('template/card-head'); ?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary be-loading">
          <h1 class="panel-heading panel-heading-divider my-3">Edit Airport Pass Details</h1>
          <hr />
          <div class="panel-body">
            <form action="<?php echo base_url('AirportPass/editPassDetailsPost'); ?>" class="form-horizontal" method="post">
              <input type="hidden" name="ID" value="<?php echo $passDetails->PassID; ?>">
              <div class="form-group">
                <label class="col-sm-3 control-label">Airport Pass Number</label>
                <div class="col-sm-6">
                  <input type="text" required="" name="PassNumber" value="<?php echo $passDetails->PassNumber; ?>" placeholder="Airport Pass Number" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Full Name</label>
                <div class="col-sm-6">
                  <input type="text" required="" name="PassName" value="<?php echo $passDetails->AirportPassName; ?>" placeholder="Name as for Pass" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Date of Expiry</label>
                <div class="col-sm-6">
                  <input type="date" required="" name="DOE" value="<?php echo $passDetails->DateOfExpiry; ?>" placeholder="dd/mm/yyyy" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-space btn-primary">Submit</button>
                  <a href="<?php echo base_url(''); ?>" class="btn btn-space btn-default">Cancel</a>
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

      <?php $this->load->view('template/card-foot'); ?>

      <?php $this->load->view('template/footer'); ?>
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