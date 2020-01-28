-- MySQL Script generated by MySQL Workbench
-- Mon Jan 27 18:24:26 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema gestionfct
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gestionfct
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestionfct` DEFAULT CHARACTER SET utf8mb4 ;
USE `gestionfct` ;

-- -----------------------------------------------------
-- Table `gestionfct`.`centro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`centro` (
  `cod` VARCHAR(255) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `localidad` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`cod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`colectivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`colectivo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `foto` BLOB NOT NULL,
  `n_dias` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`comida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`comida` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `importe` VARCHAR(8) NOT NULL,
  `fecha` DATE NOT NULL,
  `foto` BLOB NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`cursos` (
  `id` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `centro_cod` VARCHAR(255) NOT NULL,
  `ano_academico` VARCHAR(255) NOT NULL,
  `familia` VARCHAR(255) NOT NULL,
  `horas` INT(11) NOT NULL,
  `tutor` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `cursos_centro_cod_foreign` (`centro_cod` ASC) VISIBLE,
  CONSTRAINT `cursos_centro_cod_foreign`
    FOREIGN KEY (`centro_cod`)
    REFERENCES `gestionfct`.`centro` (`cod`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`empresa` (
  `cif` VARCHAR(9) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `dni_responsable` VARCHAR(9) NOT NULL,
  `nombre_responsable` VARCHAR(100) NOT NULL,
  `direccion` VARCHAR(200) NOT NULL,
  `localidad` VARCHAR(200) NOT NULL,
  `horario` VARCHAR(100) NOT NULL,
  `nueva` INT(11) NULL DEFAULT NULL,
  `gastos` INT(11) NULL DEFAULT NULL,
  `apto` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`cif`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`propio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`propio` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `kms` INT(11) NOT NULL,
  `n_dias` VARCHAR(255) NOT NULL,
  `precio` DOUBLE(8,2) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`transporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`transporte` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` INT(11) NOT NULL,
  `donde` INT(11) NOT NULL,
  `colectivo_id` INT(11) NOT NULL,
  `propio_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `transporte_colectivo_id_foreign` (`colectivo_id` ASC) VISIBLE,
  INDEX `transporte_propio_id_foreign` (`propio_id` ASC) VISIBLE,
  CONSTRAINT `transporte_colectivo_id_foreign`
    FOREIGN KEY (`colectivo_id`)
    REFERENCES `gestionfct`.`colectivo` (`id`),
  CONSTRAINT `transporte_propio_id_foreign`
    FOREIGN KEY (`propio_id`)
    REFERENCES `gestionfct`.`propio` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`usuarios` (
  `dni` VARCHAR(9) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(9) NOT NULL,
  `movil` VARCHAR(9) NOT NULL,
  `iban` VARCHAR(24) NOT NULL,
  `cursos_id` VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`dni`),
  INDEX `usuarios_cursos_id_foreign` (`cursos_id` ASC) VISIBLE,
  CONSTRAINT `usuarios_cursos_id_foreign`
    FOREIGN KEY (`cursos_id`)
    REFERENCES `gestionfct`.`cursos` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`gastos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`gastos` (
  `id` VARCHAR(255) NOT NULL,
  `desplazamiento` INT(11) NOT NULL,
  `tipo` INT(11) NOT NULL,
  `usuarios_dni` VARCHAR(9) NOT NULL,
  `transporte_id` INT(11) NOT NULL,
  `comida_id` INT(11) NOT NULL,
  `total_gasto_alumno` DOUBLE(8,2) NOT NULL,
  `total_gasto_ciclo` DOUBLE(8,2) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `gastos_usuarios_dni_foreign` (`usuarios_dni` ASC) VISIBLE,
  INDEX `gastos_transporte_id_foreign` (`transporte_id` ASC) VISIBLE,
  INDEX `gastos_comida_id_foreign` (`comida_id` ASC) VISIBLE,
  CONSTRAINT `gastos_comida_id_foreign`
    FOREIGN KEY (`comida_id`)
    REFERENCES `gestionfct`.`comida` (`id`),
  CONSTRAINT `gastos_transporte_id_foreign`
    FOREIGN KEY (`transporte_id`)
    REFERENCES `gestionfct`.`transporte` (`id`),
  CONSTRAINT `gastos_usuarios_dni_foreign`
    FOREIGN KEY (`usuarios_dni`)
    REFERENCES `gestionfct`.`usuarios` (`dni`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`responsable`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`responsable` (
  `dni` VARCHAR(9) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(9) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`dni`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`practicas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`practicas` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dni_responsable` VARCHAR(9) NOT NULL,
  `cod_proyecto` VARCHAR(50) NULL DEFAULT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NOT NULL,
  `empresa_cif` VARCHAR(9) NOT NULL,
  `alumno_dni` VARCHAR(9) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `practicas_alumno_dni_foreign` (`alumno_dni` ASC) VISIBLE,
  INDEX `practicas_empresa_cif_foreign` (`empresa_cif` ASC) VISIBLE,
  INDEX `practicas_dni_responsable_foreign` (`dni_responsable` ASC) VISIBLE,
  CONSTRAINT `practicas_alumno_dni_foreign`
    FOREIGN KEY (`alumno_dni`)
    REFERENCES `gestionfct`.`usuarios` (`dni`),
  CONSTRAINT `practicas_dni_responsable_foreign`
    FOREIGN KEY (`dni_responsable`)
    REFERENCES `gestionfct`.`responsable` (`dni`),
  CONSTRAINT `practicas_empresa_cif_foreign`
    FOREIGN KEY (`empresa_cif`)
    REFERENCES `gestionfct`.`empresa` (`cif`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `gestionfct`.`usuarios_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestionfct`.`usuarios_roles` (
  `usuarios_dni` VARCHAR(9) NOT NULL,
  `roles_id` INT(11) NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`roles_id`),
  INDEX `usuarios_roles_usuarios_dni_foreign` (`usuarios_dni` ASC) VISIBLE,
  CONSTRAINT `usuarios_roles_roles_id_foreign`
    FOREIGN KEY (`roles_id`)
    REFERENCES `gestionfct`.`roles` (`id`),
  CONSTRAINT `usuarios_roles_usuarios_dni_foreign`
    FOREIGN KEY (`usuarios_dni`)
    REFERENCES `gestionfct`.`usuarios` (`dni`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
