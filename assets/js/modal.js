function openModal(name){

    //Add shadow
    const shadow = `<div class="modal-shadow" modal="${name}" onclick="closeModal('${name}')"></div>`;
    document.querySelector(".modal[modal='" + name + "']").innerHTML += shadow;
    document.querySelector("body").style.overflow = "hidden"
    //display modal
    document.querySelector(".modal[modal='" + name + "']").style.display = "flex"
    document.querySelector(".modal[modal='" + name + "'] .modal-content").classList.remove("animation-hide");
    document.querySelector(".modal[modal='" + name + "'] .modal-content").classList.add("animation-show");
}

function closeModal(name){
    
     //remove shadow
     document.querySelector(".modal-shadow[modal='" + name + "']").remove();
     
    //hide modal
    document.querySelector(".modal[modal='" + name + "'] .modal-content").addEventListener("webkitAnimationEnd", (e)=>{
        document.querySelector(".modal[modal='" + name + "']").style.display = "none"
        document.querySelector("body").style.overflow = "auto";
       
    });

    document.querySelector(".modal[modal='" + name + "'] .modal-content").classList.remove("animation-show");
    document.querySelector(".modal[modal='" + name + "'] .modal-content").classList.add("animation-hide"); 
}

// window.addEventListener("DOMContentLoaded", (event) => {
//     document.querySelector(".modal-content").classList.add("animation-hide");
// });
