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
              <a href="<?php echo base_url('IC_Details/add') ?>" class="btn btn-space btn-success"><i class="fa fa-plus"></i> Add New IC</a>
            </div>
            <table id="table3" class="table table-striped table-bordered table-hover table-fw-widget">
              <thead>
                <tr>
                  <th>IC Number</th>
                  <th>Full Name</th>
                  <th>IC Type</th>
                  <th>Date of Issue</th>
                  <th>Date of Birth</th>
                  <th>Gender</th>
                  <th>Race</th>
                  <th>Country of Brith</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($IC_Details != 0) {
                  $i = 1;
                  foreach ($IC_Details as $row) {
                    echo '<tr>
                    <td>' . $row->ICNumber . '</td>
                    <td>' . $row->FullName . '</td>
                    <td>' . $row->Type . '</td>
                    <td>' . $row->DateOfIssue . '</td>
                    <td>' . $row->DateOfBirth . '</td>
                    <td>' . $row->Gender . '</td>
                    <td>' . $row->Race . '</td>
                    <td>' . $row->CountryOfBirth . '</td>'; ?>
                    <td><a href="<?php echo base_url('IC_Details/') ?>edit/<?php echo $row->ID ?>" class="btn btn-space btn-warning">Edit</a>
                      <a href="<?php echo base_url('IC_Details/') ?>delete/<?php echo $row->ID ?>" onclick="return confirm('Are you sure to delete')" class="btn btn-space btn-danger">Delete</a></td>
                <?php
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