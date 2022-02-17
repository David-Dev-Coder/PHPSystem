<?php
$codigo = $_POST["codigo"];
$nome = $_POST["nome"];
$preco = $_POST["preco"];
$quantidade = $_POST["quantidade"];
$descricao = $_POST["descricao"];
$altura = $_POST["altura"];
$largura = $_POST["largura"];
$profundidade = $_POST["profundidade"];
$peso = $_POST["peso"];
$fabricante = $_POST["fabricante"];
$codigodebarras = $_POST["codigodebarras"];

$foto = addslashes(file_get_contents($_POST['imgDados']));

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "loja";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
   die("Erro de conexão: " . $conn->connect_error);
}

if ($codigo != "katiau") {
   $sql = "UPDATE tbl_produtos SET nome ='$nome', preco ='$preco', quantidade ='$quantidade', descricao ='$descricao', 
        altura ='$altura', largura ='$largura', profundidade ='$profundidade', peso ='$peso', fabricante ='$fabricante', codigodebarras ='$codigodebarras',
        foto ='$foto' WHERE codigo='$codigo'";

   if (!$conn->query($sql)) {
      echo $conn->error;
   } else {
      echo "Alterado com Sucesso!";
   }
} else {
   $sql = "INSERT INTO tbl_produtos VALUES (NULL, '$nome', '$preco', '$quantidade', '$descricao', '$altura', '$largura', 
        '$profundidade', '$peso', '$fabricante', '$codigodebarras', '$foto');";

   if (!$conn->query($sql)) {
      echo $conn->error;
   } else {
      echo "Inserido com Sucesso!";
   }
}

$conn->close();

?>
