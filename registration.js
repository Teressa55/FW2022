


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
        newLabel.innerHTML = "Other FW Passport: "
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

// function invalidInput(){
//     document.getElementById("warning").style.display = "inline-block"
//     document.querySelector('.validInput').style.border = "2px solid rgb(220, 42, 42)"
// }


