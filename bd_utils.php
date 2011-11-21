<?php

//constantes
$host = "127.0.0.1";
$db_user = "root";
$db_pswd = "";
$db_name = "blog";



function conectar_bd() {
    /*
    retorna una conecion a la bd
    */ 
    global $host, $db_user, $db_name, $db_pswd;
    
    if (!$link = mysql_connect($host, $db_user, $db_pswd)) {
        echo "<p class='msj_error'>Error: Fallo la conecion a la BD</p>";
        exit();
    }
    
    if (!mysql_select_db($db_name, $link)) { 
        echo "<p class='msj_error'>Error seleccionando la base de datos.</p>".$db_name;
        exit();
    }
    return $link;
}


function test_db_conection() {
    //mostrara los datos de todos los usuarios registrados
    //funcion de prueba
    $cursor = conectar_bd();
    $query = "SELECT * FROM usuarios";
    $result = mysql_query($query, $cursor);
    while ($reg = mysql_fetch_array($result, MYSQL_BOTH)) {
        echo $reg[0]."&nbsp;";
        echo $reg[1]."&nbsp;<br >";
    }
}


class Session{
    function login($username=NULL, $password=NULL, $redirect=NULL) {
        /*
        Funcion que loguea un usuario en caso de no estar logueado
        parametros:
            $username: nombre de usuario
            $password: contrasenia usuario
            $redirect: sitio donde redirigir en caso de exito
         */
         
        //comprueba si ya esta logueado
        if (isset($_SESSION['id_usuario'])) {
            echo "<p class='msj_ok'>Ya estas logueado</p>";
            echo "<br /><a href='main.php' class='boton'>Continuar</a>";
            echo "<a href='logout.php' class='boton'>Desconectar</a>";
            return true;
        }
        
        //caso contrario intenta loguear
        else {
        if ($username != NULL && $password != NULL) {
            //evitar MYSQL iyection
            $username = stripslashes($username);
            $password = stripslashes($password);
            //$username = mysql_real_escape_string($username);
            //$password = mysql_real_escape_string($password);

            $cursor = conectar_bd();
            $query = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
            $result = mysql_query($query, $cursor);
            $count = mysql_num_rows($result);
            if ($count > 0) {
                $reg = mysql_fetch_assoc($result);
                $_SESSION['id_usuario'] = $reg["username"];
                $_SESSION['is_admin'] = $reg["is_admin"];
                
                //redireciona a otro sitio
                if ($redirect != NULL) {
                    //coloca enlace para 
                    echo "<p  class='msj_ok'>Login Correcto</p>";
                    echo "<br /><a href='$redirect' class='boton'>Continuar</a>";
                    return true;
                }
                else {
                    echo "<p class='msj_ok'>Login Correcto</p>";
                    echo "<br /><a href='main.php' class='boton'>Continuar</a>";
                    return true;
                }
            }
            else {
                echo "<p class='msj_error'>Error: usuario o contraseña invalida</p>";
                echo "<br /><a href='login.html' class='boton'>Login</a>";
                return true;
            }
        }
        echo "<p class='msj_error'>Error: usuario o contraseña invalida</p>";
        echo "<br /><br /><a href='login.html' class='boton'>Login</a>";
        return true;
        }

    }


    function is_login() {
        /*
         Si esta conectado, intentara redirecionar en caso de que el
         usuario no este conectado
        */
        if (isset($_SESSION['id_usuario'])) {
            return true;
        }
        //no esta conectado
        else {
            return false;
        }
    }


    function is_admin() {
        /*
        Si el usuario es administrador
        */
        if (isset($_SESSION['is_admin'])) {
            if ($_SESSION['is_admin']) {
                return true;
            }
            //esta conectado pero no es admin
            else {
                return false;
            }
        }
        //no esta conectado
        else {
            return false;
        }
    }

    //tiene prob nu usar
    function is_not_login($redirect=NULL) {
        /*
        en caso de no estar conectado redirecion al sitio
        */
        if (!$this->is_login()) {
            echo "<META HTTP-EQUIV=Refresh CONTENT='0; URL=login.html'>";
        }
    }


    function logout($redirect=NULL) {
        /*
        desconectar borra los datos de la session
        */
        session_unset();
        $_SESSION = array();
        session_destroy();
    }


    function encode($text) {
        //codifica md5
        return md5($text);
    }

    function hello() {
        echo "hola";
    }
}

?>

