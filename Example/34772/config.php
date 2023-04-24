<script language="php">
/*
##############################################################################
# PHP Scratch And Win                                           Version 2.00 #
# Copyright 2003                             phpScratchAndWin.YourPHPPro.com #
#                                                                            #
# For questions concerning licensing, please read license.txt                #
##############################################################################
*/

/*
##############################################################################
# Sets the default values for the phpScratchAndWin Game                      #
##############################################################################
*/

// Title of the pages for the game.
define ("phpScratchAndWin_Title", "phpScratchAndWin v2.00");

// URL where this application is installed.
define ("phpScratchAndWin_URL", "http://www.example.com/phpscratchandwin");
// URL where the images for this application are installed.
define ("phpScratchAndWin_ImageURL", "http://www.example.com/phpscratchandwin/images");

// If you want a truely random game, set to '1', just be kind and notify them
// if you are going to have more than 100 cards played per day.
define ("phpScratchAndWin_UseRandomOrg", "0");

// mySQL Information - set as appropriate
define ("phpScratchAndWin_Database", "phpScratchAndWin");
define ("phpScratchAndWin_Server", "localhost");
define ("phpScratchAndWin_Username", "username");
define ("phpScratchAndWin_Password", "password");

// Enter highest number that can be drawn - check odds.txt for odds based on
// highest number possible
define ("phpScratchAndWin_HighNumber", 50);

// Calculate odds of winning based on user entered high number as entered above
define ("phpScratchAndWin_Odds", intval(1/(((pow(phpScratchAndWin_HighNumber,2)*12)-(phpScratchAndWin_HighNumber*24)+14)/pow(phpScratchAndWin_HighNumber,4))));

// Do you want to notify players what the chances are of them to win ?
define ("phpScratchAndWin_DisplayOdds" , "1");

// Define default message to display while a game is being played.
define ("phpScratchAndWin_DefaultMessage" , "Please click on an image.");

// Page to redirect individuals to after they win.
define ("phpScratchAndWin_WinningPage", "http://www.example.com/phpscratchandwin/");

// Page to redirect individuals to after they lose.
define ("phpScratchAndWin_LosingPage", "http://www.example.com/phpscratchandwin/");

// Number of plays per day per email address
define ("phpScratchAndWin_PlaysperDay", "25");

// Define Email Addresses in case of winner
define ("phpScratchAndWin_ReplyEmail" , 'you@example.com');
define ("phpScratchAndWin_FromEmail" , 'from@example.com');

// Set to '1' to be able to view debug info when game is being played.
// View source to see comments
define ("phpScratchAndWin_Debug", "0");

</script>
