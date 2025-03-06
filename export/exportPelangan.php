<?php
require "../include/function.php";

?>
<html>
<head>
  <title>Cetak Pelangan</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2>Cetak Pelangan</h2>
			<h4>(Inventory)</h4>
				<div class="data-tables datatable-dark">
					
                <table id="tabel-data-pelangan" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Pelangan</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                          </tr>
                      </thead>
                      <tbody>

                          <?php
                            $get = mysqli_query($connection,"SELECT nama_pelangan, alamat, no_telep FROM tbl_pelangan");
                            $i = 1; //penomoran

                            while($pelangan=mysqli_fetch_array($get)){
                            $namaPelangan = $pelangan['nama_pelangan'];
                            $alamat = $pelangan['alamat'];
                            $noTelepon = $pelangan['no_telep'];

                          ?>
                          <tr>
                              <td><?php echo $i++;?></td>
                              <td><?php echo $namaPelangan;?> </td>
                              <td><?php echo $alamat;?></td>
                              <td><?php echo $noTelepon;?></td>
                            
                          </tr>  

                          <?php
                            };//end of while                              
                            ?>

                      </tbody>
                    </table>  
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#tabel-data-pelangan').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>