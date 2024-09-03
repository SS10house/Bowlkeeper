<?php
include '2/conn.php'; // Include the connection file

// Verify that the connection is established
if (!$conn) {
    die("Database connection failed.");
}

// Fetch the list of games with league, season, and game details
$sql = "
    SELECT 
        G.id AS game_id,
        L.name AS league_name,
        S.name AS season_name,
        G.name AS game_name,
        G.date AS game_date
    FROM Games G
    INNER JOIN Seasons S ON G.season_id = S.id
    INNER JOIN Leagues L ON S.league_id = L.id
    ORDER BY G.date
";
$stmt = $conn->prepare($sql);
$stmt->execute();
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div>
    <form id="gameForm">
        <label for="gameSelect">Select a Game:</label>
        <select id="gameSelect" name="game">
            <option value="">-- Select a Game --</option>
            <?php foreach ($games as $game): ?>
                <option value="<?php echo $game['game_id']; ?>">
                    <?php echo "{$game['league_name']} - {$game['season_name']} - {$game['game_name']} - {$game['game_date']}"; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>
<br>
<div id="gameData"></div>

<script>
$(document).ready(function() {
    $('#gameSelect').change(function() {
        var gameId = $(this).val();
        if (gameId) {
            $.ajax({
                url: '3/gameview.php',
                type: 'GET',
                data: { game: gameId },
                success: function(data) {
                    $('#gameData').html(data);
                },
                error: function() {
                    $('#gameData').html('An error occurred while fetching the game data.');
                }
            });
        } else {
            $('#gameData').html('');
        }
    });
});
</script>