<!DOCTYPE html>
<head>
  <?php include "./header.php"; ?>
  <script type="text/javascript">

    $(document).ready( function(){

      $('.btn-excluir').click(function(){
        var id_usuario = $(this).data('id_usuario' );
        var nome_usuario = $(this).data('nome_usuario' );
        $.ajax({  
          url: 'deleta_usuario.php',
          method: 'post',
          data: { deletar_usuario_id: id_usuario },
          success: function(data){
            alert("Usuario "+nome_usuario+" deletado com sucesso!");
            window.setTimeout(function() {window.location.href = 'busca_cadastro.php';}, 30);
          }
        });
      });

      $('.btn-editar').click(function(){
        var nome_usuario = $('#form_nome_usuario').data('form_nome_usuario');
        var telefone_usuario = $('#form_telefone_usuario').data('form_telefone_usuario');
        var endereco_usuario = $('#form_endereco_usuario').data('form_endereco_usuario');
        var email_usuario = $('#form_email_usuario').data('form_email_usuario');

        $.ajax({  
          url: 'outra_pag.php',
          method: 'post',
          data: { nome: nome_usuario, telefone: telefone_usuario, endereco: endereco_usuario, email: email_usuario }, 
          success: function(data){
            alert(data);
            /*window.location.replace("outra_pag.php");*/
          }
        });
      });

    });

  </script>
</head>
<body>  
  <header>
    <?php include "./head.php"; ?>
  </header>

  <section class="container mt-5 mb-5 col-sm-8 mx-auto">
    <h1 class="pt-4">CONTATO</h1>

    <?php

// Recebe um id da pagina de busca_cadastro 
// E verifica se não está vazio (isset) e se é um numero (is_numeric)
// para usar como referencia na busca sql 
//   http://localhost/Projeto_Agenda/mostra_cadastro.php?id=7

    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
      $aid = (int) $_POST['id'];
    } else {
      echo '<script type="text/javascript">';
      echo    'alert("Não conseguimos achar essa pessoa em nossos registros");';
      echo    'window.location.href= "busca_cadastro.php";';
      echo'</script>'
      ;
      /*header( "refresh:5;url=mostra_cadastro.php" );*/
    }
    
    //Require da classe banco de dados 
    require_once('db.class.php');

    //instanciando a classe do banco de dedos
    $objDb = new db();

    //A variavel $link vai receber o resultado da 
    //Funçao conecta_mysql() que resulta nas info. necessarias para a conexão
    //usando a instania do obj. $objDb
    $link = $objDb->conecta_mysql();


    //Criando a Query do sql
    $sql = "SELECT * FROM tb_pessoas WHERE id = ". $aid ."";

    /*echo $sql;
    die();*/
    $resultado = mysqli_query($link, $sql); 

//TESTE PARA SABER SE A QUERY FOI EXECUTADA COM EXITO   
//ESSE TESTE NÃO DEVE SER PÚBLICO PARA OS CLIENTES DA PÁGINA
/*

  TESTE PRECISA SER ARRUMADO padrao novo 'sqli'

*/
/*
    if (!$result = mysqli_query($link, $sql);) {
    // Oh no! The query failed. 
      echo "Sorry, the website is experiencing problems.";

    // Again, do not do this on a public site, but we'll show you how
    // to get the error information
      echo "Error: Ouve falha ne execução da query : \n";
      echo "Query: " . $sql . "\n";
      echo "Errno: " . $mysqli->errno . "\n";
      echo "Error: " . $mysqli->error . "\n";
      exit;
    }*/



    //Teste para saber se a busca veio vazia
    if ($resultado->num_rows === 0) {
    //Caso o numero de linhas for igual a zero exibe a msg de erro
      echo '<script type="text/javascript">';
      echo    'alert("Não conseguimos achar essa pessoa em nossos registros");';
      echo    'window.location.href= "busca_cadastro.php";';
      echo'</script>';
      exit;
    }

// Now, we know only one result will exist in this example so let's 
// fetch it into an associated array where the array's keys are the 
// table's column names
    $contato = $resultado->fetch_assoc();
    echo ' <div class="form-horizontal mt-5 mb-5 col-sm-8 mx-auto" action="edita_cadastro.php" method="post">';  
    echo "<div class='form-group'>";
    echo "<input type='text' name='id' class='invisible' value='".$contato['id']."'>";
    echo '<p data-form_nome_usuario="'.$contato['nome'].'" id="form_nome_usuario"> Nome: '.$contato['nome'].'<p/>';
    echo '<p data-form_telefone_usuario="'.$contato['telefone'].'" id="form_telefone_usuario" > Telefone: '.$contato['telefone'].'<p/>';
    echo '<p data-form_endereco_usuario="'.$contato['endereco'].'"  id="form_endereco_usuario"> Endereço: '.$contato['endereco'].'<p/>';
    echo '<p data-form_email_usuario="'.$contato['email'].'"  id="form_email_usuario"> Email: '.$contato['email'].'<p/>';
    echo "</div>";


    echo "<div class='form-group'><div class=''>";
    echo '<button class="btn-editar btn btn-warning mr-3" type="button">Editar</button>';
    echo '<button class="btn-excluir btn btn-danger" type="button" data-id_usuario="'.$contato['id'].'" data-nome_usuario="'.$contato['nome'].'" >EXCLUIR</button>';
    echo "</div></div>";
    echo"</div>";

    $resultado->free();
    
    /*
        Pesquisar sobre como usar o close na minha conexão
    */

        /*$mysqli->close();*/
        ?>

      </section>

    </div>
    <?php include "./footer.php"; ?>
  </body>
  </html>
