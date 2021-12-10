<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#c1">Data</a>
        </h3>
    </div>
    <div class="table-responsive collapse" id="c1">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th rowspan="2">Alternatif</th>
                    <th class="text-center" colspan="<?= count($KRITERIA) ?>">Atribut</th>
                </tr>
                <tr>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <td><?= $val->nama_atribut ?></td>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($data as $key => $val) : ?>
                <tr>
                    <td><?= $ALTERNATIF[$key]->kode_alternatif ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= $v ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#c2">Perhitungan</a>
        </h3>
    </div>
    <div class="panel-body collapse" id="c2">
        <pre>
            <?php
            $fcm = new fcm($data, $maksimum, $cluster, $pembobot, $epsilon);
            // echo '<pre>' . print_r($fcm->pusat_cluster, 1) . '</pre>';
            ?>
        </pre>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#anggota_akhir">Keanggotaan Akhir (Iterasi <?= $fcm->iterasi ?>)</a>
        </h3>
    </div>
    <div class="table-responsive collapse" id="anggota_akhir">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <?php foreach ($fcm->cluster as $val) : ?>
                        <th><?= $val ?></th>
                    <?php endforeach ?>
                    <th>Cluster</th>
                </tr>
            </thead>
            <?php
            $fields = array();
            foreach ($fcm->keanggotaan as $key => $val) :
                $fields[] = array('kode_alternatif' => $key, 'cluster' => $fcm->hasil[$key]);
            ?>
                <tr>
                    <td><?= $ALTERNATIF[$key]->kode_alternatif ?></td>
                    <td><?= $ALTERNATIF[$key]->nama_alternatif ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 3) ?></td>
                    <?php endforeach ?>
                    <td><?= $fcm->hasil[$key] ?></td>
                </tr>
            <?php endforeach ?>
            <?php
            $db->query("TRUNCATE tb_cluster");
            $db->multi_query('tb_cluster', $fields);

            foreach ($fcm->hasil as $key => $val) {
                $arr[$val]++;
            }
            $chart = array();
            foreach ($arr as $key => $val) {
                $chart[] = array(
                    'name' => $key,
                    'y' => $val,
                );
            }
            ?>
        </table>
    </div>
    <div class="panel-body">
        <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        <style type="text/css">
            .highcharts-credits {
                display: none;
            }
        </style>
        <script>
            $(function() {
                Highcharts.chart('container', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie',
                        options3d: {
                            'enabled': true,
                            'alpha': 15,
                            'beta': 15,
                            'depth': 50,
                            'viewDistance': 25
                        }
                    },
                    title: {
                        text: 'Grafik Hasil Clustering'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            },
                            'depth': 25
                        }
                    },
                    series: [{
                        name: 'Brands',
                        colorByPoint: true,
                        data: <?= json_encode($chart) ?>
                    }]
                });
            });
        </script>
    </div>
    <div class="table-responsive" id="hasil">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cluster</th>
                    <th>Jumlah Anggota</th>
                    <th>Jarak</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            $ed = get_ed($fcm->pusat_cluster, $nilai);
            $maxs = array_keys($ed, max($ed));
            $cluster = $maxs[0];
            foreach ($fcm->pusat_cluster as $key => $val) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $key ?></td>

                    <td><?= $arr[$key] ?></td>
                    <td><?= round($ed[$key], 4) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <div class="panel-footer">
        <p>Berdasarkan perhitungan jarak, cluster yang paling mendekati adalah <b><?= $cluster ?></b></p>
    </div>
</div>

<h2>Perhitungan TOPSIS</h2>
<?php
$data = get_hasil_analisa($cluster);
$normal = get_nomalize($data);
$bobot_normal = get_bobot_normal($nilai);
$terbobot = get_nomal_terbobot($normal, $bobot_normal);
$ideal = get_solusi_ideal($terbobot);
$jarak = get_jarak_solusi($terbobot, $ideal);
$pref = get_preferensi($jarak);
$rank = get_rank($pref);
$rel_alternatif = get_rel_alternatif($cluster);

//echo '<pre>' . print_r($data, 1) . '</pre>';

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#analisa">Hasil Analisa</a>
        </h3>
    </div>
    <div class="table-responsive collapse" id="analisa">
        <table class="table table-bordered table-striped table-hover nw">
            <thead>
                <tr>
                    <th rowspan="2">Kode</th>
                    <th rowspan="2">Nama</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_atribut ?></th>
                    <?php endforeach ?>
                </tr>
                <tr>
                    <?php foreach ($nilai as $key => $val) : ?>
                        <th><?= $val ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($data as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $ALTERNATIF[$key]->nama_alternatif ?></th>
                        <?php foreach ($val as $k => $v) : ?>
                    <td><?= $v ?></td>
                <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#normal">Normalisasi</a>
        </h3>
    </div>
    <div class="table-responsive collapse" id="normal">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th rowspan="2">Kode</th>
                    <?php foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
                <tr>
                    <?php foreach ($bobot_normal as $key => $val) : ?>
                        <th><?= round($val, 4) ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($normal as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 5) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#terbobot">Normalisasi Terbobot</a>
        </h3>
    </div>
    <div class="table-responsive collapse" id="terbobot">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <?php foreach ($data[key($terbobot)] as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($terbobot as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v, 5) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#solusi_ideal">Matriks Solusi Ideal</a>
        </h3>
    </div>
    <div class="table-responsive collapse" id="solusi_ideal">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th></th>
                    <?php foreach ($ideal[key($ideal)] as $key => $value) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <?php foreach ($ideal as $key => $value) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($value as $k => $v) : ?>
                        <td><?= round($v, 5) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            </tr>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#jarak">Jarak Solusi &amp; Nilai Preferensi</a>
        </h3>
    </div>
    <div class="table-responsive collapse" id="jarak">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Positif</th>
                    <th>Negatif</th>
                    <th>Preferensi</th>
                </tr>
            </thead>
            <?php foreach ($rank as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= round($jarak[$key]['positif'], 5) ?></td>
                    <td><?= round($jarak[$key]['negatif'], 5) ?></td>
                    <td><?= round($pref[$key], 5) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#total">Hasil Rank</a>
        </h3>
    </div>
    <div class="table-responsive collapse" id="total">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <?php foreach ($data[key($data)] as $key => $val) : ?>
                        <th><?= $KRITERIA[$key]->nama_atribut ?></th>
                    <?php endforeach ?>
                    <th>Total</th>
                </tr>
            </thead>
            <?php foreach ($rank as $key => $val) : ?>
                <tr>
                    <td><?= $val ?></td>
                    <td><?= $key ?></td>
                    <td><?= $ALTERNATIF[$key]->nama_alternatif ?></td>
                    <?php foreach ($data[$key] as $k => $v) : ?>
                        <td><?= $v ?></td>
                    <?php endforeach ?>
                    <td><?= round($pref[$key], 3) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>