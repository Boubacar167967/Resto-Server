<?php
function getConnection()
{
    return new PDO("mysql:host=localhost;port=3306;dbname=memdb", "root", "");
}

//function prenant en paramette le nom d'une table