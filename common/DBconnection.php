<?php

    //choices 'WAMP' or 'heroku'
    $serverType="heroku";
    
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'schedule';
    if ($serverType == "heroku") {
        //CLEARDB connection for heroku
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $server = $url["host"];
        $username = $url["user"];
        $password = $url["pass"];
        $db = substr($url["path"], 1);
    }
    
    $connect=@mysql_connect($server, $username, $password);

    if (!$connect) {
        die("database connection error:" . mysql_error());
    }
    $mydb=mysql_select_db($db);
    if (!$mydb) {
        die("could not select database :" . mysql_error());
    }
