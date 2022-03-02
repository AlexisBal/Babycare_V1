<?php 
    /**
    * Vue : pied de page
    */
    ?>

        </div>    
    </div>
</div>
            
<script src="/assets/js/modal.js"></script>
<script src="/assets/js/user.js"></script>
<script>
    async function getValues(){
        var dataElement = document.getElementsByClassName('data-capteur');
        for(var i = 0; i < dataElement.length; i++)
        {
            
            var capteurID = dataElement[i].getAttribute("capteur-id")
            var capteurNom = dataElement[i].getAttribute("capteur-nom")

            await fetch("/compte/data-capteur?capteur-id=" + capteurID + "&capteur-nom=" + capteurNom).then(function(response) {
                var contentType = response.headers.get("content-type");
                if(contentType && contentType.indexOf("application/json") !== -1) {
                    return response.json().then(function(json) {
                        var capteurType = json["capteur"][0]["type"]
                        var unit = "";
                        var value = json["valeurs"][json["valeurs"].length-1]["valeur"];
                        var percent = value;
                        var maxPercent = 100;

                        switch(capteurType){
                            case "son":
                                unit = "dB"
                                maxPercent = 140;
                                break;
                            case "temp":                               
                                unit = "°C"
                                maxPercent = 70;
                                break;
                            case "fc-cardiaque":
                                unit = "BPM"
                                maxPercent = 200;
                                break;
                            case "co2":
                                unit = "PPM";
                                maxPercent = 1000;
                                break;
                        }

                        percent = value/maxPercent*100;

                        if(percent > 100) percent = 100;
                        if(percent < 0) percent = 0;
                       
                        var dataValueElement = document.querySelector(".data-capteur[capteur-id='" + capteurID + "'][capteur-nom='" + capteurNom + "'] .data-value");
                        dataValueElement.innerHTML = value + " " + unit
                        document.querySelector(".data-capteur[capteur-id='" + capteurID + "'][capteur-nom='" + capteurNom + "'] .progress-value").style.width = percent + "%"                       
                    });
                } 
            });
            
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        getValues();
    }, false);

    setInterval((function() {
        getValues()
    }), 10000);

    async function loadModalData(type){
        await fetch("/compte/modal-content?type=" + type).then(function(response) {
            var contentType = response.headers.get("content-type");
            if(contentType && contentType.indexOf("application/json") !== -1) {
                return response.json().then(function(json) {
                    document.querySelector("#modal-title").innerHTML = json["title"];
                    document.querySelector("#modal-content").innerHTML = json["content"];
                });
            } 
        });
    }
    
    function openModalDialog(type){
        openModal("modal-info");
        loadModalData(type);
    }
    
</script>

</body>
</html>