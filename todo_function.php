<?php
//William Cruz
//Date 5/21/2014
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
//Create a function that reads the file, and adds each line to the current TODO list. 
//Loading data/list.txt should properly load the list from above. Be sure to fclose()
// the file when you are done reading it.
function open_file($items) 
{
    $filename = get_input();
    is_readable($filename);
    $filesize = filesize($filename);
    $handle = fopen($filename, 'r');
    $list_string = trim(fread($handle, $filesize));
    $list_array = explode(PHP_EOL, $list_string);
    $output = array_merge($items, $list_array);
    feof($handle);
    fclose($handle);
    return $output; 
}


//In the file menu create a s(A)ve file option.
//When s(A)ve is chosen, the user should be able to enter the path to a file to have it save. 
//Use fwrite() with the mode that starts at the beginning of a file and removes all the file 
//contents, or creates a new one if it does not exist. After save, alert the user the save was 
//successful and redisplay the list and main menu.
//If the file they are saving to exists, warn the user and ask for them to confirm overwriting the file. 
//If the user chooses not to proceed, cancel the save and return to the main menu with TODOs listed.
//Test saving, loading, and creating new TODO lists. Make sure your app works properly before proceeding.
function save_file($items)
{
    $file_name = get_input();
    $file_exist = is_file($filename);
    $items_string = implode(PHP_EOL, $items);
    if (file_exist === true) 
    {
        echo 'File already exist. Overwrite (Y)es or (N)o: ';
        if ($overwrite == 'Y' ) 
        {
            $handle = fopen($filename, 'w');
            fwrite($handle, $items_string . PHP_EOL);
            echo 'Save successfully.' . PHP_EOL;
        }

    } else {
        $handle = fopen($filename, 'w');
        fwrite($handle, $items_string . PHP_EOL);
        echo 'Save successfully.' . PHP_EOL;
    }
}
// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = false) 
{   
    // Return filtered STDIN input
	$result = trim(fgets(STDIN));
    return $upper ? strtoupper($result) : $result;
} 
//Add a (S)ort option to your menu. When it is chosen, it should call a function called sort_menu().
//When sort menu is opened, show the following options "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered".
//When a sort type is selected, order the TODO list accordingly and display the results.
function sort_menu($list) 
{
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
{   
	echo list_items($items);
    // Show the menu options
    echo '(N)ew item, (O)pen file, (R)emove item, (S)ort, s(A)ve, (Q)uit : ';
    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(true); 
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
        $items = open_file($items);
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

    } elseif ($input == 'A') {
        echo 'Enter file path to save: ';
        $filename = get_input();

}
// Exit when input is (Q)uit
} while ($input != 'Q'); 
    
// Say Goodbye!
echo "Goodbye!\n";
// Exit with 0 errors
exit(0);
