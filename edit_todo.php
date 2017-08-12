<?php
include("database.php");
$err_msg='';
if(isset($_POST['submit']))
{
   $todo_name = $_POST['todo_name'];
   if($todo_name=="")  //VALIDATION CODE
	{
		$err_msg = "Please enter Title";
	}
   else //UPDATE TODO LIST
   {
		mysqli_query($con,"Update todo_list SET todo_name ='".$todo_name."' WHERE todo_id='".$_GET['id']."'");
		mysqli_close($con);
		header("Location:index.php");
   }
}
if($_GET['id']>0 && $_GET['act']=="edit")
{ //DISPLAY TODO LIST IN EDIT PAGE
	$todo_sql = mysqli_query($con,"SELECT * FROM todo_list WHERE todo_id='".$_GET['id']."'");
	$count_todo = mysqli_num_rows($todo_sql);
	$todo_res = mysqli_fetch_object($todo_sql);
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
    <strong>Edit Todo </strong>
    </div>	
<table>
<form name="addtodo" action="" method="post">
  <tr>
    <td>Title</td>
    <td><input type="text" name="todo_name" id="todo_name" value="<?php echo $todo_res->todo_name;?>" />
    <span style="color:red;"><?php echo $err_msg;?></span>	
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Update Todo" id="submit" />
    <input type="button" name="submit" value="Back to" id="submit" onclick="window.history.back();" />
    </td>
  </tr>
</form> 
</table>
</body>
</html>
