<?php

    include('config/connect_db.php');

    // Write  query for all result
    $sql = 'SELECT id ,title , ingridents FROM pizzas ORDER BY created_at';
    // make query & get result
    $result = mysqli_query($connect , $sql)or die(mysqli_error($connect));;

    // fetch the resulting rows as an array
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// free the $result from memory (good practise)
	mysqli_free_result($result);

	// close connection
	mysqli_close($connect);




?>


<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>

    <h4 class="center grey-text">Pizzas!</h4>
    <div class="container">
        <div class="row">

            
            <?php if (is_array($pizzas) || is_object($pizzas)) { ?>
            
                <?php foreach($pizzas as $pizza){ ?>

                    <div class="col s6 md3">
                        <div class="card z-depth-0 ">
                            <img src="images/pizza.svg" alt="" class='pizza'>
                            <div class="card-content center">
                                <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>    
                                <ul>
                                    <?php foreach(explode(',', $pizza['ingridents']) as $ing): ?>
                                        <li> <?php echo htmlspecialchars($ing);?></li>
                                     <?php endforeach;?>
                                </ul>
                                
                                
                            </div>
                            <div class="card-action right-align">
                                <a href="details.php?id=<?php echo $pizza['id']?>" class="brand-text">more info</a>
                            </div>
                        </div>
                    </div>
                    
                
            
            <?php }?>
            <?php }?>

        </div>
    </div>

    <?php include('templates/footer.php'); ?>

        
    </body>
</html>