<?php
    $Rcname = $_POST['Rcname'];
    $Rspname = $_POST['Rspname'];
    $Rlname = $_POST['Rlname'];
    $Roname = $_POST['Roname'];
    $Rouname = $_POST['Rouname'];
    $Rcomname = $_POST['Rcomname'];
    $Remail = $_POST['Remail'];
    
    // Set up configuration options for the certificate
	$rootdn = array(
		"countryName" => "$Rcname",
		"stateOrProvinceName" => "$Rspname",
		"localityName" => "$Rlname",
		"organizationName" => "$Roname",
		"organizationalUnitName" => "$Rouname",
		"commonName" => "$Rcomname",
		"emailAddress" => "$Remail"
	);

	$rootCSR = array('R_CSR_Digest' => $_POST['R_CSR_Digest'],
					'R_CSR_PKEY_Name' => $_POST['R_CSR_PKEY_Name'],
					'R_CSR_PKEY_Password' => $_POST['R_CSR_PKEY_Password']);

	if(!empty($rootCSR['R_CSR_Digest'])){
		foreach($rootCSR as $x => $x_value) {
			echo $x . " => " . $x_value;
			echo "<br>";
		}
		echo '<hr>';
	}
    echo '<hr>';
    echo '<hr>';
	if(!empty($rootdn['countryName'])){
		foreach($rootdn as $x => $x_value) {
			echo $x . " => " . $x_value;
			echo "<br>";
		}
		echo '<hr>';
	}
    
    // Load the private key from file
    $private_key = openssl_pkey_get_private(file_get_contents($rootCSR['R_CSR_PKEY_Name']), $rootCSR['R_CSR_PKEY_Password']);
	// print error if there is any
    if(!$private_key){
        echo "Error privete key: " . openssl_error_string() . "<br>";
    }

	// create the rootca csr
    $csrRoot = openssl_csr_new(
        $rootdn,
        $private_key,
        array('digest_alg' => $rootCSR['R_CSR_Digest']));
    
    // print error if there is any
    if(!$csrRoot){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }

	if (!openssl_csr_export_to_file($csrRoot, '/opt/lampp/htdocs/rootCSR.csr')) {
        echo "Error exporting Root-Ca csr: " . openssl_error_string();
    }
?>