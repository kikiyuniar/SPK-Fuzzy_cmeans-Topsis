<div class="page-header">
    <h1>Tambah Data Kepala Rumah Tangga</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post" action="">
            <div class="form-group">
                <label>ID <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_alternatif" value="<?= set_value('kode_alternatif', kode_oto('kode_alternatif', 'tb_alternatif', 'A', 3)) ?>" />
            </div>
            <div class="form-group">
                <label>Nama Kepala Keluarga <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_alternatif" required>
                <!-- <textarea class="form-control" name="nama_alternatif"><?= set_value('nama_alternatif') ?></textarea> -->
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="ket_alternatif"><?= set_value('ket_alternatif') ?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
        <?php

        // Check If form submitted, insert form data into users table.
        if (isset($_POST['Submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];

            // include database connection file
            include_once("config.php");

            // Insert user data into table
            $result = mysqli_query($mysqli, "INSERT INTO users(name,email,mobile) VALUES('$name','$email','$mobile')");

            // Show message when user added
            echo "User added successfully. <a href='index.php'>View Users</a>";
        }
        ?>
    </div>
</div>