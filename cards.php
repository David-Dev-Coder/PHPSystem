<?php
   include("header.php");

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

   echo '<button class="insersao" href="#" id="inserir">
      <p>+</p>
   </button>';

   if ($result->num_rows > 0) {

      echo '<div class="container">';

      while($row = $result->fetch_assoc()) {
      
         echo '<div class="card">
            <h2>'. $row["nome"]. '</h2>
            <div class="autor">
            <div class="img-container">
               <div>
                  <img class="img" src="data:image/jpeg;base64,'.base64_encode($row["foto"]).'">
               </div>
            </div>
            <div class="info">
               Preço
               <span>'. $row["preco"]. ' R$</span>
            </div>
            <div class="newinfo">
               '. $row["descricao"]. '
            </div>
            </div>
            <div class="tags">
               <a class="sopojs" onclick="verMais('.$row['codigo'].')">Ver Mais</a>
            </div>
            <a onclick="teste('.$row['codigo'].')"><img src="img/editar.png" style="width:30px; height:30px; position: absolute; top: 5px; right: 5px; cursor: pointer;"/></a>
            <a onclick="excluir('.$row['codigo'].')"><img src="img/excluir.png" style="width:30px; height:30px; position: absolute; top: 5px; right: 37px; cursor: pointer;"/></a>
         </div>';
      }
   } else {
      echo "0 resultados";
   }

   echo '</div>';

   include('footer.php');

   $conn->close();
?>

   <div id="boxes">
      <!-- Janela Modal Inserir/Alterar -->
      <div id="dialog2" class="window">
         <form id="formDados">
            <input type="hidden" name="codigo" id="txtCodigo">
            <label>Nome</label><br>
            <input type="text" name="nome" id="txtNome" required><br>
            <label>Preço</label><br>
            <input type="text" name="preco" id="txtPreco" required><br>
            <label>Quantidade</label><br>
            <input type="text" name="quantidade" id="txtQuantidade" required><br>
            <label>Descrição</label><br>
            <input type="text" name="descricao" id="txtDescricao" required><br>
            <label>Altura</label><br>
            <input type="text" name="altura" id="txtAltura" required><br>
            <label>Largura</label><br>
            <input type="text" name="largura" id="txtLargura" required><br>
            <label>Profundidade</label><br>
            <input type="text" name="profundidade" id="txtProfundidade" required><br>
            <label>Peso</label><br>
            <input type="text" name="peso" id="txtPeso" required><br>
            <label>Fabricante</label><br>
            <input type="text" name="fabricante" id="txtFabricante" required><br>
            <label>Código de Barras</label><br>
            <input type="text" name="codigodebarras" id="txtCodigodebarras" required><br>
            Selecione uma imagem: <input id="arquivo" name="arquivo" type="file"/><br/>
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=" id="fotoDados" alt="Foto"/><br/>
            <input type="hidden" id="imgDados" name="imgDados" />
            <input type="button" value="Confirmar" id="confirmaDados"/><br/>
         </form>
      </div>
      <!-- Fim Janela Modal Ver Mais -->

      <!-- Janela Modal -->
      <div id="dialog3" class="window">
         <img id="lblFoto">
         <div class="row-1">
            <div class="column-1">
               <label style="margin-top: 4px;">Nome</label>
               <p style="color: grey;" id="lblNome"></p>
               <label style="margin-top: 4px;">Preço</label>
               <p style="color: grey;" id="lblPreco"></p>
               <label style="margin-top: 4px;">Quantidade</label>
               <p style="color: grey;" id="lblQuantidade"></p>
               <label style="margin-top: 4px;">Descrição</label>
               <p style="color: grey;" id="lblDescricao"></p>
               <label style="margin-top: 4px;">Altura</label>
               <p style="color: grey;" id="lblAltura"></p>
            </div>
            <div class="column-2">
               <label style="margin-top: 4px;">Largura</label>
               <p style="color: grey;" id="lblLargura"></p>
               <label style="margin-top: 4px;">Profundidade</label>
               <p style="color: grey;" id="lblProfundidade"></p>
               <label style="margin-top: 4px;">Peso</label>
               <p style="color: grey;" id="lblPeso"></p>
               <label style="margin-top: 4px;">Fabricante</label>
               <p style="color: grey;" id="lblFabricante"></p>
               <label style="margin-top: 4px;">Código de Barras</label>
               <p style="color: grey;" id="lblCodigodebarras"></p>
            </div>
         </div>
         <!-- <div class="porcentagem-content">
            <div id="porcentagem"></div>
         </div> -->
      </div>
      <!-- Fim Janela Modal-->

      <!-- Máscara para cobrir a tela -->
      <div id="mask"></div>
   </div>
</body>

<script>
$('#mask').click(function() {
   $(this).hide();
   $('.window').hide();
   $('#porcentagem').html("")
});

$('#inserir').click(function() {
   //Inicialização dos Campos
   $('#txtCodigo').val("katiau");
   $('#txtNome').val("");
   $('#txtPreco').val("");
   $('#txtQuantidade').val("");
   $('#txtDescricao').val("");
   $('#txtAltura').val("");
   $('#txtLargura').val("");
   $('#txtProfundidade').val("");
   $('#txtPeso').val("");
   $('#txtFabricante').val("");
   $('#txtCodigodebarras').val("");
   $('#arquivo').val(null);
   $('#fotoDados').attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=');

   var maskHeight = $(document).height();
   var maskWidth = $(window).width();

   $('#mask').css({
      'width': maskWidth,
      'height': maskHeight
   });

   $('#mask').fadeIn(1000);
   $('#mask').fadeTo("slow", 0.8);

   var winH = $(window).height();
   var winW = $(window).width();

   $('#dialog2').css('top', winH / 2 - $('#dialog2').height() / 2);
   $('#dialog2').css('left', winW / 2 - $('#dialog2').width() / 2);

   $('#dialog2').fadeIn(2000);
});

$("#arquivo").change(function() {
   if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
         $('#fotoDados').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
   }
});

$("#confirmaDados").click(function() {
   $('#imgDados').val($('#fotoDados').attr('src'));

   $.post("inserir.php", $('#formDados').serialize(), function(data) {
      alert(data);
      window.location.reload();
   });
});

function verMais(codigo) {

   $.post("alterar.php", {
      codigo
   }, function(data) {

      var obj = JSON.parse(data);

      $('#lblNome').html(obj[0].nome);
      $('#lblPreco').html(obj[0].preco);
      $('#lblQuantidade').html(obj[0].quantidade);
      $('#lblDescricao').html(obj[0].descricao);
      $('#lblAltura').html(obj[0].altura);
      $('#lblLargura').html(obj[0].largura);
      $('#lblProfundidade').html(obj[0].profundidade);
      $('#lblPeso').html(obj[0].peso);
      $('#lblFabricante').html(obj[0].fabricante);
      $('#lblCodigodebarras').html(obj[0].codigodebarras);
      $('#lblFoto').attr('src', 'data:image/gif;base64,' + obj[0].foto);

      var maskHeight = $(document).height();
      var maskWidth = $(window).width();

      $('#mask').css({
         'width': maskWidth,
         'height': maskHeight
      });

      $('#mask').fadeIn(1000);
      $('#mask').fadeTo("slow", 0.8);

      var winH = $(window).height();
      var winW = $(window).width();

      $('#dialog3').css('top', winH / 2 - $('#dialog3').height() / 2);
      $('#dialog3').css('left', winW / 2 - $('#dialog3').width() / 2);

      $('#dialog3').fadeIn(2000);

      // var pctg = Math.floor(Math.random() * 100);

      // $('#porcentagem').css({
      //    "width": 0,
      // });

      // if (pctg == 0) {
      //    $('#porcentagem').css("padding", "0 0");
      // }

      // $('#porcentagem').animate({
      //    "width": pctg + "%",
      // }, {
      //    duration: 2000,
      //    complete: function() {
      //          pctg == 0 ? $('#porcentagem').html("") : $('#porcentagem').html(pctg);
      //    }
      // });

   });
}

function excluir(codigo) {
   $.post("excluir.php", {
      codigo
   }, function(data) {
      alert(data);
      window.location.reload();
   })
}

function teste(codigo) {
    // $.ajax({
    //   type: 'POST',
    //   url: 'alterar.php',
    //   data: {
    //     codigo : codigo
    //   }, success: function(data){
    //     console.log(data);
    //   }
    // });
   $.post("alterar.php", {
      codigo
   }, function(data) {

      var obj = JSON.parse(data);

      $('#txtCodigo').val(obj[0].codigo);
      $('#txtNome').val(obj[0].nome);
      $('#txtPreco').val(obj[0].preco);
      $('#txtQuantidade').val(obj[0].quantidade);
      $('#txtDescricao').val(obj[0].descricao);
      $('#txtAltura').val(obj[0].altura);
      $('#txtLargura').val(obj[0].largura);
      $('#txtProfundidade').val(obj[0].profundidade);
      $('#txtPeso').val(obj[0].peso);
      $('#txtFabricante').val(obj[0].fabricante);
      $('#txtCodigodebarras').val(obj[0].codigodebarras);
      $('#arquivo').val(null);
      $('#fotoDados').attr('src', 'data:image/gif;base64,' + obj[0].foto);

      var maskHeight = $(document).height();
      var maskWidth = $(window).width();

      $('#mask').css({
         'width': maskWidth,
         'height': maskHeight
      });

      $('#mask').fadeIn(1000);
      $('#mask').fadeTo("slow", 0.8);

      var winH = $(window).height();
      var winW = $(window).width();

      $('#dialog2').css('top', winH / 2 - $('#dialog2').height() / 2);
      $('#dialog2').css('left', winW / 2 - $('#dialog2').width() / 2);

      $('#dialog2').fadeIn(2000);

   })
}
</script>

</html>