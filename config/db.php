<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=siparis", "admin", "1234");
     $db->query("SET CHARACTER SET utf8");

} catch ( PDOException $e ){
     print $e->getMessage();
}