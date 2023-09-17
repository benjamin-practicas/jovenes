// const token   = "b73bb18bc24d4c308891ee79ae63e748",//"a608050b6daed9edb2584f3e3623b309",
//       funcion = "core_course_get_courses"
//       sitio   = "http://148.223.238.131:8432/moodle";//"http://www.practice-design.xyz/benjamin/moodle";
console.log("test");

const token   = "a608050b6daed9edb2584f3e3623b309",
      funcion = "core_course_get_courses"
      sitio   = "http://www.practice-design.xyz/benjamin/moodle";


//http://www.practice-design.xyz/benjamin/moodle/webservice/rest/server.php?wstoken=&wsfunction=mod_quiz_get_user_best_grade&moodlewsrestformat=json`


const get_courses = `${sitio}/webservice/rest/server.`+
`php?wstoken=${token}&wsfunction=${funcion}&moodlewsrestformat=json`;

const coursesList = document.querySelector("#courses");
console.log(get_courses);

fetch(get_courses).then(response=>response.json())
.then(course=>{  
        coursesList.innerHTML = "";          
        course.forEach((course) => {   
         
        let courseid= course.id;

          coursesList.innerHTML += `
            <div class="card card-body my-2 animated fadeInLeft" style={{ textAlign: "center" }} >
            
             <button
               class="btn btn-primary btn-sm"  
               onclick="window.location.href='./usuarios/usuarios.php?courseid=${courseid}'" >
              <h4> ${course.displayname} </h4>
              </button>
              
            </div>
          `;
//
        
        });
    }
);//*        <h4>${t.name}</h4>
        //       <p>${t.description}</p>
        //       <h3>${t.price}$</h3>
        //       <p>
        //       <button class="btn btn-danger btn-sm" onclick="deleteProduct('${t.id}')">
        //         DELETE
        //       </button>
        //       <button class="btn btn-secondary btn-sm" onclick="editProduct('${t.id}')">
        //         EDIT 
        //       </button>
        //       </p> */