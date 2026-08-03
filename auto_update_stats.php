<?php
// auto_update_stats.php
// Included in session.php to ensure it runs automatically.

$year_file = __DIR__ . '/last_update_year.txt';
$current_year = date('Y');
$last_update = 0;

if (file_exists($year_file)) {
    $last_update = intval(file_get_contents($year_file));
}

// If the system hasn't updated the ages for this current calendar year
if ($last_update < $current_year) {
    
    // Safety check: ensure $conn is available from session.php / dbcon.php
    if (isset($conn)) {
        
        $current_month = date('m');
        $current_day = date('d');
        
        $query = $conn->query("SELECT personnel_id, bdMM, bdDD, bdYYYY, appointment_date FROM personnels");
        
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $pid = $row['personnel_id'];
            $bMonth = intval($row['bdMM']);
            $bDay = intval($row['bdDD']);
            $bYear = intval($row['bdYYYY']);
            $appointment = trim($row['appointment_date']);
            
            // --- CALCULATE AGE ---
            $age = 0;
            if ($bYear > 1900) {
                $age = $current_year - $bYear;
                if ($current_month < $bMonth || ($current_month == $bMonth && $current_day < $bDay)) {
                    $age--;
                }
            }
            
            // --- CALCULATE YEARS IN SERVICE ---
            $years_in_service = 0;
            if (!empty($appointment)) {
                $app_timestamp = strtotime($appointment);
                if ($app_timestamp !== false) {
                    $app_year = date('Y', $app_timestamp);
                    $app_month = date('m', $app_timestamp);
                    $app_day = date('d', $app_timestamp);
                    
                    $years_in_service = $current_year - $app_year;
                    if ($current_month < $app_month || ($current_month == $app_month && $current_day < $app_day)) {
                        $years_in_service--;
                    }
                    if ($years_in_service < 0) {
                        $years_in_service = 0;
                    }
                }
            }
            
            // --- UPDATE DATABASE ---
            try {
                $update_stmt = $conn->prepare("UPDATE personnels SET age = :age, num_of_yrs = :num_of_yrs WHERE personnel_id = :pid");
                $update_stmt->execute([
                    ':age' => $age,
                    ':num_of_yrs' => $years_in_service,
                    ':pid' => $pid
                ]);
            } catch (PDOException $e) {
                // Ignore silently for background task
            }
        }
        
        // Save the current year so it doesn't run again until next Jan 1
        file_put_contents($year_file, $current_year);
    }
}
?>
