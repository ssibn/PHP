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

class clsGridticket { //ticket class @4-A552DF4F

//Variables @4-F20EDA04

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
    var $Sorter_Month;
    var $Sorter_Count;
//End Variables

//Class_Initialize Event @4-501F8D6E
    function clsGridticket()
    {
        global $FileName;
        $this->ComponentName = "ticket";
        $this->Visible = True;
        $this->Errors = new clsErrors();
        $this->ds = new clsticketDataSource();
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 12;
        else
            $this->PageSize = intval($this->PageSize);
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        $this->SorterName = CCGetParam("ticketOrder", "");
        $this->SorterDirection = CCGetParam("ticketDir", "");

        $this->Date = new clsControl(ccsLabel, "Date", "Date", ccsInteger, "", CCGetRequestParam("Date", ccsGet));
        $this->Count = new clsControl(ccsLabel, "Count", "Count", ccsInteger, "", CCGetRequestParam("Count", ccsGet));
        $this->WinsForMonth = new clsControl(ccsLabel, "WinsForMonth", "WinsForMonth", ccsText, "", CCGetRequestParam("WinsForMonth", ccsGet));
        $this->Sorter_Month = new clsSorter($this->ComponentName, "Sorter_Month", $FileName);
        $this->Sorter_Count = new clsSorter($this->ComponentName, "Sorter_Count", $FileName);
    }
//End Class_Initialize Event

//Initialize Method @4-383CA3E0
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->ds->PageSize = $this->PageSize;
        $this->ds->SetOrder($this->SorterName, $this->SorterDirection);
        $this->ds->AbsolutePage = $this->PageNumber;
    }
//End Initialize Method

//Show Method @4-BFC1EA82
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
                $this->Date->SetValue($this->ds->Date->GetValue());
                $this->Count->SetValue($this->ds->Count->GetValue());
                $this->WinsForMonth->SetValue(Custom_GetTotalWinsForMonth($this->ds->Date->GetValue()));
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow");
                $this->Date->Show();
                $this->Count->Show();
                $this->WinsForMonth->Show();
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

        $this->Sorter_Month->Show();
        $this->Sorter_Count->Show();
        $Tpl->parse("", false);
        $Tpl->block_path = "";
    }
//End Show Method

} //End ticket Class @4-FCB6E20C

class clsticketDataSource extends clsDBConnection {  //ticketDataSource Class @4-F9F8BD8E

//DataSource Variables @4-0845EFC4
    var $CCSEvents = "";
    var $CCSEventResult;

    var $CountSQL;
    var $wp;

    // Datasource fields
    var $Date;
    var $Count;
//End DataSource Variables

//Class_Initialize Event @4-53E325C7
    function clsticketDataSource()
    {
        $this->Initialize();
        $this->Date = new clsField("Date", ccsInteger, "");
        $this->Count = new clsField("Count", ccsInteger, "");

    }
//End Class_Initialize Event

//SetOrder Method @4-D156EC0D
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection,
            array("Sorter_Month" => array("Date", ""),
            "Sorter_Count" => array("Count", "")));
    }
//End SetOrder Method

//Prepare Method @4-DFF3DD87
    function Prepare()
    {
    }
//End Prepare Method

//Open Method @4-1AE8A284
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect");
        $this->CountSQL = "SELECT COUNT(*) FROM ticket GROUP BY Month(DrawDate)";
        $this->SQL = "SELECT Month(DrawDate) as Date, count( ticket_id ) as Count FROM ticket GROUP BY Month(DrawDate)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect");
        $this->RecordsCount = CCGetDBValue($this->CountSQL, $this);
        $this->query(CCBuildSQL($this->SQL, "", $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect");
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @4-28F5F153
    function SetValues()
    {
        $this->Date->SetDBValue($this->f("Date"));
        $this->Count->SetDBValue($this->f("Count"));
    }
//End SetValues Method

} //End ticketDataSource Class @4-FCB6E20C


//Include Page implementation @3-86456262
include("./footer.php");
//End Include Page implementation

//Initialize Page @1-8B54DBB4
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

$FileName = "monthlystats.php";
$Redirect = "";
$TemplateFileName = "monthlystats.html";
$BlockToParse = "main";
$PathToRoot = "../";
//End Initialize Page

//Authenticate User @1-7FED0150
CCSecurityRedirect("1;2", "login.php", $FileName, CCGetQueryString("QueryString", ""));
//End Authenticate User


//Initialize Objects @1-36E04772
$DBConnection = new clsDBConnection();

// Controls
$header = new clsheader();
$header->BindEvents();
$header->TemplatePath = "./";
$header->Initialize();
$ticket = new clsGridticket();
$footer = new clsfooter();
$footer->BindEvents();
$footer->TemplatePath = "./";
$footer->Initialize();
$ticket->Initialize();

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

//Show Page @1-1855787F
$header->Show("header");
$ticket->Show();
$footer->Show("footer");
$Tpl->PParse("main", false);
//End Show Page

//Unload Page @1-AB7622EF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload");
unset($Tpl);
//End Unload Page


?>
