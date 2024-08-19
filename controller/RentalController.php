<?php
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/rental.php';

class RentalController {
    private $db;
    private $rental;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->rental = new Rental($this->db);
    }

    public function addRental($user_id, $book_id, $duration) {
        return $this->rental->addRental($user_id, $book_id, $duration);
    }

    public function getRentals($user_id, $duration) {
        return $this->rental->getRentals($user_id, $duration);
    }
    public function returnRental($rental_id) {
        return $this->rental->returnRental($rental_id);
    }
}
?>