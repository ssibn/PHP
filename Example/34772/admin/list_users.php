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

//Include Page implementation @21-E34C2C5D
include("./header.php");
//End Include Page implementation

Class clsRecordusersSearch { //usersSearch Class @2-4B2A360C

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

//Class_Initialize Event @2-B28FB7E6
    function clsRecordusersSearch()
    {

        global $FileName;
        $this->Visible = true;
        $this->Errors = new clsErrors();
        if($this->Visible)
        {
            $this->ComponentName = "usersSearch";
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

//Operation Method @2-26CBC74C
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
        $Redirect = "list_users.php?" . CCGetQueryString("Form", Array("DoSearch","ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "DoSearch") {
                if(!CCGetEvent($this->DoSearch->CCSEvents, "OnClick")) {
                    $Redirect = "";
                } else {
                    $Redirect = "list_users.php?" . CCGetQueryString("Form", Array("DoSearch"));
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

} //End usersSearch Class @2-FCB6E20C

class clsGridusers { //users class @6-0CB76799

//Variables @6-A66935C8

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
    var $Sorter_Users_ID;
    var $Sorter_Users_Name;
    var $Sorter_Users_Password;
    var $Sorter_Users_Access;
    var $Navigator;
//End Variables

//Class_Initialize Event @6-158E9E0F
    function clsGridusers()
    {
        global $FileName;
        $this->ComponentName = "users";
        $this->Visible = True;
        $this->Errors = new clsErrors();
        $this->ds = new clsusersDataSource();
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        $this->SorterName = CCGetParam("usersOrder", "");
        $this->SorterDirection = CCGetParam("usersDir", "");

        $this->Users_ID = new clsControl(ccsLink, "Users_ID", "Users_ID", ccsInteger, "", CCGetRequestParam("Users_ID", ccsGet));
        $this->Users_Name = new clsControl(ccsLabel, "Users_Name", "Users_Name", ccsText, "", CCGetRequestParam("Users_Name", ccsGet));
        $this->Users_Password = new clsControl(ccsLabel, "Users_Password", "Users_Password", ccsText, "", CCGetRequestParam("Users_Password", ccsGet));
        $this->Users_Access = new clsControl(ccsLabel, "Users_Access", "Users_Access", ccsInteger, "", CCGetRequestParam("Users_Access", ccsGet));
        $this->Sorter_Users_ID = new clsSorter($this->ComponentName, "Sorter_Users_ID", $FileName);
        $this->Sorter_Users_Name = new clsSorter($this->ComponentName, "Sorter_Users_Name", $FileName);
        $this->Sorter_Users_Password = new clsSorter($this->ComponentName, "Sorter_Users_Password", $FileName);
        $this->Sorter_Users_Access = new clsSorter($this->ComponentName, "Sorter_Users_Access", $FileName);
        $this->users_Insert = new clsControl(ccsLink, "users_Insert", "users_Insert", ccsText, "", CCGetRequestParam("users_Insert", ccsGet));
        $this->users_Insert->Parameters = CCGetQueryString("QueryString", Array("Users_ID", "ccsForm"));
        $this->users_Insert->Page = "edit_users.php";
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple);
    }
//End Class_Initialize Event

//Initialize Method @6-383CA3E0
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->ds->PageSize = $this->PageSize;
        $this->ds->SetOrder($this->SorterName, $this->SorterDirection);
        $this->ds->AbsolutePage = $this->PageNumber;
    }
//End Initialize Method

//Show Method @6-6F7A6B15
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
                $this->Users_ID->SetValue($this->ds->Users_ID->GetValue());
                $this->Users_ID->Parameters = CCGetQueryString("QueryString", Array("ccsForm"));
                $this->Users_ID->Parameters = CCAddParam($this->Users_ID->Parameters, "Users_ID", $this->ds->f("Users_ID"));
                $this->Users_ID->Page = "edit_users.php";
                $this->Users_Name->SetValue($this->ds->Users_Name->GetValue());
                $this->Users_Password->SetValue($this->ds->Users_Password->GetValue());
                $this->Users_Access->SetValue($this->ds->Users_Access->GetValue());
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow");
                $this->Users_ID->Show();
                $this->Users_Name->Show();
                $this->Users_Password->Show();
                $this->Users_Access->Show();
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
        $this->Sorter_Users_ID->Show();
        $this->Sorter_Users_Name->Show();
        $this->Sorter_Users_Password->Show();
        $this->Sorter_Users_Access->Show();
        $this->users_Insert->Show();
        $this->Navigator->Show();
        $Tpl->parse("", false);
        $Tpl->block_path = "";
    }
//End Show Method

} //End users Class @6-FCB6E20C

class clsusersDataSource extends clsDBConnection {  //usersDataSource Class @6-F58FF67F

//DataSource Variables @6-912525BF
    var $CCSEvents = "";
    var $CCSEventResult;

    var $CountSQL;
    var $wp;

    // Datasource fields
    var $Users_ID;
    var $Users_Name;
    var $Users_Password;
    var $Users_Access;
//End DataSource Variables

//Class_Initialize Event @6-2F72197A
    function clsusersDataSource()
    {
        $this->Initialize();
        $this->Users_ID = new clsField("Users_ID", ccsInteger, "");
        $this->Users_Name = new clsField("Users_Name", ccsText, "");
        $this->Users_Password = new clsField("Users_Password", ccsText, "");
        $this->Users_Access = new clsField("Users_Access", ccsInteger, "");

    }
//End Class_Initialize Event

//SetOrder Method @6-F8633E7A
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection,
            array("Sorter_Users_ID" => array("Users_ID", ""),
            "Sorter_Users_Name" => array("Users_Name", ""),
            "Sorter_Users_Password" => array("Users_Password", ""),
            "Sorter_Users_Access" => array("Users_Access", "")));
    }
//End SetOrder Method

//Prepare Method @6-7ABF8FA9
    function Prepare()
    {
        $this->wp = new clsSQLParameters();
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "");
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "");
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "`Users_Name`", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText));
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "`Users_Password`", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText));
        $this->Where = $this->wp->opOR(false, $this->wp->Criterion[1], $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @6-28C412B2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect");
        $this->CountSQL = "SELECT COUNT(*)  " .
        "FROM users";
        $this->SQL = "SELECT *  " .
        "FROM users";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect");
        $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect");
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @6-FA282904
    function SetValues()
    {
        $this->Users_ID->SetDBValue($this->f("Users_ID"));
        $this->Users_Name->SetDBValue($this->f("Users_Name"));
        $this->Users_Password->SetDBValue($this->f("Users_Password"));
        $this->Users_Access->SetDBValue($this->f("Users_Access"));
    }
//End SetValues Method

} //End usersDataSource Class @6-FCB6E20C

//Include Page implementation @22-86456262
include("./footer.php");
//End Include Page implementation

//Initialize Page @1-6AF56463
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

$FileName = "list_users.php";
$Redirect = "";
$TemplateFileName = "list_users.html";
$BlockToParse = "main";
$PathToRoot = "../";
//End Initialize Page

//Authenticate User @1-2CA9346F
CCSecurityRedirect("2", "login.php", $FileName, CCGetQueryString("QueryString", ""));
//End Authenticate User

//Initialize Objects @1-7B1FD0F8
$DBConnection = new clsDBConnection();

// Controls
$Header = new clsheader();
$Header->BindEvents();
$Header->TemplatePath = "./";
$Header->Initialize();
$usersSearch = new clsRecordusersSearch();
$users = new clsGridusers();
$Footer = new clsfooter();
$Footer->BindEvents();
$Footer->TemplatePath = "./";
$Footer->Initialize();
$users->Initialize();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize");
//End Initialize Objects

//Execute Components @1-25003A86
$Header->Operations();
$usersSearch->Operation();
$Footer->Operations();
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

//Show Page @1-D35F5D65
$Header->Show("Header");
$usersSearch->Show();
$users->Show();
$Footer->Show("Footer");
$Tpl->PParse("main", false);
//End Show Page

//Unload Page @1-AB7622EF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload");
unset($Tpl);
//End Unload Page


?>
