<?php
class Hotel {
    private string $_nomHotel; 
    // Nom de l'hôtel
    private string $_adresseHotel; 
    // Adresse de l'hôtel
    private string $_villeHotel; 
    // Ville où l'hôtel est situé
    private string $_codePostalHotel; 
    // Code postal de l'hôtel
    private int $_nombreChambres = 27; 
    // Le nombre total de chambres dans l'hôtel

    private array $_chambres = []; 
    // Tableau qui contient toutes les chambres de l'hôtel, initialisé comme un tableau vide

    // Constructeur pour initialiser les informations de l'hôtel
    public function __construct(string $nomHotel, string $adresseHotel, string $codePostalHotel, string $villeHotel) {
        // Ce constructeur permet d'initialiser les propriétés de l'hôtel lors de sa création.
        $this->_nomHotel = $nomHotel;
         // On affecte la valeur du nom de l'hôtel 
        $this->_adresseHotel = $adresseHotel; 
        // On affecte l'adresse de l'hôtel 
        $this->_codePostalHotel = $codePostalHotel; 
        // On affecte le code postal de l'hôtel 
        $this->_villeHotel = $villeHotel; 
        // On affecte la ville de l'hôtel 
    }

    // Ajoute une chambre au tableau des chambres de l'hôtel
    public function ajouterChambre(Chambre $chambre): void {
        $this->_chambres[] = $chambre; 
        // Ajoute la chambre à la liste des chambres de l'hôtel
        $this->_nombreChambres++; 
        // Incrémente le nombre total de chambres
    }

    // Compte le nombre de chambres réservées
    private function nombreChambresReservees(): int {
        $reservations = 0; 
        // Initialise un compteur pour les chambres réservées
        foreach ($this->_chambres as $chambre) { 
            // Parcourt chaque chambre de l'hôtel
            if ($chambre->estReservee()) { 
                // Si la chambre est réservée, on l'ajoute au compteur
                $reservations++;
            }
        }
        return $reservations; 
        // Retourne le nombre total de chambres réservées
    }

    // Affiche les informations de l'hôtel : nom, adresse, nombre de chambres
    public function afficherInfosHotel(): void {
        echo "<h2>{$this->_nomHotel} **** {$this->_villeHotel}</h2>"; 
        // Affiche le nom de l'hôtel et sa ville en titre
        echo "{$this->_adresseHotel} {$this->_codePostalHotel} {$this->_villeHotel}<br>"; 
        // Affiche l'adresse complète de l'hôtel
        echo "Nombre de chambres : {$this->_nombreChambres}<br>"; 
        // Affiche le nombre total de chambres
        echo "Nombre de chambres réservées : " . $this->nombreChambresReservees() . "<br>"; 
        // Affiche le nombre de chambres réservées en appelant la méthode nombreChambresReservees()
        echo "Nombre de chambres dispo : " . ($this->_nombreChambres - $this->nombreChambresReservees()) . "<br><br>"; 
        // Affiche le nombre de chambres disponibles (total - réservées)
    }

    // Affiche les réservations de l'hôtel
    public function afficherReservations(): void {
        $reservations = []; 
        // Initialise un tableau vide pour stocker les réservations

        // Fusionne toutes les réservations de chaque chambre
        foreach ($this->_chambres as $chambre) { 
            // Parcourt chaque chambre de l'hôtel
            $reservations = array_merge($reservations, $chambre->getReservations()); 
            // Ajoute les réservations de chaque chambre au tableau des réservations
        }

        // Affiche un titre avec le nom et la ville de l'hôtel
        echo "<h3>Réservations de l'hôtel {$this->_nomHotel} **** {$this->_villeHotel}</h3>";

        // Vérifie s'il y a des réservations et affiche le résultat
        if (empty($reservations)) { 
            // Si le tableau des réservations est vide, il n'y a pas de réservations
            echo "Aucune réservation !<br>"; 
            // Affiche "Aucune réservation !"
        } else {
            // Affiche le nombre de réservations en encadré vert
            echo "<span style='background-color: green; color: white; padding: 2px 5px; border-radius: 3px;'>" . count($reservations) . " RÉSERVATIONS</span><br>";

            // Affiche chaque réservation
            foreach ($reservations as $reservation) { 
                // Parcourt chaque réservation dans le tableau
                echo $reservation . "<br>"; 
                // Affiche la réservation
            }
        }

        echo "<br>"; 
    }

    // Méthodes pour obtenir le nom et la ville de l'hôtel
    public function getNomHotel(): string {
        return $this->_nomHotel; 
        // Retourne le nom de l'hôtel
    }

    public function getVilleHotel(): string {
        return $this->_villeHotel; 
        // Retourne la ville de l'hôtel
    }
}
?>