<?php
//Include Common Files @1-8E58AE89
//End Include Common Files
//Initialize Page @1-6572506B
// Variables
// Events;
//End Initialize Page
//Initialize Objects @1-C2EC4521
//End Initialize Objects
//Go to destination page @1-BEB91355
//End Go to destination page

//Initialize HTML Template @1-A0111C9D
//End Initialize HTML Template

//Show Page @1-6C7D9FD3
//End Show Page

//Unload Page @1-AB7622EF
//End Unload Page

/*
##############################################################################
# PHP Scratch And Win                                           Version 2.00 #
# Copyright 2003                             phpScratchAndWin.YourPHPPro.com #
#                                                                            #
# For questions concerning licensing, please read license.txt                #
##############################################################################
*/

#########
# Return Number of Plays this Month
#########
if (!function_exists('Custom_GetPlaysThisMonth')) {
  function Custom_GetPlaysThisMonth() {
    $DBConnection = new clsDBConnection();
 	$Result = CCGetDBValue("select count(*) from ticket where Played=\"Y\" AND (TO_DAYS(NOW()) - TO_DAYS(DrawDate) <= DAYOFMONTH(NOW()))", $DBConnection);
    if ($Result) {
      return $Result;
    } else {
      return "-";
    }
  }
}

if (!function_exists('Custom_GetPlaysToday')) {
  function Custom_GetPlaysToday() {
    $DBConnection = new clsDBConnection();
 	$Result = CCGetDBValue("select count(*) from ticket where Played=\"Y\" AND (TO_DAYS(NOW()) - TO_DAYS(DrawDate)<=1)", $DBConnection);
    if ($Result) {
      return $Result;
    } else {
      return "-";
    }
  }
}

if (!function_exists('Custom_GetTotalWinsToday')) {
  function Custom_GetTotalWinsToday() {
    $DBConnection = new clsDBConnection();
 	$Result = CCGetDBValue("select count(*) from ticket where Played=\"Y\" AND ((Number_1=Pick_1 OR Number_1=Pick_2 OR Number_1=Pick_3 OR Number_1=Pick_4) AND (Number_2=Pick_1 OR Number_2=Pick_2 OR Number_2=Pick_3 OR Number_2=Pick_4)) AND (TO_DAYS(NOW()) - TO_DAYS(DrawDate)<=1)", $DBConnection);
    if ($Result) {
      return $Result;
    } else {
      return "-";
    }
  }
}

if (!function_exists('Custom_GetTotalWinsThisMonth')) {
  function Custom_GetTotalWinsThisMonth() {
    $DBConnection = new clsDBConnection();
 	$Result = CCGetDBValue("select count(*) from ticket where (TO_DAYS(NOW()) - TO_DAYS(DrawDate) <= DAYOFMONTH(NOW())) AND Played=\"Y\" AND ((Number_1=Pick_1 OR Number_1=Pick_2 OR Number_1=Pick_3 OR Number_1=Pick_4) AND (Number_2=Pick_1 OR Number_2=Pick_2 OR Number_2=Pick_3 OR Number_2=Pick_4))", $DBConnection);
    if ($Result) {
      return $Result;
    } else {
      return "-";
    }
  }
}

if (!function_exists('Custom_GetTotalWinsForMonth')) {
  function Custom_GetTotalWinsForMonth($Month) {
    $DBConnection = new clsDBConnection();
 	$Result = CCGetDBValue("select count(*) from ticket where Month(DrawDate) = \"$Month\" AND Year(DrawDate)=Year(NOW()) AND Played=\"Y\" AND ((Number_1=Pick_1 OR Number_1=Pick_2 OR Number_1=Pick_3 OR Number_1=Pick_4) AND (Number_2=Pick_1 OR Number_2=Pick_2 OR Number_2=Pick_3 OR Number_2=Pick_4))", $DBConnection);
    if ($Result) {
      return $Result;
    } else {
      return "-";
    }
  }
}

if (!function_exists('Custom_GetTotalWinsForWeek')) {
  function Custom_GetTotalWinsForWeek($Week) {
    $DBConnection = new clsDBConnection();
 	$Result = CCGetDBValue("select count(*) from ticket where Week(DrawDate) = \"$Week\" AND Year(DrawDate)=Year(NOW()) AND Played=\"Y\" AND ((Number_1=Pick_1 OR Number_1=Pick_2 OR Number_1=Pick_3 OR Number_1=Pick_4) AND (Number_2=Pick_1 OR Number_2=Pick_2 OR Number_2=Pick_3 OR Number_2=Pick_4))", $DBConnection);
    if ($Result) {
      return $Result;
    } else {
      return "-";
    }
  }
}
if (!function_exists('Custom_ValidateEmail')) {
        function Custom_ValidateEmail($Email_Address) {
        return preg_match('/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}~]+'.
        '@'.
        '([-0-9A-Z]+\.)+'.
        '([0-9A-Z]){2,4}$/i',strtolower(trim($Email_Address)));
        }
}

?>