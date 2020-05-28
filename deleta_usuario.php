  <?php
	  require_once('backend/db.class.php');

	  $deletar_usuario_id = $_POST['deletar_usuario_id'];

	  $sql = ("DELETE FROM tb_pessoas WHERE id = $deletar_usuario_id ");

	  echo $sql;

  	  $objDb = new db();
	  $link = $objDb->conecta_mysql();

	  mysqli_query($link, $sql); 
  ?>