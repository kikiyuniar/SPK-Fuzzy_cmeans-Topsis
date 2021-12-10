<?php
$rows = $db->get_results("SELECT a.kode_alternatif, ra.kode_atribut, ra.nilai            
    FROM tb_rel_alternatif ra 
    INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
    WHERE nama_alternatif LIKE '%" . esc_field($_GET['q']) . "%'
    ORDER BY ra.kode_alternatif, ra.kode_atribut");

$data = array();
foreach ($rows as $row) {
    $data[$row->kode_alternatif][$row->kode_atribut]  = $row->nilai;
}
?>
<div class="page-header">
    <h1>Nilai Data Warga</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading mb-3">
        <form class="form-inline">
            <input type="hidden" name="m" value="rel_alternatif" />
            <div class="form-group">
                <input class="form-control" type="text" name="q" value="<?= $_GET['q'] ?>" placeholder="Pencarian..." />
            </div>
            <div class="form-group mx-sm-3">
                <a class="btn btn-success" href="?m=rel_alternatif">Refresh</a>
            </div>
        </form>
    </div>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
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
    </div>
</div>