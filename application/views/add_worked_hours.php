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
            <form action="<?php echo base_url('Employee_Status/addWorkStatus'); ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
              <input type="hidden" required="" name="Employee_Name" value="<?php echo $User_Details->FullName ?>">
              <div class="form-group">
                <label class="col-sm-3 control-label">Date</label>
                <div class="col-sm-6">
                  <input type="text" required="" name="Day" placeholder="Select Date" class="form-control working-day">
                </div>
              </div>
              <!-- <div class="form-group">
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
                  <select class="form-control" required="true" name="ICName">
                    <option value="">--- Choose Employee Name ----</option>
                    <?php
                    foreach ($Users as $key => $value) {
                      echo '<option value="' . $value->UserUID . '">' . $value->FullName . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div> -->
              <div class="form-group">
                <label class="col-sm-3 control-label">Shift Start Time</label>
                <div class="col-sm-6">
                  <input class="form-control day-timepicker" name="ShiftStartTime" id="Time" placeholder="Enter Shift start time">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Shift End Time</label>
                <div class="col-sm-6">
                  <input class="form-control day-timepicker" name="ShiftEndTime" id="Time" placeholder="Enter shift end time">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Break Start Time</label>
                <div class="col-sm-6">
                  <input class="form-control day-timepicker" name="BreakStartTime" id="Time" placeholder="Enter Break start time">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Break End Time</label>
                <div class="col-sm-6">
                  <input class="form-control day-timepicker" name="BreakEndTime" id="Time" placeholder="Enter Break end time">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-space btn-primary">Submit</button>
                  <a href="<?php echo base_url('Employee_Status'); ?>" class="btn btn-space btn-default">Cancel</a>
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

          $('.working-day').datepicker({
            startDate: 'd',
            format: 'dd/mm/yyyy'
          });

          $('.day-timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            dynamic: false,
            dropdown: true,
            scrollbar: true
          });

        });
      </script>