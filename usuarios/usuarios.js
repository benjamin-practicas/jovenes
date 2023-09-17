console.log("gggg");
const token   = "a608050b6daed9edb2584f3e3623b309",//"b73bb18bc24d4c308891ee79ae63e748",
      funcion = "core_enrol_get_enrolled_users",
      sitio   = "http://www.practice-design.xyz/benjamin/moodle";//"http://148.223.238.131:8432/moodle";




      const get_enroled_users = `${sitio}/webservice/rest/server.`+
`php?wstoken=${token}&wsfunction=${funcion}&moodlewsrestformat=json&courseid=${courseid}`;

console.log(get_enroled_users);

 const usersList = document.querySelector("#users");

let usuarioss = new Array;
let usuarios;



fetch(get_enroled_users).then(response=>response.json())
.then(users=>{
       // usuarioss.push(users.fullname);
        usersList.innerHTML = "";          
        users.forEach((user) => {   
        console.log(user);
       // let courseid= course.id;
      // usuarios=users;
        //usuarioss.push(user.fullname);

        
        let args = `courseid=${courseid}`+
        `&userid=${user.id}`
        

          usersList.innerHTML += ` 
            <div class="card card-body my-2 animated fadeInLeft" style={{ textAlign: "center" }} >
            
             <button
               class="btn btn-primary btn-sm"  
               onclick="window.location.href='../formato/formato.php?${args}' " >
              <h6> ${user.fullname} </h6>
              </button>
              
            </div>
          `;
//
        
       });
    }
);

// console.log(usuarioss);

// const inventario = [
//     {nombre: 'manzanas', cantidad: 2},
//     {nombre: 'bananas', cantidad: 0},
//     {nombre: 'cerezas', cantidad: 5}
// ];

// function esCereza(usuarios) {
//     return usuarios.fullname === 'usuario nuevo';
// }



// console.log("*******"+usuarios.find(esCereza)); 