<?php include "resource/view/template/header.php"; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Login</h1>

                    <div class="text-center">
                        <i class="fas fa-user-circle" style="font-size: 9em;"></i>

                        <form action="" method="post" class="mt-5">



                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="username" class="form-control" placeholder="Username"
                                    aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    aria-label="Password" aria-describedby="basic-addon2">

                            </div>
                            <button type="submit" name="submit" class="btn btn-dark btn-block"> <i
                                    class="fa fa-sign-in-alt"></i> Login</button>
                            <hr>
                            <a href="?page=register" class="btn btn-secondary btn-block"> <i
                                    class="fa fa-user-plus"></i> Buat Akun baru</a>

                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-center">
                        <i class="fa fa-copyright"></i>
                        <a href="?page=beranda" class="text-dark">E Laporz</a> | Kelompok 7
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "resource/view/template/footer.php"; ?>
<?php 
    if(isset($_POST['submit'])) {
        
        $username = val($_POST['username']);
        $password = val($_POST['password']);

        if(empty($username) || empty($password)) {
            alert('Username / Password tidak boleh kosong');
        } else {
            
            $check_user = $conn->query("SELECT * FROM user WHERE username = '$username'");
            $get_user = $check_user->fetch_array();
            if($check_user->num_rows < 1) {
                alert('Username tidak terdaftar');
            } else {

                
             
                if(!password_verify($password, $get_user['password'])) {
                    alert('Password Salah');
                } else {
                    session_start();
                    if($get_user['role'] == 'admin') {
                        $_SESSION['user_id'] = $get_user['id'];
                        redir('?page=admin');
                    }

                    if($get_user['role'] == 'user') {
                        $_SESSION['user_id'] = $get_user['id'];
                        redir('?page=user');
                    }

                }
            }
        }
    }
?>