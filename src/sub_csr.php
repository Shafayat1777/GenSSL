<?php
    $Scname = $_POST['Scname'];
    $Sspname = $_POST['Sspname'];
    $Slname = $_POST['Slname'];
    $Soname = $_POST['Soname'];
    $Souname = $_POST['Souname'];
    $Scomname = $_POST['Scomname'];
    $Semail = $_POST['Semail'];
    
    // Set up configuration options for the certificate
	$subdn = array(
		"countryName" => $Scname,
		"stateOrProvinceName" => $Sspname,
		"localityName" => $Slname,
		"organizationName" => $Soname,
		"organizationalUnitName" => $Souname,
		"commonName" => $Scomname,
		"emailAddress" => $Semail
	);

	$subCSR = array('SUB_CSR_Digest' => $_POST['SUB_CSR_Digest'],
					'SUB_CSR_PKEY_Name' => $_POST['SUB_CSR_PKEY_Name'],
					'SUB_CSR_PKEY_Password' => $_POST['SUB_CSR_PKEY_Password']);

	if(!empty($subCSR['SUB_CSR_Digest'])){
		foreach($subCSR as $x => $x_value) {
			echo $x . " => " . $x_value;
			echo "<br>";
		}
		echo '<hr>';
	}
    echo '<hr>';
    echo '<hr>';
	if(!empty($subdn['countryName'])){
		foreach($subdn as $x => $x_value) {
			echo $x . " => " . $x_value;
			echo "<br>";
		}
		echo '<hr>';
	}
    
    // Load the private key from file
    $private_key = openssl_pkey_get_private(file_get_contents($subCSR['SUB_CSR_PKEY_Name']), $subCSR['SUB_CSR_PKEY_Password']);
    // print error if there is any
    if(!$private_key){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }

    // create the sub-ca csr
    $csrSub = openssl_csr_new(
        $subdn,
        $private_key,
        array('digest_alg' => $subCSR['SUB_CSR_Digest']));

    
    // print error if there is any
    if(!$csrSub){
        echo "Error RootCSR: " . openssl_error_string() . "<br>";
    }

	openssl_csr_export_to_file($csrSub, '/opt/lampp/htdocs/subCSR.csr');
?>