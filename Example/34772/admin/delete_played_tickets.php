<?php
/*
##############################################################################
# PHP Scratch And Win                                           Version 2.00 #
# Copyright 2003                             phpScratchAndWin.YourPHPPro.com #
#                                                                            #
# For questions concerning licensing, please read license.txt                #
##############################################################################
*/

//Include Common Files @1-8E58AE89
define("RelativePath", "..");
include(RelativePath . "/Common.php");
include(RelativePath . "/Template.php");
include(RelativePath . "/Sorter.php");
include(RelativePath . "/Navigator.php");

//End Include Common Files

//Include Page implementation @3-E34C2C5D
include("./header.php");
//End Include Page implementation

//Include Page implementation @4-86456262
include("./footer.php");
//End Include Page implementation


//Initialize Page @1-79B1E33A
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = "delete_played_tickets.php";
$Redirect = "";
$TemplateFileName = "delete_played_tickets.html";
$BlockToParse = "main";
$PathToRoot = "../";
//End Initialize Page

//Authenticate User @1-2CA9346F
CCSecurityRedirect("2", "login.php", $FileName, CCGetQueryString("QueryString", ""));
//End Authenticate User


//Initialize Objects @1-030DED98

// Controls
$header = new clsheader();
$header->BindEvents();
$header->TemplatePath = "./";
$header->Initialize();
$footer = new clsfooter();
$footer->BindEvents();
$footer->TemplatePath = "./";
$footer->Initialize();

// Events
include("./delete_played_tickets_events.php");
BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize");
//End Initialize Objects

//Execute Components @1-2D944FA9
$header->Operations();
$footer->Operations();
//End Execute Components


//Go to destination page @1-BEB91355
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload");
    header("Location: " . $Redirect);
    exit;
}
//End Go to destination page

//Initialize HTML Template @1-A0111C9D
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView");
$Tpl = new clsTemplate();
$Tpl->LoadTemplate(TemplatePath . $TemplateFileName, "main");
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow");
//End Initialize HTML Template

//Show Page @1-5655AB10
$header->Show("header");
$footer->Show("footer");
$Tpl->PParse("main", false);
//End Show Page

//Unload Page @1-AB7622EF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload");
unset($Tpl);
//End Unload Page


?>
