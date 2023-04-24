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

//Include Page implementation @11-E34C2C5D
include("./header.php");
//End Include Page implementation

Class clsRecordusers { //users Class @2-811DFF64

//Variables @2-D65AB00C

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

    var $InsertAllowed;
    var $UpdateAllowed;
    var $DeleteAllowed;
    var $ds;
    var $EditMode;
    var $ValidatingControls;
    var $Controls;

    // Class variables
//End Variables

//Class_Initialize Event @2-7FF2B40B
    function clsRecordusers()
    {

        global $FileName;
        $this->Visible = true;
        $this->Errors = new clsErrors();
        $this->ds = new clsusersDataSource();
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "users";
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $this->ComponentName);
            $CCSForm = CCGetFromGet("ccsForm", "");
            $this->FormSubmitted = ($CCSForm == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Users_Name = new clsControl(ccsTextBox, "Users_Name", " Name", ccsText, "", CCGetRequestParam("Users_Name", $Method));
            $this->Users_Name->Required = true;
            $this->Users_Password = new clsControl(ccsTextBox, "Users_Password", " Password", ccsText, "", CCGetRequestParam("Users_Password", $Method));
            $this->Users_Password->Required = true;
            $this->Users_Access = new clsControl(ccsListBox, "Users_Access", " Access", ccsInteger, "", CCGetRequestParam("Users_Access", $Method));
            $this->Users_Access->DSType = dsListOfValues;
            $this->Users_Access->Values = array(array("0", "Unauthorized"), array("1", "Authorized"), array("2", "Administrator"));
            $this->Users_Access->Required = true;
            $this->Insert = new clsButton("Insert");
            $this->Update = new clsButton("Update");
            $this->Delete = new clsButton("Delete");
        }
    }
//End Class_Initialize Event

//Initialize Method @2-B625269A
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->ds->Parameters["urlUsers_ID"] = CCGetFromGet("Users_ID", "");
    }
//End Initialize Method

//Validate Method @2-5F827307
    function Validate()
    {
        $Validation = true;
        $Where = "";
        $Validation = ($this->Users_Name->Validate() && $Validation);
        $Validation = ($this->Users_Password->Validate() && $Validation);
        $Validation = ($this->Users_Access->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate");
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//Operation Method @2-DB6DC34B
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->ds->Prepare();
        $this->EditMode = $this->ds->AllParametersSet;
        if(!$this->FormSubmitted)
            return;

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Update" : "Insert";
            if(strlen(CCGetParam("Insert", ""))) {
                $this->PressedButton = "Insert";
            } else if(strlen(CCGetParam("Update", ""))) {
                $this->PressedButton = "Update";
            } else if(strlen(CCGetParam("Delete", ""))) {
                $this->PressedButton = "Delete";
            }
        }
        $Redirect = "index.php?" . CCGetQueryString("QueryString", Array("Insert","Update","Delete","ccsForm"));
        if($this->PressedButton == "Delete") {
            if(!CCGetEvent($this->Delete->CCSEvents, "OnClick") || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Insert") {
                if(!CCGetEvent($this->Insert->CCSEvents, "OnClick") || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Update") {
                if(!CCGetEvent($this->Update->CCSEvents, "OnClick") || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//InsertRow Method @2-360678E9
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert");
        if(!$this->InsertAllowed) return false;
        $this->ds->Users_Name->SetValue($this->Users_Name->GetValue());
        $this->ds->Users_Password->SetValue($this->Users_Password->GetValue());
        $this->ds->Users_Access->SetValue($this->Users_Access->GetValue());
        $this->ds->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert");
        if($this->ds->Errors->Count() > 0)
        {
            echo "Error in Record " . $this->ComponentName . " / Insert Operation";
            $this->ds->Errors->Clear();
            $this->Errors->AddError("Database command error.");
        }
        return ($this->Errors->Count() == 0);
    }
//End InsertRow Method

//UpdateRow Method @2-3F8A8BF4
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate");
        if(!$this->UpdateAllowed) return false;
        $this->ds->Users_Name->SetValue($this->Users_Name->GetValue());
        $this->ds->Users_Password->SetValue($this->Users_Password->GetValue());
        $this->ds->Users_Access->SetValue($this->Users_Access->GetValue());
        $this->ds->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate");
        if($this->ds->Errors->Count() > 0)
        {
            echo "Error in Record " . $this->ComponentName . " / Update Operation";
            $this->ds->Errors->Clear();
            $this->Errors->AddError("Database command error.");
        }
        return ($this->Errors->Count() == 0);
    }
//End UpdateRow Method

//DeleteRow Method @2-6A43D177
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete");
        if(!$this->DeleteAllowed) return false;
        $this->ds->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete");
        if($this->ds->Errors->Count())
        {
            echo "Error in Record " . ComponentName . " / Delete Operation";
            $this->ds->Errors->Clear();
            $this->Errors->AddError("Database command error.");
        }
        return ($this->Errors->Count() == 0);
    }
//End DeleteRow Method

//Show Method @2-6E58FDB3
    function Show()
    {
        global $Tpl;
        global $FileName;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->Users_Access->Prepare();

        $this->ds->open();
        $RecordBlock = "Record " . $this->ComponentName;
        $Tpl->block_path = $RecordBlock;
        if($this->EditMode)
        {
            if($this->Errors->Count() == 0)
            {
                if($this->ds->Errors->Count() > 0)
                {
                    echo "Error in Record users";
                }
                else if($this->ds->next_record())
                {
                    $this->ds->SetValues();
                    if(!$this->FormSubmitted)
                    {
                        $this->Users_Name->SetValue($this->ds->Users_Name->GetValue());
                        $this->Users_Password->SetValue($this->ds->Users_Password->GetValue());
                        $this->Users_Access->SetValue($this->ds->Users_Access->GetValue());
                    }
                }
                else
                {
                    $this->EditMode = false;
                }
            }
        }
        if(!$this->FormSubmitted)
        {
        }

        if($this->FormSubmitted) {
            $Error .= $this->Users_Name->Errors->ToString();
            $Error .= $this->Users_Password->Errors->ToString();
            $Error .= $this->Users_Access->Errors->ToString();
            $Error .= $this->Errors->ToString();
            $Error .= $this->ds->Errors->ToString();
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $Tpl->SetVar("Action", $this->HTMLFormAction);
        $this->Insert->Visible = !$this->EditMode;
        $this->Update->Visible = $this->EditMode;
        $this->Delete->Visible = $this->EditMode;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow");
        $this->Users_Name->Show();
        $this->Users_Password->Show();
        $this->Users_Access->Show();
        $this->Insert->Show();
        $this->Update->Show();
        $this->Delete->Show();
        $Tpl->parse("", false);
        $Tpl->block_path = "";
    }
//End Show Method

} //End users Class @2-FCB6E20C

class clsusersDataSource extends clsDBConnection {  //usersDataSource Class @2-F58FF67F

//DataSource Variables @2-58550D0C
    var $CCSEvents = "";
    var $CCSEventResult;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;

    // Datasource fields
    var $Users_Name;
    var $Users_Password;
    var $Users_Access;
//End DataSource Variables

//Class_Initialize Event @2-C1F8550F
    function clsusersDataSource()
    {
        $this->Initialize();
        $this->Users_Name = new clsField("Users_Name", ccsText, "");
        $this->Users_Password = new clsField("Users_Password", ccsText, "");
        $this->Users_Access = new clsField("Users_Access", ccsInteger, "");

    }
//End Class_Initialize Event

//Prepare Method @2-D3270FCC
    function Prepare()
    {
        $this->wp = new clsSQLParameters();
        $this->wp->AddParameter("1", "urlUsers_ID", ccsInteger, "", "", $this->Parameters["urlUsers_ID"], "");
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "`Users_ID`", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger));
        $this->Where = $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-DC1AA46D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect");
        $this->SQL = "SELECT *  " .
        "FROM users";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect");
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect");
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @2-6313CA15
    function SetValues()
    {
        $this->Users_Name->SetDBValue($this->f("Users_Name"));
        $this->Users_Password->SetDBValue($this->f("Users_Password"));
        $this->Users_Access->SetDBValue($this->f("Users_Access"));
    }
//End SetValues Method

//Insert Method @2-171A2C03
    function Insert()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert");
        $SQL = "INSERT INTO `users` ("
             . "`Users_Name`, "
             . "`Users_Password`, "
             . "`Users_Access`"
             . ") VALUES ("
             . $this->ToSQL($this->Users_Name->GetDBValue(), $this->Users_Name->DataType) . ", "
             . $this->ToSQL($this->Users_Password->GetDBValue(), $this->Users_Password->DataType) . ", "
             . $this->ToSQL($this->Users_Access->GetDBValue(), $this->Users_Access->DataType)
             . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert");
        $this->query($SQL);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert");
        if($this->Errors->Count() > 0)
            $this->Errors->AddError($this->Errors->ToString());
    }
//End Insert Method

//Update Method @2-9F595A1E
    function Update()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate");
        $SQL = "UPDATE `users` SET "
             . "`Users_Name`=" . $this->ToSQL($this->Users_Name->GetDBValue(), $this->Users_Name->DataType) . ", "
             . "`Users_Password`=" . $this->ToSQL($this->Users_Password->GetDBValue(), $this->Users_Password->DataType) . ", "
             . "`Users_Access`=" . $this->ToSQL($this->Users_Access->GetDBValue(), $this->Users_Access->DataType);
        $SQL = CCBuildSQL($SQL, $this->Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate");
        $this->query($SQL);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate");
        if($this->Errors->Count() > 0)
            $this->Errors->AddError($this->Errors->ToString());
    }
//End Update Method

//Delete Method @2-211B5EBA
    function Delete()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete");
        $SQL = "DELETE FROM `users` WHERE " . $this->Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete");
        $this->query($SQL);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete");
        if($this->Errors->Count() > 0)
            $this->Errors->AddError($this->Errors->ToString());
    }
//End Delete Method

} //End usersDataSource Class @2-FCB6E20C

//Include Page implementation @12-86456262
include("./footer.php");
//End Include Page implementation

//Initialize Page @1-5E56C870
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

$FileName = "edit_users.php";
$Redirect = "";
$TemplateFileName = "edit_users.html";
$BlockToParse = "main";
$PathToRoot = "../";
//End Initialize Page

//Authenticate User @1-2CA9346F
CCSecurityRedirect("2", "login.php", $FileName, CCGetQueryString("QueryString", ""));
//End Authenticate User

//Initialize Objects @1-328B06F3
$DBConnection = new clsDBConnection();

// Controls
$Header = new clsheader();
$Header->BindEvents();
$Header->TemplatePath = "./";
$Header->Initialize();
$users = new clsRecordusers();
$Footer = new clsfooter();
$Footer->BindEvents();
$Footer->TemplatePath = "./";
$Footer->Initialize();
$users->Initialize();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize");
//End Initialize Objects

//Execute Components @1-AB1E45CE
$Header->Operations();
$users->Operation();
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

//Show Page @1-8D0414C5
$Header->Show("Header");
$users->Show();
$Footer->Show("Footer");
$Tpl->PParse("main", false);
//End Show Page

//Unload Page @1-AB7622EF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload");
unset($Tpl);
//End Unload Page


?>
