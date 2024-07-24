<?php
require_once '../models/Game.php';

class GameController {
    public function play() {
        $mode = isset($_GET['mode']) ? $_GET['mode'] : 'flag';
        $game = new Game($mode);
        include '../views/game.php';
    }
}
?>
