<!DOCTYPE html>
<html>
      <head>
            <link rel="stylesheet" href="test.css">
      </head>
      <body>
            <div class="Main div">
                  <center><h2>OpenSSL Certificate Creation Form</h2></center>
                  <table class="Main Table">
                        <tr>
                              <td>
                              <!-- RootCA -->
                              <div class="rootCa div">
                                    <form method="post" action="root_pk.php">
                                          <h3>RootCA Private Key</h3>
                                          <label>Private key bits:</label>
                                          <!-- <input type="number" name="R_Pkey_Bits"> -->
                                          <!-- <label>should be a multiple of 64 and must be at least 384 bits</label> -->
                                          <select  name="R_Pkey_Bits">
                                                <option value="2048">2048</option>
                                                <option value="4096">4096</option>
                                          </select>
                                          <br>
                                          <!-- Private key type -->
                                          <label>Private key type:</label>
                                          <select  name="R_Pkey_Type">
                                                <option value="OPENSSL_KEYTYPE_RSA">RSA</option>
                                                <option value="OPENSSL_KEYTYPE_DSA">DSA</option>
                                                <option value="OPENSSL_KEYTYPE_EC">EC</option>
                                          </select>
                                          <br>
                                          <!-- Private key Digest Algorithm -->
                                          <label>Digest Algorithm:</label>
                                          <select  name="R_Pkey_Digest">
                                                <option value="md5">MD-5</option>
                                                <option value="sha256">SHA-256</option>
                                          </select>
                                          <br>
                                          <!-- Private key Encryption Type -->
                                          <label>Encryption Type:</label>
                                          <select  name="R_Pkey_Ency_Type">
                                                <option value="OPENSSL_CIPHER_AES_128_CBC">AES-128</option>
                                                <option value="OPENSSL_CIPHER_AES_192_CBC">AES-192</option>
                                                <option value="OPENSSL_CIPHER_AES_256_CBC">AES-256</option>
                                                <option value="OPENSSL_CIPHER_DES">DES</option>
                                                <option value="OPENSSL_CIPHER_3DES">3DES</option>
                                          </select>
                                          <br>
                                          <!-- Private key Password -->
                                          <label>Enter a Password:</label>
                                          <input type="password" name="R_Pkey_Pass">
                                          <center><input type="submit" value="Submit"> <input type="reset" value="Reset"></center>
                                          <hr>
                                    </form>

                                    <form form method="post" action="root_csr.php">
                                          <h3>RootCA CSR</h3>
                                          <!-- RootCA CSR Digest Algorithm -->
                                          <label>Digest Algorithm:</label>
                                          <select  name="R_CSR_Digest">
                                                <option value="sha256">SHA-256</option>
                                                <option value="md5">MD-5</option>
                                          </select>
                                          <!-- RootCA CSR PK file_name/path -->
                                          <label>Enter private key path/name:</label>
                                          <input type="text" name="R_CSR_PKEY_Name">
                                          <!-- RootCA CSR PK password -->
                                          <label>Enter private key password:</label>
                                          <input type="password" name="R_CSR_PKEY_Password">

                                          <table class="rootCa Table">
                                                <tr>
                                                <th colspan="2">
                                                            <label class="m_lbl">Root CA</label>
                                                </th>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Country Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Rcname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">State Or Province Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Rspname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Locality Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Rlname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Organization Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Roname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Organizational Unit Name</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Rouname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Common Name</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Rcomname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Email Address</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Remail">
                                                      </td>
                                                </tr>  
                                          </table>
                                          <center><input type="submit" value="Submit"> <input type="reset" value="Reset"></center>
                                          <hr>
                                    </form>

                                    <form form method="post" action="root_csr_sign.php">
                                          <h3>RootCA CSR Sign</h3>
                                          <!-- RootCA CSR Days -->
                                          <label>Enter number of days:</label>
                                          <input type="number" name="R_CSR_Sign_Days">
                                          <!-- RootCA private key path -->
                                          <label>Enter private key path/name:</label>
                                          <input type="text" name="R_CSR_Sign_PKEY_path">
                                          <!-- RootCA CSR PK password -->
                                          <label>Enter private key password:</label>
                                          <input type="password" name="R_CSR_Sign_PKEY_Password">
                                          <!-- RootCA CSR path/name -->
                                          <label>Enter RootCA CSR path/name:</label>
                                          <input type="text" name="R_CSR_Sign_CSR_path">
                                          <!-- RootCA CSR Sign Digest Algorithm -->
                                          <label>Digest Algorithm:</label>
                                          <select  name="R_CSR_Sign_Digest">
                                                <option value="sha256">SHA-256</option>
                                                <option value="md5">MD-5</option>
                                          </select>
                                          <center><input type="submit" value="Submit"> <input type="reset" value="Reset"></center>
                                    </form>
                              </div>
                              </td>

                              <td>
                              <!-- SubCA -->
                              <div class="subCa div">
                                    <form form method="post" action="sub_pk.php">
                                          <h3>SubCA Private Key</h3>
                                          <label>Private key bits:</label>
                                          <!-- <input type="number" name="SUB_Pkey_Bits"> -->
                                          <!-- <label>should be a multiple of 64 and must be at least 384 bits</label> -->
                                          <select  name="SUB_Pkey_Bits">
                                                <option value="2048">2048</option>
                                                <option value="4096">4096</option>
                                          </select>
                                          <br>
                                          <!-- Sub key type -->
                                          <label>Private key type:</label>
                                          <select  name="SUB_Pkey_Type">
                                                <option value="OPENSSL_KEYTYPE_RSA">RSA</option>
                                                <option value="OPENSSL_KEYTYPE_DSA">DSA</option>
                                                <option value="OPENSSL_KEYTYPE_EC">EC</option>
                                          </select>
                                          <br>
                                          <!-- Sub key Digest Algorithm -->
                                          <label>Digest Algorithm:</label>
                                          <select  name="SUB_Pkey_Digest">
                                                <option value="sha256">SHA-256</option>
                                                <option value="md5">MD-5</option>
                                          </select>
                                          <br>
                                          <!-- Sub key Encryption Type -->
                                          <label>Encryption Type:</label>
                                          <select  name="SUB_Pkey_Ency_Type">
                                                <option value="OPENSSL_CIPHER_AES_128_CBC">AES-128</option>
                                                <option value="OPENSSL_CIPHER_AES_192_CBC">AES-192</option>
                                                <option value="OPENSSL_CIPHER_AES_256_CBC">AES-256</option>
                                                <option value="OPENSSL_CIPHER_DES">DES</option>
                                                <option value="OPENSSL_CIPHER_3DES">3DES</option>
                                          </select>
                                          <br>
                                          <!-- Sub key Password -->
                                          <label>Enter a Password:</label>
                                          <input type="text" name="SUB_Pkey_Pass">
                                          <center><input type="submit" value="Submit"> <input type="reset" value="Reset"></center>
                                          <hr>      
                                    </form>

                                    <form form method="post" action="sub_csr.php">
                                          <h3>SubCA CSR</h3>
                                          <!-- SubCA CSR Digest Algorithm -->
                                          <label>Digest Algorithm:</label>
                                          <select  name="SUB_CSR_Digest">
                                                <option value="sha256">SHA-256</option>
                                                <option value="md5">MD-5</option>
                                          </select>
                                          <!-- SubCA CSR PK file_name/path -->
                                          <label>Enter private key path/name:</label>
                                          <input type="text" name="SUB_CSR_PKEY_Name">
                                          <!-- SubCA CSR Digest Algorithm -->
                                          <label>Enter private key password:</label>
                                          <input type="password" name="SUB_CSR_PKEY_Password">
                                          
                                          <table class="subCa Table">
                                                <tr>
                                                <th colspan="2">
                                                            <label class="m_lbl">Sub CA</label>
                                                </th>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Country Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Scname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">State Or Province Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Sspname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Locality Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Slname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Organization Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Soname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Organizational Unit Name</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Souname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Common Name</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Scomname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Email Address</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Semail">
                                                      </td>
                                                </tr>
                                          </table>
                                          <center><input type="submit" value="Submit"> <input type="reset" value="Reset"></center>
                                          <hr>
                                    </form>

                                    <form form method="post" action="sub_csr_sign.php">
                                          <h3>SubCA CSR Sign</h3>
                                          <!-- SubCA CSR Days -->
                                          <label>Enter number of days:</label>
                                          <input type="number" name="SUB_CSR_Sign_Days">
                                          <!-- SubCA private key path -->
                                          <label>Enter Root private key path/name:</label>
                                          <input type="text" name="SUB_CSR_Sign_ROOT_PKEY_path">
                                          <!-- SubCA CSR PK password -->
                                          <label>Enter Root private key password:</label>
                                          <input type="password" name="SUB_CSR_Sign_ROOT_PKEY_Password">
                                          <!-- SubCA CSR path/name -->
                                          <label>Enter SubCA CSR path/name:</label>
                                          <input type="text" name="SUB_CSR_Sign_CSR_path">
                                          <!-- RootCA CSR path/name -->
                                          <label>Enter RootCA Certificate path/name:</label>
                                          <input type="text" name="SUB_CSR_Sign_ROOT_CSR_path">
                                          <!-- SubCA CSR Sign Digest Algorithm -->
                                          <label>Digest Algorithm:</label>
                                          <select  name="SUB_CSR_Sign_Digest">
                                                <option value="sha256">SHA-256</option>
                                                <option value="md5">MD-5</option>
                                          </select>
                                          <center><input type="submit" value="Submit"> <input type="reset" value="Reset"></center>
                                    </form>
                              </div>
                              </td>
                              
                              <td>
                              <!-- ServerCA -->
                              <div class="serverCa div">
                                    <form form method="post" action="server_pk.php">
                                          <h3>ServerCA Private Key</h3>
                                          <label>Private key bits:</label>
                                          <!-- <input type="number" name="R_Pkey_Bits"> -->
                                          <!-- <label>should be a multiple of 64 and must be at least 384 bits</label> -->
                                          <select  name="SERVER_Pkey_Bits">
                                                <option value="2048">2048</option>
                                                <option value="4096">4096</option>
                                          </select>
                                          <br>
                                          <!-- Server Private key type -->
                                          <label>Private key type:</label>
                                          <select  name="SERVER_Pkey_Type">
                                                <option value="OPENSSL_KEYTYPE_RSA">RSA</option>
                                                <option value="OPENSSL_KEYTYPE_DSA">DSA</option>
                                                <option value="OPENSSL_KEYTYPE_EC">EC</option>
                                          </select>
                                          <br>
                                          <!-- Server Private key Digest Algorithm -->
                                          <label>Digest Algorithm:</label>
                                          <select  name="SERVER_Pkey_Digest">
                                                <option value="sha256">SHA-256</option>
                                                <option value="md5">MD-5</option>
                                          </select>
                                          <br>
                                          <!-- Server Private key Encryption Type -->
                                          <label>Encryption Type:</label>
                                          <select  name="SERVER_Pkey_Ency_Type">
                                                <option value="OPENSSL_CIPHER_AES_128_CBC">AES-128</option>
                                                <option value="OPENSSL_CIPHER_AES_192_CBC">AES-192</option>
                                                <option value="OPENSSL_CIPHER_AES_256_CBC">AES-256</option>
                                                <option value="OPENSSL_CIPHER_DES">DES</option>
                                                <option value="OPENSSL_CIPHER_3DES">3DES</option>
                                          </select>
                                          <br>
                                          <!-- Server Private key Password -->
                                          <label>Enter a Password:</label>
                                          <input type="text" name="SERVER_Pkey_Pass">
                                          <center><input type="submit" value="Submit"> <input type="reset" value="Reset"></center>
                                          <hr>
                                    </form>

                                    <form form method="post" action="server_csr.php">
                                          <h3>ServerCA CSR</h3>
                                          <!-- ServerCA CSR Digest Algorithm -->
                                          <label>Digest Algorithm:</label>
                                          <select  name="SERVER_CSR_Digest">
                                                <option value="sha256">SHA-256</option>
                                                <option value="md5">MD-5</option>
                                          </select>
                                          <!-- ServerCA CSR PK file_name/path -->
                                          <label>Enter private key path/name:</label>
                                          <input type="text" name="SERVER_CSR_PKEY_Name">
                                          <!-- ServerCA CSR Digest Algorithm -->
                                          <label>Enter private key password:</label>
                                          <input type="password" name="SERVER_CSR_PKEY_Password">
                                          
                                          <table class="serverCa Table">
                                                <tr>
                                                      <th colspan="2">
                                                            <label class="m_lbl">Server</label>
                                                      </th>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Country Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Svcname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">State Or Province Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Svspname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Locality Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Svlname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Organization Name:</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Svoname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Organizational Unit Name</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Svouname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Common Name*</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Svcomname">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            <label class="m_lbl">Email Address</label>
                                                      </td>
                                                      <td>
                                                            <input type="text" name="Svemail">
                                                      </td>
                                                </tr>   
                                          </table>
                                          <center><input type="submit" value="Submit"> <input type="reset" value="Reset"></center>
                                          <hr>
                                    </form>

                                    <form form method="post" action="server_csr_sign.php">
                                          <h3>ServerCA CSR Sign</h3>
                                          <!-- ServerCA CSR Days -->
                                          <label>Enter number of days:</label>
                                          <input type="number" name="SERVER_CSR_Sign_Days">
                                          <!-- SubCA private key path -->
                                          <label>Enter Sub private key path/name:</label>
                                          <input type="text" name="SERVER_CSR_Sign_SUB_PKEY_path">
                                          <!-- SubCA CSR PK password -->
                                          <label>Enter Sub private key password:</label>
                                          <input type="password" name="SERVER_CSR_Sign_SUB_PKEY_Password">
                                          <!-- ServerCA CSR path/name -->
                                          <label>Enter ServerCA CSR path/name:</label>
                                          <input type="text" name="SERVER_CSR_Sign_CSR_path">
                                          <!-- SubCA CSR path/name -->
                                          <label>Enter Sub Certificate path/name:</label>
                                          <input type="text" name="SERVER_CSR_Sign_SUB_CSR_path">
                                          <!-- SubCA CSR Sign Digest Algorithm -->
                                          <label>Digest Algorithm:</label>
                                          <select  name="SERVER_CSR_Sign_Digest">
                                                <option value="sha256">SHA-256</option>
                                                <option value="md5">MD-5</option>
                                          </select>
                                          <center><input type="submit" value="Submit"> <input type="reset" value="Reset"></center>
                                    </form>
                              </div>
                              </td>
                        </tr>
                  </table>
            </div>
      </body>
</html>
