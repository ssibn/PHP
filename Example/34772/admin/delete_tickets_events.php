<?php
/*
##############################################################################
# PHP Scratch And Win                                           Version 2.00 #
# Copyright 2003                             phpScratchAndWin.YourPHPPro.com #
#                                                                            #
# For questions concerning licensing, please read license.txt                #
##############################################################################
*/

//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

function Page_BeforeShow() { //Page_BeforeShow @1-66DC429C

//Custom Code @2-2A29BDB7
// -------------------------

$ThisQuery = new clsDBConnection;
$SQL = "DELETE FROM `ticket` WHERE ((Number_1!=Pick_1 AND Number_1!=Pick_2 AND Number_1!=Pick_3 AND Number_1!=Pick_4) AND (Number_2!=Pick_1 AND Number_2!=Pick_2 AND Number_2!=Pick_3 AND Number_2!=Pick_4)) AND Played='Y'";
$ThisQuery->query($SQL);

// -------------------------
//End Custom Code

} //Close Page_BeforeShow @1-FCB6E20C


?>
