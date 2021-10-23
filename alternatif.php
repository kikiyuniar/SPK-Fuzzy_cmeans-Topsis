<div class="page-header">
    <h1>Data Alternatif</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="alternatif" />
            <div class="btn-group">
                <input class=" btn btn-gray border" type="text" placeholder="Pencarian nama. . ." name="q" value="<?= $_GET['q'] ?>" />
                <a class="btn btn-success" href="?m=alternatif">Refresh</a>
                <a class="btn btn-primary" href="?m=alternatif_tambah">Tambah</a>
                <a class="btn btn-info" href="?m=alternatif_import">Import</a>
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
                <th>Judul Alternatif</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_alternatif WHERE nama_alternatif LIKE '%$q%' ORDER BY kode_alternatif");
        $no = 0;

        foreach ($rows as $row) : ?>
            <tr>
                <td><?= ++$no ?></td>
                <td><?= $row->kode_alternatif ?></td>
                <td><?= $row->nama_alternatif ?></td>
                <td><?= $row->ket_alternatif ?></td>
                <td>
                    <a class="btn btn-xs btn-warning" href="?m=alternatif_ubah&ID=<?= $row->kode_alternatif ?>">Edit</a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=alternatif_hapus&ID=<?= $row->kode_alternatif ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</div>