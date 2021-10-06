/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * SayAnythingMU implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * sayanythingmu.js
 *
 * SayAnythingMU user interface script
 * 
 * In this file, you are describing the logic of your user interface, in Javascript language.
 *
 */

define([
    "dojo","dojo/_base/declare",
    "ebg/core/gamegui",
    "ebg/counter"
],
function (dojo, declare) {
    return declare("bgagame.sayanythingmu", ebg.core.gamegui, {
        constructor: function(){
            console.log('sayanythingmu constructor');
              
            // Here, you can init the global variables of your user interface
            // Example:
            // this.myGlobalValue = 0;

        },
        
        /*
            setup:
            
            This method must set up the game user interface according to current game situation specified
            in parameters.
            
            The method is called each time the game interface is displayed to a player, ie:
            _ when the game starts
            _ when a player refreshes the game page (F5)
            
            "gamedatas" argument contains all datas retrieved by your "getAllDatas" PHP method.
        */
        
        setup: function( gamedatas )
        {
            console.log( "Starting game setup" );
            
            // Setting up player boards
            for( var player_id in gamedatas.players )
            {
                var player = gamedatas.players[player_id];
                         
                // TODO: Setting up players boards if needed
            }
            
            // TODO: Set up your game interface here, according to "gamedatas"
            
            // Make option buttons clickable for selecting which card question
            this.addEventToClass("optionButton", "onclick", "onClickOption");
	    // Make buttons not transparent on mouse enter/leave
            this.addEventToClass("optionButton", "onmouseenter", "onMouseEnterOption");
            this.addEventToClass("optionButton", "onmouseleave", "onMouseLeaveOption");
             // Make response buttons clickable
            this.addEventToClass("responseButton", "onclick", "onClickResponse");

            document.getElementById("O1").style.opacity = "0";
            document.getElementById("O2").style.opacity = "0";
            document.getElementById("O3").style.opacity = "0";
            document.getElementById("O4").style.opacity = "0";
            document.getElementById("O5").style.opacity = "0";

            // Change center card to be random
            // document.getElementById('center_card').style.backgroundImage = "url('sayanythingmu/img/Page_01.png')";

            //document.getElementById('center_card').classList.add("card" + Math.floor(Math.random()*81));
	    //document.getElementById('center_card').style.backgroundPosition = "0px " + (Math.floor(Math.random()*80) * -143.1) + "px";

	    //conslole.log("card" + Math.floor(Math.random()*81));

            // Setup game notifications to handle (see "setupNotifications" method below)
            this.setupNotifications();

            console.log( "Ending game setup" );
        },
       
        onMouseEnterOption: function( evt )
        {
		if (this.isCurrentPlayerActive()) {
			// Change button to be not transparent
			evt.srcElement.style.opacity = "0.68";
		}
	},

        onMouseLeaveOption: function( evt )
        {
		// Change button to be not transparent
		evt.srcElement.style.opacity = "0";
	},

        // Click option (for selecting card question)
        onClickOption: function( evt )
        {
		console.log("Option chosen");
		console.log(evt.srcElement.id);
		console.log("Button num: " + evt.srcElement.getAttribute("buttonNum"));
		// Check if active player
		if (this.isCurrentPlayerActive()) {
			// Hide buttons
			//$(".options").hide();
			// Make ajax call
			this.ajaxcall( "/sayanythingmu/sayanythingmu/SelectQuestion.html", {question: evt.srcElement.getAttribute("buttonNum"), card: 1}, this, function( result ) {}, function( is_error ) {} );

		}
		
	},

        // Click Response
        onClickResponse: function( evt )
        {
		console.log("Response chosen");
		console.log(evt.srcElement.innerHTML);
		console.log(evt.srcElement.getAttribute("playerNum"));
		var theNum = parseInt(evt.srcElement.id);
		// Check if active player
		if (this.isCurrentPlayerActive()) {
			// Make ajax call
			this.ajaxcall( "/sayanythingmu/sayanythingmu/SelectPlayerResponse.html", {response: evt.srcElement.getAttribute("playerNum")}, this, function( result ) {}, function( is_error ) {} );

		}
		
	},

        ///////////////////////////////////////////////////
        //// Game & client states
        
        // onEnteringState: this method is called each time we are entering into a new game state.
        //                  You can use this method to perform some user interface changes at this moment.
        //
        onEnteringState: function( stateName, args )
        {
            console.log( 'Entering state: '+stateName );
            console.log(args);

            switch( stateName )
            {
		case 'playerTurnSelectQuestion':
			document.getElementById('center_card').style.backgroundPosition = "0px " + (parseInt(args.args.chosenCard) * -143.1) + "px";
			break;
                case 'playerTurnQuestionResponse':
		            // Hide options
                    console.log("player turn question response case");

                    document.getElementById("O1").style.opacity = "0";
                    document.getElementById("O2").style.opacity = "0";
                    document.getElementById("O3").style.opacity = "0";
                    document.getElementById("O4").style.opacity = "0";
                    document.getElementById("O5").style.opacity = "0";

                    

                    document.getElementById("O" + args.args.chosenQuestion).style.opacity = "0.68";
		            //document.getElementById("options").style.display = "none";
		            //document.getElementById("center_card").style.display = "none"; //.style.backgroundImage = "";

		            break;
                    /* Example:
            
                    case 'myGameState':
            
                        // Show some HTML block at this game state
                        dojo.style( 'my_html_block_id', 'display', 'block' );
                
                        break;
                   */
           
           
                case 'dummmy':
                    break;
            }
        },

        // onLeavingState: this method is called each time we are leaving a game state.
        //                 You can use this method to perform some user interface changes at this moment.
        //
        onLeavingState: function( stateName )
        {
            console.log( 'Leaving state: '+stateName );
            
            switch( stateName )
            {
            
            /* Example:
            
            case 'myGameState':
            
                // Hide the HTML block we are displaying only during this game state
                dojo.style( 'my_html_block_id', 'display', 'none' );
                
                break;
           */
           
           
            case 'dummmy':
                break;
            }               
        }, 

        // onUpdateActionButtons: in this method you can manage "action buttons" that are displayed in the
        //                        action status bar (ie: the HTML links in the status bar).
        //        
        onUpdateActionButtons: function( stateName, args )
        {
            console.log( 'onUpdateActionButtons: '+stateName );
                            
                switch( stateName )
                {     
                 case 'playerTurnQuestionResponse':
                    this.addActionButton( 'button_1_id', _('Submit'), 'saveAnswer'); 
                    break;
                }
        },        

        ///////////////////////////////////////////////////
        //// Utility methods
        
        /*
        
            Here, you can defines some utility methods that you can use everywhere in your javascript
            script.
        
        */

	// when called simply slides the token to its destination
	moveTokenOnTable : function(player_id, token_id, destination_player_id)
	{

            this.slideToObject( token_id, 'player_'+destination_player_id ).play();
        },


        ///////////////////////////////////////////////////
        //// Player's action
        
        /*
        
            Here, you are defining methods to handle player's action (ex: results of mouse click on 
            game objects).
            
            Most of the time, these methods:
            _ check the action is possible at this game state.
            _ make a call to the game server
        
        */
        
        
        saveAnswer: function( evt )
        {       
		this.ajaxcall( "/sayanythingmu/sayanythingmu/postResponse.html", {response: evt.srcElement.getAttribute("playerNum")}, this, function( result ) {}, function( is_error ) {} );
		
        },        
        


        
        ///////////////////////////////////////////////////
        //// Reaction to cometD notifications

        /*
            setupNotifications:
            
            In this method, you associate each of your game notifications with your local method to handle it.
            
            Note: game notification names correspond to "notifyAllPlayers" and "notifyPlayer" calls in
                  your sayanythingmu.game.php file.
        
        */
        setupNotifications: function()
        {
            console.log( 'notifications subscriptions setup' );
            
            // TODO: here, associate your game notifications with local methods
            
            // Example 1: standard notification handling
            // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );
            
            // Example 2: standard notification handling + tell the user interface to wait
            //            during 3 seconds after calling the method in order to let the players
            //            see what is happening in the game.
            // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );
            // this.notifqueue.setSynchronous( 'cardPlayed', 3000 );
            // 
        },  
        
        // TODO: from this point and below, you can write your game notifications handling methods
        
        /*
        Example:
        
        notif_cardPlayed: function( notif )
        {
            console.log( 'notif_cardPlayed' );
            console.log( notif );
            
            // Note: notif.args contains the arguments specified during you "notifyAllPlayers" / "notifyPlayer" PHP call
            
            // TODO: play the card in the user interface.
        },    
        
        */
   });             
});
