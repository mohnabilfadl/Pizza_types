<?php
    include('config/connect_db.php');
    $email = $title=$ingridents='';
    $errors =['email'=>'','title'=>'','ingridents'=>''];
    if(isset($_POST['submit'])){

        $email=$_POST['email'];
        $title=$_POST['title'];
        $ingridents=$_POST['ingridents'];

        if(empty($email)){
            $errors['email']= 'An Email is required  !';
        }elseif(!filter_var($email , FILTER_VALIDATE_EMAIL)){
            $errors['email']= 'Email must be valid  ! ';
        }
        if(empty($title)){
            $errors['title']= ' Title is required  !';
        }elseif(!preg_match('/^[a-zA-Z\s]+$/' , $title)){
            $errors['title']= 'Title must be letters and spaces only  !  ';
        }
        if(empty($ingridents)){
            $errors['ingridents']= ' Ingridets are required  !';
        }elseif(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/' , $ingridents)){
            $errors['ingridents']= 'Ingridents must be a comma seperated list  ! ';
        }

        if(!array_filter($errors)){

            $email=mysqli_real_escape_string($connect,$_POST['email']);
            $title=mysqli_real_escape_string($connect,$_POST['title']);
            $ingridents=mysqli_real_escape_string($connect,$_POST['ingridents']);

            $sql="INSERT INTO pizzas(email,title,ingridents) VALUES('$email','$title','$ingridents')";
            if(mysqli_query($connect,$sql)){
                header('location: index.php');
            }else{
                echo 'query error '.mysqli_error($connect);
            }
            
        }
        
    }

?>


<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>

        <section class="container grey-text">
            <h4 class="center">Add a pizza</h4>
            <form action="add.php" method="POST" class="white">
                <label>Your Email:</label>
                <input type="text" name="email" value='<?php echo $email?>'>
                <div class='red-text'><?php echo $errors['email'];?></div>
                <label>Pizza Title:</label>
                <input type="text" name="title" value='<?php echo $title?>'>
                <div class='red-text'><?php echo $errors['title'];?></div>
                <label>Ingredients(comma seperated):</label>
                <input type="text" name="ingridents" value='<?php echo $ingridents?>'>
                <div class='red-text'><?php echo $errors['ingridents'];?></div>

                <div class="center">
                    <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
                </div>
            </form>
        </section>
    <?php include('templates/footer.php'); ?>

    
</html>