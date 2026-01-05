# TODO
1. ✅ Catalogue public (FAIT)
2. 🔄 Filtres sur le catalogue (rapide - 15 min)
3. 🔄 CRUD Vélos admin (important - 1h)
4. 🔄 Système de réservation (complexe - 1h30)
5. 🔄 Gestion réservations admin (30 min)
6. 🔄 Tableau de bord stats (30 min)
7. 🔄 CSS personnalisé (1h)

# FOAD PHP - Location de vélos : RESAVELO

Le but de la FOAD du jour est de développer une application de location de vélo de ville.

Voici les spécifications fonctionnelles :

## Partie publique (Client, fontend)

- Catalogue des vélos disponibles avec filtres (disponibilité, prix)
- Système de réservation avec sélection de dates

## Partie administration (backend)

- CRUD complet des vélos (nom, prix journalier, quantité disponible, photo)
- Vue d'ensemble des réservations (en cours, passées, annulées)
- Validation/refus des demandes de réservation
- Tableau de bord : statistiques de location

## Modèles de base de données

Créer le modele de la table velos :

- id
- name
- price
- quantity
- description
- image_url
- created_at

Créer le modele de la table reservations :

- id
- velo_id
- start_date
- end_date
- total_price
- created_at

## Organisation de travail

Voici une organisation de fichiers pour ce projet , en ajouter ou en supprimer libre à vous juste savoir justifier ses choix :

```
/resavelo
├── /config
│   └── db_connect.php          # Connexion PDO
├── /includes
│   ├── functions_velos.php       # Fonctions CRUD velos
│   ├── functions_reservation.php # Fonctions réservations
│   └── functions_calculation.php # Calculs tarifs/disponibilités
├── /admin
│   ├── index.php               # Tableau de bord
│   ├── velos.php               # Liste velos
│   ├── velo_form.php           # Ajout/Modification
│   ├── reservations.php        # Gestion réservations
├── /public
│   ├── index.php               # Accueil/Catalogue
│   ├── reservation_form.php    # Formulaire réservation
│   ├── mes_reservations.php     # Historique client
├── /assets
│   ├── /css
│   ├── /js
│   └── /imgs
├── /data
│   ├── database.sql
└── README.md
```

## Fonctions 

Voici les fonctions à créer :

### Velos

- getAllVelos($pdo)
- getVeloById($pdo, $id)
- addVelo($pdo, $data)
- updateVelo($pdo, $id, $data)
- deleteVelo($pdo, $id)

### Réservations 

- createReservation($pdo, $user_id, $equipment_id, $start_date, $end_date)
- getAllReservations($pdo)
- updateReservationStatus($pdo, $id, $status)
- cancelReservation($pdo, $id)
- checkAvailability($pdo, $equipment_id, $start_date, $end_date)

### Calculs

- calculatePrice($price_per_day, $start_date, $end_date)

## Bonus

Il y a aucune notions de MVC avec controller, vue (template) , libre à vous d'en implémenter une si envie ou nécéssité.


## Conseil de travail :

- Bien lire et s'impregner de l'énoncé du projet car il faut bien comprendre les relatiobs entre les differents tables de la base de donnée

### SQL

- Commencer par les modeles de base de données 
- Remplir les tables de fausses données
- Créer les requetes sql et s'assurer qu'elles fonctionnent correctement

### PHP

- Fonction de connexion (pdo) à la base de donnée
- Page Acceuil qui liste le catalogue de velos disponibles
- CRUD Velos
- CRUD Reservations
- Fonctions de calculs

### DESIGN

- Vous devez faire votre propre feuilles de styles , vous n'avez pas le droit d'utiliser de librairie CSS.

### JAVASCRIPT

- Vous pouvez utiliser des librairies javascript pour le tri des dashboards.

### GIT

- L'utilisation de git est obligatoire pour votre projet , donc faite souvent des commits avec des intitulés qui ont un sens.

### README

Vous devez obligatoirement avoir un readme qui explique ce que fait votre projet et comment le mettre en place.

### LLM

Il est evidement que je déconseil d'utiliser tout LLM pour faire ce travail sachant que qu'on a deja tout ça ensemble.

### LIVRABLE

- Pour 17h00 ou avant , envoyer par MP sur discord l'url de votre de dépot github (ou autre service) , apres 17h00 je ne regarderai pas votre travail.

On fera un debrief d'equipe le lendemain , en effet vous allez chacun faire une review de code d'une personne du groupe et écrire un compte rendu du travail vous aurez décortiqué.

Bonne coding journée ;-)

Durant la journée faite le maximum de choses que vous savez faire , il n'y a aucune course , le but est de faire bien et de comprendre ce qu'on fait.
