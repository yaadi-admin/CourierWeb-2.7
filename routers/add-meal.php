<?php
if(isset($_POST["hidden_name"]))  {
    if(isset($_SESSION["shopping_cart"]))  {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'               =>     $_GET["id"],
                'item_name'               =>     $_POST["hidden_name"],
                'item_price'          =>     $_POST["hidden_price"],
                'item_quantity'          =>     $_POST["quantity"],
                'item_variation'        =>    $_POST["variation"],
                'item_variation_type'        =>    $_POST["variation_typee"],
                'item_variation_side'        =>    $_POST["variation_side"],
                'item_variation_drink'        =>    $_POST["variation_drink"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
            $Itemnm = $_POST["hidden_name"];
            echo '<script>Materialize.toast("'.$Itemnm.' was added to your cart", 4000);</script>';
        }
        else
        {
            echo '<script>Materialize.toast("'.$_POST["hidden_name"].' is already in your cart", 4000);</script>';
        }
    }
    else
    {
        $item_array = array(
            'item_id'               =>     $_GET["id"],
            'item_name'               =>     $_POST["hidden_name"],
            'item_price'          =>     $_POST["hidden_price"],
            'item_quantity'          =>     $_POST["quantity"],
            'item_variation'        =>    $_POST["variation"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}
if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>Materialize.toast("'.$Itemnm.' was removed fom your cart", 4000);</script>';
            }
        }
    }
}
echo '<script>Materialize.toast("'.$_POST["hidden_id"].' was added to your cart", 4000);</script>';
?>