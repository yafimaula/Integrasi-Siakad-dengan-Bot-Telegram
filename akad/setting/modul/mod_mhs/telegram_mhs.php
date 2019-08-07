<?php 
if ($_GET['code'] == 1){
?>
	<div class='alert alert-success'>
		<h5><i class='fa fa-check'></i>Success!</h5>
		<p>ID Telegram Berhasil di Reset.</p>
	</div>
<?php
}

switch($_GET['act']){
	default:
	
?>
	<div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pvr-wrapper">
                        <div class="pvr-box">
                            <h5 class="pvr-header">
                                Reset ID Telegram
                            </h5>
                            <form action="modul/mod_mhs/aksi_telegram.php?mod=ubah_telegram" method="POST" />
                                <fieldset>
                                    Tombol Dibawah Ini Digunakan Untuk Mereset Ulang ID Telegram Anda Bila Terjadi Kesalahan Seperti Akun Telegram Anda Digunakan Oleh Orang Lain Ketika Mengakses @unipdusiakadbot, dsb. Mohon Gunakan Secara Bijak. Terimakasih<br><br>
                                    <input type="hidden" class="form-control" name="id" id="exampleInputEmail4" value=<?php echo "$_SESSION[id_mhs]"; ?> />
                                    <button type="submit" class="btn btn-red m-r-5">Reset ID Telegram</button>
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