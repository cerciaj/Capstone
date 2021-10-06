{OVERALL_GAME_HEADER}

<!-- 
--------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- SayAnythingMU implementation : © <Your name here> <Your email address here>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-------

    sayanythingmu_sayanythingmu.tpl
    
    This is the HTML template of your game.
    
    Everything you are writing in this file will be displayed in the HTML page of your game user interface,
    in the "main game zone" of the screen.
    
    You can use in this template:
    _ variables, with the format {MY_VARIABLE_ELEMENT}.
    _ HTML block, with the BEGIN/END format
    
    See your "view" PHP file to check how to set variables and control blocks
    
    Please REMOVE this comment before publishing your game on BGA
-->
<head>
<link rel="stylesheet" href="sayanythingmu.css">

</head>


<body>
	<!-- Initial board -->

    <div class="board">
        <div id="0" class="player_0_board">
            <div rows="10" cols="30" id="response" value="Say Anything">
                <span id="token_id" class="dot"></span><span id="token_id" class="dot"></span>
            </div>
        </div>
        <div id="1" class="player_1_board">
            <div rows="10" cols="30" id="response" value="Say Anything">
                <span id="token_id" class="dot"></span><span id="token_id" class="dot"></span>
            </div>
        </div>
        <div id="2" class="player_2_board">
            <div rows="10" cols="30" id="response" value="Say Anything">
                <span id="token_id" class="dot"></span><span id="token_id" class="dot"></span>
            </div>
        </div>
        <div id="3" class="player_3_board">
            <div rows="10" cols="30" id="response" value="Say Anything">
		<span id="token_id" class="dot"></span><span id="token_id" class="dot"></span>
            </div>
        </div>
        <div id="center_card" class="center_card">
            <div id="options">
                <button class="optionButton" id="O1" buttonNum="1">&nbsp;</button>
                <br>
                <button class="optionButton" id="O2" buttonNum="2">&nbsp;</button>
                <br>
                <button class="optionButton" id="O3" buttonNum="3">&nbsp;</button>
                <br>
                <button class="optionButton" id="O4" buttonNum="4">&nbsp;</button>
                <br>
                <button class="optionButton" id="O5" buttonNum="5">&nbsp;</button>
            </div>
        </div>

        <div id="4" class="player_4_board">
            <div rows="10" cols="30" id="response" value="Say Anything">
                <span id="token_id" class="dot"></span><span id="token_id" class="dot"></span>
            </div>
        </div>

        <div id="5" class="player_5_board">
            <div rows="10" cols="30" id="response" value="Say Anything">
                <span id="token_id" class="dot"></span><span id="token_id" class="dot"></span>
            </div>
        </div>
        <div id="6" class="player_6_board">
            <div rows="10" cols="30" id="response" value="Say Anything">
                <span id="token_id" class="dot"></span><span id="token_id" class="dot"></span>
            </div>
        </div>
        <div id="7" class="player_7_board">
            <div rows="10" cols="30" id="response" value="Say Anything">
                <span id="token_id" class="dot"></span><span id="token_id" class="dot"></span>
            </div>
        </div>
    </div>

    <div>
        <textarea cols="125" rows="2" style="margin:auto" id="ans" maxlength="150"></textarea>
    </div>	
	<!-- Type response -->
	<div id="vote" class="vote">
		
	</div>
	
	
	
</body>
<script type="text/javascript">

	


// Javascript HTML templates

/*
// Example:
var jstpl_some_game_item='<div class="my_game_item" id="my_game_item_${MY_ITEM_ID}"></div>';

*/
var playerBoards = '<div rows="10" cols="30" id="response" value="Say Anything"></div'
var tokens = '<div id="token_{PID}"> <span id="token_id" class="dot"></span><span id="token_id" class="dot"></span></div>';
var judge = 3;

function seeBoard() {
	

}
//populate();
//isJudge(judge);
//function populate() {
//	var i = 8;
//	for (i = 0; i < 4; i++) {
//		var node = document.createElement("DIV");
//		node.setAttribute("id", i);
//		node.setAttribute("class", "player_"+i+"_board");
//		node.innerHTML = playerBoards + tokens;
//		document.getElementById("board").appendChild(node);
//	}
//	var node = document.createElement("DIV");
//	node.setAttribute("id", "center_card");
//	node.setAttribute("class", "center_card");
//	document.getElementById("board").appendChild(node);
//	
//	for (i = 4; i < 8; i++) {
//		var node = document.createElement("DIV");
//		node.setAttribute("id", i);
//		node.setAttribute("class", "player_"+i+"_board");
//		node.innerHTML = playerBoards + tokens;
//		document.getElementById("board").appendChild(node);
//	}
//}

function isJudge(judge) {
		var node = document.getElementById(judge);
		node.innerHTML = playerBoards + '<span id="token_id" class="judge"><p>JUDGE</p></span>';
		document.getElementById(judge).appendChild(node);
}
					

</script>  

{OVERALL_GAME_FOOTER}
