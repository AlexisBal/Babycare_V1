<?php 
    /**
    * Vue : pied de page
    */
    ?>

    <footer>
        
    </footer>
    <script src="/assets/js/modal.js"></script>
    <script src="/assets/js/user.js"></script>
    <script>
        async function loadModalEditCapteur(idCapteur){
            await fetch("/admin/capteur-edit-modal?idCapteur=" + idCapteur).then(function(response) {
                var contentType = response.headers.get("content-type");
                if(contentType && contentType.indexOf("application/json") !== -1) {
                    return response.json().then(function(json) {
                        document.querySelector("#idEdit").setAttribute('value', json["idCapteur"]); 
                        document.querySelector("#sensibiliteEdit").setAttribute('value', json["sensibilite"]);
                    });
                } 
            });
        }
        
        function openModalEditDialog(idCapteur){
            openModal("modEditCapteur");
            loadModalEditCapteur(idCapteur);
        }
    </script>
</body>
</html>