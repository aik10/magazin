<?php

$this->title = 'Title';
print_r($this->title);
echo '<br>';

foreach ($categorys as $category) {
    echo '<pre>' . print_r($category, true). '</pre>';
}

?>