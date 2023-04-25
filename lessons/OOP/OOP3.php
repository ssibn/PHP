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
        class TableX
        {
        
        private $headers = [];
        private $data = [];
        
        function __construct($headers){
            $this->headers = $headers;
        }

        function addRow($row){
            $tmp = [];
            foreach($this->headers as $header){ 
                if(!isset($row[$header])) $row[$header] = "NULL";
                $tmp[] = $row[$header];
            }
            array_push($this->data, $tmp);
        } 

        function output(){
            echo "<pre><b>";
            foreach($this->headers as $header) echo "$header ";
            echo "</b><br>";
            foreach($this->data as $y){
                foreach($y as $x) echo "$x ";
                echo "<br>";
            }
            echo "</pre>";
        }
    }
    $test = new TableX(array('a', 'b', 'c', 'e', 'x'));
    $test->addRow(array('a' => 1, 'b' => 4, 'c' => 6, 'e' => 7, 'x' => 9));
    $test->addRow(array('a' => 1, 'b' => 2, 'c' => 5, 'e' => 8, 'x' => 11));
    $test->addRow(array('a' => 1, 'b' => 4, 'c' => 6, 'e' => 7, 'x' => 9));
    $test->addRow(array('a' => 1, 'b' => 4, 'c' => 6, 'x' => 9));
    $test->output();

    ?>

    <br>
    <a href='./index.php'>Back</a>

</body>
</html>