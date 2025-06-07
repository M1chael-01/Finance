
CREATE DATABASE IF NOT EXISTS finance_uzivatele;


USE finance_uzivatele;

-- 3. Vytvoření tabulky
CREATE TABLE IF NOT EXISTS `uzivatel` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `jmeno` TEXT NOT NULL,
  `prijmeni` TEXT NOT NULL,
  `heslo` TEXT NOT NULL,
  `email` TEXT NOT NULL,
  `datum` DATE NULL, 
  `role` VARCHAR(20) NOT NULL,
  `group_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



COMMIT;

