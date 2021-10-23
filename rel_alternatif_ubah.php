<?php
$row = $db->get_row("SELECT * FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah Nilai Bobot &raquo; <small><?= $row->nama_alternatif ?></small></h1>
</div>
<div class="row">
    <div class="col-sm-4">
        <form method="post" action="aksi.php?act=rel_alternatif_ubah&ID=<?= $row->kode_alternatif ?>">
            <?php
            $rows = $db->get_results("SELECT ra.ID, k.kode_atribut, k.nama_atribut, ra.nilai FROM tb_rel_alternatif ra INNER JOIN tb_atribut k ON k.kode_atribut=ra.kode_atribut  WHERE kode_alternatif='$_GET[ID]' ORDER BY kode_atribut");
            foreach ($rows as $row) : ?>
                <div class="form-group">
                    <label><?= $row->nama_atribut ?></label>
                    <input class="form-control" type="number" min="1" max="5" name="ID-<?= $row->ID ?>" value="<?= $row->nilai ?>" />
                </div>
            <?php endforeach ?>
            <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            <a class="btn btn-danger" href="?m=rel_alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
        </form>
    </div>
</div>