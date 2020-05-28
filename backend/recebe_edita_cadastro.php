
<?php
  require_once('db.class.php');

  $id_id = $_POST['id'];
  $id_nome = $_POST['nome'];
  $id_telefone = preg_replace('/[^\d]/', '',$_POST['telefone']);
  $id_email = $_POST['email'];
  $id_endereco = $_POST['endereco'];

  $sql = "UPDATE tb_pessoas SET nome='$id_nome', telefone='$id_telefone', email='$id_email', endereco='$id_endereco' WHERE id=$id_id";

  $objDb = new db();
  $link = $objDb->conecta_mysql();

  mysqli_query($link, $sql); 
?>