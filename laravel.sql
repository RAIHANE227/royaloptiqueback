-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 18 nov. 2025 à 10:19
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `product_type_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Vueق', '2025-11-16 19:53:50', '2025-11-17 21:08:41'),
(2, 1, 'Soleil', '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(3, 1, 'Sport', '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(4, 2, 'Souples', '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(5, 2, 'Rigides', '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(6, 3, 'Monofocaux', '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(8, 4, 'Étuis', '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(9, 4, 'Lingettes', '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(10, 2, 'اا', '2025-11-17 21:08:58', '2025-11-17 21:08:58'),
(11, 1, 'Vue', '2025-11-18 07:26:41', '2025-11-18 07:26:41'),
(12, 3, 'Progressifs', '2025-11-18 07:26:41', '2025-11-18 07:26:41');

-- --------------------------------------------------------

--
-- Structure de la table `delivery_fees`
--

CREATE TABLE `delivery_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wilaya` varchar(255) NOT NULL,
  `fee_home` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fee_office` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `delivery_fees`
--

INSERT INTO `delivery_fees` (`id`, `wilaya`, `fee_home`, `fee_office`, `created_at`, `updated_at`) VALUES
(1, 'Alger', 800.00, 600.00, '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(2, 'Oran', 900.00, 700.00, '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(3, 'Constantine', 950.00, 750.00, '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(4, 'Blida', 700.00, 500.00, '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(5, 'Annaba', 1000.00, 800.00, '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(6, 'boumerdes', 700.00, 200.00, '2025-11-17 21:25:41', '2025-11-17 21:25:41');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_16_200249_create_product_types_table', 1),
(5, '2025_11_16_200307_create_categories_table', 1),
(6, '2025_11_16_200409_create_products_table', 1),
(7, '2025_11_16_200512_create_product_images_table', 1),
(8, '2025_11_16_200559_create_orders_table', 1),
(9, '2025_11_16_200619_create_order_items_table', 1),
(10, '2025_11_16_200805_create_settings_table', 1),
(11, '2025_11_16_200817_create_delivery_fees_table', 1),
(13, '2025_11_16_210552_add_profile_fields_to_users_table', 2),
(14, '2025_11_17_223522_create_settings_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','processing','shipped','completed','canceled') NOT NULL DEFAULT 'pending',
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `prescription_image` varchar(255) DEFAULT NULL,
  `delivery_type` enum('home','office') NOT NULL,
  `wilaya` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `customer_name`, `customer_phone`, `customer_address`, `prescription_image`, `delivery_type`, `wilaya`, `created_at`, `updated_at`) VALUES
(1, 2, 16790.00, 'completed', 'raihane', '99999999', 'HERAOUA ROUIBA', 'orders/prescriptions/610ENqGPo0dqtIVOwDvfbaotdUgBgIhTaH2iPPWh.png', 'home', 'alger', '2025-11-17 18:44:25', '2025-11-18 07:27:48'),
(2, 2, 38780.00, 'completed', 'raihane', '99999999', 'HERAOUA ROUIBA', NULL, 'home', 'alger', '2025-11-17 19:12:53', '2025-11-17 21:09:11'),
(3, 2, 222.00, 'pending', 'raihane', '999999990', 'HERAOUA ROUIBA', 'orders/prescriptions/zrL1vrJ08YPykyoCNBuWrjvBw57gxmLaWng8Qocu.png', 'office', 'boumerdes', '2025-11-17 21:50:14', '2025-11-17 21:50:14');

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 15990.00, '2025-11-17 18:44:25', '2025-11-17 18:44:25'),
(2, 2, 2, 2, 18990.00, '2025-11-17 19:12:53', '2025-11-17 19:12:53'),
(3, 3, 6, 1, 22.00, '2025-11-17 21:50:14', '2025-11-17 21:50:14');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ouldacheraihane@gmail.com', '$2y$12$qg/AkRCbMeM4YE55EzqzJ.SOsrirwzl/0p0q5imlifcdifNMqG5aS', '2025-11-17 22:00:07');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_type_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `product_type_id`, `category_id`, `name`, `description`, `price`, `stock`, `image`, `brand`, `color`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 'Lunettes de vue Élégance', 'Monture légère en acétate avec verres anti-reflets idéal pour un port quotidien.', 15990.00, 25, 'images/produits/lunettes-elegance.jpg', 'OptiLux', 'Noir mat', '2025-11-16 19:53:50', '2025-11-18 07:26:41'),
(2, 1, 2, 'Lunettes de soleil Riviera', 'Protection UV400 avec monture métallique dorée et branches ajustables.', 18990.00, 15, 'images/produits/riviera.jpg', 'SunWave', 'Doré', '2025-11-16 19:53:50', '2025-11-18 07:26:41'),
(6, 4, NULL, 'raihane', '2222222é', 22.00, 1, 'products/MPutaZDPxjNNAg6nG4OgneCWQMM6AQDxW2kqtG6Y.jpg', 'GG', 'Noir mat', '2025-11-17 21:46:32', '2025-11-17 21:50:14'),
(7, 2, 4, 'Lentilles Confort 24h', 'Lentilles journalières hydratées pour un confort maximal.', 7990.00, 80, 'products/sMeIHfkopESEPSHmopLAK4KFKbHDXUlqVUt0UPD6.jpg', 'VisionClear', 'Transparent', '2025-11-18 07:26:41', '2025-11-18 08:10:56'),
(8, 3, 12, 'Verres progressifs Premium', 'Correction multi-distance avec filtre lumière bleue pour usage numérique.', 24990.00, 30, 'images/produits/verres-premium.jpg', 'BlueCare', 'Translucide', '2025-11-18 07:26:41', '2025-11-18 07:26:41'),
(9, 4, 8, 'Étui premium en cuir', 'Étui rigide en cuir végétal avec intérieur velours.', 2990.00, 60, 'images/produits/etui-cuir.jpg', 'RoyalCase', 'Marron', '2025-11-18 07:26:41', '2025-11-18 07:26:41');

-- --------------------------------------------------------

--
-- Structure de la table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/produits/lunettes-elegance.jpg', 1, '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(2, 2, 'images/produits/riviera.jpg', 1, '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(6, 6, 'products/gallery/eiOFLeX6aIcM76mISsn1R7RQYuqdJlGWqysebh0H.jpg', 0, '2025-11-17 21:46:32', '2025-11-17 21:46:32'),
(8, 8, 'images/produits/verres-premium.jpg', 1, '2025-11-18 07:26:41', '2025-11-18 07:26:41'),
(9, 9, 'images/produits/etui-cuir.jpg', 1, '2025-11-18 07:26:41', '2025-11-18 07:26:41');

-- --------------------------------------------------------

--
-- Structure de la table `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Lunettes', '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(2, 'Lentilles', '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(3, 'Verres médicaux', '2025-11-16 19:53:50', '2025-11-16 19:53:50'),
(4, 'Accessoires', '2025-11-16 19:53:50', '2025-11-16 19:53:50');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('iLNKhgYgwYGeweNF6X225eoY3NH9XFOzZ5mqfwFO', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV3RpMWxuZWdqdk9xdUZUOWlmd0VnU2xtaWs2T2gwUzV0UjhJNEU1ZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWl0cy83IjtzOjU6InJvdXRlIjtzOjEzOiJwcm9kdWN0cy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1763457084);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `phone`, `email`, `address`, `logo`, `social_links`, `created_at`, `updated_at`) VALUES
(1, 'Optique Royal', '+213 123 456 789ااااا', 'contact@optiqueroyale.dz', '123 Rue des Opticiens, Alger, Algérie', 'settings/CDJAQLVt4VRJU6qaUKOdXHZlisG3bl0FprQuJikT.png', '{\"facebook\":\"https:\\/\\/facebook.com\\/optiqueroyale\",\"twitter\":\"https:\\/\\/twitter.com\\/optiqueroyale\",\"instagram\":\"https:\\/\\/instagram.com\\/optiqueroyale\",\"linkedin\":\"https:\\/\\/linkedin.com\\/company\\/optiqueroyale\"}', '2025-11-17 21:42:23', '2025-11-18 08:00:27'),
(2, 'Optique Royale', '+213 770 00 00 00', 'contact@optiqueroyale.dz', 'Centre-ville, Alger', 'settings/logo.png', '{\"facebook\":\"https:\\/\\/facebook.com\\/optiqueroyale\",\"instagram\":\"https:\\/\\/instagram.com\\/optiqueroyale\",\"whatsapp\":\"https:\\/\\/wa.me\\/213770000000\"}', '2025-11-18 07:26:41', '2025-11-18 08:06:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `wilaya` varchar(255) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `city`, `wilaya`, `postal_code`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur Optique', 'admin@optiqueroyale.dz', '+213 771 00 00 00', NULL, NULL, NULL, NULL, 'admin', NULL, '$2y$12$vQJsCRJhk8zZMXgWoQmOsuQdYYKJp/uWP2pyi7dW7I1t/MljtOJ8y', NULL, '2025-11-16 19:53:50', '2025-11-18 07:26:41'),
(2, 'raihane', 'allowed1@example.com', '999999990', 'HERAOUA ROUIBA', 'ALGER', 'boumerdes', '16006', 'user', NULL, '$2y$12$gpxDdrCAkltxq4pjppSpuuX0.Atue9CNz/1Nhymnky8ebBbViYwA.', NULL, '2025-11-17 18:42:41', '2025-11-17 21:49:46'),
(3, 'raihane', 'ouldacheraihane@gmail.com', '0558788313', NULL, NULL, NULL, NULL, 'user', NULL, '$2y$12$zT/Vhe12kN6kegHyYs/7aOgbIG43yi94KQaQ3hvCbtKeHQ6Nkjdaa', NULL, '2025-11-17 21:51:34', '2025-11-17 21:51:34');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_product_type_id_foreign` (`product_type_id`);

--
-- Index pour la table `delivery_fees`
--
ALTER TABLE `delivery_fees`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_type_id_foreign` (`product_type_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Index pour la table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Index pour la table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_types_name_unique` (`name`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `delivery_fees`
--
ALTER TABLE `delivery_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
