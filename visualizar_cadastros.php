<?php
// Configuração das variáveis de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loja";

// Cria uma nova conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se um pedido de DELETE foi recebido via GET
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; // Pega o ID do registro a ser deletado
    $conn->query("DELETE FROM usuarios WHERE id = $id"); // Executa a query de DELETE
    header("Location: visualizar_cadastros.php"); // Redireciona para a página de visualização
}

// Processa as atualizações de dados enviadas via POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // ID do registro a ser atualizado
    $column = $_POST['column']; // Coluna a ser atualizada
    $value = $_POST['value']; // Novo valor para a coluna

    // Prepara e executa a query de UPDATE
    $sql = "UPDATE usuarios SET ".$column."='".$conn->real_escape_string($value)."' WHERE id=".$id;
    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o registro: " . $conn->error;
    }
    exit;
}

$sql = "SELECT id, nome, email FROM usuario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Visualizar Cadastros</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <script>
    function enableEditing(id) {
        var nameCell = document.getElementById('name-' + id);
        var emailCell = document.getElementById('email-' + id);
        nameCell.contentEditable = true;
        emailCell.contentEditable = true;
        nameCell.focus();
    }

    // Envia os dados atualizados para o servidor 
    function updateData(element, column, id) {
        var value = element.innerText;
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "visualizar_cadastros.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("value=" + value + "&column=" + column + "&id=" + id);
    }

    // Função para solicitar a exclusão de um registro
    function deleteRow(id) {
        var confirmDelete = confirm("Tem certeza que deseja excluir este registro?");
        if (confirmDelete) {
            window.location.href = 'visualizar_cadastros.php?delete=' + id;
        }
    }
    </script>
</head>
<body>

<div class="aux">
<div class="card">
    <h1>Visualizar Cadastros</h1>

    <?php
    // Exibe os registros em uma tabela HTML
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Nome</th><th>Email</th><th>Ações</th></tr>";
        // Itera por cada registro retornado
        while($row = $result->fetch_assoc()) {
            // Exibe cada linha com os dados e botões de ação
            echo "<tr><td id='name-" . $row["id"] . "' onBlur='updateData(this, \"nome\", ".$row["id"].")'>" . $row["nome"]. "</td><td id='email-" . $row["id"] . "' onBlur='updateData(this, \"email\", ".$row["id"].")'>" . $row["email"]. "</td><td>";
            echo "<button onClick='enableEditing(".$row["id"].")'>✏️</button> ";
            echo "<button onClick='deleteRow(".$row["id"].")'>🗑️</button>";
            echo "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Ainda não há cadastro...";
    }
    ?>

    <a href="cadastro.php" class="btn-retorno">Voltar ao Cadastro</a>
</div>
</div>
</body>
</html>
