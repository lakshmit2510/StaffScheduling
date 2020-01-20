<?php $this->load->view('template/header'); 
$Activeusr = $this->Dashboard_model->GetUserCount('Active');
$InActiveusr = $this->Dashboard_model->GetUserCount('In-Active');
?>

<!-- Card stats -->
<div class="row mb-5 pt-7">
  <div class="col-xl-3 col-lg-6">
    <a href="<?=base_url('Booking/Add')?>" class="card card-hover card-stats mb-4 mb-xl-0">
      <div class="card-body">
      <h5 class="card-title">Card title</h5>
        <div class="row pt-3 pb-3">
          <div class="col">
            <span class="h2 font-weight-bold">New Dock Booking</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape text-success">
              <i class="fas fa-calendar-check"></i>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-xl-3 col-lg-6">
    <a href="<?=base_url()?>" class="card card-hover card-stats mb-4 mb-xl-0">
      <div class="card-body">
        <div class="row pt-3 pb-3">
          <div class="col">
            <span class="h2 font-weight-bold">Manage IC Details</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape text-info">
              <i class="fas fa-id-card"></i>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-xl-3 col-lg-6">
    <a href="<?=base_url('AirportPass')?>" class="card card-hover card-stats mb-4 mb-xl-0">
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
  
<div class="row">
  <div style="background: #F3F3F3;width:100%;height:400px;display: flex;justify-content: center;align-items: center;border:2px solid #E2E2E2;">Content / Advertisement Comes Here</div>
</div>

  
<?php $this->load->view('template/footer'); ?>

<script type="text/javascript">
 $(document).ready(function()
 {


 }); 
</script>
