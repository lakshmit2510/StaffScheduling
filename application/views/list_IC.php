<?php $this->load->view('template/header'); ?>

<div class="mb-6"></div>
<?php $this->load->view('template/card-head'); ?>

<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default panel-border-color panel-border-color-primary">
      <div class="panel-heading panel-heading-divider"><?PHP echo $Title; ?></div>
      <div class="panel-body">
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
                <td><a href='<?php echo base_url('IC_Details/') ?>downloadFile/?filePath=<?php echo $row->AttachedFiles ?>' target='_blank' class="btn btn-info"><i class="fas fa-download"></i>Get IC</a></td>
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

<?php $this->load->view('template/card-foot'); ?>

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