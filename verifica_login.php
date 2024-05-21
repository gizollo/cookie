<?php
//código não finalizado
$email = $_POST['email'];
$senha = $_POST['senha'];

$conn = mysqli_connect("localhost", "username", "senha", "database_name");

// tentativa de conexão com sucesso
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Consulta no banco de dados 
$query = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$result = mysqli_query($conn, $query);

// Se o usuário existir, cria uma sessão e um cookie
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    session_start();
    
    setcookie("user", $user['nome'], time() + (86400 * 7), "/"); // 86400 segundos = 1 dia por 7 dias 
    // Armazena os dados do usuário em uma variável de sessão
    $_SESSION['user'] = $user;
    // Redireciona o usuário para a tela de conteúdo
    header("location: tela_conteudo.php");
} else {
    // Se o usuário não existir, redireciona de volta para a tela de login com um parâmetro de erro
    header("location: tela_login.php?error=1");
}

//sites que utilizam sistemas de login em PHP com sessões e cookies:

//https://codeshack.io/simple-php-login-system-with-session-and-cookies/

//https://www.phppot.com/php/php-login-script-with-email-and-password/

//https://www.kodingmadesimple.com/2019/07/simple-php-login-system-using-pdo.html

//https://www.webslesson.info/2019/06/php-login-and-registration-system-using-ajax-and-jquery.html

//https://www.tutsmake.com/php-login-and-registration-system-using-bootstrap-4/

mysqli_close($conn);
?>
