<?php 
/**
* Vue : Contact
*/
include("navigation.php")
?>


<h1 class="title-section ml-16">Contact</h1>

<div class="divContact">
  <p class="mb-16">Vous pouvez nous contacter en remplissant ce formulaire. Nous ferons tout notre possible pour vous répondre au plus vite.</p>
  <form action="" id="contactForm" method="POST">
    <label for="prenom"></label>
    <input type="text" id="prenom" name="prenom" class="input-text" placeholder="Votre prénom.." required onkeypress="javascript:verifEmail();" onchange="javascript:verifEmail();>
    <span id="prenomErr" class="error"></span><br/>

    <label for="nom"></label>
    <input type="text" id="nom" name="nom" class="input-text" placeholder="Votre nom de famille.." required>
    <span id="nomErr" class="error"></span><br/>

    <label for="email"></label>
    <input type="text" id="email" name="email" class="input-text" placeholder="Votre adresse email.." required>
    <span id="emailErr" class="error"></span><br/>

    <label for="objet"></label>
    <input type="text" id="objet" name="objet" class="input-text" placeholder="Entrer l'objet de votre message.." required>
    <span id="objetErr" class="error"></span><br/>

    <label for="message"></label>
    <textarea id="message" name="message" class="input-text" placeholder="Entrez votre message ici.." required></textarea>
    <span id="messageErr" class="error"></span><br/>
  
    <input type="submit" value="Envoyer" class="button_confirm mt-20">
  </form>
</div>



  