<?
    $connect=mysql_connect( "localhost", "root", "apmsetup") or
        die( "SQL server에 연결할 수 없습니다.");

    mysql_select_db("test",$connect);
?>
