<?php
include('invoice/phpinvoice.php');
include('config.php');
$invoice = new phpinvoice();
  /* Header Settings */
  $invoice->setLogo("images/sample1.jpg");
  $invoice->setColor("#007fff");
  $invoice->setType("Purchase Form");
  $invoice->setReference("INV-55033645");
  $invoice->setDate(date('M dS ,Y',time()));
  $invoice->setTime(date('h:i:s A',time()));
  $invoice->setDue(date('M dS ,Y',strtotime('+3 months')));
  $invoice->setFrom(array("Seller Name","Sample Company Name","128 AA Juanita Ave","Glendora , CA 91740","United States of America"));
  $invoice->setTo(array("Purchaser Name","Sample Company Name","128 AA Juanita Ave","Glendora , CA 91740","United States of America"));
  /* Adding Items in table */
  $select = "SELECT * FROM purchase ORDER BY id DESC ";						
  $result = $conn->query($select);
  while($row = $result->fetch_assoc()){
	$inventory_id = $row["inventory_id"];
	$quantity_need = $row["need"];
	$qr = $row["qr"];
	$branch = $row["branch"];
	$status = $row["status"];
	
	$select2 = "SELECT * FROM inventory WHERE inventory_id = '$inventory_id' ";						
	$result2 = $conn->query($select2);
	while($row1 = $result2->fetch_assoc()){
		$price = $row1["price"];
		$quantity = $row1["quantity"];
		$qr = $row1["qr"];
		$inventory_name = $row1["name"];

		
		$quantity_now = $quantity;
		$total_price = $price * $quantity_need;
	
  $invoice->addItem($inventory_name,"ID: " . $inventory_id,$quantity_need,$qr,$price,false,$total_price);
    }
  }
  /* Add totals */
  $invoice->addTotal("Total",9460);
  $invoice->addTotal("Discount",'5%');
  $invoice->addTotal("VAT 21%",1986.6);
  $invoice->addTotal("Total due",11446.6,true);
  /* Set badge */ 
  $invoice->addBadge("Payment Paid");
  /* Add title */
  $invoice->addTitle("Important Notice");
  /* Add Paragraph */
  $invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you. You can refund within 2 days of purchase.");
  /* Set footer note */
  $invoice->setFooternote("My Company Name Here");
  /* Render */
  $invoice->render('example1.pdf','I'); /* I => Display on browser, D => Force Download, F => local path save, S => return document path */
  
  echo "<img src = 'qr/php/qr_img.php?d=5b3344777e2da' width='100'></img>";
  
  
?>