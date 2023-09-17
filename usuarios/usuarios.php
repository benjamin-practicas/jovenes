<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
</head>
<body>

<br> 
    <div class="box" id="div5">
        <div class="col-md-5" >
        <div id="users" ></div></div>
      </div>

    </div>


    <?php  
$courseid=$_GET['courseid'];
?>
<script>
const courseid = "<?php echo $courseid ?>";
</script>
<script src="usuarios.js"></script>
</body>
</html>