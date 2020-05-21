<!DOCTYPE html>
<head>
  <?php include "./header.php"; ?>
    <script type="text/javascript">
    
    $(document).ready( function(){

      $('#edita_cadastro').click(function(){
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

require_once('db.class.php');
$objDb = new db();

$link = $objDb->conecta_mysql();
$sql = "SELECT id, nome, telefone, email, endereco FROM tb_pessoas WHERE id = ". $aid ."";
$resultado = mysqli_query($link, $sql); 

if ($resultado->num_rows === 0) {
  echo '<script type="text/javascript">';
  echo    'alert("Não conseguimos achar essa pessoa em nossos registros");';
  echo    'window.location.href= "busca_cadastro.php";';
  echo'</script>';
  exit;
}

$contato = $resultado->fetch_assoc();
 
$resultado->free();
$link->close();
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
