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

    <h1>Nuevo Post</h1>

    <form  action='crear-post.php' method='POST' >
    <table>
	<tr>
		<td><label>Titulo:</label></td>
		<td><input type="text" name="titulo" class="edt_g" /></td>
	</tr>
	<tr>
		<td><label>Contenido:</label></td>
		<td><textarea name="contenido" class="edt" rows="20" cols="80"/></textarea></td>
	</tr>
	<tr>
		<td><label>Tags:</label></td>
		<td><input type="text" name="tags" class="edt_g" /></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><br />
        <input type="submit" value="Crear"/>
        <input type="reset" value="Limpiar"/>
        </td>
	</tr>
    </table>
    </form>
    
    </div>
</div>

</body>

</html>
