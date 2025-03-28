<?php
$db = new SQLite3('database.sqlite');
 

$queryJobs = "CREATE TABLE IF NOT EXISTS  jobs (
    ID     INTEGER      PRIMARY KEY AUTOINCREMENT,
    TITLE  VARCHAR (50) NOT NULL,
    TYPE   INT          NOT NULL,
    STATUS INT          DEFAULT 1
);";

$db->exec($queryJobs);

$query = "CREATE TABLE users (
    ID        INTEGER       PRIMARY KEY AUTOINCREMENT,
    NAME      VARCHAR (50)  NOT NULL,
    EMAIL     VARCHAR (100) NOT NULL,
    SKILLS    TEXT          NULL,
    SUBSCRIBE INT           DEFAULT 0
);";

$db->exec($query);


?>