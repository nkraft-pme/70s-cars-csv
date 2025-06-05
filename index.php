<?php
function displayJapaneseCars($csvFilePath)
{
    // Check if file exists
    if (!file_exists($csvFilePath)) {
        echo '<p>Error: CSV file not found at: ' .
            htmlspecialchars($csvFilePath) .
            '</p>';
        return;
    }

    // Open the CSV file
    $file = fopen($csvFilePath, 'r');
    if (!$file) {
        echo '<p>Error: Could not open CSV file.</p>';
        return;
    }

    echo '<table class="table" >';

    $isFirstRow = true;

    // Read CSV line by line
    while (($row = fgetcsv($file)) !== false) {
        if ($isFirstRow) {
            // Display header row
            echo "<thead><tr>";
            foreach ($row as $header) {
                echo '<th>' . htmlspecialchars($header) . '</th>';
            }
            echo '<th>Image Search</th>';
            echo '</tr></thead><tbody>';
            $isFirstRow = false;
        } else {
            // Display data rows
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . htmlspecialchars($cell) . '</td>';
            }

            // Add Google image search link
            $modelName = $row[0];
            $manufacturer = $row[1];
            $year = $row[2];

            // Create search query
            $searchQuery = urlencode(
                $manufacturer . ' ' . $modelName . ' ' . $year
            );
            $googleImageUrl =
                'https://www.google.com/search?tbm=isch&q=' . $searchQuery;

            echo "<td><a class='image-link' href='" .
                $googleImageUrl .
                "' target='_blank'>Search Images</a></td>";
            echo '</tr>';
        }
    }

    echo '</tbody></table>';
    fclose($file);
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Japanese Cars from the 1970s</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Monoton&family=Roboto+Slab&family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">   
<link rel="stylesheet" href="styles.css" type="text/css" charset="utf-8" />
</head>
<body>
    <article>
        <h1 class="center">Vintage Japanese Cars of the 1970s</h1>
        <p class="center">As of the last few years, I find myself pre-occupied with material and industrial design of the 1970s. The deeper I dig into this fascination, the more I find that, in particular, I really enjoy the aesthetic of commercial goods manufactured in Japan from that era. This interest really began with audio gear, but has extended into the pretty remarkable automobiles that Japanese car makers produced and exported to the rest of the world.</p>
        <p class="center">This list represents some of the more notable Japanese makes and models from the 70s.</p>
        <?php displayJapaneseCars('japanese-cars-70s.csv'); ?>
    </article>
</body>
</html>
