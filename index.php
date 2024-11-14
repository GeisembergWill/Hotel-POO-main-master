<?php

include 'classeHotel.php';
include 'classeClient.php';
include 'classeChambre.php';
include 'classeReservation.php';

// Création des hôtels
$hotelH = new Hotel("Hilton", "10 route de la Gare", "67000", "Strasbourg");
$hotelR = new Hotel("Regent", "15 rue du Puit", "75000", "Paris");

// Création des clients
$client1 = new Client("Virgile", "GIBELLO", "18-09-2005");
$client2 = new Client("Micka", "MURMANN", "25-10-1995");

// Création des chambres dans les hôtels
$chambre1 = new Chambre($hotelH, "17", true, 2, 120); 
$chambre2 = new Chambre($hotelH, "3", false, 2, 120); 
$chambre3 = new Chambre($hotelH, "4", false, 2, 120); 
$chambre4 = new Chambre($hotelR, "25", false, 2, 75);

// Création des réservations
$reservation1 = new Reservation($client1, $chambre1, "01-01-2021", "01-01-2021");
$reservation2 = new Reservation($client2, $chambre2, "11-03-2021", "15-03-2021");
$reservation3 = new Reservation($client2, $chambre3, "01-04-2021", "17-04-2021");

// Affiche les informations et les réservations de l'hôtel Hilton
$hotelH->afficherInfosHotel();
$hotelH->afficherReservations();

// Affiche les informations et les réservations de l'hôtel Regent

$hotelR->afficherReservations();

// Affiche les réservations spécifiques d'un client
$client2->afficherReservationsClient();

?>