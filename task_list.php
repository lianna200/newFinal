<?php
include("db.php");

if(isset($_GET['act']) && $_GET['act']=="list" && $_GET['id']>0){
//FETCH RECORDS FOR TODO TASK	
$todo_sql = mysqli_query($con,"SELECT * FROM todo_items WHERE todo_id='".$_GET['id']."'");
$count_todo = mysqli_num_rows($todo_sql);

//FETCH TODO NAME
$todolist_sql = mysqli_query($con,"SELECT * FROM todo_list WHERE todo_id='".$_GET['id']."'");
$count_todolist = mysqli_num_rows($todolist_sql);
if($count_todolist > 0){
$todolist_res = mysqli_fetch_object($todolist_sql);
$todo_name = $todolist_res->todo_name;}
}
// DELETE TODO TASK ITEMS
if(isset($_GET['act']) && $_GET['act']=="del" && $_GET['id']>0){
$todo_delete = mysqli_query($con,"Delete FROM todo_items WHERE item_id='".$_GET['id']."'");
header('Location:task_list.php?id='. $_GET['rtn'].'&act=list');
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
<script type="text/javascript">
function confirm_delete()
{
	 return confirm('are you sure want to delete?');
}
</script>
</head>
<body>
<header>
        <h1>Task List Manager</h1>
    </header>
   <div style="height:40px;"> 
    <div style="float:right">
     <a href="index.php" target="_self">Back to TODO List</a> |
    <a href="create_task.php?id=<?php echo $_GET['id'];?>" target="_self">Create a Task</a>
    </div>	
    <div>
    <?php
    if(isset($todo_name)){?>
    <span><strong>Todo Name:</strong> </span><span><?php echo $todo_name; ?></span>
    <?php }?>
    </div>
    </div>
<table>
  <tr>
  	<th>Sr No</th>
    <th>Task Name</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php
  if($count_todo>0){ // DISPLAY TODO TASK LIST
	  $sr_no=1;
  while($todo_res = mysqli_fetch_object($todo_sql)){
	   $status = $todo_res->task_status==1?"Completed":"Pending";
	  ?>
  <tr>
    <td><?php echo $sr_no;?></td>
    <td><?php echo $todo_res->task_name;?></td>
    <td><?php echo $status;?></td>
    <td><a href="edit_task.php?id=<?php echo $todo_res->item_id;?>&rtn=<?php echo $_GET['id'];?>&act=edit" target="_self">Edit</a>  
    | <a href="task_list.php?id=<?php echo $todo_res->item_id;?>&act=del&rtn=<?php echo $_GET['id'];?>" onclick="return confirm_delete();">Delete</a> 
    </td>
  </tr>
  <?php $sr_no++;} 
  }else{?>
  <tr>
    <td colspan="4" style="text-align:center;font-weight:bold;">No task list</td>
  </tr>
  <?php }?>

</table>
</body>
</html>