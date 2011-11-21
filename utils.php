<?php
//include("bd_utils.php");

function insert_tag($conn, $tag_name) {
    /*
    inserta el tags en caso de que no exista, sino omite la insercion
    */

    $tag_name = strtoupper($tag_name); //todos los tags seran en MAYUSCULA
    $query = "SELECT * FROM `tags` WHERE name='$tag_name'";
    //$conn = conectar_bd();
    $result = mysql_query($query, $conn);
    $count = mysql_num_rows($result);
    //no existe lo creo
    if ($count == 0) {
        $query = "INSERT INTO `tags` (`name`, `descripcion`) VALUES ('$tag_name', '$tag_name');";
        mysql_query($query, $conn) or die (mysql_error());
        return true;
    }
    //si ya existe no hago nada
    else {
        return false;
    }
}

function insert_reference($conn, $tag_name, $post_id) {
    $tag_name = strtoupper($tag_name); //todos los tags seran en MAYUSCULA
    $query = "SELECT * FROM `tags_por_post` WHERE tag_name='$tag_name' AND post_id=$post_id";
    $result = mysql_query($query, $conn);
    $count = mysql_num_rows($result);
    if ($count == 0) {
        $query = "INSERT INTO `tags_por_post` (`tag_name`, `post_id`) VALUES ('$tag_name', $post_id);";
        mysql_query($query, $conn) or die (mysql_error());
        return true;
    }
    //si ya existe no hago nada
    else {
        return false;
    }
}


?>
