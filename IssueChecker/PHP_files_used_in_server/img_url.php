<?php

include('simple_html_dom.php');

$q = $_REQUEST["q"];

$google_url="http://www.google.com/search?q=" . $q . "&tbm=isch";
$google=file_get_html($google_url);
$ret = $google->find('img');

echo $ret[1]->src;

?>
