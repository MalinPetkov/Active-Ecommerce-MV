<?php


/*
	This is an AES Encryption and Decryption Code (128 Bit) in PHP which is compatible with PHP 4 & PHP 5. 
	In order to use the encrypt and decrypt methods a string and same key is required.

	encrypt method: returns the encypted text.
	decrypt mehtod: returns the plain text after decrypting.
*/

	error_reporting(0);

	function encrypt($plainText,$key)
	{
		$secretKey = hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		
	 	/* Open module and Create IV (Intialization Vector) */
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
	  	$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = pkcs5_pad($plainText, $blockSize);
	  	
		/* Initialize encryption handle */
	  	 if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
		{
		      /* Encrypt data */
		      $encryptedText = mcrypt_generic($openMode, $plainPad);
	      	      mcrypt_generic_deinit($openMode);
		      			
		} 
	
		return bin2hex($encryptedText);
	}

	function decrypt($encryptedText,$key)
	{
		$secretKey = hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText=hextobin($encryptedText);

	   	/* Open module, and create IV */
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');


		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);

		// Drop nulls from end of string
		$decryptedText = rtrim($decryptedText, "\0");

		// Returns "Decrypted string: some text here"

	 	mcrypt_generic_deinit($openMode);
		
		return $decryptedText;
		
	}
	//*********** Padding Function *********************

	 function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}

	//********** Hexadecimal to Binary function for php 4.0 version ********

	function hextobin($hexString) 
   	 { 
        	$length = strlen($hexString); 
        	$binString="";   
        	$count=0; 
        	while($count<$length) 
        	{       
        	    $subString =substr($hexString,$count,2);           
        	    $packedString = pack("H*",$subString); 
        	    if ($count==0)
		    {
			$binString=$packedString;
		    } 
        	    
		    else 
		    {
			$binString.=$packedString;
		    } 
        	    
		    $count+=2; 
        	} 
  	        return $binString; 
    	  } 
?>

