<?php
function displayJapaneseCars($csvFilePath) {
    // Check if file exists
    if (!file_exists($csvFilePath)) {
        echo "<p>Error: CSV file not found at: " . htmlspecialchars($csvFilePath) . "</p>";
        return;
    }
    
    // Open the CSV file
    $file = fopen($csvFilePath, 'r');
    if (!$file) {
        echo "<p>Error: Could not open CSV file.</p>";
        return;
    }
    
    echo "<h2>Japanese Cars from the 1970s</h2>";
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
    
    $isFirstRow = true;
    
    // Read CSV line by line
    while (($row = fgetcsv($file)) !== FALSE) {
        if ($isFirstRow) {
            // Display header row
            echo "<thead><tr style='background-color: #f2f2f2; font-weight: bold;'>";
            foreach ($row as $header) {
                echo "<th>" . htmlspecialchars($header) . "</th>";
            }
            echo "</tr></thead><tbody>";
            $isFirstRow = false;
        } else {
            // Display data rows
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
    }
    
    echo "</tbody></table>";
    fclose($file);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Japanese Cars from the 1970s</title>
<style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                background-color: #f9f9f9;
            }
            table {
                background-color: white;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                border-radius: 5px;
                overflow: hidden;
            }
            th {
                background-color: #4CAF50;
                color: white;
                text-align: left;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #e8f5e8;
            }
            h2 {
                color: #333;
                text-align: center;
            }
</style>    
</head>
<body>
<?php displayJapaneseCars($csvFilePath); ?>
</body>
</html>
