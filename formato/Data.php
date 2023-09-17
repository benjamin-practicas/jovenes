<?php
    include ("../resources/Conection.php");    


    function getURLAPI($functionRequest, $args, $webSite= "http://www.practice-design.xyz/benjamin/moodle", $token= "a608050b6daed9edb2584f3e3623b39" ){
      
      return "$webSite/webservice/rest/server.php?wstoken=$token". 
      "&wsfunction=$functionRequest&moodlewsrestformat=json$args";
      
    }


    function getTipo ($resultado, $competencias){
        $indice =0;
        while($row=mysqli_fetch_assoc($resultado)){   
          $tags[]=$row["name"];              
          $stringTipo=strtoupper(substr($row["name"],1,1)) ;
          $stringTipo == "C" ? $competencias[$indice]["tipo"]= "Conductual" : $competencias[$indice]["tipo"]= "Tecnica";  
          $indice++;
        } 
        $retorno["tags"]=$tags;
        $retorno["competencias"]=$competencias;

        return $retorno;
        
    }
    function getTags ($courseid, $conn, $competencias ){
   
      $consulta= "SELECT mdl_tag.name FROM mdl_tag_instance
                 INNER JOIN  mdl_tag ON mdl_tag_instance.tagid=mdl_tag.id 
                 where mdl_tag_instance.itemid= ${courseid}";
        
      $resultado = mysqli_query($conn, $consulta);
      return getTipo($resultado,$competencias);
    }

    function getNombresCompetencias($courseid,$tags,$competencias){
      $functionRequest='mod_quiz_get_quizzes_by_courses';
      $args="&courseids[0]=$courseid";

      echo (getURLAPI($functionRequest,$args));
      $data = json_decode( file_get_contents("http://www.practice-design.xyz/benjamin/moodle/webservice/rest/server.php?wstoken=a608050b6daed9edb2584f3e3623b309&wsfunction=&moodlewsrestformat=json"), true );
    }

    function getArrayCompetencias($courseid,$userid){
        $conn = conect();
        $competencias = array();

        $tagsCompetencias=getTags($courseid, $conn, $competencias);
        $competencias= $tagsCompetencias["competencias"];

      
        getNombrescompetencias($courseid,$tagsCompetencias,$competencias);
        
        
        return $competencias;
      }  
 
  //echo("<br> competencias estado <br>".getURLAPI("TEST","rrr"));
  var_dump(getArrayCompetencias(4,63));
  //$PHPvariable = "<script> document.write(variableJS) </script>";
 
  
///////


    

?>