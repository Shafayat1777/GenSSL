<?php

	$subCSRSIGN = array('SUB_CSR_Sign_Days' => (int)$_POST['SUB_CSR_Sign_Days'],
						'SUB_CSR_Sign_ROOT_PKEY_path' => $_POST['SUB_CSR_Sign_ROOT_PKEY_path'],
						'SUB_CSR_Sign_ROOT_PKEY_Password' => $_POST['SUB_CSR_Sign_ROOT_PKEY_Password'],
						'SUB_CSR_Sign_CSR_path' => $_POST['SUB_CSR_Sign_CSR_path'],
						'SUB_CSR_Sign_ROOT_CSR_path' => $_POST['SUB_CSR_Sign_ROOT_CSR_path'],
						'SUB_CSR_Sign_Digest' => $_POST['SUB_CSR_Sign_Digest']);

    if(!empty($subCSRSIGN['SUB_CSR_Sign_Days'])){
        foreach($subCSRSIGN as $x => $x_value) {
            echo $x . " => " . $x_value;
            echo "<br>";
        }
        echo '<hr>';
    }


    // Load the root private key from file
    $private_key = openssl_pkey_get_private(file_get_contents($subCSRSIGN['SUB_CSR_Sign_ROOT_PKEY_path']), $subCSRSIGN['SUB_CSR_Sign_ROOT_PKEY_Password']);
    // print error if there is any
    if(!$private_key){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }
    // Load the sub csr from file
    $csr = file_get_contents($subCSRSIGN['SUB_CSR_Sign_CSR_path']);
    // print error if there is any
    if(!$csr){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }
    // Load the rootca cert from file
    $certROOT = file_get_contents($subCSRSIGN['SUB_CSR_Sign_ROOT_CSR_path']);
    // print error if there is any
    if(!$certROOT){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }


    // sign the sub CA certificate with the root CA
    $caCertSub = openssl_csr_sign(
        $csr,
        $certROOT, // Pass the rootCA certificate as the signing certificate
        $private_key, // Pass the private key of the rootCA
        $subCSRSIGN['SUB_CSR_Sign_Days'],
        array('digest_alg' => $subCSRSIGN['SUB_CSR_Sign_Digest']));


    if (!openssl_x509_export_to_file($caCertSub, "/opt/lampp/htdocs/subca.crt")) {
        echo "Error exporting Root-Ca certificate: " . openssl_error_string();
    }

?>