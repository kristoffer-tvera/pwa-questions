<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php echo '<p>Hello World</p>'; ?> 
 <?php 
 include 'php/db_connect.php';
//  include 'php/question.php';
//  $question1 = new Question("Food", "Pepperoni", 0, "Salami", 5);

echo json_encode(Get_question_random());
//  echo Add_question("Pepperoni", "Salami", "Food");
 ?>
 </body>
</html>