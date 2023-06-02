<?php

	$subPK = array('SUB_Pkey_Bits' => (int)$_POST['SUB_Pkey_Bits'], 
					'SUB_Pkey_Type' => $_POST['SUB_Pkey_Type'], 
					'SUB_Pkey_Digest' => $_POST['SUB_Pkey_Digest'],
					'SUB_Pkey_Ency_Type' => $_POST['SUB_Pkey_Ency_Type'],
					'SUB_Pkey_Pass' => $_POST['SUB_Pkey_Pass']);

	// if(!empty($subPK['SUB_Pkey_Bits'])){
	// 	foreach($subPK as $x => $x_value) {
	// 		echo $x . " => " . $x_value;
	// 		echo "<br>";
	// 	}
	// 	echo '<hr>';
	// }

	if($subPK['SUB_Pkey_Type'] == 'OPENSSL_KEYTYPE_RSA'){
		$private_key_type = OPENSSL_KEYTYPE_RSA;
	}elseif($subPK['SUB_Pkey_Type'] == 'OPENSSL_KEYTYPE_DSA'){
		$private_key_type = OPENSSL_KEYTYPE_DSA;
	}else{
		$private_key_type = OPENSSL_KEYTYPE_EC;
	}
	
	//Generate the private key and certificate request for the sub CA
	$privateKeySub = openssl_pkey_new(array(
	    "private_key_bits" => $subPK['SUB_Pkey_Bits'],
	    "private_key_type" => $private_key_type,
		'digest_alg' => $subPK['SUB_Pkey_Digest']));

	openssl_pkey_export_to_file($privateKeySub, '/opt/lampp/htdocs/subca.key', $subPK['SUB_Pkey_Pass']);
?>