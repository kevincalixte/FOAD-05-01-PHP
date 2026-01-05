DROP DATABASE IF EXISTS resavelo;
CREATE DATABASE IF NOT EXISTS resavelo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE resavelo;

-- ================================================
-- Table: velos
-- ================================================
CREATE TABLE IF NOT EXISTS velos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    description TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ================================================
-- Table: reservations
-- ================================================
CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    velo_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    status ENUM('en_attente', 'confirmee', 'annulee', 'terminee') DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (velo_id) REFERENCES velos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ================================================
-- Insertion de 25 vélos
-- ================================================

INSERT INTO velos (name, price, quantity, description, image_url) VALUES
('VTT Rockrider 540', 25.00, 5, 'Vélo tout-terrain robuste idéal pour les sentiers de montagne. Suspension avant et freins à disque.', 'vtt_rockrider.jpg'),
('Vélo de ville Elops 520', 15.00, 8, 'Vélo urbain confortable avec panier avant et porte-bagages. Parfait pour les trajets quotidiens.', 'elops_520.jpg'),
('VTT électrique E-ST 900', 45.00, 3, 'VTT électrique avec assistance jusqu''à 25 km/h. Autonomie de 90 km. Pour les longues randonnées.', 'vtt_electric.jpg'),
('Vélo pliant Tilt 500', 12.00, 10, 'Compact et pratique, ce vélo se plie en quelques secondes. Idéal pour les trajets multimodaux.', 'tilt_500.jpg'),
('VTT enfant Rockrider ST 100', 10.00, 6, 'VTT pour enfants de 6 à 9 ans. Cadre bas et freins adaptés aux petites mains.', 'vtt_enfant.jpg'),
('Vélo de route Triban RC 120', 30.00, 4, 'Vélo de route avec cadre aluminium. Parfait pour les sorties sportives sur route.', 'triban_rc120.jpg'),
('Vélo électrique Elops 940 E', 40.00, 5, 'Vélo électrique urbain avec autonomie de 70 km. Porte-bagages et éclairage intégrés.', 'elops_940e.jpg'),
('BMX Wipe 320', 18.00, 7, 'BMX freestyle pour figures et tricks. Cadre acier robuste et pneus larges.', 'bmx_wipe.jpg'),
('Vélo cargo Longtail R500', 35.00, 2, 'Vélo cargo pour transporter enfants ou marchandises. Capacité jusqu''à 80 kg.', 'cargo_r500.jpg'),
('VTT Rockrider 920', 35.00, 4, 'VTT haut de gamme avec double suspension. Pour riders expérimentés.', 'rockrider_920.jpg'),
('Vélo de ville femme Elops 100', 14.00, 9, 'Vélo urbain avec cadre bas pour faciliter la montée. Très confortable.', 'elops_100_femme.jpg'),
('Gravel Bike Triban GRVL 120', 32.00, 3, 'Vélo polyvalent route et chemins. Idéal pour le bikepacking et gravel.', 'gravel_triban.jpg'),
('VTT junior Rockrider ST 500', 15.00, 5, 'VTT pour ados de 9 à 12 ans. Suspension avant et 21 vitesses.', 'rockrider_st500_junior.jpg'),
('Vélo de ville hollandais Windsor', 20.00, 6, 'Style hollandais vintage avec garde-boue et carter de chaîne complet.', 'windsor_holland.jpg'),
('Fat Bike Rockrider Fatbike 100', 28.00, 3, 'Vélo à pneus larges pour rouler sur neige, sable ou terrain meuble.', 'fatbike_100.jpg'),
('Vélo électrique pliant Tilt 500 E', 38.00, 4, 'Vélo pliant électrique. Compact et pratique avec assistance électrique.', 'tilt_500e.jpg'),
('VTT All Mountain AM 100', 38.00, 3, 'VTT enduro pour descentes techniques. Suspension 160mm avant et arrière.', 'am_100.jpg'),
('Fixie Single Speed 500', 22.00, 5, 'Vélo urbain minimaliste à pignon fixe. Design épuré et léger.', 'fixie_500.jpg'),
('Vélo de ville vintage Hoptown 300', 16.00, 7, 'Style rétro avec panier en osier et selle confort. Pour balades tranquilles.', 'hoptown_300.jpg'),
('VTT Cross Country XC 100', 32.00, 4, 'VTT de compétition léger et rapide. Idéal pour les courses XC.', 'xc_100.jpg'),
('Vélo électrique cargo', 50.00, 2, 'Vélo cargo électrique pour transporter jusqu''à 100 kg. Autonomie 60 km.', 'cargo_electrique.jpg'),
('Vélo de route Triban RC 520', 40.00, 3, 'Vélo de route avec cadre carbone. Pour cyclistes confirmés.', 'triban_rc520.jpg'),
('VTT électrique E-AM 900', 55.00, 2, 'VTT électrique All Mountain. Moteur Bosch et batterie 625 Wh.', 'e_am_900.jpg'),
('Vélo de ville 3 vitesses Elops 320', 13.00, 8, 'Vélo urbain simple avec 3 vitesses dans le moyeu. Entretien minimal.', 'elops_320.jpg'),
('Tandem Riverside 900', 45.00, 1, 'Vélo tandem pour deux personnes. Parfait pour les balades en couple.', 'tandem_riverside.jpg');

-- ================================================
-- Insertion de 25 réservations
-- ================================================

INSERT INTO reservations (velo_id, start_date, end_date, total_price, status) VALUES
(1, '2026-01-10', '2026-01-12', 50.00, 'confirmee'),
(2, '2026-01-08', '2026-01-09', 15.00, 'confirmee'),
(3, '2026-01-15', '2026-01-20', 225.00, 'en_attente'),
(4, '2026-01-06', '2026-01-07', 12.00, 'terminee'),
(5, '2026-01-11', '2026-01-13', 20.00, 'confirmee'),
(6, '2026-01-14', '2026-01-16', 60.00, 'en_attente'),
(7, '2026-01-09', '2026-01-11', 80.00, 'confirmee'),
(8, '2026-01-07', '2026-01-08', 18.00, 'terminee'),
(9, '2026-01-20', '2026-01-25', 175.00, 'en_attente'),
(10, '2026-01-12', '2026-01-14', 70.00, 'confirmee'),
(11, '2026-01-05', '2026-01-06', 14.00, 'terminee'),
(12, '2026-01-16', '2026-01-18', 64.00, 'en_attente'),
(13, '2026-01-13', '2026-01-15', 30.00, 'confirmee'),
(14, '2026-01-08', '2026-01-10', 40.00, 'confirmee'),
(15, '2026-01-22', '2026-01-25', 84.00, 'en_attente'),
(16, '2026-01-10', '2026-01-12', 76.00, 'confirmee'),
(17, '2026-01-18', '2026-01-20', 76.00, 'en_attente'),
(18, '2026-01-07', '2026-01-09', 44.00, 'terminee'),
(19, '2026-01-14', '2026-01-16', 32.00, 'confirmee'),
(20, '2026-01-11', '2026-01-13', 64.00, 'confirmee'),
(1, '2026-01-17', '2026-01-19', 50.00, 'en_attente'),
(2, '2026-01-21', '2026-01-23', 30.00, 'en_attente'),
(3, '2026-01-25', '2026-01-28', 135.00, 'annulee'),
(7, '2026-01-19', '2026-01-22', 120.00, 'confirmee'),
(10, '2026-01-23', '2026-01-26', 105.00, 'en_attente');