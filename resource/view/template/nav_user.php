<?php
    $avatar_id = $_SESSION['user_id'];
    $avatar_sql = "SELECT * FROM user WHERE id = '$avatar_id'";
    $avatar = $conn->query($avatar_sql);
    $avatar_data = $avatar->fetch_array();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="?page=user">E Service</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

        <form action="?page=user" method="post" class="form-inline ml-auto my-lg-0">
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-search">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
   
                <input class="form-control mr-sm-2" type="search" placeholder="Pencarian" name="search" aria-label="Search" aria-describedby="basic-search">
            </div>
        </form>

        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="?page=user-profile">
                    <i class="fa fa-user"></i>
                    <?= ucfirst($avatar_data['nama']); ?></a>
            </li>
            <li class="nav-item">
                <a href="?page=login" class="nav-link"><i class="fa fa-sign-in-alt"></i> Logout</a>
            </li>


        </ul>



    </div>
</nav>