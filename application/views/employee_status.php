<?php $this->load->view('template/header'); ?>

<div class="mt-5"></div>
<?php $this->load->view('template/card-head'); ?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider"><?PHP echo $Title; ?></div>
          <div class="panel-body">
            <?php if ($this->session->flashdata('done')) { ?>
              <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
                <div class="icon"><span class="mdi mdi-check"></span></div>
                <div class="message">
                  <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Success!</strong> <?php echo $this->session->flashdata('done'); ?>.
                </div>
              </div>
            <?php } ?>
            <div class="text-right">
              <a href="<?php echo base_url('Employee_Status/addWorkedHours') ?>" class="btn btn-space btn-success"><i class="fa fa-plus"></i> Add Worked Hours</a>
            </div>
            <table id="table3" class="table table-striped table-bordered table-hover table-fw-widget" style="width: 100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Employee Name</th>
                  <th>Date</th>
                  <th>Work Start Time</th>
                  <th>Break Start Tme</th>
                  <th>Break End Time</th>
                  <th>Work End Time</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($Employee_Status_Details != 0) {
                  $i = 1;
                  foreach ($Employee_Status_Details as $row) {
                    echo '<tr>
                    <td>' . $i++ . '</td>
                    <td>' . $row->EmployeeName . '</td>
                    <td>' . $row->Date . '</td>
                    <td>' . $row->StartTime . '</td>
                    <td>' . $row->BreakStartTime . '</td>
                    <td>' . $row->BreakEndTime . '</td>
                    <td>' . $row->EndTime . '</td>
                    <td>
                      <a href="' . base_url('Employee_Status/ApproveStatus/' . $row->StatusID) . '" class="btn btn-space btn-sm  btn-info"><i class="icon icon-left mdi mdi-check"></i> Approve</a>
                      <a href="' . base_url('Employee_Status/Reject/' . $row->StatusID) . '" class="btn btn-space btn-sm btn-danger"><i class="icon icon-left mdi mdi-close"></i> Reject</a>
                    </td> 
                   </tr>';
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view('template/footer'); ?>
    <script src="<?php echo base_url(); ?>assets/lib/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/datatable.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/lib/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(document).ready(function() {

        $("#table3").dataTable({
          scrollX: true,
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
          dom: "Bfrtip"
        });

        $('.buttons-html5').addClass('btn btn-default');
      });
    </script>