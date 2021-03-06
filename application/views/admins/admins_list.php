<!DOCTYPE html>
<html class="" lang="en">
    <head>
        <?php $this->load->view('lib/head')?>
    </head>
    <body class="fixed-topbar theme-sdtl fixed-sidebar color-blue bg-light-dark">
        <section>
            <?php $this->load->view('lib/sidebar')?>
            <!-- END MAIN CONTENT -->
            <div class="main-content">
                <?php $this->load->view('lib/topbar')?>
                <div class="page-content">
                    <div class="header">
                        <h2>Halaman <strong>Admin</strong></h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <!-- <li><a href="dashboard.html">Make</a></li> -->
                                <li><a href="<?php echo site_url('Admins/dashboard') ?>">Beranda</a></li>
                                <li class="active">Admin</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 portlets">
                            <div class="panel">
                                <div class="panel-header panel-controls">
                                    <br>
                                    <?php echo anchor(site_url('admins/create'),'<i class="fa fa-plus"></i> Tambah', 'class="btn btn-success btn-rounded"'); ?>
                                    <div style="margin-top: 8px" id="message">
                                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                    </div>
                                </div>
                                <div class="panel-content">
                                    <table class="table table-hover table-dynamic">
                                        <thead>
                                            <tr>
                                                <th width="80px">No</th>
                                                <th>Username</th>
                                                <th>Nama</th>
                                                <th>Role</th>
                                                <th width="200px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($admins_data as $admins){ ?>
                                                <tr>
                                                    <td class="center"><?php echo $no++ ?></td>
                                                    <td><?php echo $admins->username ?></td>
                                                    <td><?php echo $admins->name ?></td>
                                                    <td><?php echo $admins->role=='0' ? 'admin' : 'super admin' ?></td>
                                                    <td>
                                                        <div class="hidden-sm hidden-xs action-buttons">
                                                            <a href="#full-colored" data-toggle="modal">Hapus</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- END PAGE CONTENT -->
                </div>
                <!-- END MAIN CONTENT -->
            </div>
          <!-- END MODALS -->
       </section>
       <div class="modal fade" id="full-colored" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content bg-primary">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title">Konfirmasi <strong>Hapus Data</strong></h4>
                </div>
                <div class="modal-body">
                  <p class="m-t-40">Apakah anda yakin akan menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <?php echo anchor(site_url('admins/delete/'.$admins->admins_id),'Ya</i>',' class="btn btn-dark" '); ?>
                  <button type="button" class="btn btn-white" data-dismiss="modal">Tidak</button>
                  <!-- <button type="button" class="btn btn-dark" data-dismiss="modal">Delete</button> -->
                    
                </div>
              </div>
            </div>
          </div>
        <?php $this->load->view('lib/footer')?>
    </body>
</html>        