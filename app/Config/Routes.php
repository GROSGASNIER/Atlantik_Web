<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Visiteur::Accueil');

$routes->get('accueil','Visiteur::Accueil');

$routes->match(['GET', 'POST'], 'connection','Visiteur::Connection', ["filter" => "filtrevisiteur"]);

$routes->get('deconnection','Client::Deconnection', ["filter" => "filtreclient"]);

$routes->match(['GET', 'POST'], 'creerUnCompte','Visiteur::CreerUnCompte', ["filter" => "filtrevisiteur"]);

$routes->match(['GET', 'POST'], 'modifierCompte','Client::ModifierCompte', ["filter" => "filtreclient"]);

$routes->get('liaisons','Visiteur::Liaisons');

$routes->match(['GET', 'POST'], 'horairesTraversees','Visiteur::horairesTraversees');

$routes->match(['GET', 'POST'], 'horairesTraversees/(:num)','Visiteur::horairesTraversees/$1');

$routes->match(['GET', 'POST'], 'horairesTraversees/(:alpha)/(:num)','Visiteur::RedirigeVers/$1/$2');

$routes->match(['GET', 'POST'], 'horaires','Visiteur::horairesTraversees');

$routes->get('tarifs/(:num)', 'Visiteur::Tarifs/$1');

$routes->get('tarifs/(:alpha)', 'Visiteur::RedirigeVers/$1');

$routes->get('historique','Client::HistoriqueReservations', ["filter" => "filtreclient"]);

$routes->get('reserverTraversee/(:num)', 'Client::reserverTraversee/$1', ["filter" => "filtreclient"]);

$routes->get('reserverTraversee/(:alpha)', 'Visiteur::RedirigeVers/$1');