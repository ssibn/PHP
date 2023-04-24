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

//Operation Method @2-78604202
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
        $Redirect = "list_emails.php?" . CCGetQueryString("Form", Array("DoSearch","ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "DoSearch") {
                if(!CCGetEvent($this->DoSearch->CCSEvents, "OnClick")) {
                    $Redirect = "";
                } else {
                    $Redirect = "list_emails.php?" . CCGetQueryString("Form", Array("DoSearch"));
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

//Variables @5-166887C2

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
    var $Sorter_Games_Played;
    var $Sorter_Email_Address;
//End Variables

//Class_Initialize Event @5-39790403
    function clsGridticket()
    {
        global $FileName;
        $this->ComponentName = "ticket";
        $this->Visible = True;
        $this->Errors = new clsErrors();
        $this->ds = new clsticketDataSource();
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        $this->SorterName = CCGetParam("ticketOrder", "");
        $this->SorterDirection = CCGetParam("ticketDir", "");

        $this->Games_Played = new clsControl(ccsLabel, "Games_Played", "Games_Played", ccsInteger, "", CCGetRequestParam("Games_Played", ccsGet));
        $this->Email_Address = new clsControl(ccsLabel, "Email_Address", "Email_Address", ccsText, "", CCGetRequestParam("Email_Address", ccsGet));
        $this->Email_Address->HTML = true;
        $this->Sorter_Games_Played = new clsSorter($this->ComponentName, "Sorter_Games_Played", $FileName);
        $this->Sorter_Email_Address = new clsSorter($this->ComponentName, "Sorter_Email_Address", $FileName);
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

//Show Method @5-1B2FBA80
    function Show()
    {
        global $Tpl;
        if(!$this->Visible) return;


        $ShownRecords = 0;

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
                $this->Games_Played->SetValue($this->ds->Games_Played->GetValue());
                $this->Email_Address->SetValue($this->ds->Email_Address->GetValue());
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow");
                $this->Games_Played->Show();
                $this->Email_Address->Show();
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

        $this->Sorter_Games_Played->Show();
        $this->Sorter_Email_Address->Show();
        $Tpl->parse("", false);
        $Tpl->block_path = "";
    }
//End Show Method

} //End ticket Class @5-FCB6E20C

class clsticketDataSource extends clsDBConnection {  //ticketDataSource Class @5-F9F8BD8E

//DataSource Variables @5-E41E8353
    var $CCSEvents = "";
    var $CCSEventResult;

    var $CountSQL;
    var $wp;

    // Datasource fields
    var $Games_Played;
    var $Email_Address;
//End DataSource Variables

//Class_Initialize Event @5-73C49C76
    function clsticketDataSource()
    {
        $this->Initialize();
        $this->Games_Played = new clsField("Games_Played", ccsInteger, "");
        $this->Email_Address = new clsField("Email_Address", ccsText, "");

    }
//End Class_Initialize Event

//SetOrder Method @5-86D617A5
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection,
            array("Sorter_Games_Played" => array("Games_Played", ""),
            "Sorter_Email_Address" => array("Email_Address", "")));
    }
//End SetOrder Method

//Prepare Method @5-DFF3DD87
    function Prepare()
    {
    }
//End Prepare Method

//Open Method @5-33B70850
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect");
        $this->CountSQL = "SELECT COUNT(*) FROM ticket " .
        "group by Email_Address";
        $this->SQL = "select count(ticket_id) as Games_Played, Email_Address " .
        "from ticket " .
        "group by Email_Address";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect");
        $this->RecordsCount = CCGetDBValue($this->CountSQL, $this);
        $this->query(CCBuildSQL($this->SQL, "", $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect");
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @5-65D4D839
    function SetValues()
    {
        $this->Games_Played->SetDBValue($this->f("Games_Played"));
        $this->Email_Address->SetDBValue(urldecode($this->f("Email_Address")));
    }
//End SetValues Method

} //End ticketDataSource Class @5-FCB6E20C

//Include Page implementation @44-86456262
include("./footer.php");
//End Include Page implementation


//Initialize Page @1-10747C51
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

$FileName = "list_emails.php";
$Redirect = "";
$TemplateFileName = "list_emails.html";
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
