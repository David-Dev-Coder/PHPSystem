<html>

<head></head>

<body>
   <?php
   $servidor = "localhost";
   $usuario = "root";
   $senha = "";
   $banco = "loja";

   $conn = new mysqli($servidor, $usuario, $senha, $banco);

   if ($conn->connect_error) {
      die("Erro de conexão: " . $conn->connect_error);
   }

   $sql = "SELECT * FROM tbl_produtos";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      echo "<table border='1'><tr><td>Código</td><td>Nome</td><td>Preço</td>
            <td>Quantidade</td><td>Descrição</td><td>Altura</td>
            <td>Largura</td><td>Profundidade</td><td>Peso</td>
            <td>Fabricante</td><td>Código de Barras</td><td>Foto</td>
            <td>Alterar</td><td>Excluir</td></tr>";

      while ($row = $result->fetch_assoc()) {
         echo "<tr>";
         echo "<td>" . $row["codigo"] . "</td>";
         echo "<td>" . $row["nome"] . "</td>";
         echo "<td>" . $row["preco"] . "</td>";
         echo "<td>" . $row["quantidade"] . "</td>";
         echo "<td>" . $row["descricao"] . "</td>";
         echo "<td>" . $row["altura"] . "</td>";
         echo "<td>" . $row["largura"] . "</td>";
         echo "<td>" . $row["profundidade"] . "</td>";
         echo "<td>" . $row["peso"] . "</td>";
         echo "<td>" . $row["fabricante"] . "</td>";
         echo "<td>" . $row["codigodebarras"] . "</td>";
         echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['foto']) . "' style='width:50px; height:50px;'/></td>";
         echo "<td><a href='index.php?codigo=" . $row["codigo"] . "'><img src='img/editar.png' style='width:30px; height:30px; transform: translateX(7px)'/></a></td>";
         echo "<td><a href='excluir.php?codigo=" . $row["codigo"] . "'><img src='img/excluir.png' style='width:30px; height:30px; transform: translateX(7px)'/></a></td>";
         echo "</tr>";
      }

      echo "</table>";
   } else {
      echo "0 resultados";
   }
   $conn->close();

   ?>
   <br/>
   <a href="index.php">Inserir</a>
</body>

</html>