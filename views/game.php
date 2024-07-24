<!DOCTYPE html>
<html>
<head>
    <title>Game</title>
    <link rel="stylesheet" type="text/css" href="../public/css/game.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showPopup(message) {
            alert(message);
        }

        function attachFormSubmitHandler() {
            $('#game-form').submit(function(event) {
                event.preventDefault();
                console.log('Submitting form...');
                $.ajax({
                    type: 'POST',
                    url: 'process_answer.php?mode=<?php echo isset($_GET['mode']) ? $_GET['mode'] : ''; ?>',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log('Response received:', response);
                        try {
                            const data = typeof response === 'string' ? JSON.parse(response) : response;
                            console.log('Parsed data:', data);
                            if (data.error) {
                                console.error(data.error);
                                alert('Error: ' + data.error);
                                return;
                            }
                            showPopup(data.message);
                            updateScore(data.score);
                            if (data.newQuestion) {
                                $('#game-content').html(data.newQuestion);
                                attachFormSubmitHandler(); // Réattacher le gestionnaire après mise à jour du contenu
                            } else {
                                $('#game-content').html('<div class="result">Game over! Your final score is ' + data.score + ' out of 10.</div>');
                                if (data.stats) {
                                    showStatsTable(data.stats);
                                }
                                showEndOptions();
                            }
                        } catch (e) {
                            console.error('Failed to parse JSON response:', response);
                            alert('An error occurred while processing your request. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error);
                        alert('An error occurred while processing your request. Please try again.');
                    }
                });
            });
        }

        function showStatsTable(stats) {
            console.log('Stats for table:', stats);
            let tableHTML = `
                <table class="stats-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>`;
            stats.forEach(stat => {
                tableHTML += `
                    <tr>
                        <td>${stat.date_played}</td>
                        <td>${stat.score}</td>
                    </tr>`;
            });
            tableHTML += `
                    </tbody>
                </table>`;
            $('#game-content').append(tableHTML);
        }

        function updateScore(score) {
            $('#score').text('Score: ' + score);
        }

        function showEndOptions() {
            $('#game-content').append(`
                <div class="button-container">
                    <button class="submit-button" onclick="window.location.href='index.php?action=play&mode=<?php echo isset($_GET['mode']) ? $_GET['mode'] : ''; ?>';">Restart</button>
                    <button class="submit-button" onclick="window.location.href='index.php';">Main Menu</button>
                </div>
            `);
        }

        $(document).ready(function() {
            attachFormSubmitHandler(); // Attacher le gestionnaire initialement
        });
    </script>


</head>
<body>
    <div class="container">
        <h1>Game Mode: <?php echo isset($_GET['mode']) ? ucfirst($_GET['mode']) : 'Unknown'; ?></h1>
        <div class="score" id="score">Score: 0</div>
        <div id="game-content">

            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            require_once '../utils/RestCountriesAPI.php';
            require_once '../utils/Database.php';

            if (!isset($_SESSION['score'])) {
                $_SESSION['score'] = 0;
                $_SESSION['question_count'] = 0;
            }

            if (isset($_GET['mode'])) {
                if ($_SESSION['question_count'] < 10) {  // Limite le nombre de questions
                    $game = new Game($_GET['mode']);
                    echo $game->generateQuestion();
                } else {
                    echo "<div class='result'>Game over! Your final score is {$_SESSION['score']} out of 10.</div>";

                    if (isset($_SESSION['user_id'])) {
                        $db = Database::getInstance();
                        $stats = $db->getGameStats($_SESSION['user_id'], $_GET['mode']);
                        echo "<div id='stats-container'></div>";
                        echo "<script>showStatsTable(" . json_encode($stats) . ");</script>";
                    }

                    echo "<script>showEndOptions();</script>";
                }
            } else {
                echo "<div class='result'>Invalid game mode selected.</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
