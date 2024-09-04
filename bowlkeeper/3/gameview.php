<?php
include '../2/conn.php'; // Include the connection file

// Retrieve the game ID from the URL
$game_id = isset($_GET['game']) ? intval($_GET['game']) : null;

if ($game_id === null) {
    // No game ID provided, show a message
    echo "Please Select A Game";
} else {
    // Load the SQL query from the external file
    $sql = file_get_contents('gameview.sql');

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            // Get common values from the first row
            $first_row = $results[0];

            // Display common values above the table
            echo "<div class='gameblock'>";
            echo "{$first_row['league_name']} - {$first_row['season_name']}<br>";
            echo "Week: {$first_row['game_week']} - {$first_row['game_name']}<br>{$first_row['game_date']}<br>";
            echo "{$first_row['team1_name']} -VS - {$first_row['team2_name']}";

            // Display the table header
            echo "<table>
                    <tr>
                        <th>Set</th>
                        <th>Player</th>
                        <th>Team</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                    </tr>";

            $row_count = 0; // Initialize row count variable

            // Iterate through the results
            foreach ($results as $row) {
                $row_count++; // Increment row count

                // Apply classes based on row count for table row
                $row_class = ($row_count % 2 == 0) ? "yella" : "white";

                echo "<tr class='$row_class'>
                        <td>{$row['game_set']}</td>
                        <td>{$row['player_name']}</td>
                        <td>{$row['player_team_name']}</td>
                        
                        <td class='{$row['f1s_class']}'>{$row['f1a_display']} | {$row['f1b_display']}<br>{$row['f1score']}</td>
                        <td class='{$row['f2s_class']}'>{$row['f2a_display']} | {$row['f2b_display']}<br>{$row['f2score']}</td>
                        <td class='{$row['f3s_class']}'>{$row['f3a_display']} | {$row['f3b_display']}<br>{$row['f3score']}</td>
                        <td class='{$row['f4s_class']}'>{$row['f4a_display']} | {$row['f4b_display']}<br>{$row['f4score']}</td>
                        <td class='{$row['f5s_class']}'>{$row['f5a_display']} | {$row['f5b_display']}<br>{$row['f5score']}</td>
                        <td class='{$row['f6s_class']}'>{$row['f6a_display']} | {$row['f6b_display']}<br>{$row['f6score']}</td>
                        <td class='{$row['f7s_class']}'>{$row['f7a_display']} | {$row['f7b_display']}<br>{$row['f7score']}</td>
                        <td class='{$row['f8s_class']}'>{$row['f8a_display']} | {$row['f8b_display']}<br>{$row['f8score']}</td>
                        <td class='{$row['f9s_class']}'>{$row['f9a_display']} | {$row['f9b_display']}<br>{$row['f9score']}</td>
                        <td>
                            <table>
                                <tr>
                                    <td class='{$row['f10as_class']}'>{$row['f10a_display']}<br>{$row['f10scorea']}</td>
                                    <td class='{$row['f10bs_class']}'>{$row['f10b_display']}<br>{$row['f10scoreb']}</td>
                                    <td class='{$row['f10cs_class']}'>{$row['f10c_display']}<br>{$row['f10scorec']}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>";
            }

            echo "</table>";
            echo "</div>";
        } else {
            echo "No results found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
