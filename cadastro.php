  <!DOCTYPE html>
  <html lang="en">
  <head>
    <?php include "./header.php"; ?>
    <script type="text/javascript">

      $(document).ready( function(){
        $("#erro").hide();

        //Função que verifica e envia dados
        //dados do cadastro
        $('#envia_cadastro').click( function(){
            //verificar se os campos estão preenchidos
            if ($('#nome').val() == '') {
              $("#nome").css({'border-color':'red'}); 
              $("#erro").show();
              $("#erro").html("favor preencher nome");
              die();
            }else{
              $("#nome").css({'border-color':'green'}); 
            }

            if ($('#telefone').val() == '') {
              $("#telefone").css({'border-color':'red'}); 
              $("#erro").show();
              $("#erro").html("favor preencher telefone");
              die();
            }else{
              $("#telefone").css({'border-color':'green'}); 
            }

            if ($('#endereco').val() == '') {
              $("#endereco").css({'border-color':'red'}); 
              $("#erro").show();
              $("#erro").html("favor preencher endereco");
              die();
            }else{
              $("#endereco").css({'border-color':'green'}); 
            }

            if($('#email').val() == '') {
              $("#email").css({'border-color':'red'}); 
              $("#erro").show();
              $("#erro").html("favor preencher email");
              die();
            }else{
              $("#email").css({'border-color':'green'}); 
            }

            //Pega os dados do cadastro e envia
            //por ajax para a pagina recebe_cadastro.php
            
            $.ajax({
              url: 'backend/recebe_cadastro.php',
              method: 'post',
              data: $('#cadastro_usuario').serialize(),
              success: function(data) {
                alert("Usuario cadastrado com sucesso!");
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

    <section class="height-80">

      <form id="cadastro_usuario" class="form-horizontal col-sm-8 mx-auto">
        <h1 class="">CADASTRO</h1>
        <div class="form-group">
          <label for="nome">Nome:</label>
          <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
        </div>

        <div class="form-group">
          <label for="telefone">Telefone:</label>
          <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o telefone">
        </div>

        <div class="form-group">
          <label for="endereco">Endereço</label>
          <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite o endereço">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email">
        </div>

         <div class="form-group">
            <p id="erro"  class="col-sm-12 btn btn-danger"></span>
        </div>

        <div class="form-group">
          <div class="col-sm-12">
            <button id="envia_cadastro" type="button" class="btn btn-primary">CADASTRAR</button>
          </div>
        </div>
      </form>

    </section>
  </body>
  </html> 

</div>
<?php include "./footer.php"; ?>
<script>
      $("#telefone").mask("(00) 00000-0000");
</script>
</body>
</html>
