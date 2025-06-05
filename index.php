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
            echo "<thead><tr style='background-color: #f2f2f2; font-weight: bold;'>";
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

            echo "<td><a href='" .
                $googleImageUrl .
                "' target='_blank' style='color: #4CAF50; text-decoration: none;'>🔍 Images</a></td>";
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
<style>
body {
    background-color: #f9f9f9;
    color: #333;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 16px;
    line-height: 1.4;
    margin: 0;
    padding: 0;
}
article {
    width:100%;
    max-width:960px;
    margin: 2rem auto;
    padding: 1rem;
}
table {
    background-color: white;
    border-collapse: collapse;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    max-width:960px;
    overflow: hidden;
    width:100%;
}
th {
    background-color: #4CAF50;
    color: white;
    text-align: left;
}
th, td {
    padding:10px;
    margin:0;
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
h1 {
    font-family: "Monoton", sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 2.8rem;
    letter-spacing:.25rem;
    word-spacing:1rem;
}
.center {
    text-align:center;
}
.monoton-regular {
    font-family: "Monoton", sans-serif;
    font-weight: 400;
    font-style: normal;
}
.roboto-body {
    font-family: "Roboto", sans-serif;
    font-optical-sizing: auto;
    font-weight: 300;
    font-style: normal;
    font-variation-settings:"wdth" 100;
}
p {
    font-size:1.2rem;
    margin:0 0 2rem;
}

</style> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Monoton&family=Roboto+Slab&family=Roboto:ital,wght@0,300;1,300&display=swap" rel="stylesheet">   
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
