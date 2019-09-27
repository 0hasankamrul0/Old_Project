var btn = document.getElementById("clkbtn");
var para = document.getElementById("fpara");
btn.addEventListener("click", function(event) {
    // console.log("This is from script tag !!!!")
    // alert("this is triggered by clicking on the button");
    btn.innerHTML = "YOU CLICKED !!";
    para.innerHTML = document.baseURI;
});

var body = document.body;
console.log(body.scrollHeight);
console.log(body.scrollHeight);