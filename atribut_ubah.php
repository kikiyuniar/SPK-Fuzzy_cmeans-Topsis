<?php
$row = $db->get_row("SELECT * FROM tb_atribut WHERE kode_atribut='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah Atribut</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Kode Atribut <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_atribut" value="<?= $row->kode_atribut ?>" readonly />
            </div>
            <div class="form-group">
                <label>Nama Atribut <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_atribut" value="<?= $row->nama_atribut ?>" />
            </div>
            <div class="form-group">
                <label>Atribut <span class="text-danger">*</span></label>
                <select class="form-control" name="atribut">
                    <?= get_atribut_option(set_value('atribut', $row->atribut)) ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=atribut"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>