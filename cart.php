<?php
  session_start();
  ob_start();
  $sitePath = $_SERVER['DOCUMENT_ROOT']."crafts";
?>

<?php include_once($sitePath."/inc/_header.php"); ?>
<?php include_once($sitePath."/user/nav.php"); ?>
<?php include_once($sitePath."/inc/_dbconnect.php"); ?>

<h1>Cart </h1>



<?php  // Checkout label epending upon session
  $checkoutlabel="";
  if (!isset($_SESSION["user"])) {
   
      $checkoutlabel = "Checkout as Guest";
  }
  else{
     
      $checkoutlabel = "Checkout";
  }

?>






<?php
//this section creates shopping cart array

if(isset($_GET['itemId'])) {
	$itemid = $_GET['itemId'];
	$wasFound = false;
	$i = 0;

	//if the cart session variable is not set or cart array is empty
	if(!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
		//RUN if cart is empty or session is not set
			$_SESSION["cart_array"] = array(1 => array("itemid" => $itemid, "quantity" => 1));

	} else {
		//RUN if the cart has at least one item
		foreach ($_SESSION["cart_array"] as $each_item) {
			$i++;
			while (list($key, $value) = each($each_item)) {
				if($key == "itemid" && $value == $itemid) {
					//the item is already in the cart - adjust quantity
					array_splice($_SESSION["cart_array"], $i-1, 1, array(array("itemid" => $itemid, "quantity" => $each_item['quantity'] + 1)));
					$wasFound = true;
					}
				}
			}
			//new item added to the cart
			if($wasFound == false) {
				array_push($_SESSION["cart_array"], array("itemid" => $itemid, "quantity" => 1));
			}
		}
	}



?>

<?php
	////this section checks if user chooses to empty shopping cart
	if(isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
		unset($_SESSION["cart_array"]);
		}

?>

<?php
	////this section checks if user chooses to adjust item quantity

	if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "") {
	    $item_to_adjust = $_POST['item_to_adjust'];
		$quantity = $_POST['quantity'];
		$quantity = preg_replace('#[^0-9]#i', '', $quantity); // filter everything but numbers
		if ($quantity >= 100) { $quantity = 99; }
		if ($quantity < 1) { $quantity = 1; }
		if ($quantity == "") { $quantity = 1; }
		$i = 0;
		foreach ($_SESSION["cart_array"] as $each_item) {
			      $i++;
			      while (list($key, $value) = each($each_item)) {
					  if ($key == "itemid" && $value == $item_to_adjust) {
						  // That item is in cart already so lets adjust its quantity using array_splice()
						  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("itemid" => $item_to_adjust, "quantity" => $quantity)));
					  } // close if condition
			      } // close while loop
		} // close foreach loop
}
?>

<?php
	////this section checks if user chooses to remove an item from the shopping cart
if (isset($_POST['item_to_remove']) && $_POST['item_to_remove'] != "") {
    // Access the array and run code to remove that array index
	$key_to_remove = $_POST['item_to_remove'];
	if (count($_SESSION["cart_array"]) <= 1) {
		unset($_SESSION["cart_array"]);
	} else {
		unset($_SESSION["cart_array"]["$key_to_remove"]);
		sort($_SESSION["cart_array"]);
	}
}
?>

<?php
//Display Shopping Cart
$shoppingCart = "";
$product_id_array = "";
$cartTotal = "";
$priceTotal = "";
$pp_checkout_btn = "";



if(!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
	$shoppingCart = "<h2 align='center'>Your shopping cart is empty</h2>";
}
else {
	// Start PayPal Checkout Button
	$pp_checkout_btn .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	    <input type="hidden" name="cmd" value="_cart">
	    <input type="hidden" name="upload" value="1">
    	<input type="hidden" name="business" value="r.maharjan6109@gmail.com">';
	$i = 0;
	foreach ($_SESSION["cart_array"] as $each_item) {
		$itemid = $each_item['itemid'];
		$sql = "SELECT * FROM products where product_id ='$itemid' LIMIT 1";
		
		$result = mysqli_query($con, $sql);
		
		while ($row = mysqli_fetch_array($result)) {
			$itemtitle = $row['product_name'];
			$price = $row['price'];
		}

		$priceTotal = $price * $each_item['quantity'];
		$cartTotal = $priceTotal + $cartTotal;
		setlocale(LC_MONETARY, "en_US");
		//$priceTotal = money_format("%10.2n", $priceTotal);
		$priceTotal = number_format($priceTotal, 2); 

		//echo "$".$priceTotal;

		// Dynamic Checkout Btn Assembly
		$x = $i + 1;
		$pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $itemtitle . '">
		     <input type="hidden" name="amount_' . $x . '" value="' . $price . '">
        	<input type="hidden" name="quantity_' . $x . '" value="' . $each_item['quantity'] . '">  ';
		// Create the cart items array variable
		$product_id_array .= "$itemid-".$each_item['quantity'].",";
		// Dynamic shopping cart table display assembly
		$shoppingCart .= '<tr>';
		$shoppingCart .= '<td> Menu Item: ' .$itemtitle. '</td>&nbsp;';
		$shoppingCart .= '<td>$' .$price. '</td>';
		$shoppingCart .= '<td><form action="cart.php" method="post">
		<div class="form-inline">
			<input class="form-control" name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
		
			<button class="btn btn-link" name="adjustBtn' . $itemid . '" type="submit" >
				<i class="glyphicon glyphicon-pencil"></i>
			</button>
		
		</div>
		<input name="item_to_adjust" type="hidden" value="' . $itemid . '" />
		</form></td>';
		$shoppingCart .= '<td>$' .$priceTotal. '</td>';
		$shoppingCart .= '<td><form action="cart.php" method="post">
		<button class="btn btn-link" name="deleteBtn'
		. $itemid . '" type="submit" value="" />
			<i class="glyphicon glyphicon-trash"></i>
		</button>

		<input name="item_to_remove" type="hidden" value="' . $i . '" />
		</form></td>';
		$shoppingCart .= '</tr>';
		//$shoppingCart .= '<td>' . $each_item['quantity'] . '</td>';
		$i++;
	}
		setlocale(LC_MONETARY, "en_US");
	    //$cartTotal = money_format("%10.2n", $cartTotal);
		$cartTotal = number_format($cartTotal, 2); 

		//echo "$".$cartTotal;

		$cartTotal = "Cart Total : $".$cartTotal;
		//echo ($cartTotal);
		// Finish the Paypal Checkout Btn
			$pp_checkout_btn .= '
			<input type="hidden" name="custom" value="' . $product_id_array . '">
			<input type="hidden" name="notify_url" value="https://www.yoursite.com/storescripts/my_ipn.php">
			<input type="hidden" name="return" value="https://www.yoursite.com/checkout_complete.php">
			<input type="hidden" name="rm" value="2">
			<input type="hidden" name="cbt" value="Return to The Store">
			<input type="hidden" name="cancel_return" value="https://www.yoursite.com/paypal_cancel.php">
			<input type="hidden" name="lc" value="US">
			<input type="hidden" name="currency_code" value="USD">
			<input class="btn btn-success pull-right" type="submit" name="submit" value="'.$checkoutlabel.'" alt="Make payments with PayPal - its fast, free and secure!">
			
	</form>';
}
?>


    <table class="table table-striped table-bordered">
      <thead>
		<tr class="active">
	        <th>Product</th>
	        <th>Unit Price</th>
	        <th>Quantity</th>
	        <th>Total</th>
	        <th>Remove</th>
      	</tr>	
      </thead>
      

		<?php echo $shoppingCart; ?>

 </table>


<div class="row">
	<div class="col-sm-6">
	<?php echo $cartTotal; ?>
	</div>
	<div class="col-sm-6">

<?php  

      echo $pp_checkout_btn;
 

?>
	
	</div>
</div>

<hr>

<div class="form-group text-right">
<a class="btn btn-xs btn-link" href="cart.php?cmd=emptycart">EmptyCart</a>
<a class="btn btn-xs btn-default" href="home.php">Keep Shopping</a>
</div>





<?php include_once($sitePath."/inc/_footer.php"); ?>

