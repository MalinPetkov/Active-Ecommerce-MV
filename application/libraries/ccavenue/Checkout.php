<!--
	This is the sample Checkout Page php script. It can be directly used for integration with CCAvenue if your application is developed in PHP. You need to simply change the variables to match your variables as well as insert routines (if any) for handling a successful or unsuccessful transaction.
-->


<html>
<head>
<title> Checkout</title>
</head>
<body>
<center>
<?php include('adler32.php');?>
<?php include('Aes.php');?>
<?php 

error_reporting(0);
$merchant_id=$_POST['Merchant_Id'];  // Merchant id(also User_Id) 
$amount=$_POST['Amount'];            // your script should substitute the amount here in the quotes provided here
$order_id=$_POST['Order_Id'];        //your script should substitute the order description here in the quotes provided here
$url=$_POST['Redirect_Url'];         //your redirect URL where your customer will be redirected after authorisation from CCAvenue
$billing_cust_name=$_POST['billing_cust_name'];
$billing_cust_address=$_POST['billing_cust_address'];
$billing_cust_country=$_POST['billing_cust_country'];
$billing_cust_state=$_POST['billing_cust_state'];
$billing_city=$_POST['billing_city'];
$billing_zip=$_POST['billing_zip'];
$billing_cust_tel=$_POST['billing_cust_tel'];
$billing_cust_email=$_POST['billing_cust_email'];
$delivery_cust_name=$_POST['delivery_cust_name'];
$delivery_cust_address=$_POST['delivery_cust_address'];
$delivery_cust_country=$_POST['delivery_cust_country'];
$delivery_cust_state=$_POST['delivery_cust_state'];
$delivery_city=$_POST['delivery_city'];
$delivery_zip=$_POST['delivery_zip'];
$delivery_cust_tel=$_POST['delivery_cust_tel'];
$delivery_cust_notes=$_POST['delivery_cust_notes'];


$working_key='';	//Put in the 32 bit alphanumeric key in the quotes provided here.


$checksum=getchecksum($merchant_id,$amount,$order_id,$url,$working_key); // Method to generate checksum

$merchant_data= 'Merchant_Id='.$merchant_id.'&Amount='.$amount.'&Order_Id='.$order_id.'&Redirect_Url='.$url.'&billing_cust_name='.$billing_cust_name.'&billing_cust_address='.$billing_cust_address.'&billing_cust_country='.$billing_cust_country.'&billing_cust_state='.$billing_cust_state.'&billing_cust_city='.$billing_city.'&billing_zip_code='.$billing_zip.'&billing_cust_tel='.$billing_cust_tel.'&billing_cust_email='.$billing_cust_email.'&delivery_cust_name='.$delivery_cust_name.'&delivery_cust_address='.$delivery_cust_address.'&delivery_cust_country='.$delivery_cust_country.'&delivery_cust_state='.$delivery_cust_state.'&delivery_cust_city='.$delivery_city.'&delivery_zip_code='.$delivery_zip.'&delivery_cust_tel='.$delivery_cust_tel.'&billing_cust_notes='.$delivery_cust_notes.'&Checksum='.$checksum  ;

$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>

<form method="post" name="redirect" action="http://www.ccavenue.com/shopzone/cc_details.jsp"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=Merchant_Id value=$merchant_id>";

?>
</form>

</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>
