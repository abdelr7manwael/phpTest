<?php

    require_once "shared/header.php"; 
    session_start();
    $mysqli = new mysqli($_SESSION['Hoster'], $_SESSION['UserName'], $_SESSION['Password'],$_SESSION['Database']);
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    if (!isset ($_GET['page']) ) {  
    $page = 1;  
    
    } else {  
    $page = $_GET['page'];  
    }  
    $results_per_page = 3;  
    // echo($page);
    $page_first_result = ($page-1) * $results_per_page; 
      
    
    $q = $mysqli->query("SELECT * FROM `product`");
    $no_of_result = $q->num_rows;
    $number_of_page = ceil ($no_of_result / $results_per_page);

    if(isset($_GET['sort_by'])){
        if($_GET['sort_by'] == "id"){
            $query = "SELECT * FROM `product`  LIMIT ". $page_first_result . ',' . $results_per_page;
        }elseif($_GET['sort_by'] == "name"){
            $query = "SELECT * FROM `product` ORDER BY `fruit` ASC LIMIT ". $page_first_result . ',' . $results_per_page;
        }elseif($_GET['sort_by'] == "weight"){
            $query = "SELECT * FROM `product` ORDER BY `weight` ASC LIMIT ". $page_first_result . ',' . $results_per_page;
        }elseif($_GET['sort_by'] == "price"){
            $query = "SELECT * FROM `product` ORDER BY `price` ASC LIMIT ". $page_first_result . ',' . $results_per_page;
        }
    }else{

        $query = "SELECT * FROM `product`  LIMIT ". $page_first_result . ',' . $results_per_page ;
    }


    if($result = $mysqli->query($query)){

        $products = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($products,$row);
            }
        }
    }
    else{
        
        print('Error :'. $mysqli -> error . '<br/><br/>');
    }

    ?>

    <div style="margin-bottom:20px;" >
        <a style="margin-right:20px;" href="show.php?sort_by=id">id</a>
        <a style="margin-right:20px;" href="show.php?sort_by=name">Name</a>
        <a style="margin-right:20px;" href="show.php?sort_by=weight">weight</a>
        <a style="margin-right:20px;" href="show.php?sort_by=price">price</a>
    </div>

<div  style="text-align: center;">
    <table style="width:50%; border-collapse: collapse;" class="show">
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;">Fruit</td>
            <td style="border: 1px solid black;">Weight</td>
            <td style="border: 1px solid black;">Price</td>
        </tr>
        <?php
        if(isset($products)){ 
        foreach($products as $p){ ?>
        <tr >
            <td><?= $p['fruit'] ?></td>
            <td> <?= $p['weight'] ?></td>
            <td><?= $p['price'] ?></td>
        </tr>
        <?php } }?>
    </table>
</div>



<div style="margin:15px;">
<?php

for($page = 1; $page<= $number_of_page; $page++) {
        if(! isset($_GET['sort_by'])){
        echo "<a href = \"show.php?page=$page\" >  $page </a> &nbsp " ;  
               
        }else{

            echo "<a href = \"show.php?sort_by=".$_GET['sort_by']. "&page=" . $page . '">' . $page . " </a> &nbsp";  
        }
    } 
?>

</div>

<?php
  
require_once "shared/footer.php"; ?>