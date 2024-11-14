<?php
include 'classeHotel.php';
 // Inclut la classe Hôtel
include 'classeClient.php';
 // Inclut la classe Client
include 'classeChambre.php'; 
// Inclut la classe Chambre
include 'classeReservation.php'; 
// Inclut la classe Reservation

// Création des hôtels
$hotelH = new Hotel("Hilton", "10 route de la Gare", "67000", "Strasbourg"); 
// Création de l'hôtel Hilton à Strasbourg
$hotelR = new Hotel("Regent", "15 rue du Puit", "75000", "Paris"); 
// Création de l'hôtel Regent à Paris

// Création des clients
$client1 = new Client("Virgile", "GIBELLO", "18-09-2005"); 
// Création du client Virgile
$client2 = new Client("Micka", "MURMANN", "25-10-1995");
 // Création du client Micka

// Création des chambres dans les hôtels
$chambre1 = new Chambre($hotelH, "17", true, 2, 120); 
// Chambre 17 à l'hôtel Hilton avec WiFi
$chambre2 = new Chambre($hotelH, "3", false, 2, 120); 
// Chambre 3 à l'hôtel Hilton sans WiFi
$chambre3 = new Chambre($hotelH, "4", false, 2, 120); 
// Chambre 4 à l'hôtel Hilton sans WiFi
$chambre4 = new Chambre($hotelR, "25", false, 2, 75); 
// Chambre 25 à l'hôtel Regent sans WiFi

// Création des réservations
$reservation1 = new Reservation($client1, $chambre1, "01-01-2021", "01-01-2021"); 
// Réservation de Virgile dans la chambre 17 à l'hôtel Hilton
$reservation2 = new Reservation($client2, $chambre2, "11-03-2021", "15-03-2021"); 
// Réservation de Micka dans la chambre 3 à l'hôtel Hilton
$reservation3 = new Reservation($client2, $chambre3, "01-04-2021", "17-04-2021"); 
// Réservation de Micka dans la chambre 4 à l'hôtel Hilton

// Affichage du titre et de l'enoncé de l'exercice POO HOTEL
echo "<h2>POO HOTEL</h2><br>";
echo "<p> A partir de ces captures d'ecran , réaliser l'application en POO permettant la gestion de reservations de chambres par des clients dans différents hôtels:</p><br>";

//Affichage des informations et reservations de l'hôtel Hilton.
$hotelH->afficherInfosHotel(); 
// Affiche les informations de l'hôtel Hilton
$hotelH->afficherReservations(); 
// Affiche les réservations de l'hôtel Hilton

$hotelR->afficherReservations(); 
// Affiche les réservations de l'hôtel Regent

// Affichage des réservations spécifiques d'un client
echo "<h2>Réservations de {$client2->getPrenom()} {$client2->getNom()}</h2>";
$client2->afficherReservationsClient(); 
// Affiche les réservations du client Micka

?>