// these functions interact with the server

	function undo()
	{
		document.gamedata.requestUndo.value = "yes";
		if (DEBUG)
			alert("gamedata.requestUndo = " + document.gamedata.requestUndo.value);

		document.gamedata.submit();
	}

	function draw()
	{
		document.gamedata.requestDraw.value = "yes";
		if (DEBUG)
			alert("gamedata.requestDraw = " + document.gamedata.requestDraw.value);

		document.gamedata.submit();
	}

	function resigngame()
	{
		document.gamedata.resign.value = "yes";
		if (DEBUG)
			alert("gamedata.resign = " + document.gamedata.resign.value);

		document.gamedata.submit();
	}

	function logout()
	{
		document.gamedata.action = "mainmenu.php";
		document.gamedata.submit();
	}
