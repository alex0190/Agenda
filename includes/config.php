<?php
function base_url()
{
	return "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);
}
?>