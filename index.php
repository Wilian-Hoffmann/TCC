<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])){
    dd([$_POST['email'], $_POST['senha']]);
    if(strlen($_POST['email']) == 0 ){
        echo "Preencha seu E-mail";
    }else if(strlen($_POST['senha']) == 0 ){
        echo "Preencha sua Senha";
    } else{

        $mail = $mysqli->real_escape_string($_POST['email']);
        $mail = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha' "; 
        $sql_query = $mysqli->query($sql_code) or die("Falha na coneção do código SQL");
    
        $quantidade = $sql_query->num_rols;

        if($quantidade == 1){

            $usuario = $sql_query->fetch_assoc();

            if(lisset($_SESSION)){
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");

        }else{
            echo "Falha ao logar E-mail ou Senha incorreto";
        }
    
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action= "" methood="POST">
        <p>
            <label>E-mail</label>
            <input type="text" name="email">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button type="submit">Entrar</button>
        </p>

</body>
</html>