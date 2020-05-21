<!DOCTYPE html>
<head>
  <?php include "./header.php"; ?>
    <script type="text/javascript">
    
    $(document).ready( function(){

      $('#edita_cadastro').click(function(){
        /*var id_usuario = $(this).data('id_usuario' );*/
        $.ajax({  
          url: 'recebe_edita_cadastro.php',
          method: 'post',
          data: $('#form_edita_cadastro').serialize(),
          success: function(data){
            alert('Cadasto editado com sucesso');
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
    $aid = 6;
}

$conexao = include "./conexao.php";

// Perform an SQL query
$conexao = "SELECT id, nome, telefone, email, endereco FROM tb_pessoas WHERE id = ". $aid ."";
if (!$result = $mysqli->query($conexao)) {
    // Oh no! The query failed. 
    echo "Sorry, the website is experiencing problems.";

    // Again, do not do this on a public site, but we'll show you how
    // to get the error information
    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $conexao . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

// Phew, we made it. We know our MySQL connection and query 
// succeeded, but do we have a result?
if ($result->num_rows === 0) {
    // Oh, no rows! Sometimes that's expected and okay, sometimes
    // it is not. You decide. In this case, maybe actor_id was too
    // large? 
    echo "We could not find a match for ID ".$aid.", sorry about that. Please try again.";
    exit;
}

// Now, we know only one result will exist in this example so let's 
// fetch it into an associated array where the array's keys are the 
// table's column names
$contato = $result->fetch_assoc();
 
$result->free();
$mysqli->close();
?>
   
  </section>


  <section class="container mt-5">

    <form id="form_edita_cadastro" class="form-horizontal mt-5 mb-5 col-sm-8 mx-auto">
      <h1 class="mt-5 pt-5">EDITAR CADASTRO</h1>
      <div class="invisible">
        <input type="text" class="form-control" id="id" name="id"  value="<?php echo $contato['id'] ?>">
      </div>

      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome"  value="<?php echo $contato['nome'] ?>">
      </div>

      <div class="form-group">
        <label for="telefone">Telefone:</label>
        <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $contato['telefone'] ?>">
      </div>

      <div class="form-group">
        <label for="endereco">Endereço</label>
        <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $contato['endereco'] ?>">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $contato['email'] ?>">
      </div>

      <div class="form-group">
        <div class="col-sm-12">
          <button id="edita_cadastro" type="button" class="btn btn-primary">CADASTRAR</button>
        </div>
      </div>
    </form>

  </section>


</div>
    <?php include "./footer.php"; ?>
</body>
</html>
