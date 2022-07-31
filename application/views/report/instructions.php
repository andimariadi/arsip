<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">

    </div>
  </div>
</div>

<div class="container-fluid mt--6">
  <?= $this->session->flashdata('msg');?>
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Bantuan</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col" width="5"></th>
                <th scope="col">Title</th>
              </tr>
            </thead>
            <tbody class="list">
              <?php $no=0;foreach ($data_instructions as $value) : $no++;?>
              <tr>
                <th><?= $no;?>.</th>
                <td scope="row">
                  <a href="?detail=<?= $value['id'];?>"><strong><?= $value['title'];?></strong></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php $this->template->pagging(
          array(
            'page_total' => $page_total, 'page' => $page, 'url' => base_url('report/help/?page=')
          )
        );?>
      </div>
    </div>
  </div>
<!-- MODAL BOOTSTRAP SCRIPT -->