//const { read } = require("fs");
//const { resolve } = require("path");
//const { EventEmitter } = require("stream");

// Our main function
function main(){
    // Displaying the hello
    displayHello();
    // Starting the game
    startGame();

    
}

// Displaying the hello
function displayHello(){
    console.log("Hello! Welcome to snake game!");
}

// Starting the game
function startGame(){
    // Constucting the board
    let arr = constructBoard();
    let i = 0;
    let j = 0;
   
    
    //    var userInput = prompt("Please enter w,a,s,d","w");
    // Gonna try to get user input for console!
   
    const readline = require("readline");
    // Basically an interface for console!
   const rl = readline.createInterface({
        input: process.stdin,
       output: process.stdout,
    });
    // Make a working terminal version first!!!
    
    
    rl.question("Write!",function(answer){    
         rl.close();
         process.stdin.destroy();
        }); 
    

    var stdin = process.openStdin();
    stdin.addListener("data",function(d){
        console.log("You entered :");
        let an = d.toString().trim();
         i = changeArrI(an,i);
         j = changeArrJ(an,j); 
         
         arr[i][j] = "*";
        displayBoardLog(arr);
    });
}




/*let question = function(title){
    return new Promise(function(resolve,reject){
        read.question(title,function(answer){
            resolve(answer);
        })*/
    


 


function changeArrI(inPut,i){
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
function isCorrect(newI){
    let isTrue = false;
    if (newI >= 0 && newI <= 5){
        isTrue = true;
    }
    return isTrue;
}

function changeArrJ(inPut,j){
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
// Displaying the board
function displayBoardLog(arr){
    for (let p = 0; p<= 5; p++){
        console.log(...arr[p]);
    } 
}
// Displaying the board
function displayBoard(arr){
    for (let p = 0; p<= 5; p++){
        document.writeln(...arr[p]);
    } 
}

main();
            

                