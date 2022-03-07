    <?php 
    /**
    * Vue : pied de page
    */
    ?>
    <div style="flex-grow: 1;"></div>
    <footer class="footer-user">
        <p>© 2021 - Healthcare Technology</p>
    </footer>
    </div>
    <script src="/assets/js/modal.js"></script>
    <script src="/assets/js/register.js"></script>
    <script src="/assets/js/menu-home.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      crossorigin="anonymous">
    </script>
    <?php 
    if(isset($_GET['fonction'])) {  
      if($_GET['fonction']=="connexion" || $_GET['fonction']=="inscription" || $_GET['fonction']=="contact" || $_GET['fonction']=="forgotpassword"){
      ?>
      <script src="https://www.google.com/recaptcha/api.js?render=6Lf4Nm4dAAAAAN-tJcSM5WOXk_jo2XbW_0QLJD6h"></script>
      <?php
      }
    }
    ?>
    <script>
    $('#connexionForm').submit(function(event) {
        event.preventDefault();
        var email = $('#email').val();
		var password = $('#password').val();
		var rememberMe = $('#rememberMe').val();
  
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lf4Nm4dAAAAAN-tJcSM5WOXk_jo2XbW_0QLJD6h', {action: 'connexion'}).then(function(token) {
                $('#connexionForm').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('#connexionForm').prepend('<input type="hidden" name="action" value="connexion">');
                $('#connexionForm').unbind('submit').submit();
            });;
        });
    });
  </script>
  <script>
    $('#forgotPasswordForm').submit(function(event) {
        event.preventDefault();
        var email = $('#email').val();
  
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lf4Nm4dAAAAAN-tJcSM5WOXk_jo2XbW_0QLJD6h', {action: 'forgotpassword'}).then(function(token) {
                $('#forgotPasswordForm').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('#forgotPasswordForm').prepend('<input type="hidden" name="action" value="forgotpassword">');
                $('#forgotPasswordForm').unbind('submit').submit();
            });;
        });
  });
  </script>
  <script>
    $('#inscriptionForm').submit(function(event) {
        event.preventDefault();
		var prenom = $('#prenom').val();
		var nom = $('#nom').val();
		var cp = $('#cp').val();
        var email = $('#email').val();
		var password = $('#password').val();
		var passwordConfirm = $('#passwordConfirm').val();
		var idActivation = $('#idActivation').val();
  
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lf4Nm4dAAAAAN-tJcSM5WOXk_jo2XbW_0QLJD6h', {action: 'inscription'}).then(function(token) {
                $('#inscriptionForm').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('#inscriptionForm').prepend('<input type="hidden" name="action" value="inscription">');
                $('#inscriptionForm').unbind('submit').submit();
            });;
        });
  });
  </script>
  <script>
    $('#contactForm').submit(function(event) {
        event.preventDefault();
        var prenom = $('#prenom').val();
        var nom = $('#nom').val();
        var email = $('#email').val();
        var message = $('#message').val();
        var objet = $('#objet').val();
  
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lf4Nm4dAAAAAN-tJcSM5WOXk_jo2XbW_0QLJD6h', {action: 'contact'}).then(function(token) {
                $('#contactForm').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('#contactForm').prepend('<input type="hidden" name="action" value="contact">');
                $('#contactForm').unbind('submit').submit();
            });;
        });
  });
  </script>


</body>
</html>