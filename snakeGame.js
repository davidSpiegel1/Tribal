// Starting with our main function
var i = 0;
var j = 0;
function main(){
   
    playGame();

}

function playGame(){
   
   let arr = constructBoard();
   
   var name = document.getElementById("name").value;
   // Use to make snake bigger!!
   arr[i][j] = "*";
   i = moveSnakeI(name.substring(name.length-1,name.length),i);
   j = moveSnakeJ(name.substring(name.length-1,name.length),j);
   arr[i][j] = "*";
   displayBoard(arr);
   //name = "";
  
   //document.getElementById("game").innerHTML = name;
}

// Making a function that will move the character
function moveSnakeI(inPut,i){

    let newI = i;
        if (inPut == "w"){
                newI = i-1;
             
            }
        else if (inPut == "s"){
                newI = i+1;
            }
        if (isCorrect(newI)){
            return newI; 
        }else{
            return i;
        }
}

// Making a function that will move the character j
function moveSnakeJ(inPut,j){
    let newJ = j;
            
    if (inPut == "d"){
        newJ = j+1
    }
    else if (inPut == "a"){
        newJ = j-1
    }
    if (isCorrect(newJ)){
        return newJ; 
    }else{
        return j;
    }
}
function isCorrect(newI){
    let isTrue = false;
    if (newI >= 0 && newI <= 5){
        isTrue = true;
    }
    return isTrue;
}

// Displaying the board
function displayBoard(arr){

    let f = 1;
    for (let p = 0; p<= 5; p++){
       for (let k = 0; k<=5;k++){

        let string = arr[p][k]+" ";
        document.getElementById("game"+(f)).innerHTML = string;
        f++;
     
       }
      // string = string+" \n";
      //document.getElementById("game"+(p+1)).innerHTML = string;
      
      //string = "";
    } 
   // document.getElementById("game").innerHTML = string;
}


// Constructing the board
function constructBoard(){
    let arr = [];
    for (let i = 0; i<= 5;i++){
        let arr2 = [];
        for (let j = 0; j<= 5;j++){
            arr2.push(".");
        }
        arr.push(arr2);
    }
    return arr;
}

main();