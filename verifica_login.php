<?php

$usuarios = [
    [
        'nome' => 'Zollo',
        'email' => 'giovanni@zollo',
        'senha' => password_hash('senha123', PASSWORD_DEFAULT)
    ],
   
];

$email = $_POST['email'];
$senha = $_POST['senha'];

// Verifica se o usuário existe
$usuario = null;
foreach ($usuarios as $u) {
    if ($u['email'] === $email) {
        $usuario = $u;
        break;
    }
}

if ($usuario && password_verify($senha, $usuario['senha'])) {
    
    // Cria uma sessão e um cookie
    session_start();
    setcookie("usuario", $usuario['nome'], time() + (86400 * 7), "/"); // 86400 s = 1 dia por 7 dias

    // Armazena os dados do usuário em uma variável de sessão
    $_SESSION['usuario'] = $usuario;

    header("location: tela_conteudo.php");
} 

else {
   header("location: error.php");
}

//sites que utilizam sistemas de login em PHP com sessões e cookies:

//https://codeshack.io/simple-php-login-system-with-session-and-cookies/

//https://www.phppot.com/php/php-login-script-with-email-and-password/

//https://www.kodingmadesimple.com/2019/07/simple-php-login-system-using-pdo.html

//https://www.webslesson.info/2019/06/php-login-and-registration-system-using-ajax-and-jquery.html

//https://www.tutsmake.com/php-login-and-registration-system-using-bootstrap-4/

mysqli_close($conn);
?>
