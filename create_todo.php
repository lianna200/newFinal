<?php
include("database.php");
$err_msg='';
if(isset($_POST['submit'])){
$todo_name = $_POST['todo_name'];
	if($todo_name=="") //VALIDATION OF TITLE
	{
		$err_msg = "Please enter Title";
	}
   else
   { // INSERT TODO LIST
	mysqli_query($con,"INSERT INTO todo_list (todo_name) 
	VALUES ('".$todo_name."')");
	mysqli_close($con);
	header("Location:index.php");
   }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>
<header>
        <h1>TODO List Manager</h1>
    </header>
    <div style="float:left">
    <strong>Add Todo </strong>
    </div>	
<table>
<form name="addtodo" action="" method="post">
  <tr>
    <td>Title</td>
    <td><input type="text" name="todo_name" id="todo_name" /> 
	<span style="color:red;"><?php echo $err_msg;?></span>	
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Add Todo" id="submit" />
    <input type="button" name="submit" value="Back to" id="submit" onclick="window.history.back();" />
    </td>
  </tr>
</form> 
</table>
</body>
</html>
