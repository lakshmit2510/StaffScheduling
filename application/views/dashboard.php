<?php $this->load->view('template/header');
$Activeusr = $this->Dashboard_model->GetUserCount('Active');
$InActiveusr = $this->Dashboard_model->GetUserCount('In-Active');
?>
<div class="mt-5">
  <button type="button" style="float: right;" class="btn btn-warning" data-toggle="modal" data-target="#addShiftModal"><i class="fa fa-plus"></i> New Shift Timings</button>
</div>
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
        <form>
          <div class="form-group">
            <label for="avaialableBookingsField">Available Bookings</label>
            <input type="number" class="form-control" name="Bookingscount" id="avaialableBookingsField" aria-describedby="availableBookingsHelp" placeholder="Enter available bookings">
            <small id="availableBookingsHelp" class="form-text text-muted">Please enter the no of bookings available.</small>
          </div>
          <div class="form-group">
            <label for="startTime">Start Time</label>
            <input class="form-control timepicker" name="StartTime" id="startTime" placeholder="Enster start time">
          </div>
          <div class="form-group">
            <label for="endTime">End Time</label>
            <input class="form-control timepicker" name="Endtime" id="endTime" placeholder="Enter end time">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Card stats -->
<div class="row mb-5 pt-5">
  <div class="col-xl-3 col-lg-6 card">
    <div>
      <a style="float:right" href="<?= base_url('') ?>"><i style="float: right;" class="fas fa-times"></i></a>
      <a style="float:left; margin-right:10px" href="<?= base_url('') ?>"><i class="far fa-edit"></i>edit</a>
    </div>
    <div class="card-body">
      <div>
        <h3 class="card-title">Available Bookings (22)</h3>
      </div>
      <div class="row pt-3 pb-3">
        <div class="col">
          <span class="h2 font-weight-bold">05:00 AM - 09:00 AM</span>
        </div>
      </div>
      <a style="margin-left: 50px;" href="<?= base_url('Booking/Add') ?>">Start Booking</a>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6">
    <a href="<?= base_url('Booking/Add') ?>" class="card card-hover card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <h3 class="card-title">Available Bookings (4)</h3>
        <div class="row pt-3 pb-3">
          <div class="col">
            <span class="h2 font-weight-bold">09:00 AM - 21:00 PM</span>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-xl-3 col-lg-6">
    <a href="<?= base_url('AirportPass') ?>" class="card card-hover card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <div class="row pt-3 pb-3">
          <div class="col">
            <span class="h2 font-weight-bold">Manage Airport Pass Details</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape text-warning">
              <i class="fas fa-id-card"></i>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>

<!-- <div class="row">
  <div style="background: #F3F3F3;width:100%;height:400px;display: flex;justify-content: center;align-items: center;border:2px solid #E2E2E2;">Content / Advertisement Comes Here</div>
</div> -->


<?php $this->load->view('template/footer'); ?>

<script type="text/javascript">
  $(document).ready(function() {
    $('.timepicker').timepicker({
      timeFormat: 'h:mm p',
      interval: 60,
      // minTime: '10',
      // maxTime: '6:00pm',
      // defaultTime: '11',
      // startTime: '10:00',
      dynamic: false,
      dropdown: true,
      scrollbar: true
    });

  });
</script>