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

//Include Page implementation @32-E34C2C5D
include("./header.php");
//End Include Page implementation

Class clsRecordticketSearch { //ticketSearch Class @2-CA8B6C4C

//Variables @2-90DA4C9A

    // Public variables
    var $ComponentName;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $FormSubmitted;
    var $Visible;
    var $Recordset;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $ds;
    var $EditMode;
    var $ValidatingControls;
    var $Controls;

    // Class variables
//End Variables

//Class_Initialize Event @2-68662E3C
    function clsRecordticketSearch()
    {

        global $FileName;
        $this->Visible = true;
        $this->Errors = new clsErrors();
        if($this->Visible)
        {
            $this->ComponentName = "ticketSearch";
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $this->ComponentName);
            $CCSForm = CCGetFromGet("ccsForm", "");
            $this->FormSubmitted = ($CCSForm == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_Email_Address = new clsControl(ccsTextBox, "s_Email_Address", "s_Email_Address", ccsText, "", CCGetRequestParam("s_Email_Address", $Method));
            $this->DoSearch = new clsButton("DoSearch");
        }
    }
//End Class_Initialize Event

//Validate Method @2-32776C17
    function Validate()
    {
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_Email_Address->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate");
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//Operation Method @2-6FB9E54C
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->EditMode = true;
        if(!$this->FormSubmitted)
            return;

        if($this->FormSubmitted) {
            $this->PressedButton = "DoSearch";
            if(strlen(CCGetParam("DoSearch", ""))) {
                $this->PressedButton = "DoSearch";
            }
        }
        $Redirect = "list_winners.php?" . CCGetQueryString("Form", Array("DoSearch","ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "DoSearch") {
                if(!CCGetEvent($this->DoSearch->CCSEvents, "OnClick")) {
                    $Redirect = "";
                } else {
                    $Redirect = "list_winners.php?" . CCGetQueryString("Form", Array("DoSearch"));
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-B731302D
    function Show()
    {
        global $Tpl;
        global $FileName;
        $Error = "";

        if(!$this->Visible)
            return;


        $RecordBlock = "Record " . $this->ComponentName;
        $Tpl->block_path = $RecordBlock;
        if(!$this->FormSubmitted)
        {
        }

        if($this->FormSubmitted) {
            $Error .= $this->s_Email_Address->Errors->ToString();
            $Error .= $this->Errors->ToString();
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $Tpl->SetVar("Action", $this->HTMLFormAction);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow");
        $this->s_Email_Address->Show();
        $this->DoSearch->Show();
        $Tpl->parse("", false);
        $Tpl->block_path = "";
    }
//End Show Method

} //End ticketSearch Class @2-FCB6E20C

class clsGridticket { //ticket class @10-A552DF4F

//Variables @10-6CC4FA12

    // Public variables
    var $ComponentName;
    var $Visible; var $Errors;
    var $ds; var $PageSize;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;

    var $CCSEvents = "";
    var $CCSEventResult;

    // Grid Controls
    var $StaticControls; var $RowControls;
    var $Sorter_Ticket_ID;
    var $Sorter_Email_Address;
    var $Sorter_DrawDate;
    var $Sorter_Number_1;
    var $Sorter_Number_2;
    var $Sorter_Played;
    var $Navigator;
//End Variables

//Class_Initialize Event @10-94582403
    function clsGridticket()
    {
        global $FileName;
        $this->ComponentName = "ticket";
        $this->Visible = True;
        $this->Errors = new clsErrors();
        $this->ds = new clsticketDataSource();
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        $this->SorterName = CCGetParam("ticketOrder", "");
        $this->SorterDirection = CCGetParam("ticketDir", "");

        $this->Ticket_ID = new clsControl(ccsLink, "Ticket_ID", "Ticket_ID", ccsInteger, "", CCGetRequestParam("Ticket_ID", ccsGet));
        $this->Email_Address = new clsControl(ccsLabel, "Email_Address", "Email_Address", ccsText, "", CCGetRequestParam("Email_Address", ccsGet));
        $this->Email_Address->HTML = true;
        $this->DrawDate = new clsControl(ccsLabel, "DrawDate", "DrawDate", ccsDate, Array("mm", "/", "dd", "/", "yyyy"), CCGetRequestParam("DrawDate", ccsGet));
        $this->Number_1 = new clsControl(ccsLabel, "Number_1", "Number_1", ccsInteger, "", CCGetRequestParam("Number_1", ccsGet));
        $this->Number_2 = new clsControl(ccsLabel, "Number_2", "Number_2", ccsInteger, "", CCGetRequestParam("Number_2", ccsGet));
        $this->Played = new clsControl(ccsLabel, "Played", "Played", ccsText, "", CCGetRequestParam("Played", ccsGet));
        $this->Sorter_Ticket_ID = new clsSorter($this->ComponentName, "Sorter_Ticket_ID", $FileName);
        $this->Sorter_Email_Address = new clsSorter($this->ComponentName, "Sorter_Email_Address", $FileName);
        $this->Sorter_DrawDate = new clsSorter($this->ComponentName, "Sorter_DrawDate", $FileName);
        $this->Sorter_Number_1 = new clsSorter($this->ComponentName, "Sorter_Number_1", $FileName);
        $this->Sorter_Number_2 = new clsSorter($this->ComponentName, "Sorter_Number_2", $FileName);
        $this->Sorter_Played = new clsSorter($this->ComponentName, "Sorter_Played", $FileName);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple);
    }
//End Class_Initialize Event

//Initialize Method @10-383CA3E0
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->ds->PageSize = $this->PageSize;
        $this->ds->SetOrder($this->SorterName, $this->SorterDirection);
        $this->ds->AbsolutePage = $this->PageNumber;
    }
//End Initialize Method

//Show Method @10-FE21FD2A
    function Show()
    {
        global $Tpl;
        if(!$this->Visible) return;


        $ShownRecords = 0;

        $this->ds->Parameters["urls_Email_Address"] = CCGetFromGet("s_Email_Address", "");
        $this->ds->Prepare();
        $this->ds->Open();

        $GridBlock = "Grid " . $this->ComponentName;
        $Tpl->block_path = $GridBlock;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow");


        $is_next_record = $this->ds->next_record();
        if($is_next_record && $ShownRecords < $this->PageSize)
        {
            do {
                    $this->ds->SetValues();
                $Tpl->block_path = $GridBlock . "/Row";
                $this->Ticket_ID->SetValue($this->ds->Ticket_ID->GetValue());
                $this->Ticket_ID->Parameters = CCGetQueryString("QueryString", Array("ccsForm"));
                $this->Ticket_ID->Parameters = CCAddParam($this->Ticket_ID->Parameters, "Ticket_ID", $this->ds->f("Ticket_ID"));
                $this->Ticket_ID->Page = "edit_tickets.php";
                $this->Email_Address->SetValue($this->ds->Email_Address->GetValue());
                $this->DrawDate->SetValue($this->ds->DrawDate->GetValue());
                $this->Number_1->SetValue($this->ds->Number_1->GetValue());
                $this->Number_2->SetValue($this->ds->Number_2->GetValue());
                $this->Played->SetValue($this->ds->Played->GetValue());
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow");
                $this->Ticket_ID->Show();
                $this->Email_Address->Show();
                $this->DrawDate->Show();
                $this->Number_1->Show();
                $this->Number_2->Show();
                $this->Played->Show();
                $Tpl->block_path = $GridBlock;
                $Tpl->parse("Row", true);
                $ShownRecords++;
                $is_next_record = $this->ds->next_record();
            } while ($is_next_record && $ShownRecords < $this->PageSize);
        }
        else // Show NoRecords block if no records are found
        {
            $Tpl->parse("NoRecords", false);
        }

        $this->Navigator->TotalPages = $this->ds->PageCount();
        $this->Sorter_Ticket_ID->Show();
        $this->Sorter_Email_Address->Show();
        $this->Sorter_DrawDate->Show();
        $this->Sorter_Number_1->Show();
        $this->Sorter_Number_2->Show();
        $this->Sorter_Played->Show();
        $this->Navigator->Show();
        $Tpl->parse("", false);
        $Tpl->block_path = "";
    }
//End Show Method

} //End ticket Class @10-FCB6E20C

class clsticketDataSource extends clsDBConnection {  //ticketDataSource Class @10-F9F8BD8E

//DataSource Variables @10-C88A6C22
    var $CCSEvents = "";
    var $CCSEventResult;

    var $CountSQL;
    var $wp;

    // Datasource fields
    var $Ticket_ID;
    var $Email_Address;
    var $DrawDate;
    var $Number_1;
    var $Number_2;
    var $Played;
//End DataSource Variables

//Class_Initialize Event @10-3975F5DA
    function clsticketDataSource()
    {
        $this->Initialize();
        $this->Ticket_ID = new clsField("Ticket_ID", ccsInteger, "");
        $this->Email_Address = new clsField("Email_Address", ccsText, "");
        $this->DrawDate = new clsField("DrawDate", ccsDate, Array("yyyy", "-", "mm", "-", "dd"));
        $this->Number_1 = new clsField("Number_1", ccsInteger, "");
        $this->Number_2 = new clsField("Number_2", ccsInteger, "");
        $this->Played = new clsField("Played", ccsText, "");

    }
//End Class_Initialize Event

//SetOrder Method @10-184BAB45
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection,
            array("Sorter_Ticket_ID" => array("Ticket_ID", ""),
            "Sorter_Email_Address" => array("Email_Address", ""),
            "Sorter_DrawDate" => array("DrawDate", ""),
            "Sorter_Number_1" => array("Number_1", ""),
            "Sorter_Number_2" => array("Number_2", ""),
            "Sorter_Played" => array("Played", "")));
    }
//End SetOrder Method

//Prepare Method @10-E0DCF039
    function Prepare()
    {
        $this->wp = new clsSQLParameters();
        $this->wp->AddParameter("2", "urls_Email_Address", ccsText, "", "", $this->Parameters["urls_Email_Address"], "");
        $this->wp->Criterion[1] = "Played='Y' AND ((Number_1=Pick_1 OR Number_1=Pick_2 OR Number_1=Pick_3 OR Number_1=Pick_4) AND (Number_2=Pick_1 OR Number_2=Pick_2 OR Number_2=Pick_3 OR Number_2=Pick_4))";
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "`Email_Address`", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText));
        $this->Where = $this->wp->opAND(false, $this->wp->Criterion[1], $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @10-82231D23
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect");
        $this->CountSQL = "SELECT COUNT(*)  " .
        "FROM ticket";
        $this->SQL = "SELECT *  " .
        "FROM ticket";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect");
        $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect");
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @10-E5E8B5A3
    function SetValues()
    {
        $this->Ticket_ID->SetDBValue($this->f("Ticket_ID"));
        $this->Email_Address->SetDBValue(urldecode($this->f("Email_Address")));
        $this->DrawDate->SetDBValue($this->f("DrawDate"));
        $this->Number_1->SetDBValue($this->f("Number_1"));
        $this->Number_2->SetDBValue($this->f("Number_2"));
        $this->Played->SetDBValue($this->f("Played"));
    }
//End SetValues Method

} //End ticketDataSource Class @10-FCB6E20C

//Include Page implementation @33-86456262
include("./footer.php");
//End Include Page implementation

//Initialize Page @1-AD063584
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

$FileName = "list_winners.php";
$Redirect = "";
$TemplateFileName = "list_winners.html";
$BlockToParse = "main";
$PathToRoot = "../";
//End Initialize Page

//Authenticate User @1-7FED0150
CCSecurityRedirect("1;2", "login.php", $FileName, CCGetQueryString("QueryString", ""));
//End Authenticate User


//Initialize Objects @1-0664C7D6
$DBConnection = new clsDBConnection();

// Controls
$header = new clsheader();
$header->BindEvents();
$header->TemplatePath = "./";
$header->Initialize();
$ticketSearch = new clsRecordticketSearch();
$ticket = new clsGridticket();
$footer = new clsfooter();
$footer->BindEvents();
$footer->TemplatePath = "./";
$footer->Initialize();
$ticket->Initialize();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize");
//End Initialize Objects

//Execute Components @1-941F2934
$header->Operations();
$ticketSearch->Operation();
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

//Show Page @1-54D9D979
$header->Show("header");
$ticketSearch->Show();
$ticket->Show();
$footer->Show("footer");
$Tpl->PParse("main", false);
//End Show Page

//Unload Page @1-AB7622EF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload");
unset($Tpl);
//End Unload Page


?>
