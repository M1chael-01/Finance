
  CREATE DATABASE IF NOT EXISTS finance_transakce;


  USE finance_transakce;


  CREATE TABLE IF NOT EXISTS `transakce` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `datum` DATE NULL,
    `aktivita` DATE NULL,
    `typ` VARCHAR(20) NOT NULL,
    `castka` INT(11) NOT NULL,
    `osoba` VARCHAR(100) NOT NULL,
    `popis` VARCHAR(100) NOT NULL,
    `group_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


  COMMIT;


 