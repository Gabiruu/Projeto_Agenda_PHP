<!DOCTYPE html>
<head>
  <?php include "./header.php"; ?>
</head>
<body>  
  <header>
    <?php include "./head.php"; ?>
  </header>

  <section class="container mt-5 mb-5 col-sm-8 mx-auto">
    <h1 class="pt-5">BUSCA</h1>
    
    <?php

    require_once('db.class.php');
    $objDb = new db();
    $link = $objDb->conecta_mysql();
    $sql = "SELECT id, nome FROM tb_pessoas ORDER BY nome ";
    $resultado = mysqli_query($link, $sql); 

    //Verificando se tem algum registro no banco
    if ($resultado->num_rows === 0) {
        // Menssagem exibida ao não achar nenhum registro
        echo "<div class='btn btn-danger col-sm-12'>";
        echo "<h3>"; 
        echo "Não existe nenhum registro na agenda";
        echo "<h3>";    
        echo "</div>";
        exit;
    }

    //Mostra Resultados 
    echo " <form class='form-horizontal mt-5 mb-5 col-sm-8 mx-auto' action='mostra_cadastro.php' method='post'>";  
    echo "<div class='form-group '>";
    echo "<label for='id'><p><strong>Selecione o nome da pessoa</strong></p></label>";
    echo "<select id='id' name='id' class='form-control' >";
    while ($cadastro = $resultado->fetch_assoc()) {
      echo "<option value='".$cadastro['id']."'>" . $cadastro['nome'] . "</option>";  
    }
    echo "</select>";

    echo "</div>";

    echo "<div class='form-group'><div class=''>";
    echo "<button type='submit' class='btn btn-primary btn-block'>BUSCAR</button>";
    echo "</div></div>";
    echo"</form>";

    ?>
    
  </section>
  <section class="container mt-5 mb-5 col-sm-8 mx-auto">
    <div class="container mt-5 mb-5 col-sm-8 mx-auto">
      <p class="text-center"><strong>OU</strong></p>
      <p class="text-center"><strong>Selecione todos os contatos</strong></p>
      <a class="btn btn-primary btn-block" href="mostra_cadastros.php">BUSCAR TODOS</a>
    </div>
  </section>
</div>
<?php include "./footer.php"; ?>
</body>
</html>
