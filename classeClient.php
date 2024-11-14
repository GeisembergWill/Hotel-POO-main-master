<?php
class Client {
    private string $_prenomClient; // Prénom du client
    private string $_nomClient; // Nom du client
    private string $_dateNaissance; // Date de naissance du client
    private array $_reservations = []; // Liste des réservations du client

    // Constructeur pour initialiser les informations du client
    public function __construct(string $prenom, string $nom, string $dateNaissance) {
        $this->_prenomClient = $prenom; // Assigne le prénom du client
        $this->_nomClient = $nom; // Assigne le nom du client
        $this->_dateNaissance = $dateNaissance; // Assigne la date de naissance du client
    }

    // Ajoute une réservation à la liste des réservations du client
    public function ajouterReservation(Reservation $reservation): void {
        $this->_reservations[] = $reservation; // Ajoute la réservation à la liste de réservations
    }

    // Affiche toutes les réservations du client avec le total
    public function afficherReservationsClient(): void {
        // Affiche le titre avec le prénom et le nom du client
        echo "<h3>Réservations de {$this->_prenomClient} {$this->_nomClient}</h3>";

        // Vérifie s'il y a des réservations pour le client
        if (empty($this->_reservations)) {
            echo "Aucune réservation !<br>"; // Affiche un message si aucune réservation n'est trouvée
        } else {
            // Affiche le nombre de réservations en style visuel 
            echo "<span style='background-color: green; color: white; padding: 2px 5px; border-radius: 3px;'>" . count($this->_reservations) . " RÉSERVATIONS</span><br>";

            $total = 0; // Initialise le total du montant des réservations
            foreach ($this->_reservations as $reservation) {
                echo $reservation . "<br>"; // Affiche chaque réservation en utilisant __toString de la classe Reservation
                $total += $reservation->getPrix(); // Ajoute le prix de chaque réservation au total
            }
            // Affiche le total des réservations
            echo "Total : " . $total . " €<br><br>";
        }
    }

    // Méthode magique __toString pour obtenir une représentation textuelle du client
    public function __toString(): string {
        return "{$this->_prenomClient} {$this->_nomClient}"; // Retourne le prénom et le nom du client sous forme de chaîne
    }

    // Méthode pour obtenir le prénom du client
    public function getPrenom(): string {
        return $this->_prenomClient; // Retourne le prénom du client
    }

    // Méthode pour obtenir le nom du client
    public function getNom(): string {
        return $this->_nomClient; // Retourne le nom du client
    }
}
?>