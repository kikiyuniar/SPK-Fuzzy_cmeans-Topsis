<div class="page-header">
    <h1>Atribut</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="atribut" />
            <div class="btn-group">
                <input class="btn form-control border" type="text" placeholder="Pencarian nama. . ." name="q" value="<?= $_GET['q'] ?>" />
                <a href="?m=atribut" class="btn btn-success">Refresh</a>
                <a class="btn btn-primary" href="?m=atribut_tambah">Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Atribut</th>
                    <!-- <th>Atribut</th> -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_atribut WHERE nama_atribut LIKE '%$q%' ORDER BY kode_atribut");
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row->kode_atribut ?></td>
                    <td><?= $row->nama_atribut ?></td>
                    <!-- <td><?= $row->atribut ?></td> -->
                    <td>
                        <a class="btn btn-xs btn-warning" href="?m=atribut_ubah&ID=<?= $row->kode_atribut ?>">Edit</a>
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=atribut_hapus&ID=<?= $row->kode_atribut ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>