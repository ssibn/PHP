<?php
/*
##############################################################################
# PHP Scratch And Win                                           Version 2.00 #
# Copyright 2003                             phpScratchAndWin.YourPHPPro.com #
#                                                                            #
# For questions concerning licensing, please read license.txt                #
##############################################################################
*/

class clsheader { //header class @1-0325152D


//Variables @1-E1CF4CAE
    var $FileName = "";
    var $Redirect = "";
    var $Tpl = "";
    var $TemplateFileName = "";
    var $BlockToParse = "";
    var $ComponentName = "";

    // Events;
    var $CCSEvents = "";
    var $CCSEventResult = "";
    var $TemplatePath;
    var $Enabled;
//End Variables

//Class_Initialize Event @1-458566C4
    function clsheader()
    {
        $this->Enabled = true;
        if($this->Enabled)
        {
            $this->FileName = "header.php";
            $this->Redirect = "";
            $this->TemplateFileName = "header.html";
            $this->BlockToParse = "main";

            // Create Components
            $this->Link6 = new clsControl(ccsLink, "Link6", "Link6", ccsText, "", CCGetRequestParam("Link6", ccsGet));
            $this->Link6->Parameters = CCGetQueryString("QueryString", Array("ccsForm"));
            $this->Link6->Page = "index.php";
            $this->ticket_list = new clsControl(ccsLink, "ticket_list", "ticket_list", ccsText, "", CCGetRequestParam("ticket_list", ccsGet));
            $this->ticket_list->Page = "list_tickets.php";
            $this->Link3 = new clsControl(ccsLink, "Link3", "Link3", ccsText, "", CCGetRequestParam("Link3", ccsGet));
            $this->Link3->Parameters = CCGetQueryString("QueryString", Array("ccsForm"));
            $this->Link3->Page = "list_emails.php";
            $this->users_list = new clsControl(ccsLink, "users_list", "users_list", ccsText, "", CCGetRequestParam("users_list", ccsGet));
            $this->users_list->Page = "list_users.php";
            $this->Link4 = new clsControl(ccsLink, "Link4", "Link4", ccsText, "", CCGetRequestParam("Link4", ccsGet));
            $this->Link4->Parameters = CCGetQueryString("QueryString", Array("ccsForm"));
            $this->Link4->Page = "monthlystats.php";
            $this->Link5 = new clsControl(ccsLink, "Link5", "Link5", ccsText, "", CCGetRequestParam("Link5", ccsGet));
            $this->Link5->Parameters = CCGetQueryString("QueryString", Array("ccsForm"));
            $this->Link5->Page = "weeklystats.php";
            $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet));
            $this->Link1->Parameters = CCGetQueryString("QueryString", Array("ccsForm"));
            $this->Link1->Page = "list_winners.php";
            $this->Link2 = new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet));
            $this->Link2->Parameters = CCGetQueryString("QueryString", Array("ccsForm"));
            $this->Link2->Page = "list_nonwinners.php";
        }
    }
//End Class_Initialize Event

//Class_Terminate Event @1-A3749DF6
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload");
    }
//End Class_Terminate Event

//BindEvents Method @1-236CCD5D
    function BindEvents()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize");
    }
//End BindEvents Method

//Operations Method @1-F24547FA
    function Operations()
    {
        global $Redirect;
        if(!$this->Enabled)
            return "";
    }
//End Operations Method

//Initialize Method @1-61B81EE0
    function Initialize()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView");
        if(!$this->Enabled)
            return "";
    }
//End Initialize Method

//Show Method @1-F22B9814
    function Show($Name)
    {
        global $Tpl;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow");
        if(!$this->Enabled)
            return "";
        $Tpl->LoadTemplate($this->TemplatePath . $this->TemplateFileName, $Name);
        $this->Link6->Show();
        $this->ticket_list->Show();
        $this->Link3->Show();
        $this->users_list->Show();
        $this->Link4->Show();
        $this->Link5->Show();
        $this->Link1->Show();
        $this->Link2->Show();
        $Tpl->Parse($Name, false);
        $Tpl->SetVar($Name, $Tpl->GetVar($Name));
    }
//End Show Method

} //End header Class @1-FCB6E20C



?>
