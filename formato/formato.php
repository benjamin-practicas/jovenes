


<?php 
    /////CONSULTA DE TAGS/////

   // include ("../resources/Conection.php");
    include ("Data.php");
    var_dump(getArrayCompetencias(4,834));

    $userid  =$_GET['userid']; 
    $courseid=$_GET['courseid'];


    $usercompl = json_decode( file_get_contents("http://www.practice-design.xyz/benjamin/moodle/webservice/rest/server.php?wstoken=a608050b6daed9edb2584f3e3623b309&wsfunction=core_user_get_users&moodlewsrestformat=json&criteria[0][key]=id&criteria[0][value]=${userid}"), true );
  
   /// print_r($usercompl['users'][0]) ;
    $user = $usercompl['users'][0];
    
  echo "<br><br>";
    $coursecompl = json_decode( file_get_contents("http://www.practice-design.xyz/benjamin/moodle/webservice/rest/server.php?wstoken=a608050b6daed9edb2584f3e3623b309&wsfunction=core_course_get_courses&moodlewsrestformat=json"), true );
  

    foreach($coursecompl as $course){
      if($course['id']==$courseid){
          $course_details=$course;
      }

    }

   // echo $course_details['fullname'] ;
    $user = $usercompl['users'][0];

    $conn = conect();
    // Check connection
    

    $consulta= "SELECT mdl_tag.name FROM mdl_tag_instance
     INNER JOIN  mdl_tag ON mdl_tag_instance.tagid=mdl_tag.id where mdl_tag_instance.itemid=${courseid} ";
    
    $resultado = mysqli_query($conn, $consulta);
   
    while($row=mysqli_fetch_assoc($resultado)){   
      $tags[]=$row["name"];        
    }   
   $data = json_decode( file_get_contents("http://www.practice-design.xyz/benjamin/moodle/webservice/rest/server.php?wstoken=a608050b6daed9edb2584f3e3623b309&wsfunction=mod_quiz_get_quizzes_by_courses&courseids[0]=${courseid}&moodlewsrestformat=json"), true );
////EMPAREJANDO TAG CON QUIZ 
print_r($data);
 echo"<br>";echo"<br>";
 $iterable= $data['quizzes'];
 
foreach($tags as $value){
     foreach ($iterable as $valor) {
        
     if($value===strtolower($valor['name'])){
       echo $valor['id']."*****"."<br>";
         $quizids[]=$valor["id"];        
     }
 
}
}

///EMPAREJANDO QUIZ CON CALIFICACIÓN
foreach($quizids as $quizid){
$url ="http://www.practice-design.xyz/benjamin/moodle/webservice/rest/server.php?wstoken=a608050b6daed9edb2584f3e3623b309&wsfunction=mod_quiz_get_user_best_grade&quizid=${quizid}&userid=${userid}&moodlewsrestformat=json";
$data = json_decode( file_get_contents($url), true );
$grade[]=$data["grade"];

}
  
    mysqli_close($conn);    
///DATOS EMPLEADO

?>

<script>
  const getUrl = new URLSearchParams(window.location.search)
  const userid = getUrl.get('userid') 
  
  console.log(`este es el id desde js ${userid}`);
  
  
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formato</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
</head>
<body>
<div class="col-md-10">

<table class="table">

<tr>
    <td > <b>Del empleado</b> 
      <tr>
        <td>No control:</td>
        <td><?php echo $user['username'] ?></td>
      </tr>  
      <tr>
        <td> Nombre Completo </td>
        <td><?php echo strtoupper($user['fullname']) ?></td>
        
      </tr> 
        <td>Puesto</td>
        <td><?php echo strtoupper($user['institution']) ?></td>  
      <tr>

      </tr> 
        <td>Área</td>
        <td><?php echo strtoupper($user['department']) ?></td>  
      <tr>

      </tr>
    </td>
    <td  > <b>Del jefe directo</b> </td>
    <tr>
        <td>No control:</td>
        <td><?php echo $user['username'] ?></td>
      </tr>  
      <tr>
        <td>Nombre Completo</td>
        <td><?php echo strtoupper($user['fullname']) ?></td>
        
      </tr> 
        <td>Puesto</td>
        <td><?php echo strtoupper($user['institution']) ?></td>  
      <tr>

      </tr> 
        <td>Área</td>
        <td><?php echo strtoupper($user['department']) ?></td>  
      <tr>

  </tr>
  <tr>
    <td> <b></b> Nombre del curso:</td>
    <td><?php echo strtoupper($course_details['fullname']) ?></td>
  </tr>

  <tr>
  <td><?php echo $course_details['summary'] ?></td>
  </tr>

   <tr>
      <td><b>Competencia</b></td>
      <td><b>Efectividad</b></td>
    </tr>
  <?php 
  $variable=0;
  foreach($tags as $tag){ 
    ?>
   
    <tr>
          <td><?php echo $tag;?></td>
          <td><?php echo $grade[$variable];
          $variable= $variable+1;?></td>
    </tr>
   

 <?php }  ?>

</table>
</div>

   
<script>
const   userid   ="<?php echo $userid ?>",
 courseid = "<?php echo $courseid ?>";
 //const courseid = "<?php echo $courseid."+++" ?>";


</script>
 <script src="formato.js"></script> 
</body>
</html> 