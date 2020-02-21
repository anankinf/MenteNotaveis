Ambiente de desenvolvimento e teste exige PHP 7, MariaDB ou MySQL

- É necessário habilitar as extensões mysqli no arquivo php.ini
- Para utilização da aplicação é necessário a criação do bando de dados, para isso execute os scripts no prompt de comando do banco de dados:
CREATE DATABASE mnteste;

CREATE TABLE `modules` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`description` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`status` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`);
	
CREATE TABLE `activities` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`module_id` BIGINT(20) UNSIGNED NOT NULL,
	`title` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`description` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`status` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
	`updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
	PRIMARY KEY (`id`),
	INDEX `activities_module_id_foreign` (`module_id`),
	CONSTRAINT `activities_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=12
;

Abra a pasta raiz da aplicação e edite o arquivo connection.php.
Preencha as informações conforme o ambiente de teste, lembrando de manter o nome do banco de dados:
 - $server = "localhost";
 - $user 	= "root";
 - $pass	= "secret";
 - $database = "mnteste";