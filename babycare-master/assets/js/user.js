var isMenuFixed = false;
var lastWindowsWidth = 0;

function showMenu(){
    isMenuFixed = true;

    if(isMenuVisible()){
        toggleMenu(false);
    } else {
        toggleMenu(true);
    }
}

function displayMenu(){
    if(window.innerWidth < 640){
        toggleMenu(false);
    } else {
        toggleMenu(true);
    }
}

function toggleMenu(show){
    if(show){
        document.querySelector(".user-leftbar").style["animation-name"] = "MenuAnimationIn";
    } else {
        document.querySelector(".user-leftbar").style["animation-name"] = "MenuAnimationOut";
    }
}

function isMenuVisible(){
    return document.querySelector(".user-leftbar").style["animation-name"] == "MenuAnimationIn";
}

window.addEventListener('resize', reportWindowSize);
function reportWindowSize(){
    if(document.querySelector(".user-leftbar").style["animation-name"] == "") return;
    if(window.innerWidth > 640 && lastWindowsWidth < 640 || window.innerWidth < 640 && lastWindowsWidth > 640){ isMenuFixed = false; }
    lastWindowsWidth = window.innerWidth;
    displayMenu();
}

window.addEventListener('click', function(e){   
    if (!document.querySelector(".user-leftbar").contains(e.target) && isMenuVisible() && !document.querySelector("#buttonMenu").contains(e.target) && window.innerWidth < 640){
        toggleMenu(false);
    }
});

window.addEventListener("load", function(event) {
    lastWindowsWidth = window.innerWidth;
});