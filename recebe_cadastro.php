<?php
  
  require_once('db.class.php');

  $nome = $_POST['nome']; 
  $telefone = $_POST['telefone'];
  $endereco = $_POST['endereco'];
  $email = $_POST['email'];


  $objDb = new db();
  $link = $objDb->conecta_mysql();

  $sql = "INSERT INTO tb_pessoas(nome, telefone, email, endereco) values('$nome', '$telefone', '$email', '$endereco')";

  mysqli_query($link, $sql); 

  //Criar uma forma de conferir o sucesso
  //do insert e e criar um echo para ser
  //exibido na cadastra.php dinamicamento por ajax
?>