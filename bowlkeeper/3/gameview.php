<?php
include '../2/conn.php'; // Include the connection file

// Retrieve the game ID from the URL
$game_id = isset($_GET['game']) ? intval($_GET['game']) : null;

if ($game_id === null) {
    // No game ID provided, show a message
    echo "Please Select A Game";
} else {
    // SQL query
    $sql = "
    SELECT
        L.name AS league_name,
        S.name AS season_name,
        G.date AS game_date,
        G.week AS game_week,
        G.name AS game_name,
        Sc.game_set AS game_set,
        T1.name AS team1_name,
        T2.name AS team2_name,
        P.name AS player_name,
        T.name AS player_team_name,
        CASE 
            WHEN Sc.f1a = 10 THEN 'strike'
            WHEN Sc.f1s = 1 AND Sc.f1a + Sc.f1b = 10 THEN 'spare split'
            WHEN Sc.f1a + Sc.f1b = 10 THEN 'spare'
            WHEN Sc.f1s = 1 THEN 'split'
            ELSE 'normalball'
        END AS f1s_class,
        CASE 
            WHEN Sc.f2a = 10 THEN 'strike'
            WHEN Sc.f2s = 1 AND Sc.f2a + Sc.f2b = 10 THEN 'spare split'
            WHEN Sc.f2a + Sc.f2b = 10 THEN 'spare'
            WHEN Sc.f2s = 1 THEN 'split'
            ELSE 'normalball'
        END AS f2s_class,
        CASE 
            WHEN Sc.f3a = 10 THEN 'strike'
            WHEN Sc.f3s = 1 AND Sc.f3a + Sc.f3b = 10 THEN 'spare split'
            WHEN Sc.f3a + Sc.f3b = 10 THEN 'spare'
            WHEN Sc.f3s = 1 THEN 'split'
            ELSE 'normalball'
        END AS f3s_class,
        CASE 
            WHEN Sc.f4a = 10 THEN 'strike'
            WHEN Sc.f4s = 1 AND Sc.f4a + Sc.f4b = 10 THEN 'spare split'
            WHEN Sc.f4a + Sc.f4b = 10 THEN 'spare'
            WHEN Sc.f4s = 1 THEN 'split'
            ELSE 'normalball'
        END AS f4s_class,
        CASE 
            WHEN Sc.f5a = 10 THEN 'strike'
            WHEN Sc.f5s = 1 AND Sc.f5a + Sc.f5b = 10 THEN 'spare split'
            WHEN Sc.f5a + Sc.f5b = 10 THEN 'spare'
            WHEN Sc.f5s = 1 THEN 'split'
            ELSE 'normalball'
        END AS f5s_class,
        CASE 
            WHEN Sc.f6a = 10 THEN 'strike'
            WHEN Sc.f6s = 1 AND Sc.f6a + Sc.f6b = 10 THEN 'spare split'
            WHEN Sc.f6a + Sc.f6b = 10 THEN 'spare'
            WHEN Sc.f6s = 1 THEN 'split'
            ELSE 'normalball'
        END AS f6s_class,
        CASE 
            WHEN Sc.f7a = 10 THEN 'strike'
            WHEN Sc.f7s = 1 AND Sc.f7a + Sc.f7b = 10 THEN 'spare split'
            WHEN Sc.f7a + Sc.f7b = 10 THEN 'spare'
            WHEN Sc.f7s = 1 THEN 'split'
            ELSE 'normalball'
        END AS f7s_class,
        CASE 
            WHEN Sc.f8a = 10 THEN 'strike'
            WHEN Sc.f8s = 1 AND Sc.f8a + Sc.f8b = 10 THEN 'spare split'
            WHEN Sc.f8a + Sc.f8b = 10 THEN 'spare'
            WHEN Sc.f8s = 1 THEN 'split'
            ELSE 'normalball'
        END AS f8s_class,
        CASE 
            WHEN Sc.f9a = 10 THEN 'strike'
            WHEN Sc.f9s = 1 AND Sc.f9a + Sc.f9b = 10 THEN 'spare split'
            WHEN Sc.f9a + Sc.f9b = 10 THEN 'spare'
            WHEN Sc.f9s = 1 THEN 'split'
            ELSE 'normalball'
        END AS f9s_class,
        CASE 
            WHEN Sc.f10a = 10 THEN 'strike'
            WHEN Sc.f10as = 1 THEN 'split'
            ELSE 'normalball'
        END AS f10as_class,
        CASE 
            WHEN Sc.f10b = 10 THEN 'strike'
            WHEN Sc.f10a + Sc.f10b = 10 AND Sc.f10a != 10 THEN 'spare'
            WHEN Sc.f10bs = 1 THEN 'split'
            ELSE 'normalball'
        END AS f10bs_class,
        CASE 
            WHEN Sc.f10c = 10 THEN 'strike'
            WHEN Sc.f10b + Sc.f10c = 10 THEN 'spare'
            WHEN Sc.f10cs = 1 THEN 'split'
            WHEN Sc.f10cs = 1 AND Sc.f10b + Sc.f10c = 10 THEN 'spare split'
            ELSE 'normalball'
        END AS f10cs_class,
CASE WHEN Sc.f1a = 10 THEN 'X' ELSE Sc.f1a END AS f1a_display,
CASE 
    WHEN Sc.f1a + Sc.f1b = 10 AND Sc.f1a != 10 THEN '/' 
    WHEN Sc.f1a = 10 AND Sc.f1b = 0 THEN '&nbsp;'
    ELSE Sc.f1b 
END AS f1b_display,
Sc.f1score,
CASE WHEN Sc.f2a = 10 THEN 'X' ELSE Sc.f2a END AS f2a_display,
CASE 
    WHEN Sc.f2a + Sc.f2b = 10 AND Sc.f2a != 10 THEN '/' 
    WHEN Sc.f2a = 10 AND Sc.f2b = 0 THEN '&nbsp;'
    ELSE Sc.f2b 
END AS f2b_display,
Sc.f2score,
CASE WHEN Sc.f3a = 10 THEN 'X' ELSE Sc.f3a END AS f3a_display,
CASE 
    WHEN Sc.f3a + Sc.f3b = 10 AND Sc.f3a != 10 THEN '/' 
    WHEN Sc.f3a = 10 AND Sc.f3b = 0 THEN '&nbsp;'
    ELSE Sc.f3b 
END AS f3b_display,
Sc.f3score,
CASE WHEN Sc.f4a = 10 THEN 'X' ELSE Sc.f4a END AS f4a_display,
CASE 
    WHEN Sc.f4a + Sc.f4b = 10 AND Sc.f4a != 10 THEN '/' 
    WHEN Sc.f4a = 10 AND Sc.f4b = 0 THEN '&nbsp;'
    ELSE Sc.f4b 
END AS f4b_display,
Sc.f4score,
CASE WHEN Sc.f5a = 10 THEN 'X' ELSE Sc.f5a END AS f5a_display,
CASE 
    WHEN Sc.f5a + Sc.f5b = 10 AND Sc.f5a != 10 THEN '/' 
    WHEN Sc.f5a = 10 AND Sc.f5b = 0 THEN '&nbsp;'
    ELSE Sc.f5b 
END AS f5b_display,
Sc.f5score,
CASE WHEN Sc.f6a = 10 THEN 'X' ELSE Sc.f6a END AS f6a_display,
CASE 
    WHEN Sc.f6a + Sc.f6b = 10 AND Sc.f6a != 10 THEN '/' 
    WHEN Sc.f6a = 10 AND Sc.f6b = 0 THEN '&nbsp;'
    ELSE Sc.f6b 
END AS f6b_display,
Sc.f6score,
CASE WHEN Sc.f7a = 10 THEN 'X' ELSE Sc.f7a END AS f7a_display,
CASE 
    WHEN Sc.f7a + Sc.f7b = 10 AND Sc.f7a != 10 THEN '/' 
    WHEN Sc.f7a = 10 AND Sc.f7b = 0 THEN '&nbsp;'
    ELSE Sc.f7b 
END AS f7b_display,
Sc.f7score,
CASE WHEN Sc.f8a = 10 THEN 'X' ELSE Sc.f8a END AS f8a_display,
CASE 
    WHEN Sc.f8a + Sc.f8b = 10 AND Sc.f8a != 10 THEN '/' 
    WHEN Sc.f8a = 10 AND Sc.f8b = 0 THEN '&nbsp;'
    ELSE Sc.f8b 
END AS f8b_display,
Sc.f8score,
CASE WHEN Sc.f9a = 10 THEN 'X' ELSE Sc.f9a END AS f9a_display,
CASE 
    WHEN Sc.f9a + Sc.f9b = 10 AND Sc.f9a != 10 THEN '/' 
    WHEN Sc.f9a = 10 AND Sc.f9b = 0 THEN '&nbsp;'
    ELSE Sc.f9b 
END AS f9b_display,
Sc.f9score,
        CASE WHEN Sc.f10a = 10 THEN 'X' ELSE Sc.f10a END AS f10a_display,
        CASE 
            WHEN Sc.f10b = 10 THEN 'X'
            WHEN Sc.f10a + Sc.f10b = 10 AND Sc.f10a != 10 THEN '/'
            ELSE Sc.f10b
        END AS f10b_display,
        CASE 
            WHEN Sc.f10a = 10 AND Sc.f10b + Sc.f10c = 10 THEN '/' 
            WHEN Sc.f10c = 10 THEN 'X'
            WHEN Sc.f10a + Sc.f10b < 10 AND Sc.f10c = 0 THEN '&nbsp;'
            ELSE Sc.f10c
        END AS f10c_display,
        Sc.f10scorea, Sc.f10scoreb, Sc.f10scorec
    FROM
        Scores Sc
        INNER JOIN Games G ON Sc.game_id = G.id
        INNER JOIN Seasons S ON G.season_id = S.id
        INNER JOIN Leagues L ON S.league_id = L.id
        INNER JOIN Players P ON Sc.player_id = P.id
        INNER JOIN PlayerTeamRel PTR ON P.id = PTR.player_id
        INNER JOIN Teams T ON PTR.team_id = T.id
        INNER JOIN Teams T1 ON G.team1_id = T1.id
        INNER JOIN Teams T2 ON G.team2_id = T2.id
    WHERE
        G.id = :game_id
    ORDER BY
        P.name;
    ";

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
                        <th>Player Name</th>
                        <th>Player Team Name</th>
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
