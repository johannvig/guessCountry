<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$response = [];

try {
    require_once '../utils/RestCountriesAPI.php';
    require_once '../utils/Database.php';

    function generateQuestion($mode) {
        $api = new RestCountriesAPI();
        $countries = $api->fetchCountries();
        $questionCountry = $countries[array_rand($countries)];
        $options = [$questionCountry];

        while (count($options) < 4) {
            $randomCountry = $countries[array_rand($countries)];
            if (!in_array($randomCountry, $options)) {
                $options[] = $randomCountry;
            }
        }

        shuffle($options);

        $question = '';
        $correctAnswer = '';
        $questionHTML = '';
        $optionsHTML = "<ul class='options'>";

        switch ($mode) {
            case 'flag':
                $question = "Which country does this flag belong to?";
                $correctAnswer = $questionCountry['name']['common'];
                $imageSrc = isset($questionCountry['flags']['png']) ? $questionCountry['flags']['png'] : '';
                $questionHTML = "<div class='question'><img src='$imageSrc' alt='Flag of $correctAnswer' width='200'></div>";
                foreach ($options as $option) {
                    $optionsHTML .= "<li><label><input type='radio' name='answer' value='{$option['name']['common']}' required> {$option['name']['common']}</label></li>";
                }
                break;

            case 'currency':
                $question = "What is the currency of {$questionCountry['name']['common']}?";
                $correctAnswer = isset($questionCountry['currencies']) ? implode(', ', array_column($questionCountry['currencies'], 'name')) : 'Unknown';
                $questionHTML = "<div class='question'><p>$question</p></div>";
                foreach ($options as $option) {
                    $currency = isset($option['currencies']) ? implode(', ', array_column($option['currencies'], 'name')) : 'Unknown';
                    $optionsHTML .= "<li><label><input type='radio' name='answer' value='$currency' required> $currency</label></li>";
                }
                break;

            case 'language':
                $question = "What is the official language of {$questionCountry['name']['common']}?";
                $correctAnswer = isset($questionCountry['languages']) ? implode(', ', array_values($questionCountry['languages'])) : 'Unknown';
                $questionHTML = "<div class='question'><p>$question</p></div>";
                foreach ($options as $option) {
                    $language = isset($option['languages']) ? implode(', ', array_values($option['languages'])) : 'Unknown';
                    $optionsHTML .= "<li><label><input type='radio' name='answer' value='$language' required> $language</label></li>";
                }
                break;

            case 'location':
                $question = "Which country is located at the coordinates ({$questionCountry['latlng'][0]}, {$questionCountry['latlng'][1]})?";
                $correctAnswer = $questionCountry['name']['common'];
                $questionHTML = "<div class='question'><p>$question</p></div>";
                foreach ($options as $option) {
                    $optionsHTML .= "<li><label><input type='radio' name='answer' value='{$option['name']['common']}' required> {$option['name']['common']}</label></li>";
                }
                break;

            case 'capital':
                $question = "What is the capital of {$questionCountry['name']['common']}?";
                $correctAnswer = isset($questionCountry['capital']) ? $questionCountry['capital'][0] : 'Unknown';
                $questionHTML = "<div class='question'><p>$question</p></div>";
                foreach ($options as $option) {
                    $capital = isset($option['capital']) ? $option['capital'][0] : 'Unknown';
                    $optionsHTML .= "<li><label><input type='radio' name='answer' value='$capital' required> $capital</label></li>";
                }
                break;

            default:
                $question = "Invalid game mode selected.";
                $correctAnswer = "";
                $questionHTML = "<div class='question'><p>$question</p></div>";
                break;
        }

        $optionsHTML .= "</ul>";

        $formHTML = "
            <form id='game-form' method='post'>
                $questionHTML
                $optionsHTML
                <input type='hidden' name='correct_answer' value='$correctAnswer'>
                <button type='submit' class='submit-button'>Submit</button>
            </form>
        ";

        return $formHTML;
    }

    if (!isset($_SESSION['question_count'])) {
        $_SESSION['question_count'] = 0;
    }

    if ($_SESSION['question_count'] == 0) {
        // Generate the first question but do not display it
        $mode = $_GET['mode'];
        generateQuestion($mode);
        $_SESSION['question_count']++;
    }

    $correctAnswer = $_POST['correct_answer'];
    $userAnswer = $_POST['answer'];

    if ($userAnswer == $correctAnswer) {
        $_SESSION['score']++;
        $response['message'] = "Correct! The answer is $correctAnswer.";
    } else {
        $response['message'] = "Wrong! The correct answer is $correctAnswer.";
    }
    $response['score'] = $_SESSION['score']; // Add this line to include the score in the response
    $_SESSION['question_count']++;

    if ($_SESSION['question_count'] <= 10) {
        ob_start();
        $mode = $_GET['mode'];
        echo generateQuestion($mode);
        $response['newQuestion'] = ob_get_clean();
    } else {
        // Save the game stats
        if (isset($_SESSION['user_id'])) {
            $db = Database::getInstance();
            $db->insertGameStats($_SESSION['user_id'], $_GET['mode'], $_SESSION['score']);
            // Fetch stats for the chart
            $response['stats'] = $db->getGameStats($_SESSION['user_id'], $_GET['mode']);
        }

        $response['newQuestion'] = false;
        $response['score'] = $_SESSION['score'];
        $_SESSION['score'] = 0; // Reset score for next game
        $_SESSION['question_count'] = 0; // Reset question count for next game
    }
} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>
