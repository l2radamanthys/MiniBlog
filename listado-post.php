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
    //paginacion
    $conn = conectar_bd();
    $query = "SELECT * FROM `posts`";
    $result = mysql_query($query, $conn);
    $NUM_POST = mysql_num_rows($result); //cantidad total de post
    $PAGE_SIZE = 3; //cantidad de post por pagina
    $PAGE_NUM = ceil($NUM_POST / $PAGE_SIZE); //cantidad de paginas
    //si se seleciono alguna pagina
    if (isset($_GET["pag"])) {
        $PAGE = $_GET["pag"];
        if ($PAGE > $PAGE_NUM) { //controlo que no se salga del rango
            $PAGE = $PAGE_NUM;
        }
    }
    else {
        $PAGE = 1;
    }
    $OFFSET = ($PAGE - 1) * $NUM_POST; //desplazamiento

    if ($OFFSET > 0) {
        $OFFSET -= 1;
    }
    
    echo "<div align='right'>";
    for ($i=1; $i <= $PAGE_NUM; $i++) {
        if ($i == $PAGE) {
            echo "<a href='listado-post.php?pag=$i' class='page_select'>$i</a>";
        }
        else {
            echo "<a href='listado-post.php?pag=$i' class='page_num'>$i</a>";
        }
    }
    echo "</div><hr />";

    echo "<h1>Listado Posts</h1>";
    
    //muestro primero los ultimos post
    $query = "SELECT * FROM `posts` ORDER BY `id` DESC LIMIT $PAGE_SIZE OFFSET $OFFSET";
    $result = mysql_query($query, $conn);
    while ($post = mysql_fetch_assoc($result)) {
        echo "<div class='post_cont'>";
        echo "<h2>".$post["titulo"]."</h2><hr />";
        echo  substr($post["contenido"],0, 100);
        echo "<br /><div align='right'><a href='mostrar-post.php?id=".$post["id"]."'>mas..</a></div>";
        echo "</div>";
    }



    
    
    

    ?>
    
    </div>
</div>

</body>

</html>
