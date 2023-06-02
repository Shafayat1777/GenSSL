<?php
    $Svcname = $_POST['Svcname'];
    $Svspname = $_POST['Svspname'];
    $Svlname = $_POST['Svlname'];
    $Svoname = $_POST['Svoname'];
    $Svouname = $_POST['Svouname'];
    $Svcomname = $_POST['Svcomname'];
    $Svemail = $_POST['Svemail'];
    
    // Set up configuration options for the certificate
	$serverdn = array(
		"countryName" => $Svcname,
		"stateOrProvinceName" => $Svspname,
		"localityName" => $Svlname,
		"organizationName" => $Svoname,
		"organizationalUnitName" => $Svouname,
		"commonName" => $Svcomname,
		"emailAddress" => $Svemail
	);

	$serverCSR = array('SERVER_CSR_Digest' => $_POST['SERVER_CSR_Digest'],
					'SERVER_CSR_PKEY_Name' => $_POST['SERVER_CSR_PKEY_Name'],
					'SERVER_CSR_PKEY_Password' => $_POST['SERVER_CSR_PKEY_Password']);

	if(!empty($serverCSR['SERVER_CSR_Digest'])){
		foreach($serverCSR as $x => $x_value) {
			echo $x . " => " . $x_value;
			echo "<br>";
		}
		echo '<hr>';
	}
    echo '<hr>';
    echo '<hr>';
	if(!empty($serverdn['countryName'])){
		foreach($serverdn as $x => $x_value) {
			echo $x . " => " . $x_value;
			echo "<br>";
		}
		echo '<hr>';
	}
    
    // Load the private key from file
    $private_key = openssl_pkey_get_private(file_get_contents($serverCSR['SERVER_CSR_PKEY_Name']), $serverCSR['SERVER_CSR_PKEY_Password']);
    // print error if there is any
    if(!$private_key){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }

    // create the server-ca csr
    $csrServer = openssl_csr_new(
        $serverdn,
        $private_key,
        array('digest_alg' => $serverCSR['SERVER_CSR_Digest']));
    
    // print error if there is any
    if(!$csrServer){
        echo "Error SubCSR: " . openssl_error_string() . "<br>";
    }

	openssl_csr_export_to_file($csrServer, '/opt/lampp/htdocs/serverCSR.csr');
?>