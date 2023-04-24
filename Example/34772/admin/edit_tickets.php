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

//Include Page implementation @20-E34C2C5D
include("./header.php");
//End Include Page implementation

Class clsRecordticket { //ticket Class @2-66D3FB76

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

//Class_Initialize Event @2-1B369459
    function clsRecordticket()
    {

        global $FileName;
        $this->Visible = true;
        $this->Errors = new clsErrors();
        $this->ds = new clsticketDataSource();
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "ticket";
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $this->ComponentName);
            $CCSForm = CCGetFromGet("ccsForm", "");
            $this->FormSubmitted = ($CCSForm == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Email_Address = new clsControl(ccsTextBox, "Email_Address", "Email Address", ccsText, "", CCGetRequestParam("Email_Address", $Method));
            $this->Email_Address->Required = true;
            $this->DrawDate = new clsControl(ccsTextBox, "DrawDate", "Draw Date", ccsDate, Array("mm", "/", "dd", "/", "yyyy"), CCGetRequestParam("DrawDate", $Method));
            $this->DrawDate->Required = true;
            $this->Number_1 = new clsControl(ccsTextBox, "Number_1", "Number 1", ccsInteger, "", CCGetRequestParam("Number_1", $Method));
            $this->Number_1->Required = true;
            $this->Number_2 = new clsControl(ccsTextBox, "Number_2", "Number 2", ccsInteger, "", CCGetRequestParam("Number_2", $Method));
            $this->Number_2->Required = true;
            $this->Pick_1 = new clsControl(ccsTextBox, "Pick_1", "Pick 1", ccsInteger, "", CCGetRequestParam("Pick_1", $Method));
            $this->Pick_1->Required = true;
            $this->Pick_2 = new clsControl(ccsTextBox, "Pick_2", "Pick 2", ccsInteger, "", CCGetRequestParam("Pick_2", $Method));
            $this->Pick_2->Required = true;
            $this->Pick_3 = new clsControl(ccsTextBox, "Pick_3", "Pick 3", ccsInteger, "", CCGetRequestParam("Pick_3", $Method));
            $this->Pick_3->Required = true;
            $this->Pick_4 = new clsControl(ccsTextBox, "Pick_4", "Pick 4", ccsInteger, "", CCGetRequestParam("Pick_4", $Method));
            $this->Pick_4->Required = true;
            $this->Show_1 = new clsControl(ccsTextBox, "Show_1", "Show 1", ccsText, "", CCGetRequestParam("Show_1", $Method));
            $this->Show_1->Required = true;
            $this->Show_2 = new clsControl(ccsTextBox, "Show_2", "Show 2", ccsText, "", CCGetRequestParam("Show_2", $Method));
            $this->Show_2->Required = true;
            $this->Show_3 = new clsControl(ccsTextBox, "Show_3", "Show 3", ccsText, "", CCGetRequestParam("Show_3", $Method));
            $this->Show_3->Required = true;
            $this->Show_4 = new clsControl(ccsTextBox, "Show_4", "Show 4", ccsText, "", CCGetRequestParam("Show_4", $Method));
            $this->Show_4->Required = true;
            $this->Played = new clsControl(ccsListBox, "Played", "Played", ccsText, "", CCGetRequestParam("Played", $Method));
            $this->Played->DSType = dsListOfValues;
            $this->Played->Values = array(array("Y", "Yes"), array("N", "No"));
            $this->Played->Required = true;
            $this->Insert = new clsButton("Insert");
            $this->Update = new clsButton("Update");
            $this->Delete = new clsButton("Delete");
            if(!$this->FormSubmitted) {
                if(!strlen($this->DrawDate->Value) && $this->DrawDate->Value !== false)
                    $this->DrawDate->SetValue(time());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-2B98F749
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->ds->Parameters["urlTicket_ID"] = CCGetFromGet("Ticket_ID", "");
    }
//End Initialize Method

//Validate Method @2-43AF5EBA
    function Validate()
    {
        $Validation = true;
        $Where = "";
        $Validation = ($this->Email_Address->Validate() && $Validation);
        $Validation = ($this->DrawDate->Validate() && $Validation);
        $Validation = ($this->Number_1->Validate() && $Validation);
        $Validation = ($this->Number_2->Validate() && $Validation);
        $Validation = ($this->Pick_1->Validate() && $Validation);
        $Validation = ($this->Pick_2->Validate() && $Validation);
        $Validation = ($this->Pick_3->Validate() && $Validation);
        $Validation = ($this->Pick_4->Validate() && $Validation);
        $Validation = ($this->Show_1->Validate() && $Validation);
        $Validation = ($this->Show_2->Validate() && $Validation);
        $Validation = ($this->Show_3->Validate() && $Validation);
        $Validation = ($this->Show_4->Validate() && $Validation);
        $Validation = ($this->Played->Validate() && $Validation);
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

//InsertRow Method @2-C911304F
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert");
        if(!$this->InsertAllowed) return false;
        $this->ds->Email_Address->SetValue($this->Email_Address->GetValue());
        $this->ds->DrawDate->SetValue($this->DrawDate->GetValue());
        $this->ds->Number_1->SetValue($this->Number_1->GetValue());
        $this->ds->Number_2->SetValue($this->Number_2->GetValue());
        $this->ds->Pick_1->SetValue($this->Pick_1->GetValue());
        $this->ds->Pick_2->SetValue($this->Pick_2->GetValue());
        $this->ds->Pick_3->SetValue($this->Pick_3->GetValue());
        $this->ds->Pick_4->SetValue($this->Pick_4->GetValue());
        $this->ds->Show_1->SetValue($this->Show_1->GetValue());
        $this->ds->Show_2->SetValue($this->Show_2->GetValue());
        $this->ds->Show_3->SetValue($this->Show_3->GetValue());
        $this->ds->Show_4->SetValue($this->Show_4->GetValue());
        $this->ds->Played->SetValue($this->Played->GetValue());
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

//UpdateRow Method @2-4EE1BC1E
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate");
        if(!$this->UpdateAllowed) return false;
        $this->ds->Email_Address->SetValue($this->Email_Address->GetValue());
        $this->ds->DrawDate->SetValue($this->DrawDate->GetValue());
        $this->ds->Number_1->SetValue($this->Number_1->GetValue());
        $this->ds->Number_2->SetValue($this->Number_2->GetValue());
        $this->ds->Pick_1->SetValue($this->Pick_1->GetValue());
        $this->ds->Pick_2->SetValue($this->Pick_2->GetValue());
        $this->ds->Pick_3->SetValue($this->Pick_3->GetValue());
        $this->ds->Pick_4->SetValue($this->Pick_4->GetValue());
        $this->ds->Show_1->SetValue($this->Show_1->GetValue());
        $this->ds->Show_2->SetValue($this->Show_2->GetValue());
        $this->ds->Show_3->SetValue($this->Show_3->GetValue());
        $this->ds->Show_4->SetValue($this->Show_4->GetValue());
        $this->ds->Played->SetValue($this->Played->GetValue());
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

//Show Method @2-9607DF30
    function Show()
    {
        global $Tpl;
        global $FileName;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->Played->Prepare();

        $this->ds->open();
        $RecordBlock = "Record " . $this->ComponentName;
        $Tpl->block_path = $RecordBlock;
        if($this->EditMode)
        {
            if($this->Errors->Count() == 0)
            {
                if($this->ds->Errors->Count() > 0)
                {
                    echo "Error in Record ticket";
                }
                else if($this->ds->next_record())
                {
                    $this->ds->SetValues();
                    if(!$this->FormSubmitted)
                    {
                        $this->Email_Address->SetValue($this->ds->Email_Address->GetValue());
                        $this->DrawDate->SetValue($this->ds->DrawDate->GetValue());
                        $this->Number_1->SetValue($this->ds->Number_1->GetValue());
                        $this->Number_2->SetValue($this->ds->Number_2->GetValue());
                        $this->Pick_1->SetValue($this->ds->Pick_1->GetValue());
                        $this->Pick_2->SetValue($this->ds->Pick_2->GetValue());
                        $this->Pick_3->SetValue($this->ds->Pick_3->GetValue());
                        $this->Pick_4->SetValue($this->ds->Pick_4->GetValue());
                        $this->Show_1->SetValue($this->ds->Show_1->GetValue());
                        $this->Show_2->SetValue($this->ds->Show_2->GetValue());
                        $this->Show_3->SetValue($this->ds->Show_3->GetValue());
                        $this->Show_4->SetValue($this->ds->Show_4->GetValue());
                        $this->Played->SetValue($this->ds->Played->GetValue());
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
            $Error .= $this->Email_Address->Errors->ToString();
            $Error .= $this->DrawDate->Errors->ToString();
            $Error .= $this->Number_1->Errors->ToString();
            $Error .= $this->Number_2->Errors->ToString();
            $Error .= $this->Pick_1->Errors->ToString();
            $Error .= $this->Pick_2->Errors->ToString();
            $Error .= $this->Pick_3->Errors->ToString();
            $Error .= $this->Pick_4->Errors->ToString();
            $Error .= $this->Show_1->Errors->ToString();
            $Error .= $this->Show_2->Errors->ToString();
            $Error .= $this->Show_3->Errors->ToString();
            $Error .= $this->Show_4->Errors->ToString();
            $Error .= $this->Played->Errors->ToString();
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
        $this->Email_Address->Show();
        $this->DrawDate->Show();
        $this->Number_1->Show();
        $this->Number_2->Show();
        $this->Pick_1->Show();
        $this->Pick_2->Show();
        $this->Pick_3->Show();
        $this->Pick_4->Show();
        $this->Show_1->Show();
        $this->Show_2->Show();
        $this->Show_3->Show();
        $this->Show_4->Show();
        $this->Played->Show();
        $this->Insert->Show();
        $this->Update->Show();
        $this->Delete->Show();
        $Tpl->parse("", false);
        $Tpl->block_path = "";
    }
//End Show Method

} //End ticket Class @2-FCB6E20C

class clsticketDataSource extends clsDBConnection {  //ticketDataSource Class @2-F9F8BD8E

//DataSource Variables @2-12EDF838
    var $CCSEvents = "";
    var $CCSEventResult;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;

    // Datasource fields
    var $Email_Address;
    var $DrawDate;
    var $Number_1;
    var $Number_2;
    var $Pick_1;
    var $Pick_2;
    var $Pick_3;
    var $Pick_4;
    var $Show_1;
    var $Show_2;
    var $Show_3;
    var $Show_4;
    var $Played;
//End DataSource Variables

//Class_Initialize Event @2-BCD0A823
    function clsticketDataSource()
    {
        $this->Initialize();
        $this->Email_Address = new clsField("Email_Address", ccsText, "");
        $this->DrawDate = new clsField("DrawDate", ccsDate, Array("yyyy", "-", "mm", "-", "dd"));
        $this->Number_1 = new clsField("Number_1", ccsInteger, "");
        $this->Number_2 = new clsField("Number_2", ccsInteger, "");
        $this->Pick_1 = new clsField("Pick_1", ccsInteger, "");
        $this->Pick_2 = new clsField("Pick_2", ccsInteger, "");
        $this->Pick_3 = new clsField("Pick_3", ccsInteger, "");
        $this->Pick_4 = new clsField("Pick_4", ccsInteger, "");
        $this->Show_1 = new clsField("Show_1", ccsText, "");
        $this->Show_2 = new clsField("Show_2", ccsText, "");
        $this->Show_3 = new clsField("Show_3", ccsText, "");
        $this->Show_4 = new clsField("Show_4", ccsText, "");
        $this->Played = new clsField("Played", ccsText, "");

    }
//End Class_Initialize Event

//Prepare Method @2-37754ECC
    function Prepare()
    {
        $this->wp = new clsSQLParameters();
        $this->wp->AddParameter("1", "urlTicket_ID", ccsInteger, "", "", $this->Parameters["urlTicket_ID"], "");
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "`Ticket_ID`", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger));
        $this->Where = $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-58BCA8A2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect");
        $this->SQL = "SELECT *  " .
        "FROM ticket";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect");
        $this->query(CCBuildSQL($this->SQL, $this->Where, $this->Order));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect");
        $this->MoveToPage($this->AbsolutePage);
    }
//End Open Method

//SetValues Method @2-03755197
    function SetValues()
    {
        $this->Email_Address->SetDBValue($this->f("Email_Address"));
        $this->DrawDate->SetDBValue($this->f("DrawDate"));
        $this->Number_1->SetDBValue($this->f("Number_1"));
        $this->Number_2->SetDBValue($this->f("Number_2"));
        $this->Pick_1->SetDBValue($this->f("Pick_1"));
        $this->Pick_2->SetDBValue($this->f("Pick_2"));
        $this->Pick_3->SetDBValue($this->f("Pick_3"));
        $this->Pick_4->SetDBValue($this->f("Pick_4"));
        $this->Show_1->SetDBValue($this->f("Show_1"));
        $this->Show_2->SetDBValue($this->f("Show_2"));
        $this->Show_3->SetDBValue($this->f("Show_3"));
        $this->Show_4->SetDBValue($this->f("Show_4"));
        $this->Played->SetDBValue($this->f("Played"));
    }
//End SetValues Method

//Insert Method @2-0EEC23A1
    function Insert()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert");
        $SQL = "INSERT INTO `ticket` ("
             . "`Email_Address`, "
             . "`DrawDate`, "
             . "`Number_1`, "
             . "`Number_2`, "
             . "`Pick_1`, "
             . "`Pick_2`, "
             . "`Pick_3`, "
             . "`Pick_4`, "
             . "`Show_1`, "
             . "`Show_2`, "
             . "`Show_3`, "
             . "`Show_4`, "
             . "`Played`"
             . ") VALUES ("
             . $this->ToSQL($this->Email_Address->GetDBValue(), $this->Email_Address->DataType) . ", "
             . $this->ToSQL($this->DrawDate->GetDBValue(), $this->DrawDate->DataType) . ", "
             . $this->ToSQL($this->Number_1->GetDBValue(), $this->Number_1->DataType) . ", "
             . $this->ToSQL($this->Number_2->GetDBValue(), $this->Number_2->DataType) . ", "
             . $this->ToSQL($this->Pick_1->GetDBValue(), $this->Pick_1->DataType) . ", "
             . $this->ToSQL($this->Pick_2->GetDBValue(), $this->Pick_2->DataType) . ", "
             . $this->ToSQL($this->Pick_3->GetDBValue(), $this->Pick_3->DataType) . ", "
             . $this->ToSQL($this->Pick_4->GetDBValue(), $this->Pick_4->DataType) . ", "
             . $this->ToSQL($this->Show_1->GetDBValue(), $this->Show_1->DataType) . ", "
             . $this->ToSQL($this->Show_2->GetDBValue(), $this->Show_2->DataType) . ", "
             . $this->ToSQL($this->Show_3->GetDBValue(), $this->Show_3->DataType) . ", "
             . $this->ToSQL($this->Show_4->GetDBValue(), $this->Show_4->DataType) . ", "
             . $this->ToSQL($this->Played->GetDBValue(), $this->Played->DataType)
             . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert");
        $this->query($SQL);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert");
        if($this->Errors->Count() > 0)
            $this->Errors->AddError($this->Errors->ToString());
    }
//End Insert Method

//Update Method @2-5A1D52D7
    function Update()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate");
        $SQL = "UPDATE `ticket` SET "
             . "`Email_Address`=" . $this->ToSQL($this->Email_Address->GetDBValue(), $this->Email_Address->DataType) . ", "
             . "`DrawDate`=" . $this->ToSQL($this->DrawDate->GetDBValue(), $this->DrawDate->DataType) . ", "
             . "`Number_1`=" . $this->ToSQL($this->Number_1->GetDBValue(), $this->Number_1->DataType) . ", "
             . "`Number_2`=" . $this->ToSQL($this->Number_2->GetDBValue(), $this->Number_2->DataType) . ", "
             . "`Pick_1`=" . $this->ToSQL($this->Pick_1->GetDBValue(), $this->Pick_1->DataType) . ", "
             . "`Pick_2`=" . $this->ToSQL($this->Pick_2->GetDBValue(), $this->Pick_2->DataType) . ", "
             . "`Pick_3`=" . $this->ToSQL($this->Pick_3->GetDBValue(), $this->Pick_3->DataType) . ", "
             . "`Pick_4`=" . $this->ToSQL($this->Pick_4->GetDBValue(), $this->Pick_4->DataType) . ", "
             . "`Show_1`=" . $this->ToSQL($this->Show_1->GetDBValue(), $this->Show_1->DataType) . ", "
             . "`Show_2`=" . $this->ToSQL($this->Show_2->GetDBValue(), $this->Show_2->DataType) . ", "
             . "`Show_3`=" . $this->ToSQL($this->Show_3->GetDBValue(), $this->Show_3->DataType) . ", "
             . "`Show_4`=" . $this->ToSQL($this->Show_4->GetDBValue(), $this->Show_4->DataType) . ", "
             . "`Played`=" . $this->ToSQL($this->Played->GetDBValue(), $this->Played->DataType);
        $SQL = CCBuildSQL($SQL, $this->Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate");
        $this->query($SQL);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate");
        if($this->Errors->Count() > 0)
            $this->Errors->AddError($this->Errors->ToString());
    }
//End Update Method

//Delete Method @2-D3D60C63
    function Delete()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete");
        $SQL = "DELETE FROM `ticket` WHERE " . $this->Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete");
        $this->query($SQL);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete");
        if($this->Errors->Count() > 0)
            $this->Errors->AddError($this->Errors->ToString());
    }
//End Delete Method

} //End ticketDataSource Class @2-FCB6E20C

//Include Page implementation @21-86456262
include("./footer.php");
//End Include Page implementation


//Initialize Page @1-6D1E5917
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

$FileName = "edit_tickets.php";
$Redirect = "";
$TemplateFileName = "edit_tickets.html";
$BlockToParse = "main";
$PathToRoot = "../";
//End Initialize Page

//Authenticate User @1-7FED0150
CCSecurityRedirect("1;2", "login.php", $FileName, CCGetQueryString("QueryString", ""));
//End Authenticate User


//Initialize Objects @1-B879CFFE
$DBConnection = new clsDBConnection();

// Controls
$header = new clsheader();
$header->BindEvents();
$header->TemplatePath = "./";
$header->Initialize();
$ticket = new clsRecordticket();
$footer = new clsfooter();
$footer->BindEvents();
$footer->TemplatePath = "./";
$footer->Initialize();
$ticket->Initialize();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize");
//End Initialize Objects

//Execute Components @1-38195B50
$header->Operations();
$ticket->Operation();
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
