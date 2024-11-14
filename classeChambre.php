<?php
class Chambre {
    // Attributs pour stocker les informations de la chambre
    private Hotel $_hotel;                 
    // Référence à l'hôtel auquel appartient la chambre
    private string $_numeroChambre;        
    // Numéro unique de la chambre
    private bool $_wifi;                   
    // Indicateur si la chambre a le WiFi (true ou false)
    private int $_prixChambre;             
    // Prix par nuit de la chambre
    private int $_nbLits;                  
    // Nombre de lits dans la chambre
    private string $_statut;               
    // Statut de la chambre (disponible, réservée, etc.)
    private array $_reservations = [];     
    // Liste des réservations associées à cette chambre

    // Constructeur pour initialiser les informations de la chambre
    public function __construct(Hotel $hotel, string $numero, bool $wifi, int $nbLits, int $prix, string $statut) {
        $this->_hotel = $hotel;               
        // Associe l'hôtel à cette chambre
        $this->_numeroChambre = $numero;      
        // Initialise le numéro de la chambre
        $this->_wifi = $wifi;                 
        // Initialise l'indicateur WiFi
        $this->_nbLits = $nbLits;             
        // Définit le nombre de lits
        $this->_prixChambre = $prix;          
        // Définit le prix par nuit
        $this->_statut = $statut;             
        // Définit le statut initial de la chambre
        $hotel->ajouterChambre($this);        
        // Ajoute cette chambre à la liste des chambres de l'hôtel
    }

    // Méthode pour vérifier si la chambre est réservée
    public function estReservee(): bool {
        return $this->_statut === "reservee";   
        // Retourne true si le statut est "reservee"
    }

    // Méthode pour obtenir le statut de la chambre
    public function getStatut(): string {
        return $this->_statut;                  
        // Retourne le statut actuel de la chambre
    }

    // Méthode pour changer le statut de la chambre
    public function setStatut(string $statut): void {
        $this->_statut = $statut;               
        // Modifie le statut de la chambre
    }

    // Méthode pour ajouter une réservation à la chambre
    public function ajouterReservation(Reservation $reservation): void {
        $this->_reservations[] = $reservation;  
        // Ajoute la réservation à la liste des réservations
    }

    // Méthode pour obtenir la liste des réservations
    public function getReservations(): array {
        return $this->_reservations;            
        // Retourne la liste des réservations
    }

    // Méthode pour obtenir le prix de la chambre
    public function getPrix(): int {
        return $this->_prixChambre;             
        // Retourne le prix par nuit de la chambre
    }

    // Méthode pour obtenir le numéro de la chambre
    public function getNumeroChambre(): string {
        return $this->_numeroChambre;           
        // Retourne le numéro unique de la chambre
    }

    // Méthode pour obtenir le nombre de lits
    public function getNbLits(): int {
        return $this->_nbLits;                  
        // Retourne le nombre de lits dans la chambre
    }

    // Méthode pour vérifier si la chambre dispose du WiFi
    public function getWifi(): bool {
        return $this->_wifi;                    
        // Retourne true si la chambre a le WiFi
    }

    // Méthode pour obtenir l'hôtel associé à la chambre
    public function getHotel(): Hotel {
        return $this->_hotel;                   
        // Retourne l'hôtel auquel la chambre est associée
    }

    // Méthode __toString pour afficher les informations de la chambre sous forme de chaîne
    public function __toString(): string {
        $wifiStatus = $this->_wifi ? "oui" : "non"; 
         // Définit "oui" si WiFi disponible, sinon "non"
        return "Chambre {$this->_numeroChambre} - {$this->_prixChambre} € - Wifi : {$wifiStatus}";
         // Formatte et retourne les détails de la chambre
    }
}
?>