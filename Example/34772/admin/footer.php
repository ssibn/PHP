<?php
/*
##############################################################################
# PHP Scratch And Win                                           Version 2.00 #
# Copyright 2003                             phpScratchAndWin.YourPHPPro.com #
#                                                                            #
# For questions concerning licensing, please read license.txt                #
##############################################################################
*/

class clsfooter { //footer class @1-1DA8A4E8


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

//Class_Initialize Event @1-4A99691B
    function clsfooter()
    {
        $this->Enabled = true;
        if($this->Enabled)
        {
            $this->FileName = "footer.php";
            $this->Redirect = "";
            $this->TemplateFileName = "footer.html";
            $this->BlockToParse = "main";
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

//Show Method @1-6C47DCA9
    function Show($Name)
    {
        global $Tpl;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow");
        if(!$this->Enabled)
            return "";
        $Tpl->LoadTemplate($this->TemplatePath . $this->TemplateFileName, $Name);
        $Tpl->Parse($Name, false);
        $Tpl->SetVar($Name, $Tpl->GetVar($Name));
    }
//End Show Method

} //End footer Class @1-FCB6E20C



?>
