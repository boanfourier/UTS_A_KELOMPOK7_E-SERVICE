<?php include "resource/view/template/header.php"; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Register Akun Baru</h1>
                    <h2 class="text-center">E Service</h2>

                    <div class="text-center">
                        <i class="fas fa-user-plus" style="font-size: 9em;"></i>

                        <form action="" method="post" class="mt-5 text-left" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama">
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukan Password">
                            </div>

                            <div class="form-group">
                                <label for="Foto">Foto</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="form-file" name="foto">
                                    <label class="custom-file-label" for="customFile">Pilih Foto</label>


                                </div>
                                <img id="img-preview" width="300px" class="img-thumbnail img-fluid mb-2" alt="">
                            </div>

                            <button type="submit" name="submit" class="btn btn-dark btn-block"> <i
                                    class="fa fa-user-plus"></i> Register</button>
                            <hr>
                            <a href="?page=login" class="btn btn-secondary btn-block"> <i class="fa fa-user"></i>
                                Sudah punya Akun?</a>

                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-center">
                        <i class="fa fa-copyright"></i>
                        <a href="?page=beranda" class="text-dark">E Service</a> | Kelompok 7
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "resource/view/template/footer.php"; ?>
<?php 
    if(isset($_POST['submit'])) {
        
        $nama = val($_POST['nama']);
        $username = val($_POST['username']);
        $password = val($_POST['password']);
        $pass = password_hash($password, PASSWORD_DEFAULT);

        if(empty($nama) || empty($username) || empty($password)) {
            alert('Field tidak boleh kosong');
        } else {
            
            $sql_check_user = "SELECT * FROM user WHERE username = '$username'";
            $check_user = $conn->query($sql_check_user);

            if($check_user->num_rows > 0) {
                alert('Username sudah terdaftar!');
            } else {

                if(empty($_FILES['foto']['name'])) {
                    alert('Foto tidak boleh kosong');
                } else {
                    $target = "asset/upload/";
                    $temp = explode(".", $_FILES['foto']['name']);
                    $new_file_name = time().'.'.end($temp);
                    $foto = $target.$new_file_name;
                    $imageFileType = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
                        alert('File harus berekstensi JPG, JPEG, PNG');
                    } else {

                        if(move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {
                          
                            $sql_register = "INSERT into user(nama, username, password, foto, role) VALUES('$nama','$username','$pass','$foto','user')";
                            $register = $conn->query($sql_register);
                            if($register) {
                                alert('Berhasil, silahkan login!');
                                redir('?page=login');
                            } else {
                                alert('Gagal');
                            }
                        } else {
                            alert('Gagal Upload Gambar!');
                        }
                      

                    }

                }
            }


            
        }
    }
?>