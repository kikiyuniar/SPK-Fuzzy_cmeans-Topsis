<style>
    .text-primary {
        font-weight: bold;
    }
</style>
<div class="page-header">
    <h1>Perhitungan</h1>
</div>
<?php
$c = $db->get_results("SELECT * FROM tb_rel_alternatif WHERE nilai < 0 ");
$c = false;
if (!$ALTERNATIF || !$KRITERIA) :
    echo "Tampaknya anda belum mengatur alternatif dan atribut. Silahkan tambahkan minimal 3 alternatif dan 2 atribut.";
elseif ($c) :
    echo "Tampaknya anda belum mengatur nilai alternatif. Silahkan atur pada menu <strong>Nilai Alternatif</strong>.";
else :
    $data = get_data(); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Atribut Alternatif</h3>
        </div>
        <div class="panel-body">
            <?php
            $succes = false;
            if ($_POST) {
                $cluster = $_POST['cluster'];
                $maksimum = $_POST['maksimum'];
                $pembobot = $_POST['pembobot'];
                $epsilon = $_POST['epsilon'];
                $nilai = $_POST['nilai'];
                if ($cluster < 2 || $maksimum < 10) {
                    print_msg('Masukkan minimal 2 clustering, dan 10 iterasi');
                } else {
                    $succes = true;
                }
            } else {
                foreach ($KRITERIA as $key => $val) {
                    $nilai[$key] = 1;
                }
            }
            ?>
            <form method="post" action="?m=hitung#hasil">
                <?php foreach ($KRITERIA as $key => $val) : ?>
                    <div class="form-group">
                        <label><?= $val->nama_atribut ?></label>
                        <select class="form-control aw" name="nilai[<?= $key ?>]">
                            <?= get_bobot_option($_POST['nilai'][$key]) ?>
                        </select>
                    </div>
                <?php endforeach ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Pengaturan</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Jumlah Cluster Dicari <span class="text-danger">**</span></label>
                            <input class="form-control aw" type="number" name="cluster" value="<?= set_value('cluster', 2) ?>" />
                        </div>
                        <div class="form-group">
                            <label>Maksimum Iterasi <span class="text-danger">**</span></label>
                            <input class="form-control aw" type="text" name="maksimum" value="<?= set_value('maksimum', 100) ?>" />
                        </div>
                        <div class="form-group">
                            <label>Pembobot <span class="text-danger">**</span></label>
                            <input class="form-control aw" type="text" name="pembobot" value="<?= set_value('pembobot', 2) ?>" />
                        </div>
                        <div class="form-group">
                            <label>Epsilon <span class="text-danger">**</span></label>
                            <input class="form-control aw" type="text" name="epsilon" value="<?= set_value('epsilon', 0.000001) ?>" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span>Proses</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    if ($succes)
        include 'hitung_hasil.php';
    ?>
<?php endif ?>