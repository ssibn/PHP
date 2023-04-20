<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <style>
        th{
            font-size: 14px;
            font-weight: 500;
            padding: 2px;
            border: 2px solid black;
        };
    </style>
   
<body>
    
    <?php
        class Firm{
        public $firm_name = 'FOG'; //
        private $INN;
        protected $Log;

        const NAME = 2;

        function firmName(){
            echo "Hello " . $this -> firm_name . '!<br>';
        }
        function FirmRename($a){
            $this -> firm_name = $a;
            echo "New name firm " . $this -> firm_name . '!<br>';
        }
        function printname(){
            echo self::NAME;
        }
        }
        $obj = new Firm();
        $obj -> FirmName();
        $obj -> firm_name = 'GOF';
        $obj -> FirmName();
        $obj -> FirmRename('FenncOpenGroup');
        $obj -> FirmName();
        echo Firm::NAME


    ?>

    <br>
    <a href='./index.php'>Back</a>

    
</body>

</html>