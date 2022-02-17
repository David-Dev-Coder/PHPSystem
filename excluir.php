<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "loja";

    $conn = new mysqli($servidor, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    } 

    $sql = "DELETE FROM tbl_produtos WHERE codigo =".$_POST['codigo'];

    if (!$conn->query($sql)) {
        echo $conn->error;
    }else{
        echo "Excluido com Sucesso!";
    }

    $conn->close();
?>