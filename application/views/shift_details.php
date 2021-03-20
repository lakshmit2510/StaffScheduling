<?php $this->load->view('template/header');
$Activeusr = $this->Dashboard_model->GetUserCount('Active');
$InActiveusr = $this->Dashboard_model->GetUserCount('In-Active');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/lib/daterangepicker/css/daterangepicker.css" />

<style>
  @media only screen and (max-width: 450px) {
    .shift-card-styles {
      display: flex;
      flex-direction: column;
      width: 300px;
    }
  }

  .outer-card-styles {
    -webkit-box-shadow: 0px 5px 11px 0px rgba(111, 126, 204, 1);
    -moz-box-shadow: 0px 5px 11px 0px rgba(111, 126, 204, 1);
    box-shadow: 0px 5px 11px 0px rgba(111, 126, 204, 1);
  }

  .card-header-styles {
    text-align: center;
    background: #6f7ecc;
    color: #ffffff;
  }

  .inner-card-styles {
    margin: 1rem;
    -webkit-box-shadow: 0px 5px 16px -5px rgba(111, 126, 204, 1);
    -moz-box-shadow: 0px 5px 16px -5px rgba(111, 126, 204, 1);
    box-shadow: 0px 5px 16px -5px rgba(111, 126, 204, 1);
  }
</style>

<?php if (!in_array($this->session->userdata('Role'), array(2))) { ?>
  <div class="mt-5">
    <button type="button" style="float: right;" class="btn btn-warning" data-toggle="modal" data-target="#addShiftModal"><i class="fa fa-plus"></i> New Shift Timings</button>
  </div>
<?php } ?>

<div class="modal fade" id="addShiftModal" tabindex="-1" role="dialog" aria-labelledby="addShiftModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Shift Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="booking-form">
          <div class="form-group">
            <label for="avaialableBookingsField">Number Of Employees </label>
            <input type="number" class="form-control" name="Bookingscount" id="avaialableBookingsField" aria-describedby="availableBookingsHelp" placeholder="Employees Count">
            <small id="availableBookingsHelp" class="form-text text-muted">Please enter the required employees count.</small>
          </div>
          <div class="form-group">
            <label class="control-label">Select Week/ Month</label>
            <input name="ProjectDate" type="text" value="<?php echo date('m/d/Y', strtotime('-7 days')) . ' - ' . date('m/d/Y') ?>" placeholder="number" class="form-control weekMonthPicker">
          </div>
          <div class="form-group">
            <label for="startTime">Start Time</label>
            <input class="form-control timepicker" name="StartTime" id="startTime" placeholder="Enter start time">
          </div>
          <div class="form-group">
            <label for="endTime">End Time</label>
            <input class="form-control timepicker" name="Endtime" id="endTime" placeholder="Enter end time">
          </div>
          <div class="form-group">
            <label for="endTime">Project Name</label>
            <select class="form-control" required="true" id="projectId" name="ProjectID">
              <option value="">--- Choose Project Name ----</option>
              <?php
              foreach ($Projects as $key => $value) {
                echo '<option value="' . $value->ProjectCode . '">' . $value->ProjectName . '</option>';
              }
              ?>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-booking">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Card stats -->
<div style="padding-top: 120px !important;flex-direction: column;">
  <?php foreach ($Projects as $key => $value) { ?>
    <div class="card outer-card-styles mb-3">
      <div class="card-header card-header-styles"><?php echo $value->ProjectName; ?></div>
      <div class="card-body">
        <div class="row shift-card-styles">
          <?php
          $isExists = false;
          foreach ($Shifts as $value1) {
            if ($value1->ProjectID === $value->ProjectCode) {
              $isExists = true;
          ?>
              <div class="col-xl-3 col-lg-6 card mt-3 mb-4 inner-card-styles">
                <?php if (!in_array($this->session->userdata('Role'), array(2))) { ?>
                  <div class="card-header">
                    <a href="<?php echo base_url('Shifts/') ?>deleteShifts/<?php echo $value1->ShiftID ?>" onclick="return confirm('Are you sure to delete')"><i style="float: right;" class="fas fa-times"></i></a>
                    <a href="<?= base_url('Shifts/') ?>editShiftDetails/<?php echo $value1->ShiftID ?>"><i class="far fa-edit"></i>edit</a>
                  </div>
                <?php } ?>

                <div class="card-body">
                  <div>
                    <h3 class="card-title">Available Bookings (<?php echo $value1->AvailableBookings ?>)</h3>
                  </div>
                  <div class="row pt-3 pb-3">
                    <div class="col">
                      <span class="h2 font-weight-bold"><?php echo $value1->StartTime ?> - <?php echo $value1->EndTime ?></span>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
          }
          if (!$isExists) { ?>
            <div>No Shifts Added for this Project</div>
          <?php }
          ?>
        </div>
      </div>
    </div>

  <?php } ?>
</div>


<?php $this->load->view('template/footer'); ?>
<script src="<?php echo base_url() ?>assets/lib/daterangepicker/js/daterangepicker.js" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.weekMonthPicker').daterangepicker();

    $('.timepicker').timepicker({
      timeFormat: 'HH:mm',
      interval: 60,
      dynamic: false,
      dropdown: true,
      scrollbar: true
    });

    $('.save-booking').on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      console.log($('#booking-form').serialize())
      $.ajax({
        type: 'post',
        url: '<?php echo base_url('Shifts/addShiftsPost/') ?>',
        data: $('#booking-form').serialize(),
        success: function(res) {
          console.log(res);
          window.location.reload();
        }
      });
    });

  });
</script>