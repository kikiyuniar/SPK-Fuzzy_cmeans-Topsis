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
            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#Modal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </svg>
            </button>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Modal">Informasi Score Setiap Kriteria</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Pendapatan</label>
                                    <ul>
                                        <li>Rp 300.000 sampai Rp 1.630.500, score 12</li>
                                        <li>Rp 1.631.000 sampai Rp 2.961.000, score 11</li>
                                        <li>Rp 2.961.500 sampai Rp 4.291.500, score 10</li>
                                        <li>Rp 4.292.000 sampai Rp 5.622.000, score 9</li>
                                        <li>Rp 5.622.500 sampai Rp 6.952.500, score 8</li>
                                        <li>Rp 6.953.000 sampai Rp 8.283.000, score 7</li>
                                        <li>Rp 8.283.500 sampai Rp 9.613.500, score 6</li>
                                        <li>Rp 9.614.000 sampai Rp 10.944.000, score 5</li>
                                        <li>Rp 10.944.500 sampai Rp 12.274.500, score 4</li>
                                        <li>Rp 12.275.000 sampai Rp 13.605.000, score 3</li>
                                        <li>Rp 13.605.500 sampai Rp 14.935.500, score 2</li>
                                        <li>Rp 14.936.000 sampai Rp 16.266.000, score 1</li>
                                    </ul>
                                    <br>
                                    <label for="">Pengeluaran</label>
                                    <ul>
                                        <li>Rp 200.000 sampai Rp 672.770, score 10</li>
                                        <li>Rp 673.000 sampai Rp 1.145.540, score 9</li>
                                        <li>Rp 1.146.000 sampai Rp 1.618.310, score 8</li>
                                        <li>Rp 1.618.400 sampai Rp 2.091.080, score 7</li>
                                        <li>Rp 2.091.100 sampai Rp 2.563.850, score 6</li>
                                        <li>Rp 2.564.000 sampai Rp 3.036.620, score 5</li>
                                        <li>Rp 3.037.000 sampai Rp 3.509.390, score 4</li>
                                        <li>Rp 3.509.400 sampai Rp 3.982.160, score 3</li>
                                        <li>Rp 3.982.200 sampai Rp 4.454.930, score 2</li>
                                        <li>Rp 4.455.000 sampai Rp 4.927.700, score 1</li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <label for="">Luas Lahan</label>
                                    <ul>
                                        <li>Luas 60m2 sampai 144 m2, score 13</li>
                                        <li>Luas 145m2 sampai 228m2, score 12</li>
                                        <li>Luas 229m2 sampai 312m2, score 11</li>
                                        <li>Luas 313m2 sampai 396m2, score 10</li>
                                        <li>Luas 397m2 sampai 480m2, score 9</li>
                                        <li>Luas 481m2 sampai 564m2, score 8</li>
                                        <li>Luas 565m2 sampai 648m2, score 7</li>
                                        <li>Luas 649m2 sampai 732m2, score 6</li>
                                        <li>Luas 733m2 sampai 816m2, score 5</li>
                                        <li>Luas 817m2 sampai 900m2, score 4</li>
                                        <li>Luas 901m2 sampai 984m2, score 3</li>
                                        <li>Luas 985m2 sampai 1068m2, score 2</li>
                                        <li>Luas 1069m2 sampai 1152m2, score 1</li>
                                    </ul>
                                    <br>
                                    <label for="">Status Tempat Tinggal</label>
                                    <ul>
                                        <li>Kepemilikan sendiri/orang tua, score 1</li>
                                        <li>Sewa, score 2</li>
                                    </ul>
                                    <br>
                                    <label for="">Mendapatkan Bantuan Lembaga Pemerintah</label>
                                    <ul>
                                        <li>Ya, score 1</li>
                                        <li>Tidak, score 2</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>