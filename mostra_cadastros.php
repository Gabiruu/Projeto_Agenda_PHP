  <!DOCTYPE html>
  <head>
    <?php include "./header.php"; ?>
    <script type="text/javascript">

      $(document).ready( function(){

        $('.btn-excluir').click(function(){
          var id_usuario = $(this).data('id_usuario' );
          $.ajax({  
            url: 'deleta_usuario.php',
            method: 'post',
            data: { deletar_usuario_id: id_usuario },
            success: function(data){
              alert("Usuario deletado com sucesso!");
              window.location.href= "busca_cadastro.php";
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

    <section class="container mt-5 pt-5 mb-5 col-sm-8 mx-auto">
      <h1 class="mb-4">CADASTROS</h1>

      <?php
          require_once('db.class.php');

          $objDb = new db();
          $link = $objDb->conecta_mysql();

          $sql = "SELECT id, nome, telefone, email, endereco FROM tb_pessoas ORDER BY nome";

          $resultado = mysqli_query($link, $sql); 

          echo "<ol class='list-group'>\n";
          while ($contato = $resultado->fetch_assoc()) {
            echo "<li class='list-group-item list-group-item-primary mt-1 mb-1 col-sm-8 mx-auto'>";
            echo "<form id='id_contato_".$contato['id']."' class='form-horizontal' method='post' action='edita_cadastro.php'>";
            echo "<p><strong> Nome: </strong> " . $contato['nome'] . "</p>";
            echo "<p><strong> Telefone: </strong> " . $contato['telefone'] . "</p>";
            echo "<p><strong> Email: </strong>" . $contato['email'] . "</p>";
            echo "<p><strong> Endereço: </strong>" . $contato['endereco'] . "</p>";
            echo "<input type='text' name='id' class='invisible ' value='".$contato['id']."'>";
            echo "<div class='form-group'><div class=''>";
            echo '<button class="btn btn-warning mr-3" type="submit">Editar</button>';
            echo '<button class="btn-excluir btn btn-danger" data-id_usuario="'.$contato['id'].'" >EXCLUIR</button>';
            echo "</div></div>";
            echo "</form>";
            echo "</li>";
          }
          echo "</ol>";

          $resultado->free();
          $link->close();
          ?>

        </section>

      </div>
      <?php include "./footer.php"; ?>
    </body>
    </html>
