let button = document.getElementById("submit");
let text = document.getElementById("searchQ");
button.addEventListener("click",showSearch);

function showSearch(){
    alert(text.value);
    sessionStorage.setItem('label',text.value);
    window.location.href = "searchPage.html"
}


function displaySearch(){
    alert(sessionStorage.getItem('label'));
    let result = document.getElementById("div2Change2");
    let val = sessionStorage.getItem('label');
    array = ["snake","miceMen","bigShow","iPlanet"];
    str = "<div class = 'row'>"
    for (let i = 0; i<= array.length-1;i++){
       // if (array[i].includes(val)){
            console.log(array[i]);
            str += "<div class = 'col-lg-12'>"
            str += "<div class = 'game_container'>"
            str += array[i];
            str += "</div>"
            str += "</div>"
            str += "<br>";
        //}
    }
    str += "</div>";
    result.innerHTML = str;
}