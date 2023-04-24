<script language="php">
/*
##############################################################################
# PHP Scratch And Win                                           Version 2.00 #
# Copyright 2003                             phpScratchAndWin.YourPHPPro.com #
#                                                                            #
# For questions concerning licensing, please read license.txt                #
##############################################################################
*/

srand((double)microtime()*intval(rand(1,1000000)));

include("function.random.php");
include("config.php");
include("class.mysql.php");
include("admin/functions.php");
include("class.fasttemplate.php");

if (CONSTANT("phpScratchAndWin_Debug")=="1") {
	print "<!-- Defining GenerateDefaultScreen Function -->";
}

function GenerateDefaultScreen() {
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Starting GenerateDefaultScreen Function -->";
	}
	$displaytemplate = new FastTemplate("./");
	$displaytemplate->strict();
	$displaytemplate->define(array(
		"WelcomeScreen" => "welcome.tpl"
	));
	$displaytemplate->assign ("FORMLOCATION" , CONSTANT("phpScratchAndWin_URL"));
	$displaytemplate->assign ("PROGRAMTITLE", CONSTANT("phpScratchAndWin_Title"));
	$displaytemplate->parse  ("GLOBAL"    , "WelcomeScreen");
	$displaytemplate->FastPrint();
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Completing GenerateDefaultScreen Function -->";
	}
	exit;
}

if (CONSTANT("phpScratchAndWin_Debug")=="1") {
	print "<!-- Defining GenerateNewTicket Function -->";
}

function GenerateNewTicket($Email_Address) {
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Generating New Random Numbers -->";
	}
	$Number_1=GetRandomNumber("0", CONSTANT("phpScratchAndWin_HighNumber"));
	$Number_2=GetRandomNumber("0", CONSTANT("phpScratchAndWin_HighNumber"));
	$Pick_1=GetRandomNumber("0", CONSTANT("phpScratchAndWin_HighNumber"));
	$Pick_2=GetRandomNumber("0", CONSTANT("phpScratchAndWin_HighNumber"));
	$Pick_3=GetRandomNumber("0", CONSTANT("phpScratchAndWin_HighNumber"));
	$Pick_4=GetRandomNumber("0", CONSTANT("phpScratchAndWin_HighNumber"));

	$DupTries=0;
	while ($Number_1==$Number_2 && $DupTries<15):
		$Number_2=GetRandomNumber("0", CONSTANT("phpScratchAndWin_HighNumber"));
		$DupTries++;
	endwhile;

	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Received New Random Numbers -->";
	}

	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Inserting New Record into Database -->";
	}
	// Insert Record into Database
	$DB_SaW=new DB_Sql_phpScratchAndWin;
	$DB_SaW->phpScratchAndWin_Database=CONSTANT("phpScratchAndWin_Database");
	$DB_SaW->phpScratchAndWin_Server=CONSTANT("phpScratchAndWin_Server");
	$DB_SaW->phpScratchAndWin_User=CONSTANT("phpScratchAndWin_Username");
	$DB_SaW->phpScratchAndWin_Password=CONSTANT("phpScratchAndWin_Password");
	$DB_SaW->DB_connect();
	$query = $DB_SaW->DB_query("INSERT INTO `ticket` ( `Ticket_ID` , `Email_Address` , `DrawDate` , `Number_1` , `Number_2` , `Pick_1` , `Pick_2` , `Pick_3` , `Pick_4` , `Show_1` , `Show_2` , `Show_3` , `Show_4` , `Played` ) VALUES ('', '$Email_Address', NOW( ) , '$Number_1', '$Number_2', '$Pick_1', '$Pick_2', '$Pick_3', '$Pick_4', 'N', 'N', 'N', 'N', 'N')");
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Completed Inserting New Record.  -->";
	}
	return $DB_SaW->DB_insert_id();
}

if (CONSTANT("phpScratchAndWin_Debug")=="1") {
	print "<!-- Defining IsTicketActive Function -->";
}

function IsTicketActive($Email_Address) {
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Starting IsTicketActive Function -->";
	}
	$DB_SaW=new DB_Sql_phpScratchAndWin;
	$DB_SaW->phpScratchAndWin_Database=CONSTANT("phpScratchAndWin_Database");
	$DB_SaW->phpScratchAndWin_Server=CONSTANT("phpScratchAndWin_Server");
	$DB_SaW->phpScratchAndWin_User=CONSTANT("phpScratchAndWin_Username");
	$DB_SaW->phpScratchAndWin_Password=CONSTANT("phpScratchAndWin_Password");
	$DB_SaW->DB_connect();
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Running Query for IsTicketActive -->";
	}
	$ActiveTicket= $DB_SaW->DB_query_first("select Ticket_ID from ticket where Email_Address=\"$Email_Address\" and DrawDate=\"" . Date("Y-m-d") . "\" and Played=\"N\" limit 1");
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Completed Query - Ticket ID = " . $ActiveTicket["Ticket_ID"] . " -->";
	}
	return $ActiveTicket["Ticket_ID"];
}

if (CONSTANT("phpScratchAndWin_Debug")=="1") {
	print "<!-- Defining CheckPlayAbility Function -->";
}

function CheckPlayAbility($Email_Address) {
	$DB_SaW=new DB_Sql_phpScratchAndWin;
	$DB_SaW->phpScratchAndWin_Database=CONSTANT("phpScratchAndWin_Database");
	$DB_SaW->phpScratchAndWin_Server=CONSTANT("phpScratchAndWin_Server");
	$DB_SaW->phpScratchAndWin_User=CONSTANT("phpScratchAndWin_Username");
	$DB_SaW->phpScratchAndWin_Password=CONSTANT("phpScratchAndWin_Password");
	$DB_SaW->DB_connect();

	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Running Query for CheckPlayAbility -->";
	}
	// Count the number of times this Email has played today
	$PlaysToday= $DB_SaW->DB_query_first("select count(*) as Count from ticket where Email_Address=\"$Email_Address\" and DrawDate=\"" . Date("Y-m-d") . "\" limit 1");
	if ($PlaysToday["Count"]>=CONSTANT("phpScratchAndWin_PlaysperDay")) {
		if (CONSTANT("phpScratchAndWin_Debug")=="1") {
			print "<!-- Number of Plays Today Exceeded -->";
		}
		PlaysPerDayExceeded();
		exit;
	}
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Number of Plays Today Not Exceeded -->";
	}
}

if (CONSTANT("phpScratchAndWin_Debug")=="1") {
	print "<!-- Defining PlaysPerDayExceeded Function -->";
}

function PlaysPerDayExceeded() {
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Displaying PlaysPerDayExceeded Error Message -->";
	}
	print ("Sorry, you have exceeded the number of plays available today. Please come back tomorrow.");
	exit;
}

if (CONSTANT("phpScratchAndWin_Debug")=="1") {
	print "<!-- Defining PlayTicket Function -->";
}

function PlayTicket($Email_Address,$Ticket_ID, $View) {
	$DB_SaW=new DB_Sql_phpScratchAndWin;
	$DB_SaW->phpScratchAndWin_Database=CONSTANT("phpScratchAndWin_Database");
	$DB_SaW->phpScratchAndWin_Server=CONSTANT("phpScratchAndWin_Server");
	$DB_SaW->phpScratchAndWin_User=CONSTANT("phpScratchAndWin_Username");
	$DB_SaW->phpScratchAndWin_Password=CONSTANT("phpScratchAndWin_Password");
	$DB_SaW->DB_connect();
	$Ticket_ID=intval($Ticket_ID);
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Checking Views in PlayTicket -->";
	}
	if ($View=="1") {
		$DBQuery=$DB_SaW->DB_query("update ticket set Show_1=\"Y\" where Email_Address=\"$Email_Address\" and Ticket_ID=$Ticket_ID limit 1");
	}
	if ($View=="2") {
		$DBQuery=$DB_SaW->DB_query("update ticket set Show_2=\"Y\" where Email_Address=\"$Email_Address\" and Ticket_ID=$Ticket_ID limit 1");
	}
	if ($View=="3") {
		$DBQuery=$DB_SaW->DB_query("update ticket set Show_3=\"Y\" where Email_Address=\"$Email_Address\" and Ticket_ID=$Ticket_ID limit 1");
	}
	if ($View=="4") {
		$DBQuery=$DB_SaW->DB_query("update ticket set Show_4=\"Y\" where Email_Address=\"$Email_Address\" and Ticket_ID=$Ticket_ID limit 1");
	}

	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Updating Played if all Shows equal Y -->";
	}
	// Now lets update this Ticket if all shows equal Y
	$DBQuery=$DB_SaW->DB_query("update ticket set Played=\"Y\" where Show_1=\"Y\" AND Show_2=\"Y\" AND Show_3=\"Y\" AND Show_4=\"Y\" and Email_Address=\"$Email_Address\" and Ticket_ID=$Ticket_ID");

	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Getting most current Ticket Status -->";
	}
	// Now lets get the most current Ticket status
	$ThisTicket=$DB_SaW->DB_query_first("select * from ticket where Email_Address=\"$Email_Address\" and DrawDate=\"" . Date("Y-m-d") . "\" and Ticket_ID=$Ticket_ID limit 1");

	if ($ThisTicket["Ticket_ID"]!=$Ticket_ID) {
		if (CONSTANT("phpScratchAndWin_Debug")=="1") {
			print "<!-- Throwing Default PlaysPerDayExceeded Error Message when Ticket ID's dont match. -->";
		}
		PlaysPerDayExceeded();
	}

	// Lets Display This Ticket

	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Displaying Ticket WebPage -->";
	}

	$displaytemplate = new FastTemplate("./");
	$displaytemplate->strict();
	$displaytemplate->define(array(
		"InstantTicket" => "ticket.tpl",
		"Pick1"			=> "pick1.tpl",
		"Pick2"			=> "pick2.tpl",
		"Pick3"			=> "pick3.tpl",
		"Pick4"			=> "pick4.tpl",
		"Show1"			=> "show1.tpl",
		"Show2"			=> "show2.tpl",
		"Show3"			=> "show3.tpl",
		"Show4"			=> "show4.tpl",
		"WinningPage"	=> "winningpage.tpl",
		"LosingPage"	=> "losingpage.tpl"
	));

	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Assigning default values to page -->";
	}
	$displaytemplate->assign ("IMAGES" , CONSTANT("phpScratchAndWin_ImageURL"));
	$displaytemplate->assign ("MYNUMBER1" , $ThisTicket["Number_1"]);
	$displaytemplate->assign ("MYNUMBER2" , $ThisTicket["Number_2"]);
	$displaytemplate->assign ("TICKETNUMBER" , $ThisTicket["Ticket_ID"]);
	$displaytemplate->assign ("SHOWNUMBER1" , $ThisTicket["Pick_1"]);
	$displaytemplate->assign ("SHOWNUMBER2" , $ThisTicket["Pick_2"]);
	$displaytemplate->assign ("SHOWNUMBER3" , $ThisTicket["Pick_3"]);
	$displaytemplate->assign ("SHOWNUMBER4" , $ThisTicket["Pick_4"]);
	$displaytemplate->assign ("PROGRAMTITLE", CONSTANT("phpScratchAndWin_Title"));

	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Checking Show 1-4 Values -->";
	}
	if ($ThisTicket["Show_1"]=="N") {
		$displaytemplate->assign("PICK1URL", CONSTANT("phpScratchAndWin_URL") . "/index.php?View=1&Email=$Email_Address&Ticket=$Ticket_ID");
		$displaytemplate->parse("SHOWPICK1","Pick1");
	} else {
		$displaytemplate->parse("SHOWPICK1","Show1");
	}
	if ($ThisTicket["Show_2"]=="N") {
		$displaytemplate->assign("PICK2URL", CONSTANT("phpScratchAndWin_URL") . "/index.php?View=2&Email=$Email_Address&Ticket=$Ticket_ID");
		$displaytemplate->parse("SHOWPICK2","Pick2");
	} else {
		$displaytemplate->parse("SHOWPICK2","Show2");
	}
	if ($ThisTicket["Show_3"]=="N") {
		$displaytemplate->assign("PICK3URL", CONSTANT("phpScratchAndWin_URL") . "/index.php?View=3&Email=$Email_Address&Ticket=$Ticket_ID");
		$displaytemplate->parse("SHOWPICK3","Pick3");
	} else {
		$displaytemplate->parse("SHOWPICK3","Show3");
	}
	if ($ThisTicket["Show_4"]=="N") {
		$displaytemplate->assign("PICK4URL", CONSTANT("phpScratchAndWin_URL") . "/index.php?View=4&Email=$Email_Address&Ticket=$Ticket_ID");
		$displaytemplate->parse("SHOWPICK4","Pick4");
	} else {
		$displaytemplate->parse("SHOWPICK4","Show4");
	}

	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Checking to see if ticket has been completely played -->";
	}
	// Now lets find out if this Ticket is a winner.
	$Winner=$DB_SaW->DB_query_first("select * from ticket where Played=\"Y\" AND Email_Address=\"$Email_Address\" and Ticket_ID=$Ticket_ID AND ((Number_1=Pick_1 OR Number_1=Pick_2 OR Number_1=Pick_3 OR Number_1=Pick_4) AND (Number_2=Pick_1 OR Number_2=Pick_2 OR Number_2=Pick_3 OR Number_2=Pick_4))");

	if ($ThisTicket["Played"]=="Y") {
		if (CONSTANT("phpScratchAndWin_Debug")=="1") {
			print "<!-- Ticket has been played -->";
		}
		if ($ThisTicket["Ticket_ID"]==$Winner["Ticket_ID"]) {
			if (CONSTANT("phpScratchAndWin_Debug")=="1") {
				print "<!-- Ticket is a Winner -->";
			}
			$displaytemplate->assign("WINNINGPAGE", CONSTANT("phpScratchAndWin_WinningPage"));
			$displaytemplate->parse("MESSAGE", "WinningPage");
			if (CONSTANT("phpScratchAndWin_Debug")=="1") {
				print "<!-- Formulating the Email Message -->";
			}
			// Lets Send an Email message
			$headers = "From: " . CONSTANT("phpScratchAndWin_FromEmail") . "\r\n";
			// $headers .= "MIME-Version: 1.0\r\n" ;
			$headers .= "Reply-To: " . CONSTANT("phpScratchAndWin_ReplyEmail") . "\r\n";
			$headers .= "X-Sender: Scratch and Win <" . CONSTANT("phpScratchAndWin_FromEmail") . ">\r\n";
			$headers .= "X-Mailer: phpScratchAndWin v2.0\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "Return-Path: <" . CONSTANT("phpScratchAndWin_ReplyEmail") . ">\r\n";
			// $headers .= "Content-Type: text/html;charset=iso-8859-1 \r\n";
			$message = "\nWe have had a winner on the Scratch and Win Game.\r\n";
			$message .="The Winning Information: \r\n";
			$message .= "Ticket ID: " . $Winner["Ticket_ID"] . " \r\n";
			$message .= "Email Addr: " . $Winner["Email_Address"] . "\r\n";
			$message .= "DrawDate: " . $Winner["DrawDate"] . "\r\n";
			$message .= "Number_1: " . $Winner["Number_1"] . "\r\n";
			$message .= "Number_2: " . $Winner["Number_2"] . "\r\n";
			$message .= "Pick_1: " . $Winner["Pick_1"] . "\r\n";
			$message .= "Pick_2: " . $Winner["Pick_2"] . "\r\n";
			$message .= "Pick_3: " . $Winner["Pick_3"] . "\r\n";
			$message .= "Pick_4: " . $Winner["Pick_4"] . "\r\n";
			$message .= "Show_1: " . $Winner["Show_1"] . "\r\n";
			$message .= "Show_2: " . $Winner["Show_2"] . "\r\n";
			$message .= "Show_3: " . $Winner["Show_3"] . "\r\n";
			$message .= "Show_4: " . $Winner["Show_4"] . "\r\n";
			$message .= "Played: " . $Winner["Played"] . "\r\n";
			if (CONSTANT("phpScratchAndWin_Debug")=="1") {
				print "<!-- Sending Email Message -->";
			}
			mail(CONSTANT("phpScratchAndWin_FromEmail"), "Scratch and Win Winner", "$message", $headers, "-f" . CONSTANT("phpScratchAndWin_FromEmail"));
		} else {
		    if (CONSTANT("phpScratchAndWin_Debug")=="1") {
				print "<!-- Ticket is a losing ticket -->";
			}
		    $displaytemplate->assign("LOSINGPAGE", CONSTANT("phpScratchAndWin_LosingPage") . "?Email=$Email_Address");
			$displaytemplate->parse("MESSAGE", "LosingPage");
	   	}
	} else {
		if (CONSTANT("phpScratchAndWin_Debug")=="1") {
			print "<!-- Ticket has not been completely played -->";
		}
		if (CONSTANT("phpScratchAndWin_DisplayOdds")=="1") {
			$displaytemplate->assign("MESSAGE", CONSTANT("phpScratchAndWin_DefaultMessage") . "(Odds of winning are 1 in " . CONSTANT("phpScratchAndWin_Odds") . ".)");
		} else {
			$displaytemplate->assign("MESSAGE", CONSTANT("phpScratchAndWin_DefaultMessage"));
		}
	}
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Start Parsing entire Page -->";
	}
	$displaytemplate->parse  ("GLOBAL"    , "InstantTicket");
	$displaytemplate->FastPrint();
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Page Outputted -->";
	}
	exit;
}

/*
##############################################################################
# Main Program Area                                                          #
##############################################################################
*/

if (CONSTANT("phpScratchAndWin_Debug")=="1") {
	print "<!-- Start of Main Application -->";
}

// Check to see if we have a POSTed or GETed Email address
if (array_key_exists("Email", $_POST)) {
		$Email_Address=(trim($_POST["Email"]));
} elseif (array_key_exists("Email", $_GET)) {
		$Email_Address=(trim($_GET["Email"]));
} else {
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- No Email Address Found -->";
	}
	GenerateDefaultScreen();
	exit;
}

if (array_key_exists("View", $_GET)) {
	$View=intval($_GET["View"]);
} else {
	$View=0;
}

if (array_key_exists("Ticket", $_GET)) {
	$Ticket_ID=intval($_GET["Ticket"]);
} else {
	$Ticket_ID=0;
}

if (!Custom_ValidateEmail($Email_Address)) {
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Bad Email Address Found -->";
	}
	GenerateDefaultScreen();
	exit;
}

if (CONSTANT("phpScratchAndWin_Debug")=="1") {
	print "<!-- Got View, Email, Ticket if sent -->";
}

// Check to make sure the Email address has not exceeded the number of plays today
if (CONSTANT("phpScratchAndWin_Debug")=="1") {
	print "<!-- Start of CheckPlayAbility -->";
}
CheckPlayAbility($Email_Address);

if (CONSTANT("phpScratchAndWin_Debug")=="1") {
	print "<!-- Visitor Can Play -->";
}

// If we have an Email address, lets see if we have a Ticket to play.
if (is_null($Ticket_ID) || ($Ticket_ID<1)) {
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Ticket_ID is NULL - Checking for Active Ticket -->";
	}
	$ThisTicket=intval(IsTicketActive($Email_Address));
	if ($ThisTicket<1) {
		if (CONSTANT("phpScratchAndWin_Debug")=="1") {
			print "<!-- Generating New Ticket -->";
		}
		$Ticket_ID=GenerateNewTicket($Email_Address);
		if (CONSTANT("phpScratchAndWin_Debug")=="1") {
			print "<!-- Playing New Ticket -->";
		}
		PlayTicket($Email_Address, $Ticket_ID, $View);
		exit;
	}
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Ticket_ID was NULL, but we found one in the database.  Playing that Ticket -->";
	}
	PlayTicket($Email_Address, $ThisTicket, $View);
	exit;
} else {
	if (CONSTANT("phpScratchAndWin_Debug")=="1") {
		print "<!-- Ticket_ID was sent. Playing that Ticket -->";
	}
	PlayTicket($Email_Address, $Ticket_ID, $View);
	exit;
}
if (CONSTANT("phpScratchAndWin_Debug")=="1") {
	print "<!-- End of Application -->";
}

</script>