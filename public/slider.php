<div class="top-profiles">
	<div class="pf-hd">
		<h3>Top Profiles</h3>
		<i class="la la-ellipsis-v"></i>
	</div>
	<div class="profiles-slider">
		<?Php 
		$query = $koneksi->query("SELECT * FROM tb_user");
		while ($user = $query->fetch_array()) {

			if ($user['kode' != @$_SESSION['user']['kode']]) {
												
		?>
		<div class="user-profy">
		<?php 
			if ($user['foto'] != "") {
				echo "<img src='profile/" . $user['foto'] . "' width='57' height='57' />";
				 }else {
				echo "<img src='profile/user.jpeg' width='57' height='57' />";
				}
			?>
		<h3><?php echo $user['nama_user']; ?> </h3>
		<span>
			<?php if ($user['pekerjaan'] != ""){
				echo $user['pekerjaan'];
			} else {
				echo "-";
			} ?>
			</span>
		<ul>
			<li><a href="#" title="" class="envlp"><img src="images/envelop.png" alt=""></a></li>
			<li><a href="#" title="" class="hire">hire</a></li>
		</ul>
		<ul>
				<li>
					<?php 
				$follower = @$_SESSION['user']['kode'];
				$following = $user['kode'];
				$follow_connect = $koneksi->query("SELECT * FROM tb_user_follow WHERE kode = '$follower' AND following = '$following'");
				$follow_count = $follow_connect->num_rows;
				?>
				<li>
					<form action="" method="post">
							<input type="hidden" name="id" value="<?php echo $following; ?>">
						<?php 
						if ($follow_count > 0) {
							echo '<button><a href="unfollow.php?kode=' . $user['kode'] . '" title="" class="follow bg-secondary">Unfollow</a></button>';
						}else {
							echo"<input type='submit' class='followw p-1 rounded text-light' style='cursor:pointer' name='sub' value='Follow'>";
						}
						?>
					</form>
				</li>
			</li>														
		</ul>
		<a href="#" title="">View Profile</a>
	</div><!--user-profy end-->
	<?php 
	$tz = 'Asia/Jakarta';
	$dt = new DateTime("now", new DateTimeZone($tz));
	$date = $dt->format("Y-m-d G:i:s"); // 2018-0
	$id = @$_POST['id'] ?? "";
	$sub = $_POST['sub'] ?? "";
												
	if ($sub) {
		$state = $koneksi->query("INSERT INTO tb_user_follow (kode, following, subscribed) VALUES('$follower', '$id', '$date')");
		

		if ($state) {
			echo "<script> location='index.php'</script>";
			exit();
			}
		}
	  }
	}
	?>
												
</div><!--profiles-slider end-->