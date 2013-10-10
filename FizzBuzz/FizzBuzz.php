<?php

class Problem {

    public $A;
    public $B;
    public $N;

    public function __construct(
        $A,
        $B,
        $N
    ) {
        $this->A = $A;
        $this->B = $B;
        $this->N = $N;
    }

}

class ProblemReader {

    private $theFile;

    public function __construct(
        $inputFile
    ) {
        $this->theFile = $inputFile;
    }

    public function getProblems(
    ) {
        $problems = array();
        foreach (file($this->theFile) as $line) {
            $problems []= $this->createProblemFromLine($line);
        }
        return $problems;
    }

    private function createProblemFromLine(
        $line
    ) {
        list($A, $B, $N) = explode(" ", $line);
        return new Problem($A, $B, $N);
    }

}

class KnowledgeAbout {

    private $theNumber;

    public function __construct(
        $aNumber
    ) {
        $this->theNumber = $aNumber;
    }

    public function multipleOf(
        $anotherNumber
    ) {
        return ($this->theNumber % $anotherNumber == 0);
    }

}

class Mathematician {

    public function is(
        $aNumber
    ) {
        return new KnowledgeAbout($aNumber);
    }

}

class PlayerKnowledge {

    public $myNumber = NULL;
    public $theProblem = NULL;
    public $theOneWhoListens = NULL;
    public $didntSayAnything = true;

}

class Player {

    public $knowledge;
    private $myFriendTheMathematician;

    public function Player(
    ) {
        $this->knowledge = new PlayerKnowledge();
        $this->myFriendTheMathematician = new Mathematician();
    }

    public function tellUs(
    ) {
        $this->askForHelpWithMaths();
        $this->speakNowOrShutUpForever();
    }

    private function askForHelpWithMaths(
    ) {
        $pepe = $this->myFriendTheMathematician;
        $myNumber = $this->knowledge->myNumber;
        $theProblem = $this->knowledge->theProblem;

        if ($pepe->is($myNumber)->multipleOf($theProblem->A)) {
            $this->say("F");
        }
        if ($pepe->is($myNumber)->multipleOf($theProblem->B)) {
            $this->say("B");
        }
    }

    private function speakNowOrShutUpForever(
    ) {
        if ($this->knowledge->didntSayAnything) {
            $this->say($this->knowledge->myNumber);
        }
        $this->passTurn();
    }

    private function say(
        $what
    ) {
        $this->knowledge->theOneWhoListens->I_say($what);
        $this->rememberThatISaidSomething();
    }

    private function rememberThatISaidSomething(
    ) {
        $this->knowledge->didntSayAnything = false;
    }

    private function passTurn(
    ) {
        $this->knowledge->theOneWhoListens->I_ended();
    }

}

class PlayerBuilder {

    public static function buildPlayers(
        $theProblem,
        $theOutput
    ) {
        $players = array();
        for ($i = 1; $i <= $theProblem->N; $i++) {
            $player = new Player();
            $player->knowledge->myNumber = $i;
            $player->knowledge->theProblem = $theProblem;
            $player->knowledge->theOneWhoListens = $theOutput;
            $players []= $player;
        }
        return $players;
    }

}

class OutputBuffer {

    public $data;

    public function __construct(
    ) {
        $this->reset();
    }

    public function add(
        $item
    ) {
        $this->data []= $item;
    }

    public function reset(
    ) {
        $this->data = array();
    }

    public function toString(
    ) {
        return implode(" ", $this->data);
    }

}

class OutputFormatter {

    private $buffer;
    private $whatIheard;
    private $printer;

    public function __construct(
        $printDevice
    ) {
        $this->buffer = new OutputBuffer();
        $this->printer = $printDevice;
    }

    public function startProblemOutput(
    ) {
        $this->whatIheard = "";
        $this->buffer->reset();
    }

    public function endProblemOutput(
    ) {
        $this->printProblemSolution();
    }

    private function printProblemSolution(
    ) {
        $this->printer->write($this->buffer->toString());
    }

    public function I_say(
        $what
    ) {
        $this->whatIheard .= $what;
    }

    public function I_ended(
    ) {
        $this->buffer->add($this->whatIheard);
        $this->forgetWhatIHeard();
    }

    private function forgetWhatIHeard(
    ) {
        $this->whatIheard = "";
    }

}

class Console {

    public function write(
        $what
    ) {
        echo $what;
        echo "\n";
    }

}

class ProblemSolver {

    private $whereToPrint;
    private $players;

    public function __construct(
        $whereToPrint
    ) {
        $this->whereToPrint = $whereToPrint;
    }

    public function solve(
        $theProblem
    ) {
        $this->gatherPlayersForProblem($theProblem);
        $this->play();
    }

    private function gatherPlayersForProblem(
        $theProblem
    ) {
        $this->players = PlayerBuilder::buildPlayers($theProblem, $this->whereToPrint);
    }

    private function play(
    ) {
        $this->whereToPrint->startProblemOutput();
        $this->makePlayersPlay();
        $this->whereToPrint->endProblemOutput();
    }

    private function makePlayersPlay(
    ) {
        foreach ($this->players as $player) {
            $player->tellUs($this->whereToPrint);
        }
    }

}

$theFile = $argv[1];

$theReader = new ProblemReader($theFile);
$theInput = $theReader->getProblems();
$theSolver = new ProblemSolver(new OutputFormatter(new Console()));

foreach ($theInput as $aProblem) {
    $theSolver->solve($aProblem);
}
