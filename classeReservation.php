<?php
class Reservation {
    // Attributs privés pour stocker les informations d'une réservation
    private Client $_client;      
     // Client associé à la réservation
    private Chambre $_chambre;     
    // Chambre associée à la réservation
    private DateTime $_dateArrivee; 
    // Date d'arrivée du client
    private DateTime $_dateSortie;  
    // Date de départ du client

    // Constructeur pour initialiser les informations de la réservation
    public function __construct(Client $client, Chambre $chambre, string $dateArrivee, string $dateSortie) {
        $this->_client = $client;              
         // Associe le client à la réservation
        $this->_chambre = $chambre;             
        // Associe la chambre à la réservation

        // Initialise les dates d'arrivée et de sortie en utilisant le format d-m-Y
        $this->_dateArrivee = DateTime::createFromFormat('d-m-Y', $dateArrivee);
        $this->_dateSortie = DateTime::createFromFormat('d-m-Y', $dateSortie);

        // Ajoute la réservation au client et à la chambre
        $client->ajouterReservation($this);
        $chambre->ajouterReservation($this);
    }

    // Méthode pour calculer le prix total de la réservation en fonction de la durée
    public function getPrix(): int {
        // Calcule la différence en jours entre la date d'arrivée et la date de sortie
        $diff = $this->_dateArrivee->diff($this->_dateSortie);

        // Retourne le coût total de la réservation (prix par nuit * nombre de jours)
        return $this->_chambre->getPrix() * $diff->days;
    }

    // Getter pour obtenir le client associé à la réservation
    public function getClient(): Client {
        return $this->_client;
    }

    // Getter pour obtenir la chambre associée à la réservation
    public function getChambre(): Chambre {
        return $this->_chambre;
    }

    // Getter pour obtenir la date d'arrivée
    public function getDateArrivee(): DateTime {
        return $this->_dateArrivee;
    }

    // Getter pour obtenir la date de sortie
    public function getDateSortie(): DateTime {
        return $this->_dateSortie;
    }

    // Méthode magique __toString pour obtenir une représentation textuelle de la réservation
    public function __toString(): string {
        // Récupère l'hôtel associé à la chambre via la méthode getHotel()
        $hotel = $this->_chambre->getHotel();

        // Détermine si la chambre a le WiFi (affiche "oui" ou "non")
        $wifiStatus = $this->_chambre->getWifi() ? "oui" : "non";

        // Retourne une chaîne de caractères représentant la réservation en détail
        return "{$this->_client->getPrenom()} {$this->_client->getNom()} - " .
               "Hôtel {$hotel->getNomHotel()} ({$hotel->getVilleHotel()}) / " .
               "Chambre {$this->_chambre->getNumeroChambre()} ({$this->_chambre->getNbLits()} lits - " .
               "{$this->_chambre->getPrix()} € - Wifi : {$wifiStatus}) " .
               "du " . $this->_dateArrivee->format('d-m-Y') . " au " .
               $this->_dateSortie->format('d-m-Y');
    }
}
?>