<?php
class Client {
    // Attributs privés pour stocker les informations du client
    private string $_prenomClient;      
    // Prénom du client
    private string $_nomClient;         
    // Nom du client
    private string $_dateNaissance;     
    // Date de naissance du client
    private array $_reservations = [];  
    // Liste des réservations associées au client

    // Constructeur pour initialiser les informations du client
    public function __construct(string $prenom, string $nom, string $dateNaissance) {
        $this->_prenomClient = $prenom;            
        // Assigne le prénom du client
        $this->_nomClient = $nom;                  
        // Assigne le nom du client
        $this->_dateNaissance = $dateNaissance;    
        // Assigne la date de naissance du client
    }

    // Méthode pour ajouter une réservation à la liste de réservations du client
    public function ajouterReservation(Reservation $reservation): void {
        $this->_reservations[] = $reservation;     
        // Ajoute la réservation à l'array des réservations
    }

    // Méthode pour afficher toutes les réservations du client ainsi que le total des prix
    public function afficherReservationsClient(): void {
       // Vérifie s'il existe des réservations dans la liste
        if (empty($this->_reservations)) {
            echo "Aucune réservation !<br>";       
            // Affiche un message si la liste est vide
        } else {
            // Affiche le nombre de réservations en encadré vert
            echo "<span style='background-color: green; color: white; padding: 2px 5px; border-radius: 3px;'>"
                 . count($this->_reservations) . " RÉSERVATIONS</span><br>";

            $total = 0;    
            // Variable pour calculer le total des prix des réservations
            foreach ($this->_reservations as $reservation) {
                echo $reservation->getChambre()->getHotel()->getNomHotel() . ' **** ' // Nom de l'hôtel
                . $reservation->getChambre()->getHotel()->getVilleHotel() . "/ Chambre: " // Ville de l'hôtel
                . $reservation->getChambre()->getNumeroChambre() . ' ' 
                . '(' . $reservation->getChambre()->getNbLits() . ' lits - ' // Parenthèse ouverte avant le nombre de lits
                . $reservation->getChambre()->getPrix() . ' "€" - ' // Prix de la chambre
                . 'WiFi: ' . ($reservation->getChambre()->getWifi() ? 'oui' : 'non') . ') ' // Parenthèse fermée après le WiFi
                . 'du ' . $reservation->getDateArrivee()->format('d/m/Y') // Date d'arrivée
                . ' au ' . $reservation->getDateSortie()->format('d/m/Y') . '<br>'; // Date de sortie
                $total += $reservation->getPrix(); 
                // Ajoute le prix de chaque réservation au total
            }
            // Affiche le total cumulé des prix des réservations
            echo "Total : " . $total . " €<br><br>";
        }
    }

    // Méthode magique __toString pour obtenir le nom et prenom du client
    public function __toString(): string {
        return "{$this->_prenomClient} {$this->_nomClient}"; 
        // Retourne le prénom et le nom du client sous forme de chaîne
    }

    // Getter pour obtenir le prénom du client
    public function getPrenom(): string {
        return $this->_prenomClient; 
        // Retourne le prénom
    }

    // Getter pour obtenir le nom du client
    public function getNom(): string {
        return $this->_nomClient; 
        // Retourne le nom
    }
}
?>