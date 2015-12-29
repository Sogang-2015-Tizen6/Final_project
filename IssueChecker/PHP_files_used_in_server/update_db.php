<?php

include('simple_html_dom.php');

$servername = "localhost";
$username = "cs20121581";
$password = "qwer1234";
$dbname = "db_20121581";

$conn = new mysqli($servername,$username,$password,$dbname);

$html = file_get_html('http://www.naver.com');
$ret1 = $html->find('ol[id=realrank]');
$ret2 = $ret1[0]->find('a');

for($i=0;$i<10;$i++){
    $word = $ret2[$i]->title;
    $sql = "select * from Issue_DB where name = '$word'";
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc()){
        $num = ($row["count"] + 5);
        $sql = "update Issue_DB set count = $num
            where name = '$word'";
        $conn->query($sql);
    }
    else{
        $sql = "insert into Issue_DB (name,nation,count)
            values('$word','kor',10)";
        $conn->query($sql);
    }
}

$sql = "select * from Issue_DB";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    $lid = $row["id"];
    $num = ($row["count"] - 1);
    $sql = "update Issue_DB set count = $num
        where id = $lid";
    $conn->query($sql);
    if($num < 0){
        $sql = "delete from Issue_DB
            where id = $lid";
        $conn->query($sql);
    }

}
$conn->close();

?>

