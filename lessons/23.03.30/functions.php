<?php function isRequared($text, $name){
      if ($text != null){
        echo '<div class="block">Pole ' . $name . ' have text</div>' . '<br/>';
      } else {
        echo 'Pole ' . $name . ' dont have text' . '<br/>'
      }
    }