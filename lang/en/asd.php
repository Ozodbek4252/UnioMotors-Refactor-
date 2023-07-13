<?php
$arr = [];
foreach (\App\Models\Words::all() as $word){
    $arr[$word->key] = $word->word_en;
}
return $arr;