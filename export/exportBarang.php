<?php
require "../include/function.php";

?>
<html>
<head>
  <title>Cetak Barang</title>
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
			<h2>Cetak Barng</h2>
			<h4>(Inventory)</h4>
				<div class="data-tables datatable-dark">
					
        <table id="tabel-data-barang" class="table table-striped table-bordered" width="100%" cellspacing="0">
                  <thead>
                        <tr>
                          <th>Kode Produk</th>
                          <th>Nama Produk</th>
                          <th>Harga</th>
                        </tr>
                  </thead>
                      <tbody>
                      <?php
                          $get = mysqli_query($connection,"SELECT * FROM tbl_barang");
                        

                          while($barang=mysqli_fetch_array($get)){
                          $kodeBarang = $barang['id_barang'];
                          $namaBarang = $barang['nama_barang'];
                          $harga = $barang['harga'];

                        ?>
                        <tr>
                            <td><?=$kodeBarang;?></td>
                            <td><?=$namaBarang;?> </td>
                            <td><?=$harga;?></td>
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
    $('#tabel-data-barang').DataTable( {
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