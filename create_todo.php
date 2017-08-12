<?php
// Get the product data
$todo_id = filter_input(INPUT_POST, 'todo_id', FILTER_VALIDATE_INT);
$todo_name = filter_input(INPUT_POST, 'name');

// Validate inputs
if ($todo_id == null || $todo_id == false ||
        $todo_name == null  {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'INSERT INTO todo_list
                 (todo_id, todo_name)
              VALUES
                 (:todo_id, :todo_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':todo_id', $todo_id);
    $statement->bindValue(':todo_name', $name);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
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
