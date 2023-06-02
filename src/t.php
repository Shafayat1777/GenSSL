<?php

	$Rcname = $_POST['Rcname'];
        $Rspname = $_POST['Rspname'];
        $Rlname = $_POST['Rlname'];
        $Roname = $_POST['Roname'];
        $Rouname = $_POST['Rouname'];
        $Rcomname = $_POST['Rcomname'];
        $Remail = $_POST['Remail'];
        
	$Scname = $_POST['Scname'];
        $Sspname = $_POST['Sspname'];
        $Slname = $_POST['Slname'];
        $Soname = $_POST['Soname'];
        $Souname = $_POST['Souname'];
        $Scomname = $_POST['Scomname'];
        $Semail = $_POST['Semail'];
        
        $Svcname = $_POST['Svcname'];
        $Svspname = $_POST['Svspname'];
        $Svlname = $_POST['Svlname'];
        $Svoname = $_POST['Svoname'];
        $Svouname = $_POST['Svouname'];
        $Svcomname = $_POST['Svcomname'];
        $Svemail = $_POST['Svemail'];

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
	
	$subdn = array(
		"countryName" => $Scname,
		"stateOrProvinceName" => $Sspname,
		"localityName" => $Slname,
		"organizationName" => $Soname,
		"organizationalUnitName" => $Souname,
		"commonName" => $Scomname,
		"emailAddress" => $Semail
	);

	$serverdn = array(
		"countryName" => $Svcname,
		"stateOrProvinceName" => $Svspname,
		"localityName" => $Svlname,
		"organizationName" => $Svoname,
		"organizationalUnitName" => $Svouname,
		"commonName" => $Svcomname,
		"emailAddress" => $Svemail
	);

// --------------------------------------- Root Ca ----------------------------------------- //
	//Generate the private key and certificate request for the root CA
	$privateKeyRoot = openssl_pkey_new(array(
	    "private_key_bits" => 2048,
	    "private_key_type" => OPENSSL_KEYTYPE_RSA,
	));

	$csrRoot = openssl_csr_new($rootdn, $privateKeyRoot, array(
        'config' => '/opt/lampp/htdocs/rootca.conf',
        'digest_alg' => 'sha256',
        'x509_extensions' => 'v3_ca',
		'serial_number' => '1011',
		));


	
	//Create the root CA certificate
	$caCertRoot = openssl_csr_sign($csrRoot, null, $privateKeyRoot, 365, array(
        'config' => '/opt/lampp/htdocs/rootca.conf',
        'digest_alg' => 'sha256',
        'x509_extensions' => 'v3_ca',
		'serial_number' => '1011',
		));

	
// --------------------------------------- Sub Ca ----------------------------------------- //
    	//Generate the private key and certificate request for the sub-CA
   	$privateKeySub = openssl_pkey_new(array(
	    "private_key_bits" => 2048,
	    "private_key_type" => OPENSSL_KEYTYPE_RSA,
	));

	$csrSub = openssl_csr_new($subdn, $privateKeySub);


    	//Create the sub-CA certificate, using the root CA to sign it
    	$caCertSub = openssl_csr_sign($csrSub, $caCertRoot, $privateKeyRoot, 365);



// --------------------------------------- Server ----------------------------------------- //
	//Generate the private key and certificate request for the server
    	$privateKeyServer = openssl_pkey_new(array(
	    "private_key_bits" => 2048,
	    "private_key_type" => OPENSSL_KEYTYPE_RSA,
	));

	$csrServer = openssl_csr_new($serverdn, $privateKeyServer);



    //Create the server certificate, using the sub-CA to sign it:
    $caCertServer = openssl_csr_sign($csrServer, $caCertSub, $privateKeySub, 365);

	
// --------------------------------------- Exporting ----------------------------------------- //	
	$error = array();
	
	
	if (!openssl_x509_export_to_file($caCertRoot, "/opt/lampp/htdocs/ca.crt")) {
	    	array_push($error,"Error exporting certificate: " . openssl_error_string());
	}
	if (!openssl_x509_export_to_file($caCertSub, "/opt/lampp/htdocs/sub-ca.crt")) {
	    	array_push($error,"Error exporting certificate: " . openssl_error_string());
	}
	if (!openssl_csr_export_to_file($csrServer, "/opt/lampp/htdocs/server.csr")) {
		array_push($error,"Error exporting certificate signing request: " . openssl_error_string());
	}
	if (!openssl_x509_export_to_file($caCertServer, "/opt/lampp/htdocs/server.crt")) {
		array_push($error,"Error exporting certificate: " . openssl_error_string());
	}
	if (!openssl_pkey_export_to_file($privateKeyServer, "/opt/lampp/htdocs/server.key")) {
	    array_push($error,"Error exporting private server key: " . openssl_error_string());
	}
	
	if(!$error){
        	echo '<p style="color: green;">Certificates created successfully!</p>';
        } else{
        	echo '<p style="red: green;">Certificates creating failed!</p><br>';
        	
        	foreach($error as $val){
        		echo $val;
        	}
        }

?>