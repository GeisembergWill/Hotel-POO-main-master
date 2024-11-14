<?php
class Chambre {
    private Hotel $_hotel; 
    // Hôtel auquel appartient la chambre, référence à un objet de type Hotel.
    private string $_numeroChambre; 
    // Numéro de la chambre.
    private bool $_wifi; 
    private int $_prixChambre; 
    // Prix de la chambre.
    private int $_nbLits; 
    // Nombre de lits dans la chambre.

    private array $_reservations = []; 
    // Liste des réservations de la chambre.

    // Constructeur pour initialiser les informations de la chambre
    public function __construct(Hotel $hotel, string $numero, bool $wifi, int $nbLits ,int $prix) {
        $this->_hotel = $hotel; 
        // Affecte l'hôtel auquel cette chambre appartient (référence à un objet de type Hotel)
        $this->_numeroChambre = $numero; 
        // Affecte le numéro de la chambre 
        $this->_wifi = $wifi; 
        // Affecte l'état du Wi-Fi (true si la chambre a le Wi-Fi, false sinon)
        $this->_nbLits = $nbLits; 
        // Affecte le nombre de lits dans la chambre
        $this->_prixChambre = $prix; 
        // Affecte le prix de la chambre pour une nuit
        $hotel->ajouterChambre($this); 
        // Appelle la méthode 'ajouterChambre' de l'objet Hôtel, 
        // en lui passant cette chambre, afin d'ajouter 
        //la chambre à la liste des chambres de l'hôtel
    }

    // Vérifie si la chambre est réservée
    public function estReservee(): bool {
        return !empty($this->_reservations); 
        // Retourne true si le tableau des réservations n'est pas vide, 
        //autrement dit si la chambre a au moins une réservation
        // Utilise la fonction empty() pour vérifier si le tableau est vide.
    }

    // Ajoute une réservation à la chambre
    public function ajouterReservation(Reservation $reservation): void {
        $this->_reservations[] = $reservation; 
        // Ajoute une réservation à la liste des réservations de la chambre 
        //en utilisant l'opérateur d'ajout (array[]).
        // Cela permet d'associer plusieurs réservations à la même chambre.
    }

    // Retourne la liste des réservations
    public function getReservations(): array {
        return $this->_reservations; 
        // Retourne le tableau des réservations associées à cette chambre.
    }

    // Méthode pour obtenir le prix de la chambre
    public function getPrix(): int {
        return $this->_prixChambre; 
        // Retourne le prix de la chambre.
    }

    // Méthode pour obtenir le numéro de la chambre
    public function getNumeroChambre(): string {
        return $this->_numeroChambre; 
        // Retourne le numéro de la chambre.
    }

    // Méthode pour obtenir le nombre de lits
    public function getNbLits(): int {
        return $this->_nbLits; 
        // Retourne le nombre de lits présents dans la chambre.
    }

    // Méthode pour obtenir l'état du WiFi
    public function getWifi(): bool {
        return $this->_wifi; 
        // Retourne true si la chambre a le Wi-Fi, sinon retourne false.
    }

    // Méthode pour obtenir l'hôtel auquel la chambre appartient
    public function getHotel(): Hotel {
        return $this->_hotel; 
        // Retourne l'objet Hotel auquel cette chambre appartient.
    }

    // Affiche les informations de la chambre sous forme de chaîne
    public function __toString(): string {
        $wifiStatus = $this->_wifi ? "oui" : "non"; 
        // Crée une variable $wifiStatus qui sera "oui" si la chambre a le Wi-Fi, sinon "non".

        return "Chambre {$this->_numeroChambre} - {$this->_prixChambre} € - Wifi : {$wifiStatus}"; 
        // Retourne une chaîne de caractères représentant la chambre sous la forme :
        // "Chambre [numéro] - [prix] € - Wifi : [oui/non]"
    }
}
?>