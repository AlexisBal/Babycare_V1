<?php 
/**
* Vue : accueil
*/

include("navigation.php")
?>


    <div class="container-home">

        <div class="splide" data-splide='{"autoplay":true, "interval":5000, "type":"loop", "speed":3000, "pagination":false}' >
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <div class="home-slider-1">
                            <h2>Bienvenue sur le site de Baby Care</h2>
                            <h1 class="mt-20">Pour le bien-être de votre enfant</h1>
                            <div class="mt-50">
                                <a href="/utilisateur/inscription" id="button_accueil_1">Inscription</a>
                            </div>
                            <div class="mt-20">
                                <p>Déjà inscrit ? Vous pouvez <a href="/utilisateur/connexion" class="text-green2">vous connecter</a>.</p>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="center-content text-center">
                            <h1 class="mt-50">Données en temps réel <img style="height:40px;vertical-align: middle;margin-left:8px;" src="/assets/img/home/clock.png"></h1>
                            <div class="home-slider-2">
                                <div><img src="/assets/img/home/heart.png"></div>
                                <div><img src="/assets/img/home/analysis.png"></div>
                                <div><img src="/assets/img/home/playtime.png"></div>
                                <div><img src="/assets/img/home/shield.png"></div>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="home-slider-3">
                            <img src="/assets/img/home/data.jpg">
                            <div>
                                <h1 class="text-center">Affichage des données clair et concis</h1>
                                <h4 class="text-center mt-8">Sur PC, Mac, iPhone et Android</h4>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        
        <div class="text-center" id="images_accueil">
            <div>
                <img class="home-icon-zoomable" src="/assets/icons/happy.svg" alt="content">
                <div class="mt-8">Un produit innovant</div>
            </div>
            <div>
                <img class="home-icon-zoomable" src="/assets/icons/family-member_1.svg" alt="famille">
                <div class="mt-8">Intuitif et ludique</div>
            </div>
            <div>
                <img class="home-icon-zoomable" src="/assets/icons/healthcare_1.svg" alt="santé" >
                <div class="mt-8">Accessible sur tous vos appareils</div>
            </div>
        </div>
        <!-- Pourquoi Baby Care ? -->
        <div class="home-section-title">
            <hr>
            <p>Pourquoi Baby Care ?</p>
            <hr>
        </div>
        <div class="home-section-content">
            <h2 class="title-section">Une solution fiable</h2>
            <div class="home-section-div mt-50">
                <div>
                    <div class="home-text scroll-animate scroll-animate-from-left">
                        <p>En se basant sur les données recueillies par les différents capteurs, Baby Care fournit des conseils adaptés aux parents. Grâce aux nombreux paramètres pris en charge (comme la présence d’allergènes ou le niveau de pollution), les parents sont libérés d’un poids et les sorties avec leur enfant se font sans inquiétudes. Il est aussi possible de planifier ses activités en fonction des prévisions de la qualité de l’air. Baby Care ouvre un horizon de possibilités pour faciliter la vie des parents et profiter pleinement de chaque moment en famille. Ce produit dispose de nombreux atouts pour vous proposer un accompagnement personnalisé et complet :

                        </p>
                        <ul>
                            <li>Des capteurs performants</li>
                            <li>Un produit pensé pour durer</li>
                            <li>Des conseils précis</li>
                            <li>Des notifications paramétrables</li>
                        </ul>
                    </div>
                   
                </div>
                <div>
                    <img class="home-image scroll-animate scroll-animate-from-right" src="/assets/img/logo.png">
                </div>
            </div>
        </div>

        <!-- Qui sommes-nous ? -->
        <div class="home-section-title">
            <hr>
            <p>Qui sommes-nous ?</p>
            <hr>
        </div>
        <div class="home-section-content">
            <h2 class="title-section">Infinite Measure</h2>
            <div class="home-section-div home-section-div-reverse mt-50">
                <div>
                    <img class="home-image scroll-animate scroll-animate-from-left" src="/assets/img/infinite.gif">
                </div>
                <div>
                    <div class="home-text scroll-animate scroll-animate-from-right">
                        <p><?php echo $texte_accueil["texte"]; ?></p>
                    </div>
                </div>
            </div>
            <div class="home-container-team" id="container-team">
            <?php
                foreach ($equipe as $membre) {
                    ?>
                    <div class="item-team">
                        <img src="/assets/icons/user-circular.svg" width="50px">
                        <h4 class="home-name-team"><?php echo $membre['role']; ?></h4>
                        <p><?php echo $membre['nom'] . ' ' . $membre['prenom']; ?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>    

    <script src="/assets/js/splide.min.js"></script>

    <script>      
        var splide = new Splide( '.splide' );
        splide.mount();      
    </script>

    <script>
        
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        var element = document.querySelector('.container-website');
        var available = true;
        element.onscroll = async function(event) {
            var containerTeam = document.querySelector('#container-team');
            var position = containerTeam.getBoundingClientRect();

            // checking whether fully visible
            if(position.top >= 0 && position.bottom <= window.innerHeight) {
                // console.log('Element is fully visible in screen');
            }

            // checking for partial visibility
            if(position.top < window.innerHeight && position.bottom >= 0 && available) {
                available = false;
                // console.log('Element is partially visible in screen');
                var els = document.getElementsByClassName("item-team");
                for(var i = 0; i < els.length; i++)
                {
                    els[i].classList.add("home-team-animate");
                    await sleep(50);
                }
            }

            var animatedElements = document.getElementsByClassName('scroll-animate');

            for(var i = 0; i < animatedElements.length; i++)
            {
                var position = animatedElements[i].getBoundingClientRect();
                // checking for partial visibility
                if(position.top < window.innerHeight && position.bottom >= 0) {
                    animatedElements[i].classList.add("scroll-animate-active");
                }
                
            }
        };
    </script>
</body>