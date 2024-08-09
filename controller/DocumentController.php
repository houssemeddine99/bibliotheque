<?php
require_once '../config/database.php';
require_once '../models/Document.php';

class DocumentController {
    private $db;
    private $document;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->document = new Document($this->db);
    }

    // Méthode pour gérer les requêtes
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'read';
        switch ($action) {
            case 'create':
                $this->create();
                break;
            case 'read':
                $this->read();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                $this->read();
                break;
        }
    }

    private function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->document->title = $_POST['title'];
            $this->document->author = $_POST['author'];
            $this->document->year = $_POST['year'];
            $this->document->category = $_POST['category'];

            if ($this->document->create()) {
                echo "Document created successfully.";
            } else {
                echo "Failed to create document.";
            }
        }
        require '../views/create.php';
    }

    private function read() {
        $stmt = $this->document->read();
        require '../views/read.php';
    }

    private function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->document->id = $_POST['id'];
            $this->document->title = $_POST['title'];
            $this->document->author = $_POST['author'];
            $this->document->year = $_POST['year'];
            $this->document->category = $_POST['category'];

            if ($this->document->update()) {
                echo "Document updated successfully.";
            } else {
                echo "Failed to update document.";
            }
        }
        require '../views/update.php';
    }

    private function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->document->id = $_POST['id'];

            if ($this->document->delete()) {
                echo "Document deleted successfully.";
            } else {
                echo "Failed to delete document.";
            }
        }
        require '../views/delete.php';
    }
}

$controller = new DocumentController();
$controller->handleRequest();
