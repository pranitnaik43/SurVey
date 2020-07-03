<?php include 'header.php';?>
    
    <div class="container">
        <div class="justify-content-center">

            <?php if (isset($_SESSION["Name"])) {   ?>
                <h1 style="color:red;"> Welcome <?php echo $_SESSION["Name"] ?> </h1>
                <hr>
            <?php }  ?>
        </div>  
    </div>


    </body>
</html>