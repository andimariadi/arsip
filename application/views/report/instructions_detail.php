<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">

    </div>
  </div>
</div>

<div class="container-fluid mt--6">
  <?= $this->session->flashdata('msg');?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0"><?= $data_instructions['title'];?></h3>
          <small>Updated at <?= $data_instructions['updated_at'];?></small>
        </div>
        <div class="card-body">
            <hr />
            <?= $data_instructions['description'];?>
        </div>
    </div>
  </div>
</div>
<!-- MODAL BOOTSTRAP SCRIPT -->