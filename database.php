<?php

$database = new mysqli(
    "127.0.0.1",
    "wypozyczalnia-nart",
    "@7LaaM/iQQ.gsQoy",
    "wypozyczalnia-nart"
) or die('Nie udało się połączyć z bazą danych. <br>' . $database->error);

$sql = "CREATE TABLE IF NOT EXISTS `Users` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `email` VARCHAR(65) NOT NULL ,
    `password` VARCHAR(65) NOT NULL ,
    `role` VARCHAR(14) NOT NULL ,
    PRIMARY KEY (`id`))  ENGINE = InnoDB;";
$database->query($sql) or die('Nie udało się utworzyć nowych baz danych.' . $database->error);

$database->query($sql) or die('Nie udało się utworzyć nowych baz danych.' . $database->error);