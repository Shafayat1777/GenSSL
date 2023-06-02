<?php

	$serverCSRSIGN = array('SERVER_CSR_Sign_Days' => (int)$_POST['SERVER_CSR_Sign_Days'],
						'SERVER_CSR_Sign_SUB_PKEY_path' => $_POST['SERVER_CSR_Sign_SUB_PKEY_path'],
						'SERVER_CSR_Sign_SUB_PKEY_Password' => $_POST['SERVER_CSR_Sign_SUB_PKEY_Password'],
						'SERVER_CSR_Sign_CSR_path' => $_POST['SERVER_CSR_Sign_CSR_path'],
						'SERVER_CSR_Sign_SUB_CSR_path' => $_POST['SERVER_CSR_Sign_SUB_CSR_path'],
						'SERVER_CSR_Sign_Digest' => $_POST['SERVER_CSR_Sign_Digest']);

    if(!empty($serverCSRSIGN['SERVER_CSR_Sign_Days'])){
        foreach($serverCSRSIGN as $x => $x_value) {
            echo $x . " => " . $x_value;
            echo "<br>";
        }
        echo '<hr>';
    }


    // Load the sub private key from file
    $private_key = openssl_pkey_get_private(file_get_contents($serverCSRSIGN['SERVER_CSR_Sign_SUB_PKEY_path']), $serverCSRSIGN['SERVER_CSR_Sign_SUB_PKEY_Password']);
    // print error if there is any
    if(!$private_key){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }
    // Load the server csr from file
    $csr = file_get_contents($serverCSRSIGN['SERVER_CSR_Sign_CSR_path']);
    // print error if there is any
    if(!$csr){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }
    // Load the subca cert from file
    $certSUB = file_get_contents($serverCSRSIGN['SERVER_CSR_Sign_SUB_CSR_path']);
    // print error if there is any
    if(!$certSUB){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }


    // sign the sub CA certificate with the root CA
    $caCertServer = openssl_csr_sign(
        $csr,
        $certSUB, // Pass the subCA certificate as the signing certificate
        $private_key, // Pass the private key of the subCA
        $serverCSRSIGN['SERVER_CSR_Sign_Days'],
        array('digest_alg' => $serverCSRSIGN['SERVER_CSR_Sign_Digest']));


    if (!openssl_x509_export_to_file($caCertServer, "/opt/lampp/htdocs/serverca.crt")) {
        echo "Error exporting Root-Ca certificate: " . openssl_error_string();
    }
    else{
        echo "<a href=\"/opt/lampp/htdocs/rootca.key\" download>Download</a>";
    }

?>