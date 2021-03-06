<!DOCTYPE html>
<html>
<head>
	<title>Kathlyn's To-Do List</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
  <div class="warp">
    <div class="task-list">
    <ul>
      <?php require("include/connect.php"); 
      $mysqli = new sqli('localhost', 'root', 'root', 'todo');
      $query ="SELECT * FROM tasks ORDER BY date ASC, time ASC";
      if($result= $mysqli->query($query)){
        $numrows = $result->num_rows; // using numrows
        if($numrows>0){
          while($row = $result->fetch_assoc()){
            $task_id $row('id');
            $task_name = $row("task");

            echo '<li> 
            <span>'.$task_name. '</span>
            <img id="'.$task_id.'" class="delete-button" width="10px" src="images/close.svg"/></li>'; // echoing html code
          }
        }
      }
      ?>
    </ul>
  </div>
  <form class="add-new-task" autocomplete="off">
   <input type="text" name="new-task" placeholder="Add new item..."/>
   </form>
   </div> 
</body>
<script src="http//code.jquery.com/jquery-latest.min.js"></script>
<script>
  add_task // caling the add task function

  function add_task(){
    $(".add-newtask").submit(function){
      var new_task = $('add.new-task input[name=new-task]').val();

      if(new_task != ''){
        $.post('includes/add-task.php',{ task: new_task}, function(data){
           $('add-newtask input[name=new-task]'].val();
            $(data).appendTo('.task-list ul').hide().fadeIn();
         });
        }
        return false;
      });
    }

    $(".delete-button").click(function(){
      var current_element = $(this); 
      var task_id = $(this).attr('id');

      $.post('includes/delete-task.php', {id: task_id}, function(){
      current_element.parent().fadeDut("fast", function(){
        $(this).remove();
      });
    });
  });

</script>
</html>