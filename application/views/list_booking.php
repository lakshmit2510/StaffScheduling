<?php $this->load->view('template/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/lib/daterangepicker/css/daterangepicker.css" />
<style type="text/css">
  /*table.dataTable, .DTFC_RightBodyLiner td { background-color: white; }
.DTFC_RightHeadWrapper, .DTFC_RightBodyWrapper { width: 100%; }
.DTFC_RightBodyLiner { overflow: hidden !important; }
.DTFC_RightWrapper{ right: -10px !important; }*/
</style>

<div class="mt-5"></div>
<?php $this->load->view('template/card-head'); ?>

<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary be-loading">
          <h1 class="panel-heading panel-heading-divider my-3"><?= $Title ?></h1>
          <hr />
          <div class="panel-body">
            <?php if ($this->session->flashdata('done')) { ?>
              <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
                <div class="icon"><span class="mdi mdi-check"></span></div>
                <div class="message">
                  <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Success!</strong> <?php echo $this->session->flashdata('done'); ?>.
                </div>
              </div>
            <?php } ?>

            <?php if ($this->session->flashdata('error')) { ?>
              <div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible">
                <div class="icon"><span class="mdi mdi-close"></span></div>
                <div class="message">
                  <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>.
                </div>
              </div>
            <?php } ?>
            <div class="row">
              <div class="form-group col-sm-4">
                <label class="col-sm-6 control-label">Select Week/ Month</label>
                <div class="col-sm-9">
                  <!-- <input data-bind="daterangepicker: dateRange3,daterangepickerOptions: {single: true}" class="form-control weekMonthPicker" /> -->
                  <input name="" type="text" value="<?php echo date('m/d/Y', strtotime('-7 days')) . ' - ' . date('m/d/Y') ?>" placeholder="number" class="form-control weekMonthPicker">
                </div>
              </div>

              <div class="form-group col-sm-4">
                <label class="col-sm-6 control-label">Select Schedule</label>
                <div class="col-sm-9">
                  <select class="form-control required" required="true" name="ShiftTimings">
                    <option value="">--- Choose Schedule Timing ----</option>
                    <?php
                    foreach ($shiftDetails as $key => $value) {
                      echo '<option value="' . $value->ShiftID . '">' . ($value->StartTime) . ' - ' . ($value->EndTime) . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>

            </div>
            <div class="table-responsive">
              <!-- <div class="text-right">
                <a href="<?php echo base_url('Booking/add') ?>" class="btn btn-space btn-success"><i class="fa fa-plus"></i> Add New Booking</a>
              </div> -->
              <table id="table3" class="table table-striped table-hover table-bordered table-fw-widget nowrap">
                <thead>
                  <tr>
                    <!-- <th width="90"># Job Order No</th> -->
                    <th>Employee Name</th>
                    <!-- <th>Email Id</th> -->
                    <th>IC Number</th>
                    <!-- <th>Airport Pass Number</th> -->
                    <th width="230">Action</th>
                  </tr>
                </thead>
                <!-- <tbody>
                  <?php
                  if ($booking != 0) {
                    foreach ($booking as $row) {
                      echo '<tr>
                        
                        <td>' . $row->FullName . '</td> 
                        <td>' . $row->ICNumber . '</td>
                        <td>' . ($row->StartDate) . ' - ' . ($row->EndDate) . '</td>'; ?>
                      <td class="center">
                          <?php if (!in_array($this->session->userdata('Role'), array(5, 6))) {
                          ?>
                            <a href="<?php echo base_url('Booking/') ?>cancel/<?php echo $row->BookingID; ?>" class="btn btn-space btn-danger" onclick="return confirm('Are you sure to Cancel Booking ?')"><i class="icon icon-left mdi mdi-close"></i> Cancel</a>
                            <a href="<?php echo base_url('Booking/Sendmail/' . $row->BookingID); ?>" class="btn btn-space btn-primary btn-loader"><i class="icon icon-left mdi mdi-email"></i> Email</a>
                          <?php }
                          ?>
                          <a href="<?php echo base_url('Booking/BPrint/' . $row->BookingRefNo) ?>" class="btn btn-space btn-success btn-loader"><i class="icon icon-left mdi mdi-print"></i> Print</a>
                          <a href="<?php echo base_url('Booking/editBooking/' . $row->BookingID); ?>" class="btn btn-space btn-primary btn-loader"><i class="icon icon-left mdi mdi-edit"></i> Edit</a>
                        </td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody> -->
              </table>
            </div>
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
      <script src="<?php echo base_url(); ?>assets/lib/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url('assets/js/datatable.js'); ?>" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/lib/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url(); ?>assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js" type="text/javascript"></script>
      <script src="<?php echo base_url() ?>assets/lib/daterangepicker/js/daterangepicker.js" type="text/javascript"></script>


      <script type="text/javascript">
        $(document).ready(function() {

          $('.weekMonthPicker').change(function() {
            var daterange = $('.weekMonthPicker').val();
            // $.ajax({
            //   type: 'POST',
            //   url: 'getAvailableDocks',
            //   data: datas,
            //   success: function(data) {
            //   }
            // });
          });

          $('.btn-loader').click(function() {
            $('.be-loading').addClass('be-loading-active');
          });

          $('.weekMonthPicker').daterangepicker();

          $("#table3").dataTable({

            buttons: ["copy",
              {
                extend: 'excel',
                className: 'btn btn-default',
                exportOptions: {
                  columns: ['th:not(:last-child)']
                }
              }, "pdf"
            ],
            lengthMenu: [
              [10, 25, 50, -1],
              [6, 10, 25, 50, "All"]
            ],
            dom: "Bfrtip",
            'scrollX': '500px',
            'scrollCollapse': true,
            'fixedColumns': {
              'leftColumns': 1,
              'rightColumns': 1
            },
            "order": [], //Initial no order.
            "bSorting": [],
            "pageLength": 20
          });

          $('.buttons-html5').addClass('btn btn-default');
        });
      </script>