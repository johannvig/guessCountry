<?php
require_once '../utils/RestCountriesAPI.php';
require_once '../utils/Database.php';

class Game {
    private $mode;

    public function __construct($mode) {
        $this->mode = $mode;
    }

    public function generateQuestion() {
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

        switch ($this->mode) {
            case 'flag':
                $question = "Which country does this flag belong to?";
                $correctAnswer = $questionCountry['name']['common'];
                $imageSrc = isset($questionCountry['flags']['png']) ? $questionCountry['flags']['png'] : '';
                $questionHTML = "<div class='question'><img src='$imageSrc' alt='Flag of $correctAnswer' width='200'></div>";
                break;

            case 'currency':
                $question = "What is the currency of {$questionCountry['name']['common']}?";
                $correctAnswer = isset($questionCountry['currencies']) ? implode(', ', array_column($questionCountry['currencies'], 'name')) : 'Unknown';
                $questionHTML = "<div class='question'><p>$question</p></div>";
                break;

            case 'language':
                $question = "What is the official language of {$questionCountry['name']['common']}?";
                $correctAnswer = isset($questionCountry['languages']) ? implode(', ', array_values($questionCountry['languages'])) : 'Unknown';
                $questionHTML = "<div class='question'><p>$question</p></div>";
                break;

            case 'location':
                $question = "Which country is located at the coordinates ({$questionCountry['latlng'][0]}, {$questionCountry['latlng'][1]})?";
                $correctAnswer = $questionCountry['name']['common'];
                $questionHTML = "<div class='question'><p>$question</p></div>";
                break;

            case 'capital':
                $question = "What is the capital of {$questionCountry['name']['common']}?";
                $correctAnswer = isset($questionCountry['capital']) ? $questionCountry['capital'][0] : 'Unknown';
                $questionHTML = "<div class='question'><p>$question</p></div>";
                break;

            default:
                $question = "Invalid game mode selected.";
                $correctAnswer = "";
                $questionHTML = "<div class='question'><p>$question</p></div>";
                break;
        }

        $optionsHTML = "<ul class='options'>";
        foreach ($options as $option) {
            switch ($this->mode) {
                case 'flag':
                case 'location':
                    $optionsHTML .= "<li><label><input type='radio' name='answer' value='{$option['name']['common']}' required> {$option['name']['common']}</label></li>";
                    break;

                case 'currency':
                    $currency = isset($option['currencies']) ? implode(', ', array_column($option['currencies'], 'name')) : 'Unknown';
                    $optionsHTML .= "<li><label><input type='radio' name='answer' value='$currency' required> $currency</label></li>";
                    break;

                case 'language':
                    $language = isset($option['languages']) ? implode(', ', array_values($option['languages'])) : 'Unknown';
                    $optionsHTML .= "<li><label><input type='radio' name='answer' value='$language' required> $language</label></li>";
                    break;

                case 'capital':
                    $capital = isset($option['capital']) ? $option['capital'][0] : 'Unknown';
                    $optionsHTML .= "<li><label><input type='radio' name='answer' value='$capital' required> $capital</label></li>";
                    break;
            }
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
}
?>
