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
            $arr = array_keys($rows);
            foreach ($rows as $key => $row) :
                if ($key == 0) {
                    $pendapatan = $row->nilai;
                    $id_pendapatan = $row->ID;
                } else if ($key == 1) {
                    $pengeluaran = $row->nilai;
                    $id_pengeluaran = $row->ID;
                } else if ($key == 2) {
                    $lahan = $row->nilai;
                    $id_lahan = $row->ID;
                } else if ($key == 3) {
                    $status = $row->nilai;
                    $id_status = $row->ID;
                } else if ($key == 4) {
                    $bantuan = $row->nilai;
                    $id_bantuan = $row->ID;
                }
            endforeach ?>
            <div class="form-group">
                <label>Pendapatan</label>
                <select class="form-control" name="ID-<?= $id_pendapatan ?>">
                    <?= get_bobot_pendapatan(set_value('atribut', $pendapatan)) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Pengeluaran</label>
                <select class="form-control" name="ID-<?= $id_pengeluaran ?>">
                    <?= get_bobot_pengeluaran(set_value('atribut', $pengeluaran)) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Luas lahan tempat tinggal</label>
                <select class="form-control" name="ID-<?= $id_lahan ?>">
                    <?= get_bobot_lahan(set_value('atribut', $lahan)) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Status tempat tinggal</label>
                <select class="form-control" name="ID-<?= $id_status ?>">
                    <?= get_bobot_status(set_value('atribut', $status)) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Mendapatkan bantuan dari luar</label>
                <select class="form-control" name="ID-<?= $id_bantuan ?>">
                    <?= get_bobot_bantuan(set_value('atribut', $bantuan)) ?>
                </select>
            </div>
            <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            <a class="btn btn-danger" href="?m=rel_alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
        </form>
    </div>
</div>