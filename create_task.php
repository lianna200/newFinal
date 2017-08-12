<?php
include("db.php");
$err_msg_tit='';
$err_msg_st='';
if(isset($_POST['submit'])){
$task_name = $_POST['task_name'];
$task_status = $_POST['task_status'];
$todo_id = $_POST['todo_id'];
	if($task_name=="")
	{
		$err_msg_tit = "Please enter Title";
	}
	if($task_status==0)
	{
		$err_msg_st = "Please select Status";
	}
   // INSERT TODO ITEME
   if($task_name!='' && $task_status>0)
   {  
	mysqli_query($con,"INSERT INTO todo_items (task_name,task_status,todo_id) 
	VALUES ('".$task_name."','".$task_status."','".$todo_id."')");
	mysqli_close($con);
	header("Location:task_list.php?id=".$todo_id."&act=list");
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
        <h1>Task List Manager</h1>
    </header>
    <div style="float:left">
    <strong>Add Task </strong>
    </div>	
<table>
<form name="addtodo" action="" method="post">
  <tr>
    <td>Title</td>
    <td><input type="text" name="task_name" id="task_name" style="width:50%" /> 
	<span style="color:red;"><?php echo $err_msg_tit;?></span>	
    <input type="hidden" name="todo_id" id="todo_id" value="<?php echo $_GET['id'];?>"/> 
    </td>
  </tr>
   <tr>
    <td>Status</td>
    <td>
    <select name="task_status" id="task_status">
     <option value="0">Select</option>
    <option value="1">Complete</option>
    <option value="2">Pending</option>
    </select>
	<span style="color:red;"><?php echo $err_msg_st;?></span>	
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Add Task" id="submit" />
    <input type="button" name="submit" value="Back to" id="submit" onclick="window.history.back();" />
    </td>
  </tr>
</form> 
</table>
</body>
</html>