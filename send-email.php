<?php
// -------------------------------------------
//  CONFIGURATION ET SECURITÉ DE BASE
// -------------------------------------------

// Activer le reporting des erreurs (utile pour debug, désactiver en prod)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Définir le type de réponse (JSON)
header('Content-Type: application/json');

// Vérifier la méthode HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

// -------------------------------------------
//  CHARGEMENT DE PHPMailer
// -------------------------------------------
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// -------------------------------------------
//  VALIDATION DU FORMULAIRE
// -------------------------------------------
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Tous les champs sont obligatoires.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Adresse e-mail invalide.']);
    exit;
}

// -------------------------------------------
//  CONFIGURATION ET ENVOI DE L'E-MAIL
// -------------------------------------------
try {
    $mail = new PHPMailer(true);

    // ⚠️ InfinityFree bloque parfois le port 587 (Gmail)
    // Si ton hébergement ne permet pas Gmail SMTP, passe à Brevo ou Mailtrap.
    // Pour Gmail : assure-toi que ton mot de passe d’application est correct.
    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'irvictoramos@gmail.com'; // Ton email Gmail
    $mail->Password = 'ncvdfhrcpkjdmwca'; // Mot de passe d’application (sans espaces)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Expéditeur et destinataire
    $mail->setFrom('irvictoramos@gmail.com', 'Portfolio Contact Form');
    $mail->addAddress('irvictoramos@gmail.com', 'Victor Amos');
    $mail->addReplyTo($email, $name);

    // Contenu HTML
    $mail->isHTML(true);
    $mail->Subject = "Nouveau message : " . htmlspecialchars($subject, ENT_QUOTES);

    $htmlBody = <<<HTML
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; }
            .container { max-width: 600px; margin: 20px auto; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            .header { background: #00B4D8; color: #fff; text-align: center; padding: 20px; }
            .content { padding: 20px; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #00B4D8; }
            .value { padding: 10px; background: #f0f0f0; border-left: 3px solid #00B4D8; border-radius: 5px; }
            .footer { font-size: 12px; color: #777; text-align: center; padding: 10px; border-top: 1px solid #eee; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header"><h2>📩 Nouveau message du formulaire</h2></div>
            <div class="content">
                <div class="field"><div class="label">Nom :</div><div class="value">{$name}</div></div>
                <div class="field"><div class="label">Email :</div><div class="value"><a href="mailto:{$email}">{$email}</a></div></div>
                <div class="field"><div class="label">Objet :</div><div class="value">{$subject}</div></div>
                <div class="field"><div class="label">Message :</div><div class="value">{$message}</div></div>
            </div>
            <div class="footer">
                Cet email a été envoyé depuis le formulaire de contact de ton portfolio.<br>
                Répondre directement à : {$email}
            </div>
        </div>
    </body>
    </html>
    HTML;

    $mail->Body = $htmlBody;
    $mail->AltBody = "Nom: $name\nEmail: $email\nSujet: $subject\nMessage:\n$message";

    // Envoi
    if ($mail->send()) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => '✅ Message envoyé avec succès.']);
    } else {
        throw new Exception('Erreur lors de l’envoi de l’email.');
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => '❌ Erreur : ' . $e->getMessage()
    ]);
}
?>
