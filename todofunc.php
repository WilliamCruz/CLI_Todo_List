<?php

$items = array();

function list_items($list)
{  
	$result = ''; 

	foreach ($list as $key => $value)
	{
	// Iterate through list items
		$result .= "[" . ($key + 1) . "] $value\n";
	}
	return $result;
}


// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = false) 
{   
    // Return filtered STDIN input
	$result = trim(fgets(STDIN));
    return $upper ? strtoupper($result) : $result;
} 
function sort_menu($list) {
    echo '(A)-Z, (Z)-A, (O)rder Entered, (R)everse order entered : ';
        switch(get_input(true)) 
        {
            case 'A':
                asort($list);
                break;
            case 'Z':
                arsort($list);
                break;
            case 'O':
                ksort ($list);
                break;
            case 'R':
                krsort ($list);
                break; 
        }
        //sort the list
        return $list;
}
do 
{    	echo list_items($items);
    // Show the menu options
    echo '(N)ew item, (O)pen file, (R)emove item, (S)ort, (Q)uit : ';

// Open your todo.php file for editing. Commit changes and push to GitHub for each step.
// Allow a user to enter F at the main menu to remove the first item on the list. This feature will
// not be added to the menu, and will be a special feature that is only available to "power users". 
// Also add a L option that grabs and removes the last item in the list.

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(true); 

// When a new item is added to a TODO list, ask the user if they want to add it to the beginning 
// or end of the list. // Default to end if no input is given.
    // Check for actionable input
    if ($input == 'N') {
        // Ask for entry
        
        echo 'Add item to the beginning or the end of the list? ' . PHP_EOL;
        $input = get_input(true);
        echo 'Enter item: ';
            if ($input == 'B') {
                array_unshift($items, get_input());
            } else {
                array_push($items, get_input());
            }
    } elseif ($input == 'O') {
        echo 'Enter the file path: ';
        $input = get_input();
        // call function here
        // Add entry to list array
        // $items[] = get_input();
    } elseif ($input == 'R') {
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = get_input();
        // Remove from array
        // array_unshift($items)
        unset($items[$key - 1]);
        $items = array_values($items);
    } elseif ($input == 'S') {
        $list = sort_menu($items);    
    }
// Exit when input is (Q)uit
} while ($input != 'Q'); 
    
// Say Goodbye!
echo "Goodbye!\n";
// Exit with 0 errors
exit(0);
