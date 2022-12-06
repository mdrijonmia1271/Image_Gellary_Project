<?php


$conn = new mysqli('localhost','root','','image_crud');
if(!$conn){
    echo 'connected';
}

$emptSmg_email = '';
$emptSmg_password = '';

if(isset($_POST['submit'])){
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    if(empty($user_email)){
        $emptSmg_email = 'Fill up this field';
    }
    if(empty($user_password)){
        $emptSmg_password = 'Fill up this field';
    }
    if(!empty($user_email) && !empty($user_password)){
        $sql = "SELECT * FROM users WHERE user_email = '$user_email' AND user_password = '$user_password'";

        $query = $conn->query($sql);
        if($query->num_rows > 0){
            header('location:dashbord.php');
        }else{
            $notFound = 'User Not Found';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login Page</title>
</head>
<body>
    <div class="container" >
        <div class="row">
            <div class="col-4">

            </div>
            <div class="col-4" style="margin-top: 150px;">
            <?php if(isset($_POST['submit'])){echo $notFound;}?>
                <?php if(isset($_GET['userCreated'])){
                    echo 'User Create Successfully.';
                } ?>
                <form action="login.php" method="POST">
                    <div class="mt-2">
                        <h1 style="text-align:center;">Login</h1>
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" name="user_email" value="<?php if(isset($_POST['submit'])){echo $user_email;}?>">
                        <?php if(isset($_POST['submit'])){echo "<span class ='text-danger'>".$emptSmg_email."</span>";} ?>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control" name="user_password" value="<?php if(isset($_POST['submit'])){echo $user_password;}?>">
                        <?php if(isset($_POST['submit'])){echo "<span class ='text-danger'>".$emptSmg_password."</span>";} ?>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success" name="submit"> Login</button>
                    </div>
                </form>
                <h6>Do not have an account? <a href="user.php">Create account</a> </h6>
            </div>
            <div class="col-4">
            
            </div>
        </div>
    </div>
</body>
</html>