<?php include "middleware/admin.php"; ?>
<?php include "resource/view/template/header.php"; ?>
<?php include "resource/view/template/admin_header.php"; ?>
<a href="" data-toggle="modal" data-target="#addUser" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Tambah</a>
<div class="table-responsive">

    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Foto</th>
                <th>Username</th>
                <th>Role</th>
                <th class="text-center">
                    <i class="fa fa-cog"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user_sql = "SELECT * FROM user ORDER by nama";
            $user = $conn->query($user_sql);
            while ($po = $user->fetch_array()) :
            ?>
                <tr>
                    <td><?= $po['nama']; ?></td>
                    <td class="text-center">
                        <?php if ($po['foto'] == null) : ?>
                            Tidak ada
                        <?php else : ?>
                            <img src="<?= $po['foto']; ?>" width="100px" class="mx-auto d-block" alt="">
                        <?php endif; ?>
                    </td>
                    <td><?= $po['username']; ?></td>
                    <td><?= $po['role']; ?></td>
                    <td>
                        <a href="" class="btn btn-info" data-toggle="modal" data-target="#editUser<?= $po['id']; ?>"><i class="fa fa-edit"></i></a>
                        <div class="modal fade" id="editUser<?= $po['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="user_id" value="<?= $po['id']; ?>">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" class="form-control" value="<?= $po['nama']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" value="<?= $po['username']; ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="Foto">Foto</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input form-file" id="form-file" name="foto">
                                                    <label class="custom-file-label" for="customFile">Pilih Foto</label>


                                                </div>
                                                <img id="img-preview" width="300px" class="img-thumbnail img-fluid mb-2 img-preview" src="<?= $po['foto']; ?>" alt="">
                                            </div>

                                            <div class="form-group">
                                                <label for="Role">Role</label>
                                                <select name="role" class="custom-select">
                                                    <?php
                                                    $roles = ['admin', 'user'];
                                                    foreach ($roles as $rl) :
                                                    ?>
                                                        <option value="<?= $rl; ?>"><?= $rl; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                            <button type="submit" name="btnEditUser" class="btn btn-info"><i class="fa fa-edit"></i> Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editPassword<?= $po['id']; ?>"><i class="fa fa-lock"></i></a>
                        <div class="modal fade" id="editPassword<?= $po['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="post">
                                        <input type="hidden" name="user_id" value="<?= $po['id']; ?>">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nama">Password Baru</label>
                                                <input type="password" name="password" class="form-control" required>
                                            </div>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                            <button type="submit" name="btnEditPassword" class="btn btn-warning"><i class="fa fa-edit"></i> Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>






                        <a href="?page=admin-user-del&id_user=<?= $po['id']; ?>" onclick="return confirm('Yakin?')" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </a>


                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Foto">Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="form-file" name="foto">
                            <label class="custom-file-label" for="customFile">Pilih Foto</label>


                        </div>
                        <img id="img-preview" width="300px" class="img-thumbnail img-fluid mb-2" alt="">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Role">Role</label>
                        <select name="role" class="custom-select">
                            <?php
                            $roles = ['admin', 'user'];
                            foreach ($roles as $rl) :
                            ?>
                                <option value="<?= $rl; ?>"><?= $rl; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="btnAddUser" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['btnEditUser'])) {

    $user_id = $_POST['user_id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    if (empty($_FILES['foto']['name'])) {
        $edit_profile_sql = "UPDATE user 
                                SET
                                    nama='$nama',
                                    username='$username',
                                    role='$role'
                                WHERE id='$user_id'";
        $edit_profile = $conn->query($edit_profile_sql);

        if ($edit_profile) {
            alert('Berhasil');
            redir('?page=admin-user');
        } else {
            alert('Gagal');
            redir('?page=admin-user');
        }
    } else {

        $check_sql = "SELECT * FROM user WHERE id='$user_id'";

        $check = $conn->query($check_sql);
        $che = $check->fetch_array();

        if ($che['foto'] != 'asset/upload/default.png') {
            unlink($che['foto']);
        }

        $target = "asset/upload/";
        $temp = explode(".", $_FILES['foto']['name']);
        $new_file_name = time() . '.' . end($temp);
        $foto = $target . $new_file_name;
        $imageFileType = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            alert('File harus berekstensi JPG, JPEG, PNG');
            redir('?page=user-profile');
        } else {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {

                $edit_profile_sql = "UPDATE user 
                                SET
                                    nama='$nama',
                                    username='$username',
                                    foto='$foto'
                                WHERE id='$user_id'";
                $edit_profile = $conn->query($edit_profile_sql);
                if ($edit_profile) {
                    alert('Berhasil!');
                    redir('?page=admin-user');
                } else {
                    alert('Gagal');
                    redir('?page=admin-user');
                }
            } else {
                alert('Gagal Upload Foto!');
                redir('?page=admin-user');
            }
        }
    }
}

if (isset($_POST['btnEditPassword'])) {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $pass = password_hash($password, PASSWORD_DEFAULT);
    $sql_edit_password = "UPDATE
                            user
                            SET
                                password='$pass'
                            WHERE id='$user_id'";
    $edit_password = $conn->query($sql_edit_password);

    if($edit_password) {
        alert('Berhasil');
        redir('?page=admin-user');
    } else {
        alert('Gagal');
        redir('?page=admin-user');
    }
}


if (isset($_POST['btnAddUser'])) {
    if (empty($_FILES['foto']['name'])) {

        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $foto = 'asset/upload/default.png';
        $role = $_POST['role'];

        $sql_add_user = "INSERT 
                                into user(nama,username,password,foto,role)
                            VALUES('$nama','$username','$pass','$foto','$role')";
        $add_user = $conn->query($sql_add_user);
        if ($add_user) {
            alert('Berhasil');
            redir('?page=admin-user');
        } else {
            alert('Gagal');
            redir('?page=admin-user');
        }
    } else {

        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $role = $_POST['role'];

        $target = "asset/upload/";
        $temp = explode(".", $_FILES['foto']['name']);
        $new_file_name = time() . '.' . end($temp);
        $foto = $target . $new_file_name;
        $imageFileType = strtolower(pathinfo($foto, PATHINFO_EXTENSION));



        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            alert('File harus berekstensi JPG, JPEG, PNG');
            redir('?page=admin-user');
        } else {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {


                $sql_add_user = "INSERT 
                                into user(nama,username,password,foto,role)
                            VALUES('$nama','$username','$pass','$foto','$role')";
                $add_user = $conn->query($sql_add_user);
                if ($add_user) {
                    alert('Berhasil');
                    redir('?page=admin-user');
                } else {
                    alert('Gagal');
                    redir('?page=admin-user');
                }
            } else {
                alert('Gagal Upload Foto!');
                redir('?page=user-profile');
            }
        }
    }
}
?>

<?php include "resource/view/template/admin_footer.php"; ?>
<?php include "resource/view/template/footer.php"; ?>