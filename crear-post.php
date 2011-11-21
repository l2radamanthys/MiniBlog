<?php
include("bd_utils.php");
include("utils.php");
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
    </div>

    <!-- cuerpo documento -->
    <div class="primario">

    <?php
        $conn = conectar_bd();

        if (isset($_POST["titulo"])) {
            $title = $_POST["titulo"];
            $content = $_POST["contenido"];
            $tags = explode(",", $_POST["tags"]);

            //insertamos el post
            $query = "INSERT INTO `posts` (`id`, `titulo`, `contenido`, `username_usuario`) VALUES (NULL, '$title', '$content', NULL);";
            mysql_query($query, $conn) or die (mysql_error());

            $query = "SELECT * FROM `posts` ORDER BY `id` DESC LIMIT 1";
            $result = mysql_query($query, $conn);
            $post = mysql_fetch_assoc($result);

            //insertamos los tags
            foreach ($tags as $tag) {
                insert_tag($conn, $tag);
                insert_reference($conn, $tag, $post["id"]);
            }
            echo "<p>Post Agregado..</p>";
        }

        $query = "";
    ?>

    </div>
</div>

</body>

</html>
