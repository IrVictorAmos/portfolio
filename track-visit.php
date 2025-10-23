<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set response header
header('Content-Type: application/json');

// Include database configuration
require 'config.php';

try {
    $today = date('Y-m-d');
    $currentMonth = date('Y-m');
    
    // Check if visit already exists for today
    $checkSQL = "SELECT id, visit_count FROM visits WHERE visit_date = ? AND visit_month = ?";
    $stmt = $conn->prepare($checkSQL);
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ss", $today, $currentMonth);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update existing visit count
        $row = $result->fetch_assoc();
        $newCount = $row['visit_count'] + 1;
        
        $updateSQL = "UPDATE visits SET visit_count = ? WHERE visit_date = ? AND visit_month = ?";
        $updateStmt = $conn->prepare($updateSQL);
        
        if (!$updateStmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $updateStmt->bind_param("iss", $newCount, $today, $currentMonth);
        $updateStmt->execute();
        $updateStmt->close();
    } else {
        // Insert new visit
        $insertSQL = "INSERT INTO visits (visit_date, visit_month, visit_count) VALUES (?, ?, 1)";
        $insertStmt = $conn->prepare($insertSQL);
        
        if (!$insertStmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $insertStmt->bind_param("ss", $today, $currentMonth);
        $insertStmt->execute();
        $insertStmt->close();
    }
    
    $stmt->close();
    
    // Get current statistics
    $statsSQL = "SELECT 
        (SELECT visit_count FROM visits WHERE visit_date = ? LIMIT 1) as today_visits,
        (SELECT SUM(visit_count) FROM visits WHERE visit_month = ?) as month_visits,
        (SELECT SUM(visit_count) FROM visits) as total_visits";
    
    $statsStmt = $conn->prepare($statsSQL);
    
    if (!$statsStmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $statsStmt->bind_param("ss", $today, $currentMonth);
    $statsStmt->execute();
    $statsResult = $statsStmt->get_result();
    $stats = $statsResult->fetch_assoc();
    $statsStmt->close();
    
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'today_visits' => (int)($stats['today_visits'] ?? 0),
        'month_visits' => (int)($stats['month_visits'] ?? 0),
        'total_visits' => (int)($stats['total_visits'] ?? 0)
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error tracking visit: ' . $e->getMessage()
    ]);
} finally {
    $conn->close();
}
?>
