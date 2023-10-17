<?php
echo '<pre>';
var_dump($existingData);

foreach ($existingData as $key => $value) {
    if ($existingData[$key]['id'] == 1) {
        //echo $existingData[$key]['id'].'<br />';
        var_dump($existingData[$key]);
    }  
}
?>