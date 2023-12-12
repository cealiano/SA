<?php
session_start();

$erro = ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha'])) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        require_once "processa_cadastro.php"; 
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="estilo.css"> 
    <title>Cadastro</title>


   
</head>
<body>

<header>
        <div class = cabecalho>
            <div class = titulo>
                <h1><a href="index.php">Vintage Vogue</a></h1>
            </div>  
            
            <div class = opcoes>
                <a href="index.php">HOME</a>
                <a href="cadastro.php">CADASTRE-SE</a>
                <a href="pag03.html">LOGIN</a>
                <a href="pag04.html">SOBRE NÓS</a>
            </div>
        </div>
             
    </header>

<div class="aux">
    
    <div class="card">
        <h2><a href="index.php">Vintage Vogue</a></h2>
        <h1>Cadastro de Usuário</h1>
    
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo.">
    
            <label>Data de nascimento:</label>
            <input type="date" id="data_nasc" name="data_nasc" required>
    
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email.">
    
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Crie uma senha.">
    
            <label>CPF:</label>
            <input type="number" id="cpf" name="cpf"
            placeholder="Digite seu CPF (Somente números)."max="99999999999" size="30">
    
            <div class="qwe">
                <label>Sexo:</label>
                <input type="radio" id="sexo" name="sexo" value="M" required>Masculino
                
                <input type="radio" id="sexo" name="sexo" value="F"required>Feminino
            </div>
    
    
            <label>Estado:</label>
    
    
                        <select name="estado" id="estado" required>
                            <option value="default" selected="selected">--Selecione--</option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AM">AM</option>
                            <option value="AP">AP</option>
                            <option value="CE">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MT">MT</option>
                            <option value="MS">MS</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>
    
                    <label>CEP:</label>
                    <input type="number" id="cep" name="cep" placeholder="Digite seu CEP." required />
    
                    <label>Endereço:</label>
                    <input type="text" id="endereco" name="endereco" placeholder="Digite seu endereço:" required>
    
                    <label>Telefone para contato:</label>
                    <input type="number" size="20" id="telefone" name="telefone"
                            placeholder="(DDD) 99999-9999" max="99 999999999">
    
    
                <input type="submit" value="Cadastrar">
        </form>
        <a href="visualizar_cadastros.php" class="btn">Visualizar Cadastros</a>
    
        <?php
            if (!empty($erro)): ?>
                <div class="mensagem erro">
                    <?php echo $erro; ?>
                </div>
            <?php
            elseif (isset($_SESSION['mensagem']) && !empty($_SESSION['mensagem'])): ?>
                <div class="mensagem">
                    <?php
                    echo $_SESSION['mensagem'];
                    unset($_SESSION['mensagem']);
                    ?>
                </div>
</div>

<?php endif; ?>

</body>
</html>
