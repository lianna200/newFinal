<?php
include("database.php");
$err_msg_tit='';
$err_msg_st='';
if(isset($_POST['submit']))
{
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
	//UPDATE TODO TASK ITEMS
   if($task_name!='' && $task_status>0)
   {
		mysqli_query($con,"Update todo_items SET task_name ='".$task_name."',task_status='".$task_status."' WHERE item_id='".$_GET['id']."'");
		mysqli_close($con);
		header("Location:task_list.php?id=".$_GET['rtn']."&act=list");
   }
}
if($_GET['id']>0 && $_GET['act']=="edit")
{ //DISPLAY TODO LIST IN EDIT PAGE
	$todo_sql = mysqli_query($con,"SELECT * FROM todo_items WHERE item_id='".$_GET['id']."'");
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
        <h1>Task List Manager</h1>
    </header>
    <div style="float:left">
    <strong>Edit Task</strong>
    </div>	
<table>
<form name="addtodo" action="" method="post">
  <tr>
    <td>Title</td>
    <td><input type="text" name="task_name" id="task_name"  value="<?php echo $todo_res->task_name;?>" style="width:50%" /> 
	<span style="color:red;"><?php echo $err_msg_tit;?></span>	
    <input type="hidden" name="todo_id" id="todo_id" value="<?php echo $_GET['id'];?>"/> 
    </td>
  </tr>
   <tr>
    <td>Status</td>
    <td>
    <select name="task_status" id="task_status">
     <option value="0">Select</option>
    <option value="1" <?php if($todo_res->task_status==1){echo "selected='selected'";}?>>Complete</option>
    <option value="2" <?php if($todo_res->task_status==2){echo "selected='selected'";}?>>Pending</option>
    </select>
	<span style="color:red;"><?php echo $err_msg_st;?></span>	
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="Update Task" id="submit" />
    <input type="button" name="submit" value="Back to" id="submit" onclick="window.history.back();" />
    </td>
  </tr>
</form> 
</table>
</body>
</html>
