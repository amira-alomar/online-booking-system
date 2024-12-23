<?php
require_once '../../conn.php';
session_start();

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    
    $query = "DELETE FROM services WHERE id = '$service_id'";
    if ($conn->query($query)) {
        header("Location: services.php");  
        exit;  
    } else {
        echo "Error deleting service.";
    }
} else {
    echo "Service ID not provided.";
}
?>
