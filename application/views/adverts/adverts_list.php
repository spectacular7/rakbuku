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
                        <h2>Tables <strong>adverts</strong></h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <!-- <li><a href="dashboard.html">Make</a></li> -->
                                <li><a href="tables.html">Home</a></li>
                                <li class="active">adverts</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 portlets">
                            <div class="panel">
                                <div class="panel-header panel-controls">
                                    <br>

                                    <?php
                                        if ($this->session->userdata('is_admin') == TRUE) {
                                            echo anchor(site_url('adverts/create'),'<i class="fa fa-plus"></i> Create', 'class="btn btn-success btn-rounded"'); 
                                        }
                                    ?>
                                    <div style="margin-top: 8px" id="message">
                                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                    </div>
                                </div>
                                <div class="panel-content">
                                    <table class="table table-hover table-dynamic">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                        		<th>Stores Id</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                        		<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($adverts_data as $adverts){ ?>
                                                <tr>
                                        			<td width="80px"><?php echo $no++ ?></td>
                                        			<td><?php echo $adverts->stores_id ?></td>
                                                    <td><?php echo $adverts->date_of_order ?></td>
                                                    <td><?php echo $adverts->date_of_com ?></td>
                                        			<td style="text-align:center" width="200px">
                                        				<?php 
                                                        echo anchor(site_url('adverts/read/'.$adverts->adverts_id),'Read'); 
                                                        if ($this->session->userdata('is_admin') == TRUE) {
                                                        echo ' | '; 
                                                            echo anchor(site_url('adverts/update/'.$adverts->adverts_id),'Update'); 
                                                            echo ' | ';     
                                                            echo anchor(site_url('adverts/delete/'.$adverts->adverts_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                                                        }
                                        				?>
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
       </section>
       <div class="modal fade" id="full-colored" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content bg-primary">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title">Full <strong>Colored</strong></h4>
                </div>
                <div class="modal-body">
                  <p class="m-t-40">Apakah anda yakin akan menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  <!-- <button type="button" class="btn btn-dark" data-dismiss="modal">Delete</button> -->
                    <?php 
                        echo anchor(site_url('adverts/delete/'.$adverts->adverts_id),'Delete',' class="btn btn-dark" '); 

                    ?>
                </div>
              </div>
            </div>
          </div>
        <?php $this->load->view('lib/footer')?>
    </body>
</html>    
