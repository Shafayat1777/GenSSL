<?php

	$serverPK = array('SERVER_Pkey_Bits' => (int)$_POST['SERVER_Pkey_Bits'], 
					'SERVER_Pkey_Type' => $_POST['SERVER_Pkey_Type'], 
					'SERVER_Pkey_Digest' => $_POST['SERVER_Pkey_Digest'],
					'SERVER_Pkey_Ency_Type' => $_POST['SERVER_Pkey_Ency_Type'],
					'SERVER_Pkey_Pass' => $_POST['SERVER_Pkey_Pass']);

	// if(!empty($serverPK['SERVER_Pkey_Bits'])){
	// 	foreach($serverPK as $x => $x_value) {
	// 		echo $x . " => " . $x_value;
	// 		echo "<br>";
	// 	}
	// 	echo '<hr>';
	// }
	
	if($serverPK['SERVER_Pkey_Type'] == 'OPENSSL_KEYTYPE_RSA'){
		$private_key_type = OPENSSL_KEYTYPE_RSA;
	}elseif($serverPK['SERVER_Pkey_Type'] == 'OPENSSL_KEYTYPE_DSA'){
		$private_key_type = OPENSSL_KEYTYPE_DSA;
	}else{
		$private_key_type = OPENSSL_KEYTYPE_EC;
	}

	//Generate the private key and certificate request for the server CA
	$serverPK = openssl_pkey_new(array(
	    "private_key_bits" => $serverPK['SERVER_Pkey_Bits'],
	    "private_key_type" => $private_key_type,
		'digest_alg' => $serverPK['SERVER_Pkey_Digest']));

	openssl_pkey_export_to_file($serverPK, '/opt/lampp/htdocs/serverca.key', $serverPK['SERVER_Pkey_Pass']);
?>