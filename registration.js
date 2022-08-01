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
// function addFW(){
//   // let hiddenFW = document.querySelector("#hiddenFW");
//   // hiddenFW.classList.remove("noFW")
//   // hiddenFW.classList.add("seeFW")

//   let ol = document.querySelector("ol")
//   let newLi = document.createElement("li")

//   ol.appendChild(newLi)
//   ol.insertBefore(newLi, fileUpload)
//   newLi.id = "hiddenFW"
//   newLi.className = "seeFW"

//   let newLabel = document.createElement("label")
//   newLabel.innerHTML = "Add ticket number: "
//   newLabel.setAttribute('for', 'ticketNumber ticketNumber')
//   newLi.appendChild(newLabel)

//   var input = document.createElement("input")
//   input.type = "text"
//   input.name = "ticketNumber"
//   input.id = "ticketNumber"
//   input.placeholder = "123XY"
//   input.className = "validInput"
//   input.minLength = "5"
//   input.maxLength = "5"
//   newLi.appendChild(input)
//     }

// function removeFW(){
//   let hiddenFW = document.querySelector("#hiddenFW")
//   let ol = document.querySelector("ol")

//   ol.removeChild(hiddenFW)

//     }

function openTrip() {
  let myProfile__form = document.querySelector("#myProfile__form");
  myProfile__form.classList.toggle("nomyProfile__form")
  myProfile__form.classList.toggle("seemyProfile__form")
}
function openDetails() {
  let profileDetails = document.querySelector("#profileDetails");
  profileDetails.classList.toggle("noprofileDetails")
  profileDetails.classList.toggle("seeprofileDetails")
}

function addFW(){

  let profileDetails = document.querySelector("#profileDetails")
  let newDiv = document.createElement("div")

  profileDetails.appendChild(newDiv)
  profileDetails.insertBefore(newDiv, fileUpload)
  newDiv.id = "hiddenFW"
  newDiv.className = "seeFW"

  let newLabel = document.createElement("label")
  newLabel.innerHTML = "Add ticket number: "
  newLabel.setAttribute('for', 'ticketNumber ticketNumber')
  newDiv.appendChild(newLabel)

  var input = document.createElement("input")
  input.type = "text"
  input.name = "ticketNumber"
  input.id = "ticketNumber"
  input.placeholder = "123XY"
  input.className = "validInput"
  input.minLength = "5"
  input.maxLength = "5"
  newDiv.appendChild(input)
    }

function removeFW(){
  let hiddenFW = document.querySelector("#hiddenFW")
  let profileDetails = document.querySelector("#profileDetails")

  profileDetails.removeChild(hiddenFW)

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
      passwordMatchResult.innerHTML = "They are the same &#9989"
      return false;
    }
    else{
      passwordMatchResult.innerHTML = "They are not the same &#10060"
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
      passwordMatchResult.innerHTML = "They are the same &#9989"
      return false;
    }
    else{
      passwordMatchResult.innerHTML = "They are not the same &#10060"
      return true;
    }
  
}

//header
function openLogin() {
  let hiddenLogin = document.querySelector("#loginForm");
  hiddenLogin.classList.toggle("noLogin")
  hiddenLogin.classList.toggle("seeLogin")
}

//itinerary

function openPubcrawl() {
  let hiddenPubcrawl = document.querySelector("#pubcrawl-hidden");
  hiddenPubcrawl.classList.toggle("noPubcrawlInfo")
  hiddenPubcrawl.classList.toggle("seePubcrawlInfo")
}
function openDaytrip() {
  let hiddenDaytrip = document.querySelector("#daytrip-hidden");
  hiddenDaytrip.classList.toggle("noDaytripInfo")
  hiddenDaytrip.classList.toggle("seeDaytripInfo")
}
function openBoatparty() {
  let hiddenBoatparty = document.querySelector("#boatparty-hidden");
  hiddenBoatparty.classList.toggle("noBoatparty")
  hiddenBoatparty.classList.toggle("seeBoatparty")
}
function openSportsday() {
  let hiddenSposrtsday = document.querySelector("#sportsday-hidden");
  hiddenSposrtsday.classList.toggle("noSposrtsday")
  hiddenSposrtsday.classList.toggle("seeSportsday")
}
function openPaddles() {
  let hiddenPaddles = document.querySelector("#paddles-hidden");
  hiddenPaddles.classList.toggle("noPaddles")
  hiddenPaddles.classList.toggle("seePaddles")
}
function openInterfaculty() {
  let hiddenInterfaculty = document.querySelector("#interfaculty-hidden");
  hiddenInterfaculty.classList.toggle("noInterfaculty")
  hiddenInterfaculty.classList.toggle("seeInterfaculty")
}
function openFooddrinks() {
  let hiddenFooddrinks = document.querySelector("#fooddrinks-hidden");
  hiddenFooddrinks.classList.toggle("noFooddrinks")
  hiddenFooddrinks.classList.toggle("seeFooddrinks")
}
function openOrientation() {
  let hiddenOrientation = document.querySelector("#orientation-hidden");
  hiddenOrientation.classList.toggle("noOrientation")
  hiddenOrientation.classList.toggle("seeOrientation")
}
function openBeanies() {
  let hiddenBeanies = document.querySelector("#beanies-hidden");
  hiddenBeanies.classList.toggle("noBeanies")
  hiddenBeanies.classList.toggle("seeBeanies")
}

var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  spaceBetween: 30,
  slidesPerGroup: 3,
  loop: true,
  loopFillGroupWithBlank: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  // navigation: {
  //   nextEl: ".swiper-button-next",
  //   prevEl: ".swiper-button-prev",
  // },
});
