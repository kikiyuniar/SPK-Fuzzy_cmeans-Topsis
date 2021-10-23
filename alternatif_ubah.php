<?php
$row = $db->get_row("SELECT * FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah Data Alternatif</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_alternatif" value="<?= $row->kode_alternatif ?>" readonly />
            </div>
            <div class="form-group">
                <label>Judul Alternatif <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_alternatif" value="<?= $row->nama_alternatif ?>" />
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="ket_alternatif"><?= $row->ket_alternatif ?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>