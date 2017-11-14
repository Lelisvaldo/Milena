<?php ini_set('default_charset','UTF-ISO-8859-15');
    if(!isset($_SESSION)){session_start();}
    include "../conn.php";
    include '../encrypt/encrypt.php';

    // as vari�veis login e senha recebem os dados digitados na p�gina anterior
    $cpfCnpj = $_POST['formCadCpfCnpj'];
    $name = $_POST['formCadName'];
    $email = $_POST['formCadEmail'];
    $password = $_POST['formCadpassword'];

    //Define IcTipo de Usuario
    $contDigitos = strlen($cpfCnpj);
    if(($contDigitos > 0) || ($contDigitos <= 14)){$tipoUsuario = 1;}elseif(($contDigitos > 14) || ($contDigitos <= 18)){$tipoUsuario = 0;}

    $imputKey = "encryptor key";
    $blockSize = 256;
    $aes = new AES($password, $imputKey, $blockSize);
    $enc = $aes->encrypt();

    //Insereindo usuario no banco
    $insertUser = $pdo->prepare ("
                                            INSERT INTO tb_usuario (
                                                                    cd_usuario,
                                                                    ic_status,
                                                                    cd_user_Id_Fb,
                                                                    cd_cpf_cnpj,
                                                                    nm_usuario,
                                                                    im_usuario,
                                                                    nm_email,
                                                                    ds_senha,
                                                                    ic_administrador,
                                                                    ic_tipo_usuario,
                                                                    cd_telefone,
                                                                    cd_endereco
                                            )
                                            VALUES (
                                                    DEFAULT,
                                                    DEFAULT,
                                                    DEFAULT,
                                                    '".$cpfCnpj."',
                                                    '".$name."',
                                                    DEFAULT,
                                                    '".$email."',
                                                    '".$enc."',
                                                    DEFAULT,
                                                    '".$tipoUsuario."',
                                                    DEFAULT,
                                                    DEFAULT
                                            );
    ");
    $insertUser->execute();
    $lastId = $pdo->lastInsertId("tb_usuario");
    // atualiza id tel e id end
    $updateUser = $pdo->prepare (" CALL sp_updateUserTelEnd('".$lastId."');");
    $updateUser->execute();

    // Insert Endereco
    $insertEndereco = $pdo->prepare (" CALL sp_insertEndereco('".$lastId."');");
    $insertEndereco->execute();

    // insert Telefone
    $insertTelefone = $pdo->prepare (" CALL sp_insertTelefone('".$lastId."');");
    $insertTelefone->execute();

    //header('location:../views/formLogin.php');

    $selectLogin = $pdo->prepare ("SELECT cd_usuario, nm_email, ic_administrador FROM tb_usuario WHERE nm_email = :email AND ds_senha = :enc");
    $selectLogin->bindParam(':email', $email);
    $selectLogin->bindParam(':enc', $enc);
    $selectLogin->execute();
    $query_num_rows = $selectLogin->rowCount();

    /*Definindo Session Login*/
    if($query_num_rows != 0){
        $_SESSION['idUser'] = $lastId;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $enc;
        $_SESSION['admin'] = 0;
        header('location:../formViewsDB/selectUser.php');
    }