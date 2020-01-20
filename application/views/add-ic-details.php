<?php $this->load->view('template/header'); ?>

<div class="mt-5"></div>
<?php $this->load->view('template/card-head'); ?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary be-loading">
          <h1 class="my-3 panel-heading panel-heading-divider"><i class="icon mdi mdi-car"></i> <?php echo $Title; ?></h1>
          <hr />
          <div class="panel-body">
            <form action="<?php echo base_url('IC_Details/addICDetailsPost'); ?>" class="form-horizontal" method="post">
              <div class="form-group">
                <label class="col-sm-3 control-label">IC Number</label>
                <div class="col-sm-6">
                  <input type="text" required="" name="ICNumber" placeholder="IC Number" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">IC Type</label>
                <div class="col-sm-6">
                  <select class="form-control" required="true" name="Type">
                    <option value="">--- Choose Type Of IC ----</option>
                    <?php
                    foreach ($vtype as $key => $value) {
                      echo '<option value="' . $value->TypeID . '">' . $value->Type . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Full Name</label>
                <div class="col-sm-6">
                  <input type="text" required="" name="ICName" placeholder="Name as for IC" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Date of Birth</label>
                <div class="col-sm-6">
                  <input type="date" required="" name="DOB" placeholder="dd/mm/yyyy" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Country Of Birth</label>
                <div class="col-sm-6">
                  <input type="text" name="Nationality" placeholder="Country of Birth" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Date of Issue</label>
                <div class="col-sm-6">
                  <input type="date" name="DateofIssue" placeholder="dd/mm/yyyy" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Gender</label>
                <div class="col-sm-6">
                  <select class="form-control" required="true" name="Gender">
                    <option value="">--- Choose Gender ---</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Race</label>
                <div class="col-sm-6">
                  <input type="text" name="race" placeholder="Race" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Attatch IC</label>
                <div class="col-sm-6">
                  <input type="file" name="upload_file" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-space btn-primary">Submit</button>
                  <a href="<?php echo base_url('IC_Details/update'); ?>" class="btn btn-space btn-default">Cancel</a>
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