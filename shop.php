<main class="container-fluid">
    <div class="row">

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
