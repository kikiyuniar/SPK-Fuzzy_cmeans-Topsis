<?php
require_once 'functions.php';
/** LOGIN */
if ($mod == 'login') {
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);

    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND pass='$pass'");
    if ($row) {
        $_SESSION['login'] = $row->user;
        redirect_js("index.php");
    } else {
        print_msg("Salah kombinasi username dan password.");
    }
} elseif ($act == 'logout') {
    unset($_SESSION['login']);
    header("location:index.php?m=login");
} else if ($mod == 'password') {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$_SESSION[login]' AND pass='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    elseif ($pass1 == $pass2 || $pass1 == $pass3)
        print_msg('Password baru dan password baru sama.');
    else {
        $db->query("UPDATE tb_admin SET pass='$pass2' WHERE user='$_SESSION[login]'");
        print_msg('Password berhasil diubah.', 'success');
    }
}

/** ALTERNATIF */
elseif ($mod == 'alternatif_tambah') {
    $kode_alternatif = $_POST['kode_alternatif'];
    $nama_alternatif = $_POST['nama_alternatif'];
    $ket_alternatif = $_POST['ket_alternatif'];
    if ($kode_alternatif == '' || $nama_alternatif == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_alternatif WHERE kode_alternatif='$kode_alternatif'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_alternatif (kode_alternatif, nama_alternatif, ket_alternatif) VALUES ('$kode_alternatif', '$nama_alternatif', '$ket_alternatif')");

        $db->query("INSERT INTO tb_rel_alternatif(kode_alternatif, kode_atribut) 
            SELECT '$kode_alternatif', kode_atribut FROM tb_atribut");
        redirect_js("index.php?m=alternatif");
    }
} else if ($mod == 'alternatif_ubah') {
    $nama_alternatif = $_POST['nama_alternatif'];
    $ket_alternatif = $_POST['ket_alternatif'];

    if ($nama_alternatif == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_alternatif SET nama_alternatif='$nama_alternatif', ket_alternatif='$ket_alternatif' WHERE kode_alternatif='$_GET[ID]'");
        redirect_js("index.php?m=alternatif");
    }
} else if ($act == 'alternatif_hapus') {
    $db->query("DELETE FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'");
    $db->query("DELETE FROM tb_rel_alternatif WHERE kode_alternatif='$_GET[ID]'");
    header("location:index.php?m=alternatif");
}

/** atribut */
else if ($mod == 'atribut_tambah') {
    $kode_atribut = $_POST['kode_atribut'];
    $nama_atribut = $_POST['nama_atribut'];
    $atribut = $_POST['atribut'];

    if ($kode_atribut == '' || $nama_atribut == '' || $atribut == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_atribut WHERE kode_atribut='$kode_atribut'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_atribut (kode_atribut, nama_atribut, atribut) 
            VALUES ('$kode_atribut', '$nama_atribut', '$atribut')");

        $db->query("INSERT INTO tb_rel_alternatif(kode_alternatif, kode_atribut) 
            SELECT kode_alternatif, '$kode_atribut'  FROM tb_alternatif");
        redirect_js("index.php?m=atribut");
    }
} else if ($mod == 'atribut_ubah') {
    $nama_atribut = $_POST['nama_atribut'];
    $atribut = $_POST['atribut'];

    if ($nama_atribut == '' || $atribut == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_atribut SET nama_atribut='$nama_atribut', atribut='$atribut' WHERE kode_atribut='$_GET[ID]'");
        redirect_js("index.php?m=atribut");
    }
} else if ($act == 'atribut_hapus') {
    $db->query("DELETE FROM tb_atribut WHERE kode_atribut='$_GET[ID]'");
    $db->query("DELETE FROM tb_rel_alternatif WHERE kode_atribut='$_GET[ID]'");
    header("location:index.php?m=atribut");
}

/** rel_alternatif */
else if ($act == 'rel_alternatif_ubah') {
    foreach ($_POST as $key => $value) {
        $ID = str_replace('ID-', '', $key);
        $db->query("UPDATE tb_rel_alternatif SET nilai='$value' WHERE ID='$ID'");
    }
    header("location:index.php?m=rel_alternatif");
}
