<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-danger'>
		<h5><i class="fa fa-ban"></i>Failed!</h5>
		<p>Password lama Anda salah.</p>
	</div>
<?php
}
if ($_GET['code'] == 2){
?>
	<div class='alert alert-danger'>
		<h5><i class="fa fa-ban"></i>Failed!</h5>
		<p>Password Baru dan Re-type password tidak cocok.</p>
	</div>
<?php
}
if ($_GET['code'] == 3){
?>
	<div class='alert alert-info'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>Password berhasil diubah.</p>
	</div>
<?php
}
?>
<?php
switch($_GET['act']){
	default:
	
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Ubah Password
                                <div class="pvr-box-controls">
                                    <i class="material-icons" data-box="refresh" data-effect="win8_linear">refresh</i>
                                    <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                </div>
                            </h5>
                            <form action="modul/mod_user/aksi_password.php?mod=ubah_password" method="POST" />
                                <fieldset>
                                  <div class="row">
                                     <div class="col-sm-12">
                                		<div class="form-group">
	                                        <label for="exampleInputEmail4">Password Lama</label>
	                                        <input type="password" class="form-control" name="pass_lama" id="exampleInputEmail4" />
	                                    </div>
                                     </div>
                                   </div>
                                   <div class="row">
                                	<div class="col-sm-6">
                                		<div class="form-group">
	                                        <label for="exampleInputEmail4">Password Baru</label>
	                                        <input type="password" class="form-control" name="pass_baru" id="exampleInputEmail4" />
	                                    </div>
                                     </div>
                                     <div class="col-sm-6">
                                     	<div class="form-group">
	                                        <label for="exampleInputEmail4">Ketik Ulang Password Baru</label>
	                                        <input type="password" class="form-control" name="pass_baru2" id="exampleInputEmail4" />
	                                    </div>
                                     </div>
                                   </div>
                                    <button type="submit" class="btn btn-purple m-r-5">Save</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
<?php

	break;
}
?>