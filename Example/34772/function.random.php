<script language="php">
/*
##############################################################################
# PHP Scratch And Win                                           Version 2.00 #
# Copyright 2003                             phpScratchAndWin.YourPHPPro.com #
#                                                                            #
# For questions concerning licensing, please read license.txt                #
##############################################################################
*/

/*
##############################################################################
# Description: Get a random number                                           #
##############################################################################
*/

function GetRandomNumber($Min="0", $Max="500") {
	if (phpScratchAndWin_UseRandomOrg=="1") {
		$fp_RandomOrg = fopen ("http://www.random.org/cgi-bin/randnum?num=1&min="."$Min"."&max="."$Max"."&col=1", "r");
		$RandomOrg_Text = fread ($fp_RandomOrg, 4096);
		$ReturnedValue=$RandomOrg_Text;
		fclose($fp_RandomOrg);
	} else {
		$ReturnedValue=intval(rand($Min, $Max));
	}
	return $ReturnedValue;
}

</script>
