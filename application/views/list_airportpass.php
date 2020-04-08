<?php $this->load->view('template/header'); ?>

<div class="mt-5"></div>
<?php $this->load->view('template/card-head'); ?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
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
            <!-- <div class="text-right">
                    <a href="<?php //echo base_url('Docks/add')
                              ?>" class="btn btn-space btn-success"><i class="fa fa-plus"></i> Add Docks</a>
                  </div> -->
            <table id="table3" class="table table-striped table-hover table-bordered table-fw-widget" style="width:100%">
              <thead>
                <tr>
                  <th>Airport Pass Number</th>
                  <th>Name On Airpot Pass</th>
                  <th>Date of Expiry</th>
                  <th>Access Control Areas</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($AirportPass != 0) {
                  $i = 1;
                  foreach ($AirportPass as $row) {
                    echo '<tr>
                    <td>' . $row->PassNumber . '</td>
                    <td>' . $row->FullName . '</td>
                    <td>' . $row->DateOfExpiry . '</td>
                    <td>' . $row->AccessControlAreas . '</td>'; ?>
                    <td><a href="<?php echo base_url('AirportPass/') ?>downloadFile/?filePath= <?php echo $row->Attachments ?>" class="btn btn-info"><i class="fas fa-download"></i>Get Airport Pass</a></td>
                  <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <?php $this->load->view('template/card-foot'); ?>
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