
const quote = document.querySelector(".quoteWrapper .quote");
const author = document.querySelector(".quoteWrapper .author");


window.onload = function (){
    fetch("https://api.quotable.io/random").then(res => res.json()).then(result =>{
        
        quote.innerText = '" ' + result.content + ' "';
        author.innerText = "--" + result.author;
    })
}



        
function displayTime(){
    var time = new Date();
    let hour = time.getHours();
    let minute = time.getMinutes();
    let second = time.getSeconds();
   let session =  document.getElementById("session");
   session.innerText = "AM";
    
    if(hour > 12){
        hour = hour - 12;
        session.innerText = "PM";
    }

    document.getElementById("hour").innerText = hour;
    document.getElementById("minute").innerText = minute;
    document.getElementById("second").innerText = second;
}

setInterval(displayTime, 10)