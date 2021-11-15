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
                    <input class="form-control" type="number" min="1" max="13" name="ID-<?= $row->ID ?>" value="<?= $row->nilai ?>" />
                </div>
            <?php endforeach ?>
            <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
            <a class="btn btn-danger" href="?m=rel_alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
        </form>
    </div>
    <div class="col-sm-4">
        <label>Pendapatan Setiap Bulan :</label>
        <ul>
            <li>Jika pendapatan 3jt sampai 4,5jt score = 4</li>
            <li>Jika pendapatan 4,5jt sampai 8,7jt score = 3</li>
            <li>Jika pendapatan 8,7jt sampai 12,9jt score = 2</li>
            <li>Jika pendapatan 12,9jt sampai 17,1jt score = 1</li>
        </ul>
        <label>Pengeluaran Setiap Bulan :</label>
        <ul>
            <li>Jika pengeluaran setiap bulan 2jt sampai 2,2jt, score = 3</li>
            <li>Jika pengeluaran setiap bulan 2,2jt sampai 4,2jt score = 2</li>
            <li>Jika pengeluaran setiap bulan 4,2jt sampai 6,2jt score = 1</li>
        </ul>
        <label>Luas Lahan Tempat Tinggal :</label>
        <ul>
            <li>Jika luas lahan 60m2 sampai 266m2, score = 6</li>
            <li>Jika luas lahan 266m2 sampai 472m2, score = 5</li>
            <li>Jika luas lahan 472m2 sampai 678m2, score = 4</li>
            <li>Jika luas lahan 678m2 sampai 884m2, score = 3</li>
            <li>Jika luas lahan 884m2 sampai 1090m2, score = 2</li>
            <li>Jika luas lahan 1090m2 sampai 1296m2, score = 1</li>
        </ul>
    </div>
    <div class="col-sm-4">
        <label>Pendapatan Setiap Bulan :</label>
        <ul>
            <li>Jika pendapatan 3jt sampai 4,5jt score = 4</li>
            <li>Jika pendapatan 4,5jt sampai 8,7jt score = 3</li>
            <li>Jika pendapatan 8,7jt sampai 12,9jt score = 2</li>
            <li>Jika pendapatan 12,9jt sampai 17,1jt score = 1</li>
        </ul>
        <label>Pengeluaran Setiap Bulan :</label>
        <ul>
            <li>Jika pengeluaran setiap bulan 2jt sampai 2,2jt, score = 3</li>
            <li>Jika pengeluaran setiap bulan 2,2jt sampai 4,2jt score = 2</li>
            <li>Jika pengeluaran setiap bulan 4,2jt sampai 6,2jt score = 1</li>
        </ul>
        <label>Luas Lahan Tempat Tinggal :</label>
        <ul>
            <li>Jika luas lahan 60m2 sampai 266m2, score = 6</li>
            <li>Jika luas lahan 266m2 sampai 472m2, score = 5</li>
            <li>Jika luas lahan 472m2 sampai 678m2, score = 4</li>
            <li>Jika luas lahan 678m2 sampai 884m2, score = 3</li>
            <li>Jika luas lahan 884m2 sampai 1090m2, score = 2</li>
            <li>Jika luas lahan 1090m2 sampai 1296m2, score = 1</li>
        </ul>
    </div>
</div>