<html>

<head></head>

<body>
   <?php
   if (isset($_GET['codigo'])) {
      $servidor = "localhost";
      $usuario = "root";
      $senha = "";
      $banco = "loja";

      $conn = new mysqli($servidor, $usuario, $senha, $banco);

      if ($conn->connect_error) {
         die("Erro de conexão: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM tbl_produtos WHERE codigo =" . $_GET['codigo'];
      $result = $conn->query($sql);

      if ($row = $result->fetch_assoc()) {
         echo '<form action="inserirnew.php" enctype="multipart/form-data" method="post">';
         echo '	<input type="hidden" name="codigo" value="' . $row["codigo"] . '"><br>';
         echo '	<label>Nome</label><br>';
         echo '	<input type="text" name="nome" value="' . $row["nome"] . '"><br>';
         echo '	<label>Preço</label><br>';
         echo '	<input type="text" name="preco" value="' . $row["preco"] . '"><br>';
         echo '	<label>Quantidade</label><br>';
         echo '	<input type="text" name="quantidade" value="' . $row["quantidade"] . '"><br>';
         echo '	<label>Descrição</label><br>';
         echo '	<input type="text" name="descricao" value="' . $row["descricao"] . '"><br>';
         echo '	<label>Altura</label><br>';
         echo '	<input type="text" name="altura" value="' . $row["altura"] . '"><br>';
         echo '	<label>Largura</label><br>';
         echo '	<input type="text" name="largura" value="' . $row["largura"] . '"><br>';
         echo '	<label>Profundidade</label><br>';
         echo '	<input type="text" name="profundidade" value="' . $row["profundidade"] . '"><br>';
         echo '	<label>Peso</label><br>';
         echo '	<input type="text" name="peso" value="' . $row["peso"] . '"><br>';
         echo '	<label>Fabricante</label><br>';
         echo '	<input type="text" name="fabricante" value="' . $row["fabricante"] . '"><br>';
         echo '	<label>Código de Barras</label><br>';
         echo '	<input type="text" name="codigodebarras" value="' . $row["codigodebarras"] . '"><br>';
         echo '  <img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" style="width:40px;height:40px;"/><br>';
         echo '  Selecione uma imagem: <input name="arquivo" type="file"/><br>';
         echo '	<input type="submit"/><br/>';
         echo '</form>';
      } else {
         echo "Erro! Não existe esse cliente!";
      }
      $conn->close();
   } else {
   ?>
      <form action="inserir.php" enctype="multipart/form-data" method="post">
         <label>Nome</label><br>
         <input type="text" name="nome" required><br>
         <label>Preço</label><br>
         <input type="text" name="preco" required><br>
         <label>Quantidade</label><br>
         <input type="text" name="quantidade" required><br>
         <label>Descrição</label><br>
         <input type="text" name="descricao" required><br>
         <label>Altura</label><br>
         <input type="text" name="altura" required><br>
         <label>Largura</label><br>
         <input type="text" name="largura" required><br>
         <label>Profundidade</label><br>
         <input type="text" name="profundidade" required><br>
         <label>Peso</label><br>
         <input type="text" name="peso" required><br>
         <label>Fabricante</label><br>
         <input type="text" name="fabricante" required><br>
         <label>Código de Barras</label><br>
         <input type="text" name="codigodebarras" required><br>
         <img src="data:image/jpeg;base64,'.base64_encode($row['foto']).'" style="width:40px;height:40px;" /><br>
         <label>Selecione uma imagem: <input name="arquivo" type="file" /><br></label>
         <input type="submit">
      </form>
   <?php
   }
   ?>
</body>

</html>