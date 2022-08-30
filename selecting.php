<?php
    require_once "shared/header.php"; 
    session_start();
    $mysqli = new mysqli($_SESSION['Hoster'], $_SESSION['UserName'], $_SESSION['Password'],$_SESSION['Database']);
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
 
// 
    $query = "SELECT `language`,COUNT(*)  FROM visitors GROUP BY `language` ORDER BY COUNT(*) DESC";

    $result = $mysqli->query($query);
    ?>


    <div  style="text-align: center;">
    <table style="width:50%; border-collapse: collapse;" class="show">
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;">Language</td>
            <td style="border: 1px solid black;">Visitors</td>
        </tr>
        <?php
        if(true){ 
        while($row = $result->fetch_assoc()){ ?>
        <tr >
            <td><?= $row['language'] ?></td>
            <td> <?= $row['COUNT(*)'] ?></td>
        </tr>
        <?php } }?>
    </table>
</div>


<?php  require_once "shared/footer.php";  ?>