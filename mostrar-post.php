<?php
include("bd_utils.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>sin título</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link type="text/css" rel="stylesheet" media="all" href="css/base.css">
</head>

<body>

<div align="center">
    <!-- secundario -->
    <div class="secundario">
        <h3>Listado Tags</h3>
        
        <h3>Ultimos Post</h3>
    
    </div>

    <!-- cuerpo documento -->
    <div class="primario">

    <?php
    $conn = conectar_bd();
    //si no hay post pasado por parametro selecion el primero
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }
    else {
        $id = 1;
    }

    $query = "SELECT * FROM `posts` WHERE `id`=$id";
    $result = mysql_query($query, $conn);
    $post = mysql_fetch_assoc($result);

    echo "<h1>".$post["titulo"]."</h1><hr />";
    echo "<div align='left'>".$post["contenido"]."</div>";
        

    ?>
    
    </div>
</div>

</body>

</html>
