<?php
//código não finalizado
$email = $_POST['email'];
$senha = $_POST['senha'];



// Conexão com o banco de dados
$conn = new mysqli("localhost", "usuario", "senha", "database_name");

$usuario = "zollo";
$senha = "senha123";

// Verificação de conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta no banco de dados
$query = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Se o usuário existir, cria uma sessão e um cookie
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    session_start();

    // Verifica a senha fornecida com a senha armazenada no banco de dados
    if (password_verify($senha, $usuario['senha'])) {
        setcookie("usuario", $usuario['nome'], time() + (86400 * 7), "/"); // 86400 s = 1 dia por 7 dias

        // Armazena os dados do usuário em uma variável de sessão
        $_SESSION['usuario'] = $usuario;

    
        header("location: tela_conteudo.php");
    } else {
        
        header("location: tela_login.php?error=1");
    }
} else {

    header("location: tela_login.php?error=1");
}

$conn->close();

//sites que utilizam sistemas de login em PHP com sessões e cookies:

//https://codeshack.io/simple-php-login-system-with-session-and-cookies/

//https://www.phppot.com/php/php-login-script-with-email-and-password/

//https://www.kodingmadesimple.com/2019/07/simple-php-login-system-using-pdo.html

//https://www.webslesson.info/2019/06/php-login-and-registration-system-using-ajax-and-jquery.html

//https://www.tutsmake.com/php-login-and-registration-system-using-bootstrap-4/

mysqli_close($conn);
?>
