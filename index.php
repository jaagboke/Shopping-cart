<?php

//start session
session_start();

require_once ('php/component.php');
require_once ('php/CreateDb.php');

//create instance of createDB class
$database = new CreateDb('Productdb', 'productdb');

if (isset($_POST['add'])){
    //print_r($_POST['product_id']);
    if (isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], ['product_id']);
        print_r($item_array_id);


        //check if the product_id is in the array
        if(in_array($_POST['product_id'], $item_array_id)){
            $expression = "Product is already in the cart...!";
            echo "<script>alert($expression)</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{

            //use count to store number of element in array
             $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart']['count'] = $item_array;
            print_r($_SESSION['cart']);
        }

    }else{
        $item_array = array(
        'product_id' => $_POST['product_id']
        );
        //create new sesssion variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}
//?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
<!--    font awesome-->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
<div class="container">


    <div class="row text-center py-5">
        <?php
        $result = $database->getData();
        $result = $database->getData();
        while($row = mysqli_fetch_assoc($result)){
        component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
        }
        ?>

    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
