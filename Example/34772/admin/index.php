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

//Include Page implementation @2-E34C2C5D
include("./header.php");
//End Include Page implementation

//Include Page implementation @3-86456262
include("./footer.php");
//End Include Page implementation

//Initialize Page @1-29F8EC39
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

$FileName = "index.php";
$Redirect = "";
$TemplateFileName = "index.html";
$BlockToParse = "main";
$PathToRoot = "../";
//End Initialize Page

//Authenticate User @1-7FED0150
CCSecurityRedirect("1;2", "login.php", $FileName, CCGetQueryString("QueryString", ""));
//End Authenticate User


//Initialize Objects @1-6018190E

// Controls
$header = new clsheader();
$header->BindEvents();
$header->TemplatePath = "./";
$header->Initialize();
$GetPlaysThisMonth = new clsControl(ccsLink, "GetPlaysThisMonth", "GetPlaysThisMonth", ccsInteger, "", CCGetRequestParam("GetPlaysThisMonth", ccsGet));
$GetPlaysThisMonth->Page = "list_tickets.php";
$GetWinsThisMonth = new clsControl(ccsLink, "GetWinsThisMonth", "GetWinsThisMonth", ccsInteger, "", CCGetRequestParam("GetWinsThisMonth", ccsGet));
$GetWinsThisMonth->Page = "list_winners.php";
$GetPlaysToday = new clsControl(ccsLink, "GetPlaysToday", "GetPlaysToday", ccsInteger, "", CCGetRequestParam("GetPlaysToday", ccsGet));
$GetPlaysToday->Page = "list_tickets.php";
$GetTotalWinsToday = new clsControl(ccsLink, "GetTotalWinsToday", "GetTotalWinsToday", ccsInteger, "", CCGetRequestParam("GetTotalWinsToday", ccsGet));
$GetTotalWinsToday->Page = "list_winners.php";
$Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet));
$Link1->Page = "delete_played_tickets.php";
$Link2 = new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet));
$Link2->Page = "delete_unplayed_tickets.php";
$Link3 = new clsControl(ccsLink, "Link3", "Link3", ccsText, "", CCGetRequestParam("Link3", ccsGet));
$Link3->Parameters = CCGetQueryString("QueryString", Array("ccsForm"));
$Link3->Page = "delete_winning_tickets.php";
$footer = new clsfooter();
$footer->BindEvents();
$footer->TemplatePath = "./";
$footer->Initialize();
if(!strlen($GetPlaysThisMonth->Value) && $GetPlaysThisMonth->Value !== false)
    $GetPlaysThisMonth->SetValue(Custom_GetPlaysThisMonth());
if(!strlen($GetWinsThisMonth->Value) && $GetWinsThisMonth->Value !== false)
    $GetWinsThisMonth->SetValue(Custom_GetTotalWinsThisMonth());
if(!strlen($GetPlaysToday->Value) && $GetPlaysToday->Value !== false)
    $GetPlaysToday->SetValue(Custom_GetPlaysToday());
if(!strlen($GetTotalWinsToday->Value) && $GetTotalWinsToday->Value !== false)
    $GetTotalWinsToday->SetValue(Custom_GetTotalWinsToday());

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

//Show Page @1-6566481A
$header->Show("header");
$GetPlaysThisMonth->Show();
$GetWinsThisMonth->Show();
$GetPlaysToday->Show();
$GetTotalWinsToday->Show();
$Link1->Show();
$Link2->Show();
$Link3->Show();
$footer->Show("footer");
$Tpl->PParse("main", false);
//End Show Page

//Unload Page @1-AB7622EF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload");
unset($Tpl);
//End Unload Page


?>
