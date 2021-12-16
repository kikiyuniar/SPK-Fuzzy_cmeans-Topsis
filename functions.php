<?php
error_reporting(~E_NOTICE);
session_start();
include 'config.php';
include 'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include 'includes/general.php';
include 'includes/fcm.php';

$mod = $_GET['m'];
$act = $_GET['act'];

$rows = $db->get_results("SELECT kode_alternatif, nama_alternatif FROM tb_alternatif ORDER BY kode_alternatif");
foreach ($rows as $row) {
    $ALTERNATIF[$row->kode_alternatif] = $row;
}

$rows = $db->get_results("SELECT * FROM tb_atribut ORDER BY kode_atribut");
foreach ($rows as $row) {
    $KRITERIA[$row->kode_atribut] = $row;
}

function get_atribut_option($selected = '')
{
    $atribut = array('benefit' => 'Benefit', 'cost' => 'Cost');
    $a = '';
    foreach ($atribut as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_bobot_option($selected = '')
{
    $atribut = array(
        '1' => 'Sangat Tidak Penting',
        '2' => 'Tidak Penting',
        '3' => 'Netral',
        '4' => 'Penting',
        '5' => 'Sangat Penting',
    );
    $a = '';
    foreach ($atribut as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_bobot_pendapatan($selected = '')
{
    $atribut = array(
        '1'  => 'Rp 14.936.000 sampai Rp 16.266.000',
        '2'  => 'Rp 13.605.500 sampai Rp 14.935.500',
        '3'  => 'Rp 12.275.000 sampai Rp 13.605.000',
        '4'  => 'Rp 10.944.500 sampai Rp 12.274.500',
        '5'  => 'Rp 9.614.000 sampai Rp 10.944.000',
        '6'  => 'Rp 8.283.500 sampai Rp 9.613.500',
        '7'  => 'Rp 6.953.000 sampai Rp 8.283.000',
        '8'  => 'Rp 5.622.000 sampai Rp 6.952.500',
        '9'  => 'Rp 4.292.000 sampai Rp 5.622.000',
        '10' => 'Rp 2.961.000 sampai Rp 4.291.500',
        '11' => 'Rp 1.631.000 sampai Rp 2.961.000',
        '12' => 'Rp 300.000 sampai Rp 1.630.500',
    );
    $a = '';
    foreach ($atribut as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_bobot_pengeluaran($selected = '')
{
    $atribut = array(
        '1'  => 'Rp 4.455.000 sampai Rp 4.927.70',
        '2'  => 'Rp 3.982.200 sampai Rp 4.454.930',
        '3'  => 'Rp 3.509.400 sampai Rp 3.982.160',
        '4'  => 'Rp 3.037.000 sampai Rp 3.509.390',
        '5'  => 'Rp 2.564.000 sampai Rp 3.036.620',
        '6'  => 'Rp 2.091.100 sampai Rp 2.563.850',
        '7'  => 'Rp 1.618.400 sampai Rp 2.091.080',
        '8'  => 'Rp 1.146.000 sampai Rp 1.618.310',
        '9'  => 'Rp 673.000 sampai Rp 1.145.540',
        '10' => 'Rp 200.000 sampai Rp 672.770'
    );
    $a = '';
    foreach ($atribut as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}
function get_bobot_lahan($selected = '')
{
    $atribut = array(
        '1'  => 'luas lahan 1069m2 sampai 1152m2',
        '2'  => 'luas lahan 985m2 sampai 1068m2',
        '3'  => 'luas lahan 901m2 sampai 984m2',
        '4'  => 'luas lahan 817m2 sampai 900m2',
        '5'  => 'luas lahan 733m2 sampai 816m2',
        '6'  => 'luas lahan 649m2 sampai 732m2',
        '7'  => 'luas lahan 565m2 sampai 648m2',
        '8'  => 'luas lahan 481m2 sampai 564m2',
        '9'  => 'luas lahan 397m2 sampai 480m2',
        '10' => 'luas lahan 313m2 sampai 396m2',
        '11' => 'luas lahan 229m2 sampai 312m2',
        '12' => 'luas lahan 145m2 sampai 228m2',
        '13' => 'luas lahan 60m2 sampai 144m2'
    );
    $a = '';
    foreach ($atribut as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}
function get_bobot_status($selected = '')
{
    $atribut = array(
        '1'  => 'Kepemilikan Sendiri/Orang Tua',
        '2'  => 'Sewa'
    );
    $a = '';
    foreach ($atribut as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}
function get_bobot_bantuan($selected = '')
{
    $atribut = array(
        '1'  => 'Ya, mendapatkan bantuan',
        '2'  => 'Tidak, mendapatkan bantuan'
    );
    $a = '';
    foreach ($atribut as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function kode_oto($field, $table, $prefix, $length)
{
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . (substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function get_data()
{
    global $db;
    $rows = $db->get_results("SELECT a.kode_alternatif, k.kode_atribut, ra.nilai
        FROM tb_alternatif a 
        INNER JOIN tb_rel_alternatif ra ON ra.kode_alternatif=a.kode_alternatif
        INNER JOIN tb_atribut k ON k.kode_atribut=ra.kode_atribut
        ORDER BY a.kode_alternatif, k.kode_atribut");
    $data = array();
    foreach ($rows as $row) {
        $data[$row->kode_alternatif][$row->kode_atribut] = $row->nilai;
    }
    return $data;
}
