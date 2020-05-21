<?php
  
  require_once('db.class.php');

  $nome = $_POST['nome']; 
  $telefone = $_POST['telefone'];
  $endereco = $_POST['endereco'];
  $email = $_POST['email'];

  //Cria um Obj da classe db.class
  $objDb = new db();

  
  //A variavel $link vai receber o resultado da 
  //Funçao conecta_mysql() que resulta nas info. necessarias para a conexão
  //usando a instania do obj. $objDb
  $link = $objDb->conecta_mysql();

  $sql = "INSERT INTO tb_pessoas(nome, telefone, email, endereco) values('$nome', '$telefone', '$email', '$endereco')";

  //cria a query com link
  mysqli_query($link, $sql); 

  //Criar uma forma de conferir o sucesso
  //do insert e e criar um echo para ser
  //exibido na busca_cadastro.php dinamicamento por ajax
?>