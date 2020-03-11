<?php $this->load->view('template/header'); ?>

<div class="mt-5"></div>
<?php $this->load->view('template/card-head'); ?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary be-loading">
          <h1 class="panel-heading panel-heading-divider my-3"> <?php echo $Title; ?></h1>
          <hr />
          <div class="panel-body">
            <form action="<?php echo base_url('IC_Details/editICDetailsPost'); ?>" class="form-horizontal" method="post">
              <input type="hidden" value="<?php echo $IC_Details->ID ?>" name="IC_id">
              <div class="form-group">
                <label class="col-sm-3 control-label">IC Number</label>
                <div class="col-sm-6">
                  <input type="text" required="" value="<?php echo $IC_Details->ICNumber ?>" name="ICNo" placeholder="IC Number" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">IC Type</label>
                <div class="col-sm-6">
                  <select class="form-control" required="true" name="Type">
                    <option value="">--- Choose IC Type ----</option>
                    <?php
                    foreach ($vtype as $key => $value) {
                      if ($IC_Details->ICTypeID == $value->TypeID) {
                        echo '<option value="' . $value->TypeID . '" selected>' . $value->Type . '</option>';
                      } else {
                        echo '<option value="' . $value->TypeID . '">' . $value->Type . '</option>';
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Full Name</label>
                <div class="col-sm-6">
                  <select class="form-control" required="true" name="fullname">
                    <option value="">--- Choose Employee Name ----</option>
                    <?php
                    foreach ($Users as $key => $value) {
                      if ($IC_Details->FullName == $value->UserUID) {
                        echo '<option value="' . $value->UserUID . '" selected>' . $value->FullName . '</option>';
                      } else {
                        echo '<option value="' . $value->UserUID . '">' . $value->FullName . '</option>';
                      }
                    }
                    ?>
                  </select>
                  <!-- <input type="text" required="" name="fullname" value="<?php echo $IC_Details->FullName ?>" placeholder="Full Name" class="form-control"> -->
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Date of Birth</label>
                <div class="col-sm-6">
                  <input type="date" required="" name="DOB" placeholder="dd/mm/yyyy" class="form-control" value="<?php echo $IC_Details->DateOfBirth ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Country Of Birth</label>
                <div class="col-sm-6">
                  <input type="text" name="Nationality" value="<?php echo $IC_Details->CountryOfBirth ?>" placeholder="Country Of Birth" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Date of Issue</label>
                <div class="col-sm-6">
                  <input type="date" name="DateofIssue" value="<?php echo $IC_Details->DateOfIssue ?>" placeholder="Date of Issue" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Gender</label>
                <div class="col-sm-6">
                  <select class="form-control" required="true" name="Gender">
                    <option value="">--- Choose Gender ----</option>
                    <?php
                    if ($IC_Details->Gender != '') {
                      echo '<option value="' . $IC_Details->Gender . '" selected>' . $IC_Details->Gender . '</option>';
                    } else {
                      echo '<option value="Female">Female</option>';
                      echo '<option value="Male">Male</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Race</label>
                <div class="col-sm-6">
                  <input type="text" name="Race" value="<?php echo $IC_Details->Race ?>" placeholder="Race" class="form-control">
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