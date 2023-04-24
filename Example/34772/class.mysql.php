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
# Description: Create database classs                                        #
##############################################################################
# Arguments: none                                                            #
# Return: none                                                               #
# Required Variables: none                                                   #
# Bugs: none known                                                           #
# To Do: none                                                                #
#----------------------------------------------------------------------------#
# Notes: This class is used in all scripts - do not fiddle unless you know   #
#        what you are doing.                                                 #
##############################################################################
*/

class DB_Sql_phpScratchAndWin {

  var $link_id  = 0;
  var $query_id = 0;
  var $record   = array();

  var $errdesc    = "";
  var $errno   = 0;
  var $reporterror = 1;

  // Default username/password/server/database

  var $phpScratchAndWin_Database;
  var $phpScratchAndWin_Server;
  var $phpScratchAndWin_User;
  var $phpScratchAndWin_Password;

  var $appname  = "phpScratchAndWin";
  var $appshortname = "phpScratchAndWin";

  function DB_connect() {
    // connect to db server

    if ( 0 == $this->link_id ) {
      if ($this->phpScratchAndWin_Password=="") {
        $this->link_id=mysql_connect($this->phpScratchAndWin_Server,$this->phpScratchAndWin_User);
      } else {
        $this->link_id=mysql_connect($this->phpScratchAndWin_Server,$this->phpScratchAndWin_User,$this->phpScratchAndWin_Password);
      }
      if (!$this->link_id) {
        $this->DB_halt("Link-ID == false, connect failed");
      }
      if ($this->phpScratchAndWin_Database!="") {
        if(!mysql_select_db($this->phpScratchAndWin_Database, $this->link_id)) {
          $this->DB_halt("cannot use database ".$this->phpScratchAndWin_Database);
        }
      }
    }
  }

  function DB_geterrdesc() {
    $this->error=mysql_error();
    return $this->error;
  }

  function DB_geterrno() {
    $this->errno=mysql_errno();
    return $this->errno;
  }

  function DB_select_db($database="") {
    // select database
    if ($database!="") {
      $this->phpScratchAndWin_Database=$database;
    }

    if(!mysql_select_db($this->phpScratchAndWin_Database, $this->link_id)) {
      $this->DB_halt("cannot use database ".$this->phpScratchAndWin_Database);
    }

  }

  function DB_query($query_string) {
    // do query

    $this->query_id = mysql_query($query_string,$this->link_id);
    if (!$this->query_id) {
      $this->DB_halt("Invalid SQL: ".$query_string);
    }

    return $this->query_id;
  }

  function DB_fetch_array($query_id=-1) {
      // retrieve row
      if ($query_id!=-1) {
        $this->query_id=$query_id;
      }
      $this->record = mysql_fetch_array($this->query_id);

      return $this->record;
  }

  function DB_fetch_row($query_id=-1) {
      // retrieve row
      if ($query_id!=-1) {
        $this->query_id=$query_id;
      }
      $this->record = mysql_fetch_row($this->query_id);

      return $this->record;
  }

  function DB_free_result($query_id=-1) {
    // retrieve row
    if ($query_id!=-1) {
      $this->query_id=$query_id;
    }
    return @mysql_free_result($this->query_id);
  }

  function DB_query_first($query_string) {
    // does a query and returns first row
    $query_id = $this->DB_query($query_string);
    $returnarray=$this->DB_fetch_array($query_id);
    $this->DB_free_result($query_id);
    return $returnarray;
  }

  function query_first($query_string) {
      // does a query and returns first row
  }

  function DB_data_seek($pos,$query_id=-1) {
    // goes to row $pos
    if ($query_id!=-1) {
      $this->query_id=$query_id;
    }
    $status = mysql_data_seek($this->query_id, $pos);
    return $status;
  }

  function DB_num_rows($query_id=-1) {
      // returns number of rows in query
      if ($query_id!=-1) {
        $this->query_id=$query_id;
      }
      return mysql_num_rows($this->query_id);
  }

  function DB_affected_rows() {
      // returns number of rows affected in last query
  return mysql_affected_rows($this->link_id);
  }

  function DB_insert_id() {
    // returns last auto_increment field number assigned

    return mysql_insert_id($this->link_id);

  }

  function DB_halt($msg) {
    $this->errdesc=mysql_error();
    $this->errno=mysql_errno();

    $message="Database error in $this->appname: $msg\n";
    $message.="mysql error: " . $this->errdesc . "\n";
    $message.="mysql error number: " . $this->errno . "\n";
    $message.="Date: ".date("l dS of F Y h:i:s A")."\n";
    $message.="Script: ".getenv("REQUEST_URI")."\n";
    $message.="Referer: ".getenv("HTTP_REFERER")."\n";

    if ($this->reporterror==1) {
      echo "\n<!-- $message -->\n";

      echo "</td></tr></table>\n<p>There seems to have been a slight problem with the database.\n";
      echo "Please try again by pressing the refresh button in your browser.</p>";
      echo "<p>We apologise for any inconvenience.</p>";
      exit;
    }
  }
}

</script>