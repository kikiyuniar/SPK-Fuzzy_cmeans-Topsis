<div class="page-header">
    <h1>Import Data</h1>
</div>
<div class="row">
    <div class="col-md-6">
        <form method="post" enctype="multipart/form-data">
            <?php
            if ($_POST) {
                $row = 0;
                $file_name = 'assets/csv/' . $_FILES['data']['name'];
                move_uploaded_file($_FILES['data']['tmp_name'], $file_name) or die('Upload gagal');

                $arr = array();
                $nama = array();

                ini_set('auto_detect_line_endings', TRUE);
                if (($handle = fopen($file_name, "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $num = count($data);
                        if ($row > 0) {
                            $nama[$row] = $data[1];
                            for ($c = 0; $c < $num; $c++) {
                                $arr[$row][$c] = $data[$c];
                            }
                        }
                        $row++;
                    }
                    fclose($handle);
                }
                ini_set('auto_detect_line_endings', FALSE);

                function isi_key($data)
                {
                    global $KRITERIA;
                    $keys = array_keys($KRITERIA);
                    $arr = array();
                    foreach ($data as $key => $val) {
                        $kode = $val[0];
                        $arr[$kode]['nama'] = $val[1];
                        $arr[$kode]['ket_alternatif'] = $val[2];
                        foreach ($val as $k => $v) {
                            if (($k > 2))
                                $arr[$kode]['nilai'][$keys[$k - 3]] = $v;
                            else
                                $arr[$kode]['nama'] = $v;
                        }
                    }
                    //echo '<pre>', print_r($arr, 1), '</pre>';
                    return $arr;
                }


                $db->query("TRUNCATE tb_alternatif");
                $db->query("TRUNCATE tb_rel_alternatif");

                //echo '<pre>', print_r($arr, 1), '</pre>';

                $arr = isi_key($arr);
                $alternatif = array();
                $rel_alternatif = array();
                foreach ($arr as $key => $val) {
                    $kode_alternatif = 'A' . substr('000' . $key, -3);
                    $alternatif[$kode_alternatif] = array(
                        'kode_alternatif' => $key,
                        'nama_alternatif' => $val['nama'],
                        'ket_alternatif' => $val['ket_alternatif'],
                    );
                    foreach ($val['nilai'] as $k => $v) {
                        $rel_alternatif[] = array(
                            'kode_alternatif' => $kode_alternatif,
                            'kode_atribut' => $k,
                            'nilai' => $v,
                        );
                    }
                }
                //echo '<pre>', print_r($arr, 1), '</pre>';
                $db->multi_query('tb_alternatif', $alternatif);
                $db->multi_query('tb_rel_alternatif', $rel_alternatif);

                print_msg('Dataset berhasil diimport!', 'success');
            }
            ?>
            <div class="form-group">
                <label>Pilih file</label>
                <input class="form-control" type="file" name="data" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" name="import"><span class="glyphicon glyphicon-import"></span> Import</button>
                <a class="btn btn-danger" href="?m=alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>