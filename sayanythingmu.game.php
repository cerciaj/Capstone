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
  * sayanythingmu.game.php
  *
  * This is the main file for your game logic.
  *
  * In this PHP file, you are going to defines the rules of the game.
  *
  */


require_once( APP_GAMEMODULE_PATH.'module/table/table.game.php' );


class SayAnythingMU extends Table
{
	function __construct( )
	{
        // Your global variables labels:
        //  Here, you can assign labels to global variables you are using for this game.
        //  You can use any number of global variables with IDs between 10 and 99.
        //  If your game has options (variants), you also have to associate here a label to
        //  the corresponding ID in gameoptions.inc.php.
        // Note: afterwards, you can get/set the global variables with getGameStateValue/setGameStateInitialValue/setGameStateValue
        parent::__construct();
        
        self::initGameStateLabels( array( 
            "round" => 10, 
	    "currentCard" => 11        
	) );   
      
        }
	
    protected function getGameName( )
    {
	// Used for translations and stuff. Please do not modify.
        return "sayanythingmu";
    }	

    /*
        setupNewGame:
        
        This method is called only once, when a new game is launched.
        In this method, you must setup the game according to the game rules, so that
        the game is ready to be played.
    */
    protected function setupNewGame( $players, $options = array() )
    {    
        // The number of colors defined here must correspond to the maximum number of players allowed for the games
        $gameinfos = self::getGameinfos();
        $default_colors = array( "#ec008c", "#bcbdc0", "#88c878", "#f1e100", "#00aeef", "#d0a96a", "#f36f21", "#84378b" );
 
        // Create players
        $sql = "INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar) VALUES ";
        $values = array();
        foreach( $players as $player_id => $player )
        {
            $color = array_shift( $default_colors );
            $values[] = "('".$player_id."','$color','".$player['player_canal']."','".addslashes( $player['player_name'] )."','".addslashes( $player['player_avatar'] )."')";
	}
		
        $sql .= implode( $values, ',' );
        self::DbQuery( $sql );
		
        self::reloadPlayersBasicInfos();
        self::reattributeColorsBasedOnPreferences( $players, $gameinfos['player_colors'] );
        self::reloadPlayersBasicInfos();
        
        /************ Start the game initialization *****/

        // Init global values with their initial values
        self::setGameStateInitialValue( 'round', 0 );
		
        // Init game statistics
        // (note: statistics used in this file must be defined in your stats.inc.php file)
        //self::initStat( 'table', 'table_teststat1', 0 );    // Init a table statistics
        //self::initStat( 'player', 'player_teststat1', 0 );  // Init a player statistics (for all players)

        // TODO: setup the initial game situation here

		// create and add cards to db

		{$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the most underrated place for a date?'", "'What\'s the dumbest thing to try to do in the dark?'", "'What\'s the best thing about being a celebrity?'", "'What can I do with just one finger?'", "'My last relationship would have gone a lot better if _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";
		self::DbQuery( $sql2 );

		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who would be the most interesting person to take a class from?'", "'I\'m in jail. Why?'", "'What should always be done by experts?'", "'On which TV show would I most want to guest star?'", "'Beauty fades, but _______ is forever.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which movie prop would be the coolest to own?'", "'What would be the worst idea for a themed wedding?'", "'What does Santa do every day other than Christmas?'", "'What would be the worst possible job?'", "'I could have been _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What website would the hardest to live without?'", "'What\'s the biggest waste of money?'", "'What should I do after I retire?'", "'What\'s the best way to impress a woman?'", "'I\'d be embarrassed if people found out I listened to _______'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which celebrity would be the most fun to hang out with?'", "'What\'s the best way to relax?'", "'A genie just granted me a wish. What should I ask for?'", "'What would be the weirdest job?'", "'Weekends are made for _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best way to spend a rainy day?'", "'Which animal would make the best shark replacement in a Jaws parody movie?'", "'What can a robot do better than a human?'", "'What would be the most inappropriate thing to have on your desk?'", "'I really love my new pet. It\'s a _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best video game of all time?'", "'What\'s the best excuse for forgetting your anniversary?'", "'What would be the coolest name for a band?'", "'What would be the worst thing to scream during church?'", "'There\'s no crying in _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best word in the English language?'", "'What would be the dumbest thing to say to a new mother-in-law?'", "'What would be the weirdest thing to collect?'", "'What\'s a bad song I secretly love?'", "'I\'d love to travel with _______, but it doesn\'t fit in my luggage.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What fruit skin would make for the least comfortable t-shirt fabric?'", "'What did I dream about last night?'", "'When\'s the worst time to burst out laughing?'", "'Which fictional character would make the best Yoda replacement in a Star Wars parody movie?'", "'When I was a kid, I never _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which historical event would it have been the coolest to witness in person?'", "'What\'s the best activity for a first date?'", "'What would be the least popular college class?'", "'What would make me more hip?'", "'When buying a bottle of baby oil, never say _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which historical figure would be the most interesting dinner guest?'", "'I can sing one song at karaoke. What should I sing?'", "'What\'s the best excuse for not finishing an assignment?'", "'What\'s the best way to impress a man?'", "'My life won\'t be complete until _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What would be the most interesting country to visit?'", "'What word best describes me?'", "'If you could train a monkey to do anything what would it be?'", "'What\'s my favorite thing to do in the dark?'", "'As long as there are women, there will be _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the funniest movie of all time?'", "'I\'m the star of a TV public service announcement. What\'s the message?'", "'What\'s the best thing about civilization?'", "'What world record would my mother least like me to attempt?'", "'A gorilla just walked up to me and _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best reality TV show of all time?'", "'What\'s the best way to spend a Saturday?'", "'What does the world need more of?'", "'What would be the weirdest fortune to find on a fortune cookie?'", "'It takes two to _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );

		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best song of all time?'", "'If I taught a college class, what would the subject be?'", "'What would be the worst possible pizza topping?'", "'What\'s an inappropriate time for a touchdown celebration?'", "'If I go to heaven, I want to take _______ with me.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best TV drama of all time?'", "'What would be the most fun thing to smash with a giant hammer?'", "'When\'s a bad time to fall asleep?'", "'What\'s a tourist attraction that I\'d love to manage for a year?'", "'The first thing I do when I get home is _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the most overrated movie of all time?'", "'What\'s the tackiest that that people do?'", "'What company would I most want to run?'", "'What would be the weirdest thing to find written on a bathroom stall?'", "'Stangers stared at me in disbelief after I _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best looking actor of all time?'", "'What would be the most fun thing to throw off a tall building?'", "'What am I most likely to be doing in 20 minutes?'", "'What message would I write on the moon for all to see?'", "'I need a _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the funniest TV show of all time?'", "'What toy would be the most fun for adults?'", "'What would I do if I won $100,000?'", "'They called him Alexander the Great. But was the dude so great?'", "'You know you\'re getting old when _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the movie that you could watch every day for a year?'", "'If I was a rapper, what would my stage name be?'", "'What would I do if I never had to work for a living?'", "'What would be the dumbest thing to do in public?'", "'If you want to double your money, invest in _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the most overrated TV show of all time?'", "'What\'s a random activity that would be fun to try?'", "'If I could be anyone famous, who would I choose?'", "'What wouldn\'t you want to see on a fast food menu?'", "'The 1990s were just grunge music, Seinfeld, and _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the funniest TV character ever?'", "'Who would be the least inspiring motivational speaker?'", "'If I could have anything, what would it be?'", "'What would I least want thrown in my face?'", "'I could earn a gold medal in _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the most memorable movie character?'", "'What fictional location would be an interesting place to live?'", "'What do I want to be when I grow up?'", "'What would be the weirdest fear to have?'", "'This town ain\'t big enough for _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the most overrated band of all time?'", "'What\'s the best way to remove a sleeping cat from your lap?'", "'I\'m late. Why?'", "'What would be the greatest world record to hold?'", "'Everyone wonders where I got my _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the greatest musician or band of all time?'", "'What do I do when I\'m alone in my car at a red light?'", "'What am I most likely to become famous for?'", "'What would be the worst name for a superhero?'", "'Cats would take over the world if we didn\'t have _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best action movie of all time?'", "'What would I most want to see constructed out of Legos?'", "'Where\'s my happy place?'", "'What wouldn\'t you want your neighbors to do?'", "'Did you see that new movie? It\'s called Cows on _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the most overrated actor of all time?'", "'What would be a really fun hobby?'", "'I just sent a text to the player on my left. What does it say?'", "'What do kids hate most?'", "'I would be really sad if _______ went out of business.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best way to spend the day when playing hooky?'", "'Which celebrity has no business being a celebrity?'", "'What\'s the most confusing thing ever?'", "'What one thing would I most want to do before I die?'", "'Three cheers for _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best movie sequel of all time?'", "'What\'s the best way to pamper yourself?'", "'What\'s the best present I could give my significant other?'", "'Where\'s the worst place to hide chocolate?'", "'My cat loves _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the most overrated actress of all time?'", "'Which historical figure would have had the most interesting Twitter account?'", "'If my pet could talk, what would it say about me?'", "'What do bears really do when people think they\'re hibernating?'", "'The only thing I can\'t resist is _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the best TV couple of all time?'", "'What should we learn in high school that we don\'t?'", "'What illegal thing would be the most fun to do if it was legal?'", "'Where\'s the last place you\'d find me?'", "'I\'d be embarrassed if people found out I watched _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best romantic comedy of all time?'", "'What\'s the worst thing about being a woman?'", "'I\'m the star of a new sitcom. What\'s it called?'", "'What would be the strangest thing to find listed on Craigslist?'", "'I\'m mad as hell and I\'m _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the greatest villain of all time?'", "'What would be the coolest thing to do with a $100 million lottery jackpot?'", "'What\'s a cheesy pickup line?'", "'If I could speak at birth, what would my first words have been?'", "'What this town needs is a good _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which celebrity would look most out of place on an NFL football team?'", "'What would be the best topic for a college class?'", "'If I opened a restaurant, what would it be called?'", "'What would be the worst question to ask someone on a first date?'", "'I brake for _______!'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which celebrity would make the worst Superhero?'", "'What one item would you put in a time capsule to be opened in the year 3000?'", "'What should be the title of my autobiography?'", "'What would be a strange venue for a high school prom?'", "'There\'s no place like _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'With which celebrity would I most want to be Facebook friends?'", "'What would be a bad last name for me?'", "'Which athlete would I most want to be?'", "'What would make the best cereal box prize?'", "'The last how-to book I read was _______ for Dummies.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s a hit song that should have never been recorded?'", "'Who wouldn\'t I want as my personal chef?'", "'What would I want most for my next birthday?'", "'What would make the worst centerpiece for a dining room table?'", "'Never come home with a bag full of _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which celebrity should not be the star of a musical?'", "'What would be the coolest skill to have without needing to practice?'", "'Where\'s the worst place to clip your toenails?'", "'If I ran my own country, what would be the first law I enact?'", "'I feel like _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the best cartoon character of all time?'", "'What would be the coolest magical power to have?'", "'If I could go on a date with anyone, who would it be?'", "'What should I tattoo on my friends face?'", "'The Terminator movies would have been way funnier if they starred _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which celebrity would fail fastest on American Ninja Warrior?'", "'Who\'s voice would I least want on my GPS?'", "'I just moved. What\'s the first thing I do?'", "'What\'s would be the most inappropriate item to bring to show and tell?'", "'I love answering questions about _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best song to dance to?'", "'What\'s the best thing about being a woman?'", "'What do I wish was always available via one-day shipping?'", "'What would I be shocked to find in my pocket?'", "'Words cannot describe how good I feel after _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the best actor of all time?'", "'What would be the coolest thing to try just once?'", "'What\'s my biggest pet peeve?'", "'Where\'s the best place to take off your pants?'", "'My wedding vows should read, \'to love, to honor, and to _______\'.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the best actress of all time?'", "'Which fictional character would I most hate to meet?'", "'Who should sponsor my life?'", "'What\'s the worst thing my neighbors could catch me doing?'", "'If I was the opposite sex for a day, I would _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the most annoying celebrity?'", "'What would be the coolest thing to have in the mansion?'", "'What job would I most like to try for a week?'", "'What would be the most embarrassing thing to say in front of the Queen of England?'", "'As long as there are men, there will be _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the famous person that should never be allowed to rap?'", "'What would be the best job?'", "'What gets me up in the morning?'", "'What shouldn\'t you say when going through airport security?'", "'_______ makes no sense to me.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which technology product would be the hardest to live without?'", "'Where would be the worst place to live?'", "'What should I do when the zombie apocalypse begins?'", "'What would be the grossest thing to kiss?'", "'I am so over _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best animated TV show of all time?'", "'With which celebrity would I most want to take a selfie?'", "'What would be the worst possible party favor?'", "'What shouldn\'t be done while driving?'", "'The 1980s were just Pac-Man, synth music, and _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who would be the worst person to sit next to on an airplane?'", "'What\'s the coolest new technology?'", "'When\'s a bad time to break out into song?'", "'The world will end in one week. What should I do?'", "'If I had a dollar for every time _______, I\'d be rich!'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who would you be least surprised to find out is an alien?'", "'What\'s the weirdest fad of all time?'", "'What would make work more fun?'", "'Your parents are out of town. What happens at the party?'", "'Keep calm and _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What was the most fun thing to do during elementary school recess?'", "'Where would be the worst place to wake up?'", "'If I could have a private concert featuring anyone who would it be?'", "'I just got to Las Vegas. What should I do?'", "'I do my best thinking when _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the best character from Sesame Street or The Muppets?'", "'What\'s the best thing about college?'", "'What\'s the most important thing in life?'", "'What technology don\'t we have that you wish we did?'", "'I know it\'s time for a vacation whenever I _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What would be the best store to work at?'", "'Who\'s a movie character that you wouldn\'t want to be?'", "'What\'s going through my head right now?'", "'What would be the worst thing to have in your mouth?'", "'To enjoy life, don\'t think too much about _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which celebrity would be the best desert island companion?'", "'What would be the coolest thing to collect?'", "'What\'s a good t-shirt slogan?'", "'What would be the most inappropriate thing to say on a date?'", "'I just can\'t get _______ out of my head.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the craziest celebrity?'", "'Who would be the worst choice to sing the national anthem at a sporting event?'", "'An alien ship landed on Earth. What should we do?'", "'What do I miss most about being a kid?'", "'When I\'m in church, I sometimes think about _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who would be the weirdest celebrity couple?'", "'What\'s the worst thing about being a man?'", "'If I could win a $1,000 gift card for any store, which would it be?'", "'What makes people happy?'", "'As I get older, I find it more and more difficult to _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the greatest snack food of all time?'", "'Who\'s a fictional character that you wish actually existed?'", "'What new holiday tradition should I start?'", "'What\'s a bad time for your mom to show up?'", "'Three things are certain in life: death, taxes, and _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who would be the coolest person to trade places with?'", "'What should I name my car?'", "'I just got fired. Why?'", "'What would be the coolest robotic attachment to add to my body?'", "'I wish I liked _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the most important aspect of a good relationship?'", "'Which TV character would I least want to be?'", "'I\'m going to the zoo. What am I hoping to see?'", "'What would be the dumbest thing to say in a job interview?'", "'Heaven is _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which city would be the most fun to visit?'", "'Which celebrity would be the most difficult to have as an in-law?'", "'What do women really keep in their purses?'", "'What\'s the most embarrassing thing that could happen on a blind date?'", "'I really wish I was eating _______ right now.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What was the most important invention of the past 100 years?'", "'If I was invisible for the day, what would I do?'", "'Why did the chicken cross the road?'", "'What TV show would be better if Kanye West was the host?'", "'My dog loves _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s a movie that should never have been made?'", "'What\'s the best thing about hotel rooms?'", "'I just wrote a book. What\'s it called?'", "'What\'s the worst thing to say to a cop after getting pulled over?'", "'I don\'t understand why _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What would be the best wedding present?'", "'What would be the most difficult item to sell door-to-door?'", "'Which celebrity would make the best nanny?'", "'What would be the most fun activity to do on the moon?'", "'I have a fever and the only cure is _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best toy of all time?'", "'Which professional athlete would I most want on my dodgeball team?'", "'Who\'s the coolest superhero?'", "'What do people say to dogs that they shouldn\'t say to their boss?'", "'I wish that my car could _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best Olympic sport?'", "'If I could bring one celebrity back to life, who would I choose?'", "'What do zoo animals do after the people go home?'", "'What would be ther weirdest secret to hear from your mother?'", "'America runs on _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the most important quality a person can have?'", "'What would make next weekend more exciting?'", "'What\'s the most embarrassing thing a parent could do?'", "'If I could have a BIG anything, what would it be?'", "'I don\'t have time for _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What should more people pay attention to?'", "'What\'s the best band name of all time?'", "'What would I least want to be trapped in a elevator with?'", "'What doesn\'t taste better with ketchup?'", "'You know your party is going really well when _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best movie of all time?'", "'What would be a good task for a Boy Scout merit badge?'", "'What\'s my biggest guilty pleasure?'", "'What\'s the nicest thing to come home to?'", "'They may take our lives, but they\'ll never take our _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What would be the worst song for a wedding first dance?'", "'What\'s the best thing about being a man?'", "'What\'s a birthday gift that would surprise me?'", "'What\'s the weirdest thing that could happen right now?'", "'Last night, I had a nightmare about _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What sport would be the most fun to watch if played by sloths?'", "'Who would be the coolest TV character to be?'", "'What song should play whenever I enter a room?'", "'Who would you be most shocked to find on a dating app?'", "'There\'s no such thing as a little _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which animal would be the most fun to ride in a parade?'", "'What\'s the worst fashion trend of all time?'", "'What would be a really terrible habit?'", "'What would be the strangest thing to sue someone over?'", "'Meryl Streep is to acting what I am to _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which living person would be the most interesting dinner guest?'", "'Which celebrity would make the best spouse?'", "'What would be the weirdest New Year\'s resolution?'", "'What\'s the best excuse to get out of a speeding ticket?'", "'You never forget your first _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );

		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Who\'s the funniest comedian of all time?'", "'Which of my interests do I most wish my significant other shared?'", "'What really annoys people?'", "'What would be the dumbest gift to take from a stranger?'", "'My bathroom is awesome! It\'s got _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which historical figure would make the best prom date?'", "'What movie definitely doesn\'t need a sequel?'", "'What would be the strangest campaign sogan?'", "'What\'s the dumbest thing that someone has actually done?'", "'Everyone knows my name at _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What word is the most fun to say?'", "'Which cartoon character would I most to be my best friend?'", "'What should I spend more money on?'", "'What wouldn\'t I want my taxi driver to say?'", "'Apple just announced its next product. It\'s called the _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Where would be the best place to go for spring break?'", "'Who would be the coolest movie character to be?'", "'Why did dinosaurs really go extinct?'", "'What would be the worst place for a date?'", "'If I bottled and sold a fragrance, it would be called _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the most memorable movie line ever?'", "'If I could delete anything in the world, what would it be?'", "'What\'s the best thing you can buy for $5?'", "'What would Jesus do?'", "'There\'s a popular new children\'s book. It\'s called Goodnight _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'Which animal would you most want to be?'", "'What would be the oddest subject for a documentary?'", "'What makes me laugh the hardest?'", "'What\'s a food item I\'ll never try?'", "'I once saw this really cool movie where Godzilla _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s a tourist attraction you\'d love to visit?'", "'What do I wish delivery drones could drop off at my house?'", "'What will people miss most 50 years from now?'", "'Why couldn\'t I be an astronaut?'", "'I\'ll be your best friend if you place _______ next to my drink.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the best game of all time?'", "'Which historical figure would I have most likely followed on Twitter?'", "'What should my gravestone say?'", "'What does an ostrich think about when its head is in the sand?'", "'If I was 10 years old, I would _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 );
		
		$sql2 = "INSERT INTO cards (option1, option2, option3, option4, option5) VALUES ";
		$cardValues = array("'What\'s the most useless thing you learn in school?'", "'What would be the strangest thing to find at home after returning from vacation?'", "'What do I most wish I could predict?'", "'If I could hold anything in my hands right now, what would it be?'", "'People always compliment me on my _______.'");
		$card = implode( $cardValues, ',');
		$sql2 .= "(".$card.")";			
		self::DbQuery( $sql2 ); }
		
	$randomQuestion = rand(1, 80);
	$sql = "INSERT INTO roundInfo (selected_question, selected_response, selected_card) VALUES (-1, 0, $randomQuestion)";
	self::DbQuery($sql);

        // Activate first player (which is in general a good idea :) )
        $this->activeNextPlayer();

        // Active first player
        self::activeNextPlayer();
        /************ End of the game initialization *****/
    }
    /*
        SelectQuestion:

        A Player is able to call this method when they are chosen
        to select a question. Only one player per round will be 
        allowed to call this method. The $question is the specific
        question that the player would like to select.
    */
    function SelectQuestion($question, $card) {
		// Save $question so it can be displayed to others
		//$sql = "UPDATE roundInfo SET selected_question='$question' WHERE round_id = (SELECT MAX(round_id) FROM roundInfo)";	
		$sql = "UPDATE roundInfo SET selected_question='$question' WHERE round_id = (SELECT round_id FROM (SELECT MAX(round_id) FROM roundInfo) as c);";
		self::DbQuery($sql);

        	// Go to next game state
		$this->gamestate->nextState("SelectQuestion");
		// Delete this next part later, just for testing to get to next state
		// $this->gamestate->nextState("QuestionResponse");
	}

    /*
        SelectPlayerResponse:

        This method can only be run by the player in the playerTurnSelectPlayerResponse state.
        This is where the player who originally chose the question choose their favorite response.
        $selectedResponse is the response that they have chosen.
    */
    function SelectPlayerResponse($selectedResponse) {
		// Save $question so it can be displayed to others
		// Note fix sql query later, use some global round id instead of 1
		//$sql = "UPDATE roundInfo SET (1, $selectedResponse) WHERE";
		
		//self::DbQuery($sql);
        	// Go to next game state
		$this->gamestate->nextState("SelectPlayerResponse");
	}

   function st_MultiPlayerInit() {
       $this->gamestate->setAllPlayersMultiactive();

       $active_player_id = $this->getActivePlayerId();

       $this->gamestate->setPlayerNonMultiactive($active_player_id, 'next'); 
   }

    /*
        QuestionResponse:

        Players are allowed to use this method in the playerTurnQuestionResponse state.
        This allows players to send a response for to the prompt, this method will then
        ensure it is a valid response and handle it. $response is the player's response.
    */
    function QuestionResponse($response) {
        	// get card used for the round
		$card = self::getGameStateValue( "currentCard" );

		// get the your own player id
		$current_player_id = self::getCurrentPlayerId(); 

		$this->gamestate->setPlayerNonMultiactive($current_player_id, 'next'); 
  
		// insert this specific response into the db
		$sql = "INSERT INTO responses VALUES '$current_player_id', '$card', '$response'";  
		self::DbQuery( $sql );
	}

    /*
        placeToken1:

        Players in the playerTurnplaceTokens are allowed to run this method.
        All players except for the player who initially chose the question must 
        place two tokens, this method is for placing the first token. $target is 
        the response that the player wants to place a token on.
    */
    function placeToken1($target) {
		// get card used for the round
		$card = self::getGameStateValue( "currentCard" );

		//get your own player_id
		$current_player_id = self::getCurrentPlayerId();    
		
		// get the player id of who you want to give chips to
		$player_id = self::getUniqueValueFromDb("SELECT player_no FROM responses WHERE response = '$target'");

		// create chips assigned to the target that you selected
		$sql = "INSERT INTO chips (player_no, response_id, card_id) VALUES " + $player_id +"," + $target + "," + $card;
		self::DbQuery( $sql );

		// physically move the token
		this.moveTokenOnTable($current_player_id, 'token' + ($player_id * 2 + 1), $player_id );
	}

    /*
        placeToken2:

        Same as placeToken1 but for the second token. 
        Players in the playerTurnplaceTokens are allowed to run this method.
        All players except for the player who initially chose the question must 
        place two tokens, this method is for placing the second token. $target is 
        the response that the player wants to place a token on.
    */
    function placeToken2($target) {
        	// get card used for the round
		$card = self::getGameStateValue( "currentCard" );

		//get your own player_id
		$current_player_id = self::getCurrentPlayerId();    
		
		// get the player id of who you want to give chips to
		$player_id = self::getUniqueValueFromDb("SELECT player_no FROM responses WHERE response = '$target'");

		// create chips assigned to the target that you selected
		$sql = "INSERT INTO chips (player_no, response_id, card_id) VALUES " + $player_id +"," + $target + "," + $card;
		self::DbQuery( $sql );

		// physically move the token
		this.moveTokenOnTable($current_player_id, 'token' + ($player_id * 2 + 2), $player_id );
	}

    /*
        selectionRevealed:

        Handles revealing what the chosen response was and awards given points.
    */
    function selectionRevealed() {
        	// get card used for the round
		$card = self::getGameStateValue( "currentCard" );
		
		// award point for correct answer
	    	$correctResponsePlayer = self::getUniqueValueFromDb("SELECT player_no FROM responses WHERE card_id = '$card' AND correct = true");
		
		$newScore = self::getUniqueValueFromDb("SELECT player_score FROM player WHERE player_no = '$correctResponsePlayer'") + 1;
		$sql = "UPDATE player SET player_score = '$newScore' WHERE player_no = '$correctResponsePlayer'";
		self::DbQuery( $sql );
		
		// award points for correct chips 
		// get correct response_id
		$correctResponseId = self::getUniqueValueFromDb("SELECT response_id FROM responses WHERE card_id = '$card' AND correct = true");
		
		// make array of correct chips
		$chipsSql = mysql_query("SELECT chip_id FROM chips WHERE response_id = '$correctResponseId'");
		$chips = mysql_fetch_row($chipsSql);
		
		// go through each correct chip, find corresponding player, and add point to score
		for ($i; $i < count($chips[0]); $i++) {
		$correctChipPlayer = self::getUniqueValueFromDb("SELECT player_no FROM chips WHERE chip_id = '$chips[0][$i]'");
			
		$newScore = self::getUniqueValueFromDb("SELECT player_score FROM player WHERE player_no = '$correctChipPlayer'") + 1;
		$sql = "UPDATE player SET player_score = '$newScore' WHERE player_no = '$correctChipPlayer'";
		self::DbQuery( $sql );
		}

		// award points for correct chips on judge's choice
		$newScore = self::getUniqueValueFromDb("SELECT player_score FROM player WHERE player_no = '$active_player'") + min(count($chips[0]), 3);
		$sql = "UPDATE player SET player_score = '$newScore' WHERE player_no = '$active_player'";
		self::DbQuery( $sql);
		// check end game
		stGameEnd();	
	}

    /*
        stGameEnd:

        This function is activated at the gameEnd state. It finalizes who 
        has the most points and handles end game events.
    */
    function stGameEnd() {
	// check if game end 
	if (self::getGameStateValue('round') == 12) {
            $this->gamestate->nextState( "endGame" );
        }
		
	// add next round
	$nextRound = self::getGameStateValue( "round" );
        self::setGameStateValue( "round", $nextRound + 1);
		
	// switch first player and go to next round
	$player_id = self::activeNextPlayer();
	self::giveExtraTime( $player_id );
		
        $this->gamestate->nextState( "SelectQuestion" );
    }



    /*
        getAllDatas: 
        
        Gather all informations about current game situation (visible by the current player).
        
        The method is called each time the game interface is displayed to a player, ie:
        _ when the game starts
        _ when a player refreshes the game page (F5)
    */
    protected function getAllDatas()
    {
        $result = array();
    
        $current_player_id = self::getCurrentPlayerId();    // !! We must only return informations visible by this player !!
    
        // Get information about players
        // Note: you can retrieve some extra field you added for "player" table in "dbmodel.sql" if you need it.
        $sql = "SELECT player_id id, player_score score FROM player ";
        $result['players'] = self::getCollectionFromDb( $sql );
  
        // TODO: Gather all information about current game situation (visible by player $current_player_id).
  
        return $result;
    }

    /*
        getGameProgression:
        
        Compute and return the current game progression.
        The number returned must be an integer beween 0 (=the game just started) and
        100 (= the game is finished or almost finished).
    
        This method is called each time we are in a game state with the "updateGameProgression" property set to true 
        (see states.inc.php)
    */
    function getGameProgression()
    {
        // TODO: compute and return the game progression

        return 0;
    }


//////////////////////////////////////////////////////////////////////////////
//////////// Utility functions
////////////    

    /*
        In this space, you can put any utility methods useful for your game logic
    */



//////////////////////////////////////////////////////////////////////////////
//////////// Player actions
//////////// 

    /*
        Each time a player is doing some game action, one of the methods below is called.
        (note: each method below must match an input method in sayanythingmu.action.php)
    */

    /*
    
    Example:

    function playCard( $card_id )
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'playCard' ); 
        
        $player_id = self::getActivePlayerId();
        
        // Add your game logic to play a card there 
        ...
        
        // Notify all players about the card played
        self::notifyAllPlayers( "cardPlayed", clienttranslate( '${player_name} plays ${card_name}' ), array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'card_name' => $card_name,
            'card_id' => $card_id
        ) );
          
    }
    
    */

    
//////////////////////////////////////////////////////////////////////////////
//////////// Game state arguments
////////////

    /*
        Here, you can create methods defined as "game state arguments" (see "args" property in states.inc.php).
        These methods function is to return some additional information that is specific to the current
        game state.
    */

    /*
    
    Example for game state "MyGameState":
    
    function argMyGameState()
    {
        // Get some values from the current game situation in database...
    
        // return values:
        return array(
            'variable1' => $value1,
            'variable2' => $value2,
            ...
        );
    }    
    */
	function argSendQuestionData()
    {
        // Get chosen question from the database, gets question with highest roundid (current round)
		$chosenQuestion = self::getUniqueValueFromDb("SELECT selected_question FROM roundInfo WHERE round_id = (SELECT MAX(round_id) FROM roundInfo)");

        // return values:
        return array(
            'chosenQuestion' => $chosenQuestion
        );
    }   


	function argSendQuestionCard()
    {
        // Get chosen question from the database, gets question with highest roundid (current round)
		$chosenCard = self::getUniqueValueFromDb("SELECT selected_card FROM roundInfo WHERE round_id = (SELECT MAX(round_id) FROM roundInfo)");

        // return values:
        return array(
            'chosenCard' => $chosenCard
        );
    }  
	

//////////////////////////////////////////////////////////////////////////////
//////////// Game state actions
////////////

    /*
        Here, you can create methods defined as "game state actions" (see "action" property in states.inc.php).
        The action method of state X is called everytime the current game state is set to X.
    */
    
    /*
    
    Example for game state "MyGameState":

    function stMyGameState()
    {
        // Do some stuff ...
        
        // (very often) go to another gamestate
        $this->gamestate->nextState( 'some_gamestate_transition' );
    }    
    */

//////////////////////////////////////////////////////////////////////////////
//////////// Zombie
////////////

    /*
        zombieTurn:
        
        This method is called each time it is the turn of a player who has quit the game (= "zombie" player).
        You can do whatever you want in order to make sure the turn of this player ends appropriately
        (ex: pass).
        
        Important: your zombie code will be called when the player leaves the game. This action is triggered
        from the main site and propagated to the gameserver from a server, not from a browser.
        As a consequence, there is no current player associated to this action. In your zombieTurn function,
        you must _never_ use getCurrentPlayerId() or getCurrentPlayerName(), otherwise it will fail with a "Not logged" error message. 
    */

    function zombieTurn( $state, $active_player )
    {
    	$statename = $state['name'];
    	
        if ($state['type'] === "activeplayer") {
            switch ($statename) {
                default:
                    $this->gamestate->nextState( "zombiePass" );
                	break;
            }

            return;
        }

        if ($state['type'] === "multipleactiveplayer") {
            // Make sure player is in a non blocking status for role turn
            $this->gamestate->setPlayerNonMultiactive( $active_player, '' );
            
            return;
        }

        throw new feException( "Zombie mode not supported at this game state: ".$statename );
    }
    
///////////////////////////////////////////////////////////////////////////////////:
////////// DB upgrade
//////////

    /*
        upgradeTableDb:
        
        You don't have to care about this until your game has been published on BGA.
        Once your game is on BGA, this method is called everytime the system detects a game running with your old
        Database scheme.
        In this case, if you change your Database scheme, you just have to apply the needed changes in order to
        update the game database and allow the game to continue to run with your new version.
    
    */
    
    function upgradeTableDb( $from_version )
    {
        // $from_version is the current version of this game database, in numerical form.
        // For example, if the game was running with a release of your game named "140430-1345",
        // $from_version is equal to 1404301345
        
        // Example:
//        if( $from_version <= 1404301345 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "ALTER TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        if( $from_version <= 1405061421 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "CREATE TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        // Please add your future database scheme changes here
//
//


    }    
}
