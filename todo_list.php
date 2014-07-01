<?php

function list_items($list)
{  
	$result = ''; 

	foreach ($list as $key => $value)
	{
		$result .= . $key . PHP_EOL;
	}

	return $result:
    // Return string of list items separated by newlines.
    // Should be listed [KEY] Value like this:
    // [1] TODO item 1
    // [2] TODO item 2 - blah
    // DO NOT USE ECHO, USE RETURN
}
// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = true) 
{   
    // Return filtered STDIN input
	$result = trim(fgets(STDIN));
    return $upper ? strtoupper(result) : $result;
}