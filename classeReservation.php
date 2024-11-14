<?php
class Reservation {
    private Client $_client; 
    // Référence au client qui a effectué la réservation
    private Chambre $_chambre; 
    // Chambre associée à cette réservation
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

        // Utilisation de createFromFormat pour spécifier le format d'entrée des dates
        $this->_dateArrivee = DateTime::createFromFormat('d-m-Y', $dateArrivee); 
        // Initialise la date d'arrivée
        $this->_dateSortie = DateTime::createFromFormat('d-m-Y', $dateSortie); 
        // Initialise la date de sortie

        // Ajoute cette réservation aux réservations du client
        $client->ajouterReservation($this);

        // Ajoute cette réservation aux réservations de la chambre
        $chambre->ajouterReservation($this);
    }

    // Méthode pour calculer le prix total de la réservation en fonction de la durée
    public function getPrix(): int {
        // Calcule la différence en jours entre la date d'arrivée et la date de sortie
        $diff = $this->_dateArrivee->diff($this->_dateSortie);

        // Retourne le prix total basé sur le nombre de jours multiplié par le prix de la chambre par nuit
        return $this->_chambre->getPrix() * $diff->days;
    }

    // Méthode pour obtenir le client de la réservation
    public function getClient(): Client {
        return $this->_client; 
        // Retourne le client associé à cette réservation
    }

    // Méthode pour obtenir la chambre de la réservation
    public function getChambre(): Chambre {
        return $this->_chambre; 
        // Retourne la chambre associée à cette réservation
    }

    // Méthode pour obtenir la date d'arrivée
    public function getDateArrivee(): DateTime {
        return $this->_dateArrivee; 
        // Retourne la date d'arrivée de la réservation
    }

    // Méthode pour obtenir la date de sortie
    public function getDateSortie(): DateTime {
        return $this->_dateSortie; 
        // Retourne la date de sortie de la réservation
    }

    public function __toString(): string {
        // Récupérer les informations de l'hôtel associé à la chambre
        $hotel = $this->_chambre->getHotel();  
        // On récupère l'objet Hotel de la chambre via la méthode getHotel()
    
        // Déterminer si la chambre a le WiFi ou non, pour l'affichage
        $wifiStatus = $this->_chambre->getWifi() ? "oui" : "non";  
        // On vérifie si la chambre a du WiFi et on attribue "oui" ou "non" à la variable $wifiStatus
        
        // Retourner une chaîne de caractères qui représente la réservation
        return "{$this->_client->getPrenom()} {$this->_client->getNom()} - " .  
        // Affiche le prénom et le nom du client de la réservation
               "Hôtel {$hotel->getNomHotel()} ({$hotel->getVilleHotel()}) / " .  
               // Affiche le nom et la ville de l'hôtel associé à la réservation
               "Chambre {$this->_chambre->getNumeroChambre()} ({$this->_chambre->getNbLits()} lits - " .  
               // Affiche le numéro de la chambre et le nombre de lits
               "{$this->_chambre->getPrix()} € - Wifi : {$wifiStatus}) " .  
               // Affiche le prix de la chambre et si elle a du WiFi (oui ou non)
               "du " . $this->_dateArrivee->format('d-m-Y') . " au " .  
               // Affiche la date d'arrivée de la réservation au format 'jour-mois-année'
               $this->_dateSortie->format('d-m-Y');  
               // Affiche la date de sortie de la réservation au format 'jour-mois-année'
    }
}    
?>