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

//Include Page implementation @43-E34C2C5D
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

//Class_Initialize Event @2-6520A772
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
            $this->s_keyword = new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method));
            $this->DoSearch = new clsButton("DoSearch");
        }
    }
//End Class_Initialize Event

//Validate Method @2-F230E30A
    function Validate()
    {
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate");
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//Operation Method @2-14970EDB
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
        $Redirect = "list_tickets.php?" . CCGetQueryString("Form", Array("DoSearch","ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "DoSearch") {
                if(!CCGetEvent($this->DoSearch->CCSEvents, "OnClick")) {
                    $Redirect = "";
                } else {
                    $Redirect = "list_tickets.php?" . CCGetQueryString("Form", Array("DoSearch"));
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-EF1FA547
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
            $Error .= $this->s_keyword->Errors->ToString();
            $Error .= $this->Errors->ToString();
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $Tpl->SetVar("Action", $this->HTMLFormAction);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow");
        $this->s_keyword->Show();
        $this->DoSearch->Show();
        $Tpl->parse("", false);
        $Tpl->block_path = "";
    }
//End Show Method

} //End ticketSearch Class @2-FCB6E20C

class clsGridticket { //ticket class @5-A552DF4F

//Variables @5-7E0A3FD7

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
    var $Sorter_Played;
    var $Navigator;
//End Variables

//Class_Initialize Event @5-BE08C00C
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
        $this->Played = new clsControl(ccsLabel, "Played", "Played", ccsText, "", CCGetRequestParam("Played", ccsGet));
        $this->Sorter_Ticket_ID = new clsSorter($this->ComponentName, "Sorter_Ticket_ID", $FileName);
        $this->Sorter_Email_Address = new clsSorter($this->ComponentName, "Sorter_Email_Address", $FileName);
        $this->Sorter_DrawDate = new clsSorter($this->ComponentName, "Sorter_DrawDate", $FileName);
        $this->Sorter_Played = new clsSorter($this->ComponentName, "Sorter_Played", $FileName);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple);
    }
//End Class_Initialize Event

//Initialize Method @5-383CA3E0
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->ds->PageSize = $this->PageSize;
        $this->ds->SetOrder($this->SorterName, $this->SorterDirection);
        $this->ds->AbsolutePage = $this->PageNumber;
    }
//End Initialize Method

//Show Method @5-30F1C21A
    function Show()
    {
        global $Tpl;
        if(!$this->Visible) return;


        $ShownRecords = 0;

        $this->ds->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", "");
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
                $this->Played->SetValue($this->ds->Played->GetValue());
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow");
                $this->Ticket_ID->Show();
                $this->Email_Address->Show();
                $this->DrawDate->Show();
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
        $this->Sorter_Played->Show();
        $this->Navigator->Show();
        $Tpl->parse("", false);
        $Tpl->block_path = "";
    }
//End Show Method

} //End ticket Class @5-FCB6E20C

class clsticketDataSource extends clsDBConnection {  //ticketDataSource Class @5-F9F8BD8E

//DataSource Variables @5-F5A4064F
    var $CCSEvents = "";
    var $CCSEventResult;

    var $CountSQL;
    var $wp;

    // Datasource fields
    var $Ticket_ID;
    var $Email_Address;
    var $DrawDate;
    var $Played;
//End DataSource Variables

//Class_Initialize Event @5-5BE8D079
    function clsticketDataSource()
    {
        $this->Initialize();
        $this->Ticket_ID = new clsField("Ticket_ID", ccsInteger, "");
        $this->Email_Address = new clsField("Email_Address", ccsText, "");
        $this->DrawDate = new clsField("DrawDate", ccsDate, Array("yyyy", "-", "mm", "-", "dd"));
        $this->Played = new clsField("Played", ccsText, "");

    }
//End Class_Initialize Event

//SetOrder Method @5-9A5ACDD2
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection,
            array("Sorter_Ticket_ID" => array("Ticket_ID", ""),
            "Sorter_Email_Address" => array("Email_Address", ""),
            "Sorter_DrawDate" => array("DrawDate", ""),
            "Sorter_Played" => array("Played", "")));
    }
//End SetOrder Method

//Prepare Method @5-A2D915CB
    function Prepare()
    {
        $this->wp = new clsSQLParameters();
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "");
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "");
        $this->wp->AddParameter("3", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "");
        $this->wp->AddParameter("4", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "");
        $this->wp->AddParameter("5", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "");
        $this->wp->AddParameter("6", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "");
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "`Email_Address`", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText));
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "`Show_1`", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText));
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "`Show_2`", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText));
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "`Show_3`", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText));
        $this->wp->Criterion[5] = $this->wp->Operation(opContains, "`Show_4`", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText));
        $this->wp->Criterion[6] = $this->wp->Operation(opContains, "`Played`", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText));
        $this->Where = $this->wp->opOR(false, $this->wp->opOR(false, $this->wp->opOR(false, $this->wp->opOR(false, $this->wp->opOR(false, $this->wp->Criterion[1], $this->wp->Criterion[2]), $this->wp->Criterion[3]), $this->wp->Criterion[4]), $this->wp->Criterion[5]), $this->wp->Criterion[6]);
    }
//End Prepare Method

//Open Method @5-82231D23
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

//SetValues Method @5-4A0F990F
    function SetValues()
    {
        $this->Ticket_ID->SetDBValue($this->f("Ticket_ID"));
        $this->Email_Address->SetDBValue(urldecode($this->f("Email_Address")));
        $this->DrawDate->SetDBValue($this->f("DrawDate"));
        $this->Played->SetDBValue($this->f("Played"));
    }
//End SetValues Method

} //End ticketDataSource Class @5-FCB6E20C

//Include Page implementation @44-86456262
include("./footer.php");
//End Include Page implementation


//Initialize Page @1-58D1BAC1
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

$FileName = "list_tickets.php";
$Redirect = "";
$TemplateFileName = "list_tickets.html";
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
