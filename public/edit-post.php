<?php
@session_start();
if  (@$_SESSION['user']) {


?>

<!DOCTYPE html>
<html >

<?php include "head.php";?>

<body>
	

	<div class="wrapper">
		
		<?php include 'header.php'; ?>

		

		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-3 col-md-4 pd-left-none no-pd">
								<?php include 'sidebar.php'; ?>
							</div>
							<div class="col-lg-9 col-md-8 no-pd">
								<div class="main-ws-sec">
                                <div class="posts-section">
										
										<div class="post-bar">
											
											
											<div class="job_descp">
												<h3 class="mt-3 text-center">UPDATE POST</h3>

                                                <?php
                                                
												$id = @$_GET['id'];
                                                 $update = $koneksi->query("SELECT * FROM tb_pengaduan WHERE id_pengaduan='$id'");
                                                 $hasil = $update->fetch_array();

                                                 ?>

                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="judul_post" placeholder="judul pengaduan" value="<?php echo $hasil['judul_pengaduan']; ?>" >
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea type="text" class="form-control" name="isi_post" value="" placeholder="Isi Pengaduan"><?php echo $hasil['isi_pengaduan']; ?> </textarea>
                                                    </div>
                                                    
													<?php 
													if ($hasil['gambar_pengaduan'] != "") {
														echo "<img class='mb-3 img-thumbnail col-lg-12' src='foto/" . $hasil['gambar_pengaduan'] . "' width='100' height='100' />";
												  	}else {
														echo "";
												  }
												?>
													<div class="form-group">
														<input type="file" name="foto" class="form-control">
													</div>

                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary" name="tombol" value="update post">
                                                    </div>

                                                </form>
												<?php 
												$judul_post = @$_POST['judul_post'];
												$isi_post = @$_POST['isi_post'];

												$foto = @$_FILES['foto']['name'];
												$asalFoto = @$_FILES['foto']['tmp_name'];
												$directory = 'foto/';


												$tombol = @$_POST['tombol'];

												if ($tombol) {
													if ($hasil['gambar_pengaduan'] != ""){
														move_uploaded_file($asalFoto, $directory . $foto);
													
													$update = $koneksi->query("UPDATE tb_pengaduan SET judul_pengaduan='$judul_post', isi_pengaduan='$isi_post',gambar_pengaduan='$foto' WHERE id_pengaduan='$id'");

													if ($update) {
														unlink("foto/" . $hasil['gambar_pengaduan']);
														echo "<script>alert('Data berhasil Diupdate'); location='index.php';</script>";
													}else {
														echo "<script>alert('Data Gagal Diupdate')</script>";
													}
												} else {
													move_uploaded_file($asalFoto, $directory . $foto);
													
													$update = $koneksi->query("UPDATE tb_pengaduan SET judul_pengaduan='$judul_post', isi_pengaduan='$isi_post',gambar_pengaduan='$foto' WHERE id_pengaduan='$id'");

													if ($update) {
														echo "<script>alert('Data berhasil Diupdate'); location='index.php';</script>";
													}else {
														echo "<script>alert('Data Gagal Diupdate')</script>";
													}
												}
											}
												
											?>
                                            </div>
										</div>
										
									</div><!--posts-section end-->
								</div><!--main-ws-sec end-->
							</div>
						</div>
					</div><!-- main-section-data end-->
				</div> 
			</div>
		</main>

       <?php include "footer.php"; ?>

	</div><!--theme-layout end-->

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/scrollbar.js"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>

<?php
} else {
    echo "<script>location='../login.php'</script>";
}
?>