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

$rows = mysqli_query($conn, "SELECT a.kode_alternatif, ra.kode_atribut, ra.nilai            
    FROM tb_rel_alternatif ra 
    INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
    WHERE nama_alternatif LIKE '%" . esc_field($_GET['q']) . "%'
    ORDER BY ra.kode_alternatif, ra.kode_atribut");





foreach ($rows as $row) {
    $row = mysqli_query($conn, "SELECT * FROM tb_rel_alternatif LIMIT $halaman_awal, $batas");
    $no = $halaman_awal + 0;
    $data[$row->kode_alternatif][$row->kode_atribut]  = $row->nilai;
    $jumlah_data = mysqli_num_rows($row);
    $total_halaman = ceil($jumlah_data / $batas);
}
$data = array();
?>
<div class="page-header">
    <h1>Nilai Bobot Alternatif</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading mb-3">
        <form class="form-inline">
            <input type="hidden" name="m" value="rel_alternatif" />
            <div class="form-group">
                <input class="form-control" type="text" name="q" value="<?= $_GET['q'] ?>" placeholder="Pencarian..." />
            </div>
            <div class="form-group mx-sm-3">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
        </form>
    </div>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Judul Alternatif</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_atribut ?></th>
                    <?php endforeach ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // while ($d = mysqli_fetch_array($data)) { 

                foreach ($data as $key => $val) : ?>
                    <tr>
                        <td><?= $ALTERNATIF[$key]->kode_alternatif ?></td>
                        <td><?= $ALTERNATIF[$key]->nama_alternatif ?></td>
                        <?php foreach ($val as $k => $v) : ?>
                            <td><?= $v ?></td>
                        <?php endforeach ?>
                        <td>
                            <a class="btn btn-xs btn-warning" href="?m=rel_alternatif_ubah&ID=<?= $key ?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <!-- <?php  ?> -->
            </tbody>
        </table>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman > 1) {
                                                echo "href='index.php?m=rel_alternatif&halaman=$Previous'";
                                            } ?>>Previous</a>
                </li>
                <?php
                for ($x = 1; $x <= $total_halaman; $x++) {
                ?>
                    <li class="page-item"><a class="page-link" href="index.php?m=rel_alternatif&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                echo "href='index.php?m=rel_alternatif&halaman=$next'";
                                            } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>