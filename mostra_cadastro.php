<!DOCTYPE html>
<head>
  <?php include "./header.php"; ?>
  <script type="text/javascript">

    $(document).ready( function(){

      $('.btn-excluir').click(function(){
        let id_usuario = $(this).data('id_usuario' );
        let nome_usuario = $(this).data('nome_usuario' );
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

      $('.btn-editarasdasdasd').click(function(){
       let id_usuario = $(this).data('id_usuario');
       
        $.ajax({  
          url: 'recebe_edita_cadastro.php',
          method: 'post',
          data: { id: id_usuario}, 
          success: function(response){
            window.location.replace("outra_pag.php");
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

  <section class="height-80 col-sm-8 mx-auto teste">
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
        echo  '</script>'
        ;
      }
      
      require_once('db.class.php');
      $objDb = new db();

      $link = $objDb->conecta_mysql();
      $sql = "SELECT * FROM tb_pessoas WHERE id = ". $aid ."";
      $resultado = mysqli_query($link, $sql); 

      if ($resultado->num_rows === 0) {
        echo '<script type="text/javascript">';
        echo    'alert("Não conseguimos achar essa pessoa em nossos registros");';
        echo    'window.location.href= "busca_cadastro.php";';
        echo'</script>';
        exit;
      }
      
      echo "<ol class='list-group'>\n";
      echo "<li class='list-group-item list-group-item-primary '>";
      $contato = $resultado->fetch_assoc();
      echo '<form class="form-horizontal col-sm-10 mx-auto" action="edita_cadastro.php" method="post">';  
      echo '<div class="form-group">';
      echo "<input type='text' name='id' class='invisible ' value='".$contato['id']."'>";
      echo '<p id="form_nome_usuario"> Nome: '.$contato['nome'].'<p/>';
      echo '<p id="form_telefone_usuario" > Telefone: '.$contato['telefone'].'<p/>';
      echo '<p id="form_endereco_usuario"> Endereço: '.$contato['endereco'].'<p/>';
      echo '<p id="form_email_usuario"> Email: '.$contato['email'].'<p/>';
      echo '</div>';
      echo '<div class="form-group"><div class="">';
      echo '<button class="btn-editar btn btn-warning mr-3" type="submit" data-id_usuario="'.$contato['id'].'">Editar</button>';
      echo '<button class="btn-excluir btn btn-danger" type="button" data-id_usuario="'.$contato['id'].'" data-nome_usuario="'.$contato['nome'].'" >Excluir</button>';
      echo '</div></div>';
      echo '</form>';
      echo "</li>";
      echo "</ol>";

      $resultado->free();
      $link->close();
      
    ?>

      </section>

    </div>
    <?php include "./footer.php"; ?>
  </body>
  </html>
