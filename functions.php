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
