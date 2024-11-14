<?php
// Inclure les classes nécessaires pour la gestion des hôtels, clients, chambres, et réservations
include 'classeHotel.php';
include 'classeClient.php';
include 'classeChambre.php';
include 'classeReservation.php';

// Ajouter le lien vers le fichier CSS externe pour le style
echo '<link rel="stylesheet" type="text/css" href="styles.css">';

// Création des hôtels
$hotelH = new Hotel("Hilton", "10 route de la Gare", "67000", "Strasbourg"); 
// Crée l'hôtel Hilton à Strasbourg
$hotelR = new Hotel("Regent", "15 rue du Puit", "75000", "Paris"); 
// Crée l'hôtel Regent à Paris

// Création des clients
$client1 = new Client("Virgile", "GIBELLO", "18-09-2005"); 
// Crée le client Virgile Gibello, né le 18-09-2005
$client2 = new Client("Micka", "MURMANN", "25-10-1995"); 
// Crée le client Micka Murmann, né le 25-10-1995

// Création des chambres pour chaque hôtel
$chambre1 = new Chambre($hotelH, "1", false, 2, 120, "disponible"); 
$chambre2 = new Chambre($hotelH, "2", false, 2, 120, "disponible"); 
$chambre3 = new Chambre($hotelH, "3", false, 2, 120, "reservee"); 
$chambre4 = new Chambre($hotelR, "25", false, 2, 75, "reservee"); 
$chambre16 = new Chambre($hotelH,"16", true, 1,300,"disponible");
$chambre17 = new Chambre($hotelH,"17", true, 1,300 ,"reservee");
$chambre18 = new Chambre($hotelH,"18", true, 1,300,"disponible");
$chambre19 = new Chambre($hotelH,"19", true, 1,300,"disponible");

// Chaque chambre est associée à un hôtel et possède un numéro, le type de connexion, une capacité, un prix et un statut


// Création des réservations
$reservation1 = new Reservation($client1, $chambre1, "01-01-2021", "02-01-2021"); 
// Crée une réservation pour Virgile dans la chambre 1 du Hilton, du 01-01-2021 au 02-01-2021
$reservation2 = new Reservation($client2, $chambre2, "11-03-2021", "15-03-2021"); 
// Crée une réservation pour Micka dans la chambre 2 du Hilton, du 11-03-2021 au 15-03-2021
$reservation3 = new Reservation($client2, $chambre3, "01-04-2021", "17-04-2021"); 
// Crée une réservation pour Micka dans la chambre 3 du Hilton, du 01-04-2021 au 17-04-2021

// Affichage de l'en-tête de la page
echo "<h2>POO HOTEL</h2><br>";
echo "<p>À partir de ces captures d'écran, réalisez l'application en POO permettant la gestion de réservations de chambres par des clients dans différents hôtels :</p><br>";

// Affichage des informations et réservations pour l'hôtel Hilton
$hotelH->afficherInfosHotel();           
// Affiche les informations générales de l'hôtel Hilton
$hotelH->afficherReservations();          
// Affiche les réservations de l'hôtel Hilton

// Affichage des réservations pour l'hôtel Regent
$hotelR->afficherReservations();          
// Affiche les réservations de l'hôtel Regent

// Affichage des réservations spécifiques d'un client
echo "<h2>Réservations de {$client2->getPrenom()} {$client2->getNom()}</h2>";
$client2->afficherReservationsClient();   
// Affiche toutes les réservations du client Micka Murmann

// Affichage des statuts des chambres après les réservations
$hotelH->afficherStatutChambres();        
// Affiche le statut de toutes les chambres de l'hôtel Hilton après réservation

?>