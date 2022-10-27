<?php
$db_host="NjvzGhmtO0ZofkpbhxDU"; //localhost server 
$db_user="uun4px2mbuhzl48d";	//database username
$db_password="NjvzGhmtO0ZofkpbhxDU";	//database password   
$db_name="bzqzhoqbxlmptdjilu8c";	//database name

try
{
	$db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
	$e->getMessage();
}

?>



