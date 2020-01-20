<?php $this->load->view('template/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/lib/jquery.gritter/css/jquery.gritter.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<style type="text/css">
  .dockslot {
    background-color: #0b53ca;
    display: inline-block;
    width: 10%;
    color: #fff;
    text-align: center;
    height: 60px;
    margin: 0 5px;
    border-radius: 8px;
    padding: 13px;
    cursor: pointer;
    border: 1px dashed #b5b5b5;
  }

  #dockslots-div input[type=checkbox] {
    display: none;
  }

  #dockslots-div input[type=checkbox]:checked+.dockslot {
    background-color: #11ca11;
    color: #fff;
    border: 1px dashed #333;
  }

  #dockslots-div input[type=checkbox]:disabled+.dockslot {
    background-color: #e60606;
    color: #fff;
    border: 1px dashed #333;
  }

  #dockslots-div input[type=checkbox] {
    display: none;
  }

  #dockslots-div input[type=checkbox]:checked+.dockslot_1 {
    background-color: #11ca11;
    color: #fff;
    border: 1px dashed #333;
  }

  #dockslots-div input[type=checkbox]:disabled+.dockslot_1 {
    background-color: #e60606 !important;
    color: #fff;
    border: 1px dashed #333;
  }

  #dockslots-div input[type=checkbox] {
    display: none;
  }

  #dockslots-div input[type=checkbox]:checked+.dockslot_2 {
    background-color: #11ca11;
    color: #fff;
    border: 1px dashed #333;
  }

  #dockslots-div input[type=checkbox]:disabled+.dockslot_1 {
    background-color: #e60606 !important;
    color: #fff;
    border: 1px dashed #333;
  }

  .border-dotted {
    border: 2px dotted #ccc;
    padding: 20px 25px;
  }

  h3.docleg>span::before {
    content: '';
    width: 20px;
    height: 20px;
    display: inline-block;
    background: #444;
  }

  .select2-container {
    width: 100% !important;
  }

  #AvailableDocks {
    position: relative;
  }

  .docklegend {
    display: inline-block;
    width: 35%;
    position: absolute;
    right: 0;
    top: 0;
  }

  .docklegend>span {
    width: 115px;
    display: block;
    float: left;
    font-size: 15px;
  }

  .docklegend>span::before {
    content: '';
    width: 26px;
    display: block;
    height: 13px;
    float: left;
    margin: 4px 5px;
    padding: 0px;
  }

  .docklegend>span.free::before {
    background: #0b53ca;
  }

  .docklegend>span.booked::before {
    background: #e60606;
  }

  .docklegend>span.select::before {
    background: #11ca11;
  }

  .selectDockGroup {
    border: 1px solid #b1e5ef;
    padding: 25px;
    border-radius: 6px;
    background: #effaff;
  }

  .btn:disabled {
    opacity: 0.25;
  }
</style>

<div class="mt-5"></div>
<?php $this->load->view('template/card-head'); ?>


<div class="be-content">
  <div class="main-content container-fluid">

    <div class="row wizard-row">
      <div class="col-md-12 fuelux">

        <h1 class="panel-heading panel-heading-divider my-3"><?= $Title ?> </h1>
        <hr />

        <?php if ($this->session->flashdata('type') == 'done') { ?>
          <div role="alert" class="alert alert-success alert-dismissible">
            <div class="message">
              <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>.
            </div>
          </div>
        <?php } else if ($this->session->flashdata('type') == 'error') { ?>
          <div role="alert" class="alert alert-danger alert-dismissible">
            <div class="message">
              <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Error!</strong> <?php echo $this->session->flashdata('msg'); ?>.
            </div>
          </div>
        <?php } ?>

        <form action="<?= base_url('Booking/save') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label required-star">Full Name</label>
                <input type="text" name="Fullname" data-parsley-trigger="keyup" required="true" id="PONumber" placeholder="Name" class="form-control required">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">Email Id</label>
                <input type="text" name="emailid" placeholder="Email Address" class="form-control">
              </div>
            </div>

          </div>
          <div class="row">

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">IC Number</label>
                <select class="form-control required" required="true" name="DeliveryTo">
                  <option value="">--- Choose IC Number ----</option>
                  <?php
                  foreach ($ICDetails as $key => $value) {
                    echo '<option value="' . $value->ID . '">' . $value->ICNumber . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">Airport Pass Number</label>
                <select class="form-control required" required="true" name="DeliveryTo">
                  <option value="">--- Choose Airport Pass Number ----</option>
                  <?php
                  foreach ($company as $key => $value) {
                    echo '<option value="' . $value->CompanyUID . '">' . $value->ICNo . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-sm-4">
              <label class="control-label required-star">Select Shift Timings : </label>
              <div class="form-group" style="margin-left: 30px;">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="">
                  <label class="form-check-label" for="inlineRadio1">12 Hour Shift</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="">
                  <label class="form-check-label" for="inlineRadio2">9 Hour Shift</label>
                </div>
              </div>
            </div>
          </div>

          <!--Upload file input-->
          <div class="row mt-5">
            <div class="col-sm-4 form-group">
              <label class="control-label">Attatch Documents</label>
              <input type="file" name="upload_file" multiple />
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-sm-8">
              <div class="alert alert-warning font-weight-300" id="mismatchError" style="display:none;">
                <i class="fa fa-info-circle"></i> <span></span>
              </div>

            </div>
          </div>

          <!--  Booking Details -->
          <div class="row mt-4" id="bookingSummary" style="display:none;">
            <div class="col-sm-8">

              <h2 class="text-primary">Booking Summary</h2>
              <table class="table shadow-sm border">
                <thead class="thead-light">
                  <th class="text-primary">No. </th>
                  <th class="text-primary">PO Number / Do </th>
                  <th class="text-primary">Date</th>
                  <th class="text-primary">Time</th>
                </thead>
                <tbody class="list">

                </tbody>
              </table>
            </div>
          </div>

          <!-- Hidden Data -->

          <input type="hidden" name="VType" id="pVType">

          <?php if ($this->session->userdata('Role') == 1) { ?>
            <input type="hidden" value="Internal" name="UserType">
          <?php } else {
            echo '<input type="hidden" name="UserType" value="' . $this->session->userdata('UserType') . '">';
          } ?>

          <input type="hidden" name="Mode" value="<?= $mode[0]->ModeID ?>">

          <input type="hidden" id="SlotNos" name="SlotNos" value="1">

          <!--  Submit Button   -->

          <div class="row mt-4">
            <div class="col-sm-12">
              <div class="col-sm-10" style="padding: 15px 0;">
                <button type="submit" class="btn btn-success btn-lg" id="submitButton" disabled>Confirm & Proceed to Book <i class="fa fa-check-circle fa-big ml-2" style="font-size: 18px; "></i></button>
              </div>
            </div>
          </div>

        </form>
        <div class="be-spinner">
          <svg width="50px" height="50px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle fill="none" stroke-width="5" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
          </svg>
        </div>

      </div>
    </div>
  </div>

  <?php $this->load->view('template/card-foot'); ?>

  <?php $this->load->view('template/footer'); ?>


  <script src="<?php echo base_url(); ?>assets/lib/bootstrap-slider/js/bootstrap-slider.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/lib/jquery.gritter/js/jquery.gritter.js" type="text/javascript"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>



  <script type="text/javascript">
    function isValidDate(dateObject) {
      return new Date(dateObject).toString() !== 'Invalid Date';
    }

    $(document).ready(function() {
      $('form').parsley();
      $.listen('parsley:field:error', function(ParsleyField) {
        ParsleyField.$element.addClass('is-invalid');
      });
      $.listen('parsley:field:success', function(ParsleyField) {
        ParsleyField.$element.removeClass("is-invalid");
      });

      var date = new Date();
      var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());


      $('#Date').datepicker({
        startDate: '+1d',
        format: 'dd/mm/yyyy'
      });


      Date.prototype.addHours = function(h) {
        this.setHours(this.getHours() + h);
        return this;
      }

      var date = new Date();
      var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
      $('.timepicker').datetimepicker({
        startDate: new Date(),
        minTime: 0,
        minView: 1,
        autoclose: !0,
        componentIcon: ".mdi.mdi-calendar",
        navIcons: {
          rightIcon: "mdi mdi-chevron-right",
          leftIcon: "mdi mdi-chevron-left"
        },
      });

    });
  </script>