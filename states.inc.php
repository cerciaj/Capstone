<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * SayAnythingMU implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 * 
 * states.inc.php
 *
 * SayAnythingMU game states description
 *
 */

 
$machinestates = array(

    // The initial state. Please do not modify.
    1 => array(
        "name" => "gameSetup",
        "description" => "",
        "type" => "manager",
        "action" => "stGameSetup",
        "transitions" => array( "" => 2 )
    ),
    
    // The first state where starting player picks question 
    2 => array(
    		"name" => "playerTurnSelectQuestion",
    		"description" => clienttranslate('${actplayer} is the judge and must pick a question'),
    		"descriptionmyturn" => clienttranslate('${you} must pick a question'),
    		"type" => "activeplayer",
            "args" => "argSendQuestionCard",
    		"possibleactions" => array( "SelectQuestion"),
    		"transitions" => array( "SelectQuestion" => 3)
    ),
	
	// The second state where other players answer question
    3 => array(
    		"name" => "playerTurnQuestionResponse",
    		"description" => clienttranslate('Other players must answer question '),
    		"descriptionmyturn" => clienttranslate('${you} must answer question'),
    		"type" => "multiactiveplayer",
                "args" => "argSendQuestionData",
    		"possibleactions" => array( "QuestionResponse"),
		"action" => "st_MultiPlayerInit",
    		"transitions" => array( "QuestionResponse" => 4)
    ),
	

	// The third state where active player selects answer
    4 => array(
    		"name" => "playerTurnSelectPlayerResponse",
    		"description" => clienttranslate('${actplayer} must choose answer'),
    		"descriptionmyturn" => clienttranslate('${you} must choose answer'),
    		"type" => "activeplayer",
    		"possibleactions" => array( "SelectPlayerResponse"),
    		"transitions" => array( "SelectPlayerResponse" => 5)
    ),	
	
	// The fourth state where other players place tokens
    5 => array(
    		"name" => "playerTurnplaceTokens",
    		"description" => clienttranslate('$Other players must place tokens'),
    		"descriptionmyturn" => clienttranslate('${you} must place tokens'),
    		"type" => "multiactiveplayer",
    		"possibleactions" => array( "placeToken1", "placeToken2"),
    		"transitions" => array( "placeToken1" => 5, "placeToken2" => 6)
    ),

	// The fifth state where prompt is revealed
    6 => array(
        "name" => "selectionRevealed",
        "description" => clienttranslate("{selectedplayerresponse} is the winner for {question)"),
        "type" => "game",
        "action" => "selectionRevealed",
        "transitions" => array( "" => 2, "endGame" => 99)
    ),
	
	// The sixth state where game ends
    99 => array(
        "name" => "gameEnd",
        "description" => clienttranslate("End of game"),
        "type" => "game",
        "action" => "stGameEnd",
        "args" => "argGameEnd"
    )
);

