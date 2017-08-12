<?php
include("database.php");
$todo_sql = mysqli_query($con,"SELECT * FROM todo_list");
$count_todo = mysqli_num_rows($todo_sql);
if(isset($_GET['act']) && $_GET['act']=="del" && $_GET['id']>0){ // DELETE TODO LIST
$todo_delete = mysqli_query($con,"Delete FROM todo_list WHERE todo_id='".$_GET['id']."'");
$todotask_delete = mysqli_query($con,"Delete FROM todo_items WHERE todo_id='".$_GET['id']."'");
header('Location:index.php');
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
        <h1>TODO List Manager</h1>
    </header>
    
    <div style="float:right;height:40px;">
    <a href="create_todo.php" target="_self">Create a TODO</a>
    </div>	
    
<table>
  <tr>
  	<th>Sr No</th>
    <th>TODO Name</th>
    <th>Created Date</th>
    <th>Action</th>
  </tr>
  <?php
  if($count_todo>0){
	  $sr_no=1;
  while($todo_res = mysqli_fetch_object($todo_sql)){ // LISTING OF TODO LIST?>
  <tr>
    <td><?php echo $sr_no;?></td>
    <td><?php echo $todo_res->todo_name;?></td>
    <td><a href="edit_todo.php?id=<?php echo $todo_res->todo_id;?>&act=edit" target="_self">Edit</a>  
    | <a href="index.php?id=<?php echo $todo_res->todo_id;?>&act=del" onclick="return confirm_delete();">Delete</a> 
    | <a href="task_list.php?id=<?php echo $todo_res->todo_id;?>&act=list">Add Todo Task</a>
    </td>
  </tr>
  <?php $sr_no++;} 
  }else{?>
  <tr>
   <td colspan="4" style="text-align:center;font-weight:bold;">No TODO List</td>
  </tr>
  <?php }?>

</table>
</body>
</html>
