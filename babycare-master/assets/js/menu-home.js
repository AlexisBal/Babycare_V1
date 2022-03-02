var lastWindowsWidth = 0;

function showMenu(){

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
    if(!document.querySelector(".header-link-container")) return;
    
    if(show){
        document.querySelector(".header-link-container").style["animation-name"] = "MenuAnimationIn";
    } else {
        document.querySelector(".header-link-container").style["animation-name"] = "MenuAnimationOut";
    }
}

function isMenuVisible(){
    return document.querySelector(".header-link-container").style["animation-name"] == "MenuAnimationIn";
}

window.addEventListener('resize', reportWindowSize);
function reportWindowSize(){
    if(!document.querySelector(".header-link-container")) return;

    if(document.querySelector(".header-link-container").style["animation-name"] == "") return;
    lastWindowsWidth = window.innerWidth;
    if(isMenuVisible()) toggleMenu(false);
}

window.addEventListener("load", function(event) {
    lastWindowsWidth = window.innerWidth;
});
