<?php


$product_ids = array();


//check if Add to Cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){
        
        //keep track of how mnay products are in the shopping cart
        $count = count($_SESSION['shopping_cart']);
        
        //create sequantial array for matching array keys to products id's
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        
        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
        $_SESSION['shopping_cart'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'Naam' => filter_input(INPUT_POST, 'Naam'),
                'Prijs' => filter_input(INPUT_POST, 'Prijs'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );   
        }
        else { //product already exists, increase quantity
            //match array key to id of the product being added to the cart
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    //add item quantity to the existing product in the array
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
    }
    else { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'Naam' => filter_input(INPUT_POST, 'Naam'),
            'Prijs' => filter_input(INPUT_POST, 'Prijs'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through all products in the shopping cart until it matches with GET id variable
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //remove product from the shopping cart when it matches with the GET id
            unset($_SESSION['shopping_cart'][$key]);
            header("location: index.php?content=cart");
        }
    }
    //reset session array keys so they match with $product_ids numeric array
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);

}

//pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
    <title>Ninjas in pyjamas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>


            <?php

            include("./phpscripts/connect_db.php");
            $query = 'SELECT * FROM pyjamas ORDER by id ASC';

            $result = mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_num_rows($result)) {
                    while ($product = mysqli_fetch_assoc($result)) {
            ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <form method="post" action="index.php?content=cart&action=add&id=<?php echo $product['id']; ?>">
                                <div class="card h-100">
                                    <a><img class="card-img-top" src="./img/pyjamas/<?php echo $product['Foto']; ?>" alt=""></a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a><?php echo $product['Naam']; ?></a>
                                        </h4>
                                        <h5><?php echo $product['Prijs']; ?></h5>
                                        <p class="card-text"><?php echo $product['Beschrijving']; ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <input type="text" name="quantity" class="form-control" value="1">
                                        <br>
                                        <input type="hidden" name="Naam" value="<?php echo $product['Naam']; ?>">
                                        <input type="hidden" name="Prijs" value="<?php echo $product['Prijs']; ?>">
                                        <input type="submit" name="add_to_cart" class="btn btn-info" value="Add to cart">
                                    </div>
                                </div>
                            </form>
                        </div>



                        <div style="clear:both"></div>  
        <br />  
        
  <?php
        }
    }
      }
            ?>
        </div>
    </main>
    <div class="table-responsive">  
        <table class="table">  
            <tr><th colspan="5"><h3>Order Details</h3></th></tr>   
        <tr>  
             <th width="40%">Product Name</th>  
             <th width="10%">Quantity</th>  
             <th width="20%">Price</th>  
             <th width="15%">Total</th>  
             <th width="5%">Action</th>  
        </tr>  
        <?php   
        if(!empty($_SESSION['shopping_cart'])):  
            
             $total = 0;  
        
             foreach($_SESSION['shopping_cart'] as $key => $product): 
        ?>  
        <tr>  
           <td><?php echo $product['Naam']; ?></td>  
           <td><?php echo $product['quantity']; ?></td>  
           <td>$ <?php echo $product['Prijs']; ?></td>  
           <td>$ <?php echo number_format($product['quantity'] * $product['Prijs'], 2); ?></td>  
           <td>
               <a href="index.php?content=cart&action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn-danger">Remove</div>
               </a>
           </td>  
        </tr>  
        <?php  
                  $total = $total + ($product['quantity'] * $product['Prijs']);  
             endforeach;  
        ?>  
        <tr>  
             <td colspan="3" align="right">Total</td>  
             <td align="right">$ <?php echo number_format($total, 2); ?></td>  
             <td></td>  
        </tr>  
        <tr>
            <!-- Show checkout button only if the shopping cart is not empty -->
            <td colspan="5">
             <?php 
                if (isset($_SESSION['shopping_cart'])):
                if (count($_SESSION['shopping_cart']) > 0):
             ?>
                <a href="#" class="button">Checkout</a>
             <?php endif; endif; ?>
            </td>
        </tr>
        <?php  
        endif;
        ?>  
        </table>  
         </div>
        </div>

        <?php 
        include("./components/footer.php");
        ?>
