<?php
include('session.php');

// Validate request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid access. Please use the Custom Personnel Report form.");
}

$group_by = isset($_POST['group_by']) ? $_POST['group_by'] : 'mixed';
$cols = isset($_POST['cols']) ? $_POST['cols'] : [];

// Always include fullname
if (!in_array('fullname', $cols)) {
    array_unshift($cols, 'fullname'); // Put it at the beginning
}

// Get school preferences for header
$school_query = $conn->query("SELECT * FROM school_preferences LIMIT 1");
$sf_row = $school_query->fetch(PDO::FETCH_ASSOC);
$schoolName = $sf_row ? $sf_row['schoolName'] : 'Local Government Unit';

// Map requested columns to SQL fields and table headers
$col_map = [
    'fullname' => ['header' => 'Full Name', 'sql' => "CONCAT(p.lname, ', ', p.fname, ' ', p.mname) as full_name"],
    'sex' => ['header' => 'Sex', 'sql' => 'p.sex'],
    'age' => ['header' => 'Age', 'sql' => 'p.age'],
    'dob' => ['header' => 'Date of Birth', 'sql' => 'p.bdMM, p.bdDD, p.bdYYYY'],
    'pob' => ['header' => 'Place of Birth', 'sql' => 'p.birth_place'],
    'address' => ['header' => 'Home Address', 'sql' => 'p.address'],
    'contact' => ['header' => 'Contact No.', 'sql' => 'p.personal_pnum'],
    'email' => ['header' => 'Email', 'sql' => 'p.email'],
    'department' => ['header' => 'Department/Office', 'sql' => 'd.dept_office_name'],
    'designation' => ['header' => 'Designation', 'sql' => 'des.designation_name'],
    'emp_status' => ['header' => 'Employment Status', 'sql' => 'e.emp_stat_name'],
    'salary_grade' => ['header' => 'SG / Step', 'sql' => "CONCAT('SG ', p.sal_grade, ' Step ', p.sal_step) as sg_step"],
    'monthly_salary' => ['header' => 'Monthly Salary', 'sql' => 'p.rate_per_day'],
    'date_hired' => ['header' => 'Date Hired', 'sql' => 'p.appointment_date'],
    'separation_date' => ['header' => 'Separation Date', 'sql' => 'p.separation_date']
];

$select_fields = [];
$table_headers = [];

foreach ($cols as $c) {
    if (isset($col_map[$c])) {
        if ($c !== 'dob') {
            $select_fields[] = $col_map[$c]['sql'];
        } else {
            // DOB is a special case mapping 3 columns
            $select_fields[] = 'p.bdMM';
            $select_fields[] = 'p.bdDD';
            $select_fields[] = 'p.bdYYYY';
        }
        $table_headers[] = $col_map[$c]['header'];
    }
}

// Grouping and sorting logic
$where_clause = "1=1";
$order_clause = "p.lname ASC, p.fname ASC";
$grouping_column = "";
$report_title_suffix = "";

if ($group_by === 'male_only') {
    $where_clause = "p.sex = 'Male'";
    $report_title_suffix = "- MALE ONLY";
} elseif ($group_by === 'female_only') {
    $where_clause = "p.sex = 'Female'";
    $report_title_suffix = "- FEMALE ONLY";
} elseif ($group_by === 'department') {
    $order_clause = "d.dept_office_name ASC, p.lname ASC, p.fname ASC";
    $grouping_column = "dept_office_name";
    if (!in_array('d.dept_office_name', $select_fields)) {
        $select_fields[] = "d.dept_office_name";
    }
} elseif ($group_by === 'employment_status') {
    $order_clause = "e.emp_stat_name ASC, p.lname ASC, p.fname ASC";
    $grouping_column = "emp_stat_name";
    if (!in_array('e.emp_stat_name', $select_fields)) {
        $select_fields[] = "e.emp_stat_name";
    }
}

$select_sql = implode(", ", array_unique($select_fields));

$sql = "SELECT $select_sql 
        FROM personnels p 
        LEFT JOIN dept_offices d ON p.do_id = d.do_id 
        LEFT JOIN emp_status e ON p.empStat_id = e.empStat_id 
        LEFT JOIN designations des ON p.des_id = des.des_id 
        WHERE $where_clause 
        ORDER BY $order_clause";

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    die("Database error: " . $ex->getMessage());
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Custom Personnel Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10pt; }
        .document-container { margin: 20px; }
        
        /* Table Styles */
        .table-custom { width: 100%; border-collapse: collapse; margin-bottom: 30px; font-size: 9pt; }
        .table-custom th, .table-custom td { border: 1px solid #333; padding: 6px; }
        .table-custom th { background-color: #f4f4f4; font-weight: bold; text-align: center; text-transform: uppercase; }
        
        .header-title { text-align: center; font-weight: bold; margin-bottom: 20px; font-size: 14pt; }
        .group-header { font-weight: bold; font-size: 11pt; margin-top: 25px; margin-bottom: 8px; text-transform: uppercase; background-color: #eaeaea; padding: 6px; border: 1px solid #333; }
        
        .btn-print { position: fixed; top: 20px; right: 20px; padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px; z-index: 1000; font-size: 12pt; }
        .btn-print:hover { background-color: #0056b3; }
        
        @media print {
            .btn-print { display: none !important; }
            .document-container { margin: 0; }
            @page { size: landscape; margin: 10mm; }
        }
    </style>
</head>
<body>

<button class="btn-print" onclick="window.print()">🖨️ Print Report</button>

<div class="document-container">

    <!-- Standard Header Included -->
    <?php include('header_print_letterHead.php'); ?>

    <div class="header-title">
        PERSONNEL CUSTOM REPORT <?php echo htmlspecialchars($report_title_suffix); ?>
    </div>

    <?php 
    // Render Function to avoid repeating HTML
    function render_table($rows, $cols, $table_headers, $col_map) {
        echo "<table class='table-custom'><thead><tr>";
        echo "<th style='width: 30px;'>NO.</th>";
        foreach ($table_headers as $th) {
            echo "<th>" . htmlspecialchars($th) . "</th>";
        }
        echo "</tr></thead><tbody>";
        
        $ctr = 1;
        if (count($rows) === 0) {
            echo "<tr><td colspan='".(count($cols)+1)."' style='text-align: center;'>No personnel found in this category.</td></tr>";
        }
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td style='text-align: center;'>".$ctr++."</td>";
            foreach ($cols as $c) {
                if ($c === 'dob') {
                    $dob = ($row['bdMM'] && $row['bdDD'] && $row['bdYYYY']) ? $row['bdMM'] . '/' . $row['bdDD'] . '/' . $row['bdYYYY'] : '';
                    echo "<td>" . htmlspecialchars($dob) . "</td>";
                } elseif ($c === 'fullname') {
                    echo "<td style='font-weight: bold;'>" . htmlspecialchars($row['full_name']) . "</td>";
                } elseif ($c === 'salary_grade') {
                    echo "<td>" . htmlspecialchars($row['sg_step']) . "</td>";
                } else {
                    $sql_field = preg_replace('/^[a-z]+\./', '', $col_map[$c]['sql']); 
                    if (strpos($sql_field, ' as ') !== false) {
                        $parts = explode(' as ', $sql_field);
                        $sql_field = trim($parts[1]);
                    }
                    echo "<td>" . htmlspecialchars($row[$sql_field] ?? '') . "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

    // Render Multi-table or Single-table
    if ($grouping_column !== "") {
        // Multi-table mode
        $grouped_data = [];
        foreach ($results as $row) {
            $grp_val = $row[$grouping_column] ? $row[$grouping_column] : "UNASSIGNED";
            $grouped_data[$grp_val][] = $row;
        }

        foreach ($grouped_data as $group_name => $rows) {
            echo "<div class='group-header'>$group_name</div>";
            render_table($rows, $cols, $table_headers, $col_map);
        }
    } else {
        // Single table mode
        render_table($results, $cols, $table_headers, $col_map);
    }
    ?>
</div>

</body>
</html>
