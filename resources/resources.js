const WEBSITE        = "http://www.practice-design.xyz/benjamin/moodle",
       TOKEN           = "a608050b6daed9edb2584f3e3623b309";

 const getURLAPI = (functionRequest, args, webSite=WEBSITE, token=TOKEN ) => 
                      `${webSite}/webservice/rest/server.php?wstoken=${token}`+
                      `&wsfunction=${functionRequest}&moodlewsrestformat=json`+
                      `${args ? `&${args}` : ''}`;
 export {getURLAPI}