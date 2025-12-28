<?php
  session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Création de compte</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="container">
      <h1>Création de compte</h1>

      <div class="success-message" id="successMessage">
        Compte créé avec succès !
      </div>

      <form id="accountForm" action="inscription.php" method="POST">
        <div class="form-group">
          <label for="prenom">Prénom *</label>
          <input type="text" id="prenom" name="prenom" value ="<?= $_SESSION['old']['prenom'] ?? '' ?>" required />
          <div class="error-message" id="prenomError">
            Veuillez entrer votre prénom
          </div>
        </div>

        <div class="form-group">
          <label for="nom">Nom *</label>
          <input type="text" id="nom" name="nom" value ="<?= $_SESSION['old']['nom'] ?? '' ?>" required />
          <div class="error-message" id="nomError">
            Veuillez entrer votre nom
          </div>
        </div>

        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" id="email" name="email" value ="<?= $_SESSION['old']['email'] ?? '' ?>" required />
          <div class="error-message" id="emailError">
            Veuillez entrer une adresse email valide
          </div>
          <?php if (isset($_SESSION['error']['email'])): ?>
            <p style="color:red;">
              <?= $_SESSION['error']['email'] ?>
            </p>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="classe">Classe *</label>
          <select id="classe" name="classe"  required>
            <option value="">Sélectionnez une classe</option>
            <option value="dut1">DUT1</option>
            <option value="dut2">DUT2</option>
            
          </select>
          <div class="error-message" id="classeError">
            Veuillez sélectionner une classe
          </div>
        </div>

        <div class="form-group">
          <label for="motdepasse">Mot de passe *</label>
          <input type="password" id="motdepasse" name="mot_de_passe" value ="<?= $_SESSION['old']['mot_de_passe'] ?? '' ?>" required />
          <div class="error-message" id="motdepasseError">
            Le mot de passe doit contenir au moins 6 caractères
          </div>
        </div>

        <div class="form-group">
          <label for="confirmation">Confirmation du mot de passe *</label>
          <input
            type="password"
            id="confirmation"
            name="confirmer_mdp"
            value ="<?= $_SESSION['old']['confirmer_mdp'] ?? '' ?>"
            required
          />
          <div class="error-message" id="confirmationError">
            Les mots de passe ne correspondent pas
          </div>
        </div>

        <button type="submit" class="btn-submit">Enregistrer</button>
      
        </form>

      <div class="links-row">
          <div class="forget">
              <a href="#">Mot de passe oublié ?</a>
          </div>

          <div class="btn_inscription">
              <a href="../connexion/connexion.html">Se connecter</a>
          </div>
      </div>
        
    </div>

    <script src="script.js"></script>

    
    <?php
    // Nettoyage (message affiché une seule fois)
    unset($_SESSION['error']);
    unset($_SESSION['old']);
    ?>
  </body>
</html>
