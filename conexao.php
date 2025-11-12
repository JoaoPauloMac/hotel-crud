<?php
//define('HOST', '127.0.0.1');
//define('USUARIO', 'root');
//define('SENHA', '');
//define('DB', 'hotel');
//$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Nao foi possivel conectar');

// Credenciais de conexão
$servidor = "localhost";
$usuario = "root";
$senha = ""; // Geralmente vazia no XAMPP
$banco = "hotel";
$porta = 3307; // ⬅️ A CHAVE ESTÁ AQUI

// Cria a conexão
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco, $porta);

// Verifica a conexão
if (!$conexao) {
    die("Falha na Conexão: " . mysqli_connect_error());
}


?>