<?php
/**
 * Database Connection Configuration for Payroll Module
 * Adapted for mob_rfid_dtr
 */

// Prevent multiple inclusions
if (defined('DB_CONNECTION_LOADED')) {
    return;
}
define('DB_CONNECTION_LOADED', true);

// Set timezone for consistent datetime handling
date_default_timezone_set('Asia/Manila');

// Include the root dbcon to use mob_rfid_dtr database and its existing PDO connection
$root_dbcon = realpath(__DIR__ . '/../dbcon.php');
if (file_exists($root_dbcon)) {
    include_once($root_dbcon);
} else {
    die("Root database connection file not found.");
}

// Since root dbcon.php already establishes $conn and fetches $sf_row from school_preferences,
// we just need to map the variables to what the payroll module expects.

try {
    // Map variables from school_preferences to legacy variable names for backward compatibility
    $zip_code = isset($sf_row['deped_id']) ? $sf_row['deped_id'] : '';
    $region = isset($sf_row['region']) ? $sf_row['region'] : '';
    $division = isset($sf_row['division']) ? $sf_row['division'] : '';
    $institution_name = isset($sf_row['schoolName']) ? $sf_row['schoolName'] : '';
    
    $deped_id = $zip_code;
    $schoolName = $institution_name;
    
    // Inject legacy keys into the $sf_row array directly to prevent Undefined Index warnings
    $sf_row['institution_name'] = $institution_name;
    $sf_row['zip_code'] = $zip_code;
    
} catch (Exception $e) {
    error_log("Error mapping institution preferences: " . $e->getMessage());
}
?>
