<?php
// Connecting to and selecting a MySQL database named db_agenda
// Hostname:] [username:] [password:] [data base]
$mysqli = new mysqli("127.0.0.1", "root", "", "db_agenda");

// Oh no! A connect_errno exists so the connection attempt failed!
if ($mysqli->connect_errno) {
    // The connection failed. What do you want to do? 
    // You could contact yourself (email?), log the error, show a nice page, etc.
    // You do not want to reveal sensitive information

    // Let's try this:
    echo "Sorry, this website is experiencing problems.";

    // Something you should not do on a public site, but this example will show you
    // anyways, is print out MySQL error related information -- you might log this
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    
    // You might want to show them something nice, but we will simply exit
    exit;
}

/*echo("<script> console.log($mysqli->host_info) </script>") . "\n";*/
?>
<!-- exibe no console info sobre o host para confirmação -->
<script type="text/javascript">
   var mensagem = "<?php echo $mysqli->host_info;?>";
console.log(mensagem);
</script>