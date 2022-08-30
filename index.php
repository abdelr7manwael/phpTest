<?php
session_start(); 
require_once "shared/header.php"; ?> 

<div class="form">

    

    <form class="text-center" method="post" action="handelers/handelConnect.php">
        <?php
    if(isset($_SESSION['success'])){?>
        
            <?php echo "<h4 class=\"text-center\">".$_SESSION['success']."</h4>" ?>
        <?php
    }
    unset($_SESSION['success']);
    ?>
        <h3>Enter The following information to create tables</h3>

        <table class="text-center data">
            <tr >
                <td>Hotser</td>
                <td ><input type="text" name="Hoster" id=""></td>
            </tr> 
            <tr >
                <td>UserName</td>
                <td ><input type="text" name="UserName" id=""></td>
            </tr> 
            <tr >
                <td>Password</td>
                <td ><input type="text" name="Password" id=""></td>
            </tr>
             <tr >
                <td>Database</td>
                <td ><input type="text" name="Database" id=""></td>
            </tr>
        </table>

        <input  type="submit" name="connect" value="Connect" >
        
    </form>

</div>






<?php require_once "shared/footer.php"; ?> 