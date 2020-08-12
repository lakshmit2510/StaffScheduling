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
                        <div class="text-right">
                            <a href="<?php echo base_url('License_Details/add') ?>" class="btn btn-space btn-success"><i class="fa fa-plus"></i> Add </a>
                        </div>
                        <table id="table3" class="table table-striped table-hover table-bordered table-fw-widget" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>ADP Holders Name</th>
                                    <th>License Number</th>
                                    <th>License Type</th>
                                    <th>License Sub Category</th>
                                    <th>License Issue Date</th>
                                    <th>License Expiry Date</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($License_Details != 0) {
                                    $i = 1;
                                    foreach ($License_Details as $row) {
                                        echo '<tr>
                                        <td>' . $i++ . '</td>
                                        <td>' . $row->StaffName . '</td>
                                        <td>' . $row->LicenseNumber . '</td>
                                        <td>' . $row->LicenseType . '</td>
                                        <td>' . $row->LicenseSubType . '</td>
                                        <td>' . $row->IssueDate . '</td>
                                        <td>' . $row->ExpiryDate . '</td>'; ?>
                                        <!-- <td>
                                            <a href="<?php echo base_url('License_Details/') ?>downloadFile/?filePath= <?php echo $row->Attachments ?>" class="btn btn-info"><i class="fas fa-download"></i>Get Airport Pass</a>
                                        </td> -->
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