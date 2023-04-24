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

//Include Page implementation @7-E34C2C5D
include("./header.php");
//End Include Page implementation

Class clsRecordLogin { //Login Class @2-426E3B84

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

//Class_Initialize Event @2-340409F8
    function clsRecordLogin()
    {

        global $FileName;
        $this->Visible = true;
        $this->Errors = new clsErrors();
        if($this->Visible)
        {
            $this->ComponentName = "Login";
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $this->ComponentName);
            $CCSForm = CCGetFromGet("ccsForm", "");
            $this->FormSubmitted = ($CCSForm == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->login = new clsControl(ccsTextBox, "login", "login", ccsText, "", CCGetRequestParam("login", $Method));
            $this->login->Required = true;
            $this->password = new clsControl(ccsTextBox, "password", "password", ccsText, "", CCGetRequestParam("password", $Method));
            $this->password->Required = true;
            $this->DoLogin = new clsButton("DoLogin");
        }
    }
//End Class_Initialize Event

//Validate Method @2-FCD4B6B1
    function Validate()
    {
        $Validation = true;
        $Where = "";
        $Validation = ($this->login->Validate() && $Validation);
        $Validation = ($this->password->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate");
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//Operation Method @2-EB5F02D7
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
            $this->PressedButton = "DoLogin";
            if(strlen(CCGetParam("DoLogin", ""))) {
                $this->PressedButton = "DoLogin";
            }
        }
        $Redirect = $FileName . "";
        if($this->Validate()) {
            if($this->PressedButton == "DoLogin") {
                if(!CCGetEvent($this->DoLogin->CCSEvents, "OnClick")) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-81C0BC85
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
            $Error .= $this->login->Errors->ToString();
            $Error .= $this->password->Errors->ToString();
            $Error .= $this->Errors->ToString();
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $Tpl->SetVar("Action", $this->HTMLFormAction);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow");
        $this->login->Show();
        $this->password->Show();
        $this->DoLogin->Show();
        $Tpl->parse("", false);
        $Tpl->block_path = "";
    }
//End Show Method

} //End Login Class @2-FCB6E20C

//Include Page implementation @8-86456262
include("./footer.php");
//End Include Page implementation

//Initialize Page @1-7FCD6DC5
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

$FileName = "login.php";
$Redirect = "";
$TemplateFileName = "login.html";
$BlockToParse = "main";
$PathToRoot = "../";
//End Initialize Page

//Initialize Objects @1-46AE3FC6

// Controls
$Header = new clsheader();
$Header->BindEvents();
$Header->TemplatePath = "./";
$Header->Initialize();
$Login = new clsRecordLogin();
$Footer = new clsfooter();
$Footer->BindEvents();
$Footer->TemplatePath = "./";
$Footer->Initialize();

// Events
include("./login_events.php");
BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize");
//End Initialize Objects

//Execute Components @1-5D676E38
$Header->Operations();
$Login->Operation();
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

//Show Page @1-0A56E5AB
$Header->Show("Header");
$Login->Show();
$Footer->Show("Footer");
$Tpl->PParse("main", false);
//End Show Page

//Unload Page @1-AB7622EF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload");
unset($Tpl);
//End Unload Page


?>
