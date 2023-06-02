<?php

	$rootCSRSIGN = array('R_CSR_Sign_Days' => (int)$_POST['R_CSR_Sign_Days'],
						'R_CSR_Sign_PKEY_path' => $_POST['R_CSR_Sign_PKEY_path'],
						'R_CSR_Sign_PKEY_Password' => $_POST['R_CSR_Sign_PKEY_Password'],
						'R_CSR_Sign_CSR_path' => $_POST['R_CSR_Sign_CSR_path'],
						'R_CSR_Sign_Digest' => $_POST['R_CSR_Sign_Digest']);

    if(!empty($rootCSRSIGN['R_CSR_Sign_Days'])){
        foreach($rootCSRSIGN as $x => $x_value) {
            echo $x . " => " . $x_value;
            echo "<br>";
        }
        echo '<hr>';
    }


    // Load the private key from file
    $private_key = openssl_pkey_get_private(file_get_contents($rootCSRSIGN['R_CSR_Sign_PKEY_path']), $rootCSRSIGN['R_CSR_Sign_PKEY_Password']);
    // print error if there is any
    if(!$private_key){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }
    // Load the csr from file
    $csr = file_get_contents($rootCSRSIGN['R_CSR_Sign_CSR_path']);
    // print error if there is any
    if(!$csr){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }


    // self-sign the root CA certificate
    $caCertRoot = openssl_csr_sign(
        $csr,
        null,
        $private_key,
        $rootCSRSIGN['R_CSR_Sign_Days'],
        array('digest_alg' => $rootCSRSIGN['R_CSR_Sign_Digest']));


    if (!openssl_x509_export_to_file($caCertRoot, "/opt/lampp/htdocs/ca.crt")) {
        echo "Error exporting Root-Ca certificate: " . openssl_error_string();
    }

?>