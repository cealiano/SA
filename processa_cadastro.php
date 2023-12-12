<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; 
    $username = "root";  
    $password = "";    
    $dbname = "loja"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        $mensagem = "Conexão falhou: " . $conn->connect_error;
    }

    $nome = $conn->real_escape_string($_POST['nome']);
    $data_nasc = $conn->real_escape_string($_POST['data_nasc']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']); 
    $cpf = $conn->real_escape_string($_POST['cpf']); 
    $sexo = $conn->real_escape_string($_POST['sexo']); 
    $estado = $conn->real_escape_string($_POST['estado']); 
    $cep = $conn->real_escape_string($_POST['cep']); 
    $endereco = $conn->real_escape_string($_POST['endereco']); 
    $telefone = $conn->real_escape_string($_POST['telefone']); 

    $sql = "INSERT INTO usuario (nome, data_nasc, email, senha, cpf, sexo, estado, cep, endereco, telefone) VALUES ('$nome', '$data_nasc', '$email', '$senha', '$cpf', '$sexo', '$estado', '$cep', '$endereco', $telefone)";

    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao realizar cadastro: " . $conn->error;
    }
    
    $conn->close();

    
    header("Location: cadastro.php");
    exit;
}
?>
