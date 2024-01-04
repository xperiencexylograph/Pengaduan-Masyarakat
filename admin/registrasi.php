        <div class="row">
          <div class="col s12 m9">
            <h3 class="orange-text">Masyarakat</h3>
          </div>  
          <div class="col s12 m3">
            <div class="section"></div>
            <a class="waves-effect waves-light btn modal-trigger blue" href="#modal1"><i class="material-icons">add</i></a>
          </div>
        </div>

        <table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
					<th>No</th>
					<th>NIK</th>
					<th>Nama</th>
					<th>Username</th>
					<th>Telp</th>
                	<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM masyarakat ORDER BY nik ASC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nik']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['username']; ?></td>
			<td><?php echo $r['telp']; ?></td>
			<td><a class="btn teal modal-trigger" href="#regis_edit?nik=<?php echo $r['nik'] ?>">Edit</a> <a onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" class="btn red" href="index.php?p=regis_hapus&nik=<?php echo $r['nik'] ?>">Hapus</a></td>

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        

        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>Add</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nik">NIK</label>
					<input id="nik" type="number" name="nik">
				</div>
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="password">Password</label>
					<input id="password" type="password" name="password"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp"><br><br>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="simpan" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['simpan'])){
					$password = md5($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO masyarakat VALUES ('".$_POST['nik']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."')");
					if($query){
						echo "<script>alert('Data Tesimpan')</script>";
						echo "<script>location='location:index.php?p=registrasi';</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>