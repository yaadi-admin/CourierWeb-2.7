<?php

include '../includes/connect.php';
$user_id = $_SESSION['user_id'];
$GetRest_id = "";
?>
<div class="modal-content">
    <h5>My Cart</h5>
    <ul id="cart-collection" class="collection center-align" style="border-radius:16px;width: auto;">
        <?php
        $result = mysqli_query($con, "SELECT * FROM users where id= $user_id AND not deleted;");
        while($row = mysqli_fetch_array($result))
        {
            $res_name = $row['name'];
            $phone = $row["contact"];

            echo '<li class="collection-item avatar" style="width: 100%;">
<i class="mdi-content-content-paste red circle"></i>
<p><strong>Name:</strong> '.$name.'</p>
<p><strong>Contact:</strong> '.$phone.'</p>
</li>';
        }
        ?>
        <?php
        if(!empty($_SESSION["shopping_cart"]))
        {
            $total = 0;
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                $mealid = $values['item_id'];

                $getresttoplace = mysqli_query($con, "SELECT * FROM items where id= $mealid AND not deleted;");
                while($row = mysqli_fetch_array($getresttoplace))
                {
                    $GetRest_id = $row['restaurantid'];
                }

                ?>
                <li class="collection-item" style="width: 100%;">
                    <div class="row">
                        <div class="col s8">
                            <h6><span style="background-color: mediumaquamarine;color: black;border-radius: 8px;font-size: 12px;">(<?php echo $values["item_quantity"];?>)</span></h6>
                            <p class="collections-title"><?php echo $values["item_name"]; ?></p>
                            <?php
                            if (isset($values["item_variation"])) {
                                echo ' 
                                                                <label>Flavor: </label><label>'.$values["item_variation"].'</label><br>';
                            }

                            if (isset($values["item_variation_type"])){
                                echo '
            <label>Type: </label><label>'.$values["item_variation_type"].'</label><br>';
                            }

                            if (isset($values["item_variation_side"])){
                                echo '
            <label>Side: </label><label>'.$values["item_variation_side"].'</label><br>';
                            }

                            if (isset($values["item_variation_drink"])) {
                                echo '
            <label>Drink: </label><label>'.$values["item_variation_drink"].'</label><br>';
                            }
                            ?>
                        </div>

                        <div class="col s4"><br>
                            <span>$<?php echo $values["item_price"]; ?> <span style="font-size: 6px;">JMD</span></span><br>
                            <a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>&pgid=<?php echo $restid; ?>"><i class="mdi-navigation-close" style="font-size: 20px;color: maroon;"></i></a>
                        </div>
                    </div>
                </li>

                <?php
                $total = $total + ($values["item_quantity"] * $values["item_price"]);
            }
            ?>

            <li class="collection-item" style="width: 100%;">
                <div class="row">
                    <div class="col s7">
                        <p class="collections-title"> Subtotal</p>
                        <div class="card-action">
                        </div>
                    </div>
                    <div class="col s5"><br>
                        <span><strong>$<?php echo number_format($total); ?> <span style="font-size: 6px;">JMD</span></strong></span>
                    </div>
                </div>
            </li>
            <?php
        }
        ?>
    </ul>
</div>
<div id="modalfoot" class="modal-footer">
    <?php
    if ($GetRest_id != ""){
        $opencloser = "";
        $openclose = mysqli_query($con, "SELECT * FROM incumbency WHERE id= 2");
        while ($row = mysqli_fetch_array($openclose)) {
            $opencloser = $row['admission'];
        }

        if ($opencloser == 0) {
            echo '<form action="place-order.php?pgid=' . $GetRest_id . '" method="post">
                        <button class="waves-effect waves-green btn-flat" type="submit" name="action" style="border-radius:6px;">Checkout
                            <i class="mdi-action-shopping-cart right"></i></button>
                    </form>';
        }
        else {
            echo '<p class="center">Ordering currently closed<span class="right" style="border-radius: 16px;"><i class="mdi-action-shopping-cart" style="color: maroon;"></i></span></p>';
        }
    }
    else{
        echo '<a href="#!" class="modal-close waves-effect waves-green btn-flat">Close <i class="mdi-navigation-close right"></a></i>';
    }

    ?>
</div>