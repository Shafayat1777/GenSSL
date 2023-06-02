<?php

	$rootPK = array('R_Pkey_Bits' => (int)$_POST['R_Pkey_Bits'], 
					'R_Pkey_Type' => $_POST['R_Pkey_Type'], 
					'R_Pkey_Digest' => $_POST['R_Pkey_Digest'],
					'R_Pkey_Ency_Type' => $_POST['R_Pkey_Ency_Type'],
					'R_Pkey_Pass' => $_POST['R_Pkey_Pass']);


	// if(!empty($rootPK['R_Pkey_Bits'])){
	// 	foreach($rootPK as $x => $x_value) {
	// 		echo $x . " => " . $x_value;
	// 		echo "<br>";
	// 	}
	// 	echo '<hr>';
	// }

	//Generate the private key and certificate request for the root CA
	if($rootPK['R_Pkey_Type'] == 'OPENSSL_KEYTYPE_RSA'){
		$private_key_type = OPENSSL_KEYTYPE_RSA;
	}elseif($rootPK['R_Pkey_Type'] == 'OPENSSL_KEYTYPE_DSA'){
		$private_key_type = OPENSSL_KEYTYPE_DSA;
	}else{
		$private_key_type = OPENSSL_KEYTYPE_EC;
	}

	$privateKeyRoot = openssl_pkey_new(array(
		"private_key_bits" => $rootPK['R_Pkey_Bits'],
		"private_key_type" => $private_key_type,
		'digest_alg' => $rootPK['R_Pkey_Digest'],
	));

	if(!$privateKeyRoot){
		echo "Error creating Root-Ca private key: " . openssl_error_string();
	}

	if (!openssl_pkey_export_to_file($privateKeyRoot, '/opt/lampp/htdocs/rootca.key', $rootPK['R_Pkey_Pass'])) {
        echo "Error exporting Root-Ca private key: " . openssl_error_string();
    }
?>