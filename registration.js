//registration
function addFields(){
  let ol = document.querySelector("ol")
  let number = document.getElementById ("ticketNumber").value
  if(number.length == 5){
    document.getElementById("ticketNumber").id = "oldTicket"
    for (i=0; i<1; i++){
        
        let newLi = document.createElement("li")
        ol.appendChild(newLi)
        ol.insertBefore(newLi, fileUpload)

        let newLabel = document.createElement("label")
        newLabel.innerHTML = "Other ticket number: "
        newLabel.setAttribute('for', 'ticketNumber ticketNumber--'+ i)
        newLi.appendChild(newLabel)

        var input = document.createElement("input")
        input.type = "text"
        input.name = "ticketNumber_" + i
        input.id = "ticketNumber"
        input.placeholder = "123XY"
        input.className = "validInput"
        input.minLength = "5"
        input.maxLength = "5"
        input.setAttribute('onkeyup', 'addFields()');
        newLi.appendChild(input)
        
        let span = document.createElement("span")
        span.innerHTML = "This number was already used."
        span.className = "warning"
        newLi.appendChild(span)
    }
  }
}

// myProfile
function addFW(){
  // let hiddenFW = document.querySelector("#hiddenFW");
  // hiddenFW.classList.remove("noFW")
  // hiddenFW.classList.add("seeFW")

  let ol = document.querySelector("ol")
  let newLi = document.createElement("li")

  ol.appendChild(newLi)
  ol.insertBefore(newLi, fileUpload)
  newLi.id = "hiddenFW"
  newLi.className = "seeFW"

  let newLabel = document.createElement("label")
  newLabel.innerHTML = "Add ticket number: "
  newLabel.setAttribute('for', 'ticketNumber ticketNumber')
  newLi.appendChild(newLabel)

  var input = document.createElement("input")
  input.type = "text"
  input.name = "ticketNumber"
  input.id = "ticketNumber"
  input.placeholder = "123XY"
  input.className = "validInput"
  input.minLength = "5"
  input.maxLength = "5"
  newLi.appendChild(input)
    }

function removeFW(){
  let hiddenFW = document.querySelector("#hiddenFW")
  let ol = document.querySelector("ol")

  ol.removeChild(hiddenFW)

    }

function addPassword(){
  let hiddenPassword = document.querySelector("#hiddenPassword");
  hiddenPassword.classList.toggle("noPassword")
  hiddenPassword.classList.toggle("seePassword")
}   

function addPubcrawl(){
  let hiddenPubcrawl = document.querySelector("#hiddenPubcrawl");
  hiddenPubcrawl.classList.toggle("noPubcrawl")
  hiddenPubcrawl.classList.toggle("seePubcrawl")
}

function addPaddles(){
  let hiddenPaddles = document.querySelector("#hiddenPaddles");
  hiddenPaddles.classList.toggle("noPaddles")
  hiddenPaddles.classList.toggle("seePaddles")
}

function checkPassword() {
  let password1 = document.getElementById("newPassword").value
  let password2 = document.getElementById("newPassword_no2").value
  let passwordMatchResult = document.querySelector(".passwordMatchResult")
  
    if (password2.startsWith(password1) && password2 == password1) {
      passwordMatchResult.innerHTML = "They are the same."
      return false;
    }
    else{
      passwordMatchResult.innerHTML = "They are not the same."
      return true;
    }
  
}

function upload(){
  let uploadButton = document.querySelector("#uploadInfo")
  let uploadSpan = document.querySelector("#uploadInfo_span")
  uploadButton.className = "noInfo"
  uploadSpan.className = "seeInfo_span"
  if(passwordMatchResult.innerHTML != "They are not the same."){
  }
}


//forgottenPassword
function checkPassword2a() {
  let password1 = document.getElementById("newPassword1a").value
  let password2 = document.getElementById("newPassword_no2a").value
  let passwordMatchResult = document.querySelector(".passwordMatchResult2a")
  
    if (password2.startsWith(password1) && password2 == password1) {
      passwordMatchResult.innerHTML = "They are the same."
      return false;
    }
    else{
      passwordMatchResult.innerHTML = "They are not the same."
      return true;
    }
  
}
