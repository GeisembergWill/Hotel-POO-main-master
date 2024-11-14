<?php
class Hotel {
    private string $_nomHotel; // Nom de l'hôtel
    private string $_adresseHotel; // Adresse de l'hôtel
    private string $_villeHotel; // Ville où se situe l'hôtel
    private string $_codePostalHotel; // Code postal de l'hôtel
    private int $_nombreChambres = 27; // Nombre total de chambres dans l'hôtel
    private array $_chambres = []; // Tableau des chambres de l'hôtel

    // Constructeur pour initialiser les informations de l'hôtel
    public function __construct(string $nomHotel, string $adresseHotel, string $codePostalHotel, string $villeHotel) {
        $this->_nomHotel = $nomHotel;
        $this->_adresseHotel = $adresseHotel;
        $this->_codePostalHotel = $codePostalHotel;
        $this->_villeHotel = $villeHotel;
    }

    // Ajoute une chambre au tableau des chambres de l'hôtel
    public function ajouterChambre(Chambre $chambre): void {
        $this->_chambres[] = $chambre;
        $this->_nombreChambres++;
    }

    // Compte le nombre de chambres réservées
    private function nombreChambresReservees(): int {
        $reservations = 0;
        foreach ($this->_chambres as $chambre) {
            if ($chambre->estReservee()) {
                $reservations++;
            }
        }
        return $reservations;
    }

    // Affiche les informations de l'hôtel : nom, adresse, nombre de chambres, etc.
    public function afficherInfosHotel(): void {
        echo "<h2>{$this->_nomHotel} **** {$this->_villeHotel}</h2>";
        echo "{$this->_adresseHotel} {$this->_codePostalHotel} {$this->_villeHotel}<br>";
        echo "Nombre de chambres : {$this->_nombreChambres}<br>";
        echo "Nombre de chambres réservées : " . $this->nombreChambresReservees() . "<br>";
        echo "Nombre de chambres dispo : " . ($this->_nombreChambres - $this->nombreChambresReservees()) . "<br><br>";
    }

    // Affiche les réservations de l'hôtel
    public function afficherReservations(): void {
        $reservations = [];
        // Fusionne toutes les réservations de chaque chambre
        foreach ($this->_chambres as $chambre) {
            $reservations = array_merge($reservations, $chambre->getReservations());
        }

        // Affiche un titre avec le nom et la ville de l'hôtel
        echo "<h3>Réservations de l'hôtel {$this->_nomHotel} **** {$this->_villeHotel}</h3>";

        // Vérifie s'il y a des réservations et affiche le résultat
        if (empty($reservations)) {
            echo "Aucune réservation !<br>";
        } else {
            // Affiche le nombre de réservations en style visuel
            echo "<span style='background-color: green; color: white; padding: 2px 5px; border-radius: 3px;'>" . count($reservations) . " RÉSERVATIONS</span><br>";

            // Affiche chaque réservation
            foreach ($reservations as $reservation) {
                echo $reservation . "<br>";
            }
        }

        echo "<br>";
    }

    // Méthodes pour obtenir le nom et la ville de l'hôtel
    public function getNomHotel(): string {
        return $this->_nomHotel; // Retourne le nom de l'hôtel
    }

    public function getVilleHotel(): string {
        return $this->_villeHotel; // Retourne la ville de l'hôtel
    }
}
?>