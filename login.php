<?php
session_start();
$host = 'localhost';
$utilisateur_db = 'root';
$mot_de_passe_db = '';
$nom_db = 'utilisateurs';

// Connexion à la base de données
$mysqli = new mysqli($host, $utilisateur_db, $mot_de_passe_db, $nom_db);

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Échec de la connexion à la base de données : " . $mysqli->connect_error);
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Préparation de la requête SQL pour récupérer l'utilisateur en fonction de l'e-mail et du mot de passe
    $sql = "SELECT id FROM utilisateurs WHERE email = ? AND mot_de_passe = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $email, $mot_de_passe);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérification si une ligne correspondante est trouvée
    if ($result->num_rows == 1) {
        // L'utilisateur est authentifié avec succès
        
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];

        // Vérification des connexions via Redis
        $user_id = $_SESSION['user_id'];
        $cmd = "C:\\Users\\hp\\anaconda3\\Lib\\python.exe" ."". "C:\Users\hp\OneDrive\Documents\S8\INFO 834\TP 1 REDIS\TP1-REDIS\code pyhton.py"." " .$user_id;
        
        $command=escapeshellcmd($cmd);

        $output = shell_exec($command);
        // Affiche la sortie du script Python
        if(strpos($output, "L'utilisateur est connecté.") !== false){
            header('location: services.php');
        } else {
            if (strpos($output ,"L'utilisateur a déjà atteint le nombre maximal de connexions dans la fenêtre de 10 minutes.") !== false) {
                echo "<p>Vous avez atteint la limite de connexions. Veuillez réessayer plus tard.</p>";
            } else {
                echo "<pre>$output</pre>";
            }
        }
        
    } else {
        // L'utilisateur n'est pas authentifié
        echo "Adresse e-mail ou mot de passe incorrect.";
    }
}
?>
   

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required><br><br>
    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>
    <input type="submit" value="Se connecter">
</form>
