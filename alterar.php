<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "loja";

    $return_arr = array();

    $conn = new mysqli($servidor, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM tbl_produtos WHERE codigo =".$_POST['codigo'];

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {

        $codigo = $row["codigo"];
        $nome = $row["nome"];
        $preco = $row["preco"];
        $quantidade = $row["quantidade"];
        $descricao = $row["descricao"];
        $altura = $row["altura"];
        $largura = $row["largura"];
        $profundidade = $row["profundidade"];
        $peso = $row["peso"];
        $fabricante = $row["fabricante"];
        $codigodebarras = $row["codigodebarras"];
        $foto = base64_encode($row["foto"]);

        $return_arr[] = array(
            "codigo" => $codigo,
            "nome" => $nome,
            "preco" => $preco,
            "quantidade" => $quantidade,
            "descricao" => $descricao,
            "altura" => $altura,
            "largura" => $largura,
            "profundidade" => $profundidade,
            "peso" => $peso,
            "fabricante" => $fabricante,
            "codigodebarras" => $codigodebarras,
            "foto" => $foto,
        );
    }

    echo json_encode($return_arr);

    $conn->close();
?>