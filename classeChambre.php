<?php
class Chambre {
    private Hotel $_hotel; // Hôtel auquel appartient la chambre
    private string $_numeroChambre; // Numéro de la chambre
    private bool $_wifi; // Indicateur si la chambre a le WiFi
    private int $_prixChambre; // Prix de la chambre
    private int $_nbLits; // Ajout de la propriété pour le nombre de lits
    private array $_reservations = []; // Liste des réservations de la chambre

    // Constructeur pour initialiser les informations de la chambre
    public function __construct(Hotel $hotel, string $numero, bool $wifi, int $nbLits ,int $prix) {
        $this->_hotel = $hotel;
        $this->_numeroChambre = $numero;
        $this->_wifi = $wifi;
        $this->_nbLits = $nbLits;
        $this->_prixChambre = $prix;
        $hotel->ajouterChambre($this);
    }

    // Vérifie si la chambre est réservée
    public function estReservee(): bool {
        return !empty($this->_reservations);
    }

    // Ajoute une réservation à la chambre
    public function ajouterReservation(Reservation $reservation): void {
        $this->_reservations[] = $reservation;
    }

    // Retourne la liste des réservations
    public function getReservations(): array {
        return $this->_reservations;
    }

    // Méthode pour obtenir le prix de la chambre
    public function getPrix(): int {
        return $this->_prixChambre; // Retourne le prix de la chambre
    }

    // Méthode pour obtenir le numéro de la chambre
    public function getNumeroChambre(): string {
        return $this->_numeroChambre; // Retourne le numéro de la chambre
    }

    // Méthode pour obtenir le nombre de lits
    public function getNbLits(): int {
        return $this->_nbLits;
    }

    // Méthode pour obtenir l'état du WiFi
    public function getWifi(): bool {
        return $this->_wifi; // Retourne vrai si la chambre a le WiFi, sinon faux
    }

    // Méthode pour obtenir l'hôtel auquel la chambre appartient
    public function getHotel(): Hotel {
        return $this->_hotel; // Retourne l'objet Hotel auquel la chambre appartient
    }

    // Affiche les informations de la chambre sous forme de chaîne
    public function __toString(): string {
        $wifiStatus = $this->_wifi ? "oui" : "non";
        return "Chambre {$this->_numeroChambre} - {$this->_prixChambre} € - Wifi : {$wifiStatus}";
    }
}
?>