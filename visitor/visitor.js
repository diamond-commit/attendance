console.log("dom loaded")
let dataId = null
let firstname = document.getElementById("name");
let middle    = document.getElementById("middle");
let last      = document.getElementById("last");
let error     = document.getElementById("error");
let signout = document.querySelectorAll(".signout")
let form = document.getElementById("form")
  
  // basic val
     function validate(first, mid, last){
    return (
        /^[A-Za-z]+$/.test(first.value) &&
        /^[A-Za-z]*$/.test(mid.value) &&   // optional middle
        /^[A-Za-z]+$/.test(last.value)
    );
}

      // signing out
     signout.forEach(button => {
        button.addEventListener("click", function(e){
          e.preventDefault()
        document.querySelector('.overlayy').style.display='flex'
         
          dataId = button.dataset.id 
        })
      })

      // what yes button does
      yes.addEventListener("click", function(e){
        e.preventDefault()
        let counsellor = document.getElementById("counsellor").value.trim() 
        if(counsellor){
       insertcounsellor(dataId, counsellor)
        }
        signoutStudent(dataId)
      })

     async function signoutStudent(id) {
        try{
        let response = await fetch(`visitorval.php?id=${id}`)
        if(!response.ok){
         console.log(`Error : ${response.status}`) 
          }
          let data = await response.json()
            if(data.success){
                window.location.href = data.redirect
            }else{
                console.log(data.message)
            }
        } catch (error) {
            console.log(error)
        }
      }
    
   //sending form information
   form.addEventListener("submit", function(e){
    e.preventDefault();
    if (!validate(firstname, middle, last)) {
        error.style.display = "block";
        return;
    }
    error.style.display = "none";

    let formData = new FormData(form);
    send(formData);
});
   // send formdata manually through async 
   async function send(formdata) {
    try {
          let response = await fetch("visitorval.php", {
          method : "POST",
          body : formdata
        })
         if(!response.ok){
         console.log(`Error : ${response.status}`) 
          }
            let data = await response.json()
            if(data.success){

                document.querySelector(".overlay").style.display="none"
                window.location.reload()
            }else{
                console.log(data.message)
            }
        } catch (error) {
            console.log(error)
        }
      }  

      async function insertcounsellor(id, name ) {
        try{
        let response = await fetch(`visitorval.php?id=${id}&name=${name}`)
        if(!response.ok){
         console.log(`Error : ${response.status}`) 
          }

          let data = await response.json()
            if(data.success){  
                window.location.href = data.redirect
            }else{
                console.log(data.message)
            }
        } catch (error) {  
            console.log(error)
        }
      }