<?php 
	session_start();
	include '../conn/koneksi.php';
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	elseif($_SESSION['data']['level'] != "admin"){
		header('location:../index.php');
	}
 ?>
  <!DOCTYPE html>
  <html>
    <head>
    	<title>Aplikasi Pengaduan Masyarakat</title>

    	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    	<link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

      	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      
      	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      
      	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      
      
      	<script type="text/javascript">
        	$(document).ready( function () {
          		$('#example').DataTable();
          		$('select').formSelect();
        	} );
      	</script>

      	<link rel="apple-touch-icon" sizes="76x76" href="../img/favico.ico">

		<link rel="icon" type="image/png" sizes="96x96" href="../img/favicon.ico">

    </head>

    <body style="background:url(../img/bg.jpg); background-size: cover;">

    <div class="row">
      <div class="col s12 m3">
          <ul id="slide-out" class="sidenav sidenav-fixed">
              <li>
                  <div class="user-view">
                      <div class="background">
                          <img src="../img/bg.jpg">
                      </div>
                      <a href="#user"><img class="circle" src="https://cdn5.vectorstock.com/i/1000x1000/01/69/businesswoman-character-avatar-icon-vector-12800169.jpg"></a>
                      <a href="#name"><span class="blue-text name"><?php echo ucwords($_SESSION['data']['nama_petugas']); ?></span></a>
                  </div>
              </li>
              <li><a href="index.php?p=dashboard"><i class="material-icons">dashboard</i>Dashboard</a></li>
              <li><a href="index.php?p=registrasi"><i class="material-icons">featured_play_list</i>Registrasi</a></li>
              <li><a href="index.php?p=pengaduan"><i class="material-icons">report</i>Pengaduan</a></li>
              <li><a href="index.php?p=respon"><i class="material-icons">question_answer</i>Respon</a></li>
              <li><a href="index.php?p=user"><i class="material-icons">account_box</i>User</a></li>
              <li><a href="index.php?p=laporan"><i class="material-icons">book</i>Laporan</a></li>
              <li>
                  <div class="divider"></div>
              </li>
              <li><a class="waves-effect" href="../index.php?p=logout"><i class="material-icons">logout</i>Logout</a></li>
          </ul>

          <a href="#" data-target="slide-out" class="btn sidenav-trigger"><i class="material-icons">menu</i></a>
      </div>

      <div class="col s12 m9">
        
	<?php 
		if(@$_GET['p']==""){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="dashboard"){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="registrasi"){
			include_once 'registrasi.php';
		}
		elseif(@$_GET['p']=="regis_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM masyarakat WHERE nik='".$_GET['nik']."'");
			if($query){
				header('location:index.php?p=registrasi');
			}
		}
		elseif(@$_GET['p']=="pengaduan"){
			include_once 'pengaduan.php';
		}
		elseif(@$_GET['p']=="pengaduan_hapus"){
			$query=mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			$data=mysqli_fetch_assoc($query);
			unlink('../img/'.$data['foto']);
			if($data['status']=="proses"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				header('location:index.php?p=pengaduan');
			}
			elseif($data['status']=="selesai"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				if($delete){
					$delete2=mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
					header('location:index.php?p=pengaduan');
				}	
			}

		}
		elseif(@$_GET['p']=="more"){
			include_once 'more.php';
		}
		elseif(@$_GET['p']=="respon"){
			include_once 'respon.php';
		}
		elseif(@$_GET['p']=="tanggapan_hapus"){
			
			$query = mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_tanggapan='".$_GET['id_tanggapan']."'");
			if($query){
				header('location:index.php?p=respon');
			}
		}
		elseif(@$_GET['p']=="user"){
			include_once 'user.php';
		}
		elseif(@$_GET['p']=="user_input"){
			include_once 'user_input.php';
		}
		elseif(@$_GET['p']=="user_edit"){
			include_once 'user_edit.php';
		}
		elseif(@$_GET['p']=="user_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM petugas WHERE id_petugas='".$_GET['id_petugas']."'");
			if($query){
				header('location:index.php?p=user');
			}
		}
		elseif(@$_GET['p']=="laporan"){
			include_once 'laporan.php';
		}
	 ?>

      </div>


    </div>

      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

      <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.sidenav');
          var instances = M.Sidenav.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.modal');
          var instances = M.Modal.init(elems);
        });

      </script>

    </body>
</html>