<div class="page-header">
    <h1>List Data Warga</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="alternatif" />
            <div class="btn-group">
                <!-- <input class=" btn btn-gray border" type="text" placeholder="Pencarian nama. . ." name="q" value="<?= $_GET['q'] ?>" /> -->
                <a class="btn btn-success" href="?m=alternatif">Refresh</a>
                <a class="btn btn-primary" href="?m=alternatif_tambah">Tambah</a>
            </div>
        </form>
    </div>
</div>
<div class="table-responsive mt-3">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Kepala Rumah Tangga</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'fcm_topsis';
        $conn = mysqli_connect($host, $user, $pass, $dbname);

        $batas = 10;
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
        $previous = $halaman - 1;
        $next = $halaman + 1;
        $q = esc_field($_GET['q']);
        $rows = mysqli_query($conn, "SELECT * FROM tb_alternatif WHERE nama_alternatif LIKE '%$q%' ORDER BY kode_alternatif");
        $jumlah_data = mysqli_num_rows($rows);
        $total_halaman = ceil($jumlah_data / $batas);
        $rows = mysqli_query($conn, "SELECT * FROM tb_alternatif LIMIT $halaman_awal, $batas");
        $no = $halaman_awal + 0;

        while ($d = mysqli_fetch_array($rows)) { ?>
            <!-- foreach ($rows as $row)  -->
            <tr>
                <td><?= ++$no ?></td>
                <td><?= $d['kode_alternatif']; ?></td>
                <td><?= $d['nama_alternatif']; ?></td>
                <td><?= $d['ket_alternatif']; ?></td>
                <td>
                    <a class="btn btn-xs btn-warning" href="?m=alternatif_ubah&ID=<?= $d['kode_alternatif']; ?>">Edit</a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=alternatif_hapus&ID=<?= $d['kode_alternatif']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <nav>
        <ul class="pagination justify-content-center">
            <?php
            $jumlah_number = 1;
            $start_number = ($halaman > $jumlah_number) ? $halaman - $jumlah_number : 1;
            $end_number = ($halaman < ($total_halaman - $jumlah_number)) ? $halaman + $jumlah_number : $total_halaman;
            if ($halaman == 1) {
                echo '<li class="page-item disabled"><a class="page-link">First</a></li>';
                echo '<li class="page-item disabled"><a class="page-link"><span aria-hidden="true">&laquo;</span></a>';
            } else {
                $link_prev = ($halaman > 1) ? $halaman - 1 : 1;
                echo '<li class="page-item halaman"><a class="page-link" href="index.php?m=alternatif">First</a></li>';
                echo '<li class="page-item halaman"><a class="page-link" href="index.php?m=alternatif&halaman=' . $link_prev . '"><span aria-hidden="true">&laquo;</span></a></li>';
            }

            for ($x = $start_number; $x <= $end_number; $x++) {
                $link_active = ($halaman == $x) ? ' active' : '';
                echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="index.php?m=alternatif&halaman=' . $x . '">' . $x . '</a></li>';
            }

            if ($halaman == $total_halaman) {
                echo '<li class="page-item disabled"><a class="page-link"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item disabled"><a class="page-link">Last</a></li>';
            } else {
                $link_next = ($halaman < $total_halaman) ? $halaman + 1 : $total_halaman;
                echo '<li class="page-item halaman"><a class="page-link" href="index.php?m=alternatif&halaman=' . $link_next . '"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item halaman"><a class="page-link" href="index.php?m=alternatif&halaman=' . $total_halaman . '">Last</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>
</div>