<?php
class Hotel {
    // Attributs pour stocker les informations de l'hôtel
    private string $_nomHotel;           
    // Nom de l'hôtel
    private string $_adresseHotel;       
    // Adresse de l'hôtel
    private string $_villeHotel;         
    // Ville de l'hôtel
    private string $_codePostalHotel;    
    // Code postal de l'hôtel
    private int $_nombreChambres = 23;   
    // Nombre total de chambres dans l'hôtel
    private array $_chambres = [];       
    // Liste des chambres de l'hôtel

    // Constructeur pour initialiser les informations de l'hôtel
    public function __construct(string $nomHotel, string $adresseHotel, string $codePostalHotel, string $villeHotel) {
        $this->_nomHotel = $nomHotel;                
        // Définit le nom de l'hôtel
        $this->_adresseHotel = $adresseHotel;        
        // Définit l'adresse de l'hôtel
        $this->_codePostalHotel = $codePostalHotel;  
        // Définit le code postal de l'hôtel
        $this->_villeHotel = $villeHotel;            
        // Définit la ville de l'hôtel
    }

    // Méthode pour ajouter une chambre à la liste des chambres de l'hôtel
    public function ajouterChambre(Chambre $chambre): void {
        $this->_chambres[] = $chambre;    
        // Ajoute la chambre à l'array des chambres
        $this->_nombreChambres++;         
        // Incrémente le compteur de chambres
    }

    // Méthode privée pour calculer le nombre de chambres réservées
    private function nombreChambresReservees(): int {
        $reservations = 0;                  
        // Compteur pour les chambres réservées
        foreach ($this->_chambres as $chambre) {
            if ($chambre->estReservee()) {  
                // Vérifie si la chambre est réservée
                $reservations++;
            }
        }
        return $reservations;               
        // Retourne le nombre total de chambres réservées
    }

    // Méthode pour afficher les informations générales de l'hôtel
    public function afficherInfosHotel(): void {
        echo "<h2>{$this->_nomHotel} **** {$this->_villeHotel}</h2>";  
        // Affiche le nom et la ville de l'hôtel
        echo "{$this->_adresseHotel} {$this->_codePostalHotel} {$this->_villeHotel}<br>";  
        // Affiche l'adresse
        echo "Nombre de chambres : {$this->_nombreChambres}<br>";     
        // Affiche le nombre total de chambres
        echo "Nombre de chambres réservées : " . $this->nombreChambresReservees() . "<br>"; 
        // Affiche le nombre de chambres réservées
        echo "Nombre de chambres dispo : " . ($this->_nombreChambres - $this->nombreChambresReservees()) . "<br><br>";  
        // Affiche les chambres disponibles
    }

    // Méthode pour afficher toutes les réservations de l'hôtel
    public function afficherReservations(): void {
        $reservations = [];                  
        // Initialise un tableau pour stocker les réservations
        foreach ($this->_chambres as $chambre) {
            $reservations = array_merge($reservations, $chambre->getReservations());  
            // Récupère les réservations de chaque chambre
        }
        echo "<h3>Réservations de l'hôtel {$this->_nomHotel} **** {$this->_villeHotel}</h3>"; 
         // Affiche le titre des réservations
        if (empty($reservations)) {          
            // Vérifie s'il n'y a pas de réservations
            echo "Aucune réservation !<br>"; 
            // Message si aucune réservation n'est trouvée
        } else {
            echo "<span style='background-color: green; color: white; padding: 2px 5px; border-radius: 3px;'>" . count($reservations) . " RÉSERVATIONS</span><br>";
            foreach ($reservations as $reservation) {
                echo $reservation . "<br>";  
                // Affiche chaque réservation (grâce à la méthode __toString de la classe Reservation)
            }
        }
        echo "<br>";
    }

    // Getter pour obtenir le nom de l'hôtel
    public function getNomHotel(): string {
        return $this->_nomHotel;
    }

    // Getter pour obtenir la ville de l'hôtel
    public function getVilleHotel(): string {
        return $this->_villeHotel;
    }

    // Méthode pour afficher le statut de chaque chambre de l'hôtel
    public function afficherStatutChambres(): void {
        echo "<h3>Statuts des chambres de <strong>{$this->_nomHotel} **** {$this->_villeHotel}</strong></h3>";
        echo "<table style='width: 100%; border-collapse: collapse;'>";  
        // Crée un tableau pour afficher le statut des chambres
        echo "<tr style='text-align: left;'>
                <th style='padding: 8px;'>CHAMBRE</th>
                <th style='padding: 8px;'>PRIX</th>
                <th style='padding: 8px;'>WIFI</th>
                <th style='padding: 8px;'>ETAT</th>
              </tr>";
        foreach ($this->_chambres as $chambre) {
            $etat = $chambre->estReservee() ? "RÉSERVÉE" : "DISPONIBLE";  
            // Détermine si la chambre est réservée ou disponible
            $couleurEtat = $chambre->estReservee() ? "red" : "green";      
            // Définit la couleur du statut
            $wifi = $chambre->getWifi() ? "<span style='color: gray;'>&#128246;</span>" : "";  
            // Affiche l'icône du WiFi si disponible
            echo "<tr style='border-top: 1px solid #ddd;'>
                    <td style='padding: 8px;'>Chambre {$chambre->getNumeroChambre()}</td>
                    <td style='padding: 8px;'>{$chambre->getPrix()} €</td>
                    <td style='padding: 8px; text-align: center;'>$wifi</td>
                    <td style='padding: 8px;'>
                        <span style='background-color: $couleurEtat; color: white; padding: 5px 10px; border-radius: 3px;'>$etat</span>
                    </td>
                  </tr>";
        }
        echo "</table>";
    }

    // Méthode pour réserver une chambre spécifique pour un client à des dates précises
    public function reserverChambre(string $numeroChambre, Client $client, string $dateArrivee, string $dateSortie): void {
        foreach ($this->_chambres as $chambre) {
            if ($chambre->getNumeroChambre() === $numeroChambre) {      
                // Cherche la chambre avec le numéro donné
                if ($chambre->getStatut() === 'disponible') {           
                    // Vérifie si la chambre est disponible
                    $reservation = new Reservation($client, $chambre, $dateArrivee, $dateSortie); 
                    // Crée une nouvelle réservation
                    $chambre->ajouterReservation($reservation);         
                    // Ajoute la réservation à la chambre
                    $chambre->setStatut('reservee');                    
                    // Change le statut de la chambre en "réservée"
                } else {
                    echo "La chambre {$numeroChambre} est déjà réservée.<br>";  
                    // Message si la chambre est déjà réservée
                }
                break;  // Quitte la boucle dès que la chambre est trouvée
            }
        }
    }
}
?>