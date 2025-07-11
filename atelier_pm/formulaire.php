<?php
// Remplacez l'adresse mail
$destinataire = "ton-adresse@email.com"; 

// Vérification que le formulaire est bien soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nom = htmlspecialchars($_POST['nom']);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $evenement = htmlspecialchars($_POST['evenement']);
  $invites = intval($_POST['invites']);
  $date = htmlspecialchars($_POST['date']);
  $message = htmlspecialchars($_POST['message']);

  if ($email && $nom && $message) {
    $sujet = "Demande de devis – L’atelier PM";
    $contenu = "Nom : $nom\n";
    $contenu .= "Email : $email\n";
    $contenu .= "Événement : $evenement\n";
    $contenu .= "Nombre d'invités : $invites\n";
    $contenu .= "Date : $date\n\n";
    $contenu .= "Message :\n$message\n";

    $headers = "From: $nom <$email>";

    if (mail($destinataire, $sujet, $contenu, $headers)) {
  	header("Location: merci.html");
  	exit;
	} else {
  	echo "<h2>Erreur : l'envoi a échoué. Veuillez réessayer.</h2>";
	}
  } else {
    echo "<h2>Veuillez remplir correctement tous les champs requis.</h2>";
  }
} else {
  echo "<h2>Accès non autorisé.</h2>";
}
?>
