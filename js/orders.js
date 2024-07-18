// Orders Navigation Bar Function 

var x1 = document.getElementById("pendingDiv");
var x2 = document.getElementById("shipDiv");
var x3= document.getElementById("receiveDiv");
var x4 = document.getElementById("completedDiv");

function viewPending() {
    x1.style.display = "block"; // Show
    x2.style.display = "none"; // Hide
    x3.style.display = "none"; // Hide
    x4.style.display = "none"; // Hide  
}

function viewShip() {
    x1.style.display = "none"; // Hide
    x2.style.display = "block"; // Show
    x3.style.display = "none"; // Hide
    x4.style.display = "none"; // Hide
}

function viewReceive() {
    x1.style.display = "none"; // Hide
    x2.style.display = "none"; // Hide
    x3.style.display = "block"; // Show
    x4.style.display = "none"; // Hide
}

function viewCompleted() {
    x1.style.display = "none"; // Hide
    x2.style.display = "none"; // Hide
    x3.style.display = "none"; // Hide
    x4.style.display = "block"; // Show
}