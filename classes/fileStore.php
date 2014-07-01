<?php
//William Cruz
//6-18-14
//Classes and Objects II
//used in todoFilestore and addressDataStore

class Filestore {

    public $filename = '';
    public $is_csv = false;

    function __construct($filename = '') 
    {
      if (substr($this->filename, -3) == 'csv') {
        $this->is_csv = true;
      }
        // Sets $this->filename
        $this->filename = $filename;  
    }

    public function read() 
    {
      if ($this->is_csv == true) {
        return $this->read_csv();
      } else {
        return $this->read_lines();
      }

    }

    public function write($array) 
    {
      if ($this->is_csv == true) {
        $this->write_csv($array);
      } else {
        $this->write_lines($array);
      } 
    }
   /**
     * Returns array of lines in $this->filename
     */
    private function read_lines()
    {
      $list_array = [];
      $filesize = filesize($this->filename);
      if ($filesize > 0) {
         $handle = fopen($this->filename, "r");
         $list_string = trim(fread($handle, $filesize));
         $list_array = explode("\n", $list_string);
         fclose($handle);
      } 
        return $list_array; 
    }
        
    /**
     * Writes each element in $array to a new line in $this->filename
     */
    private function write_lines($array)
    {
      $list_string = implode("\n", $array);
      $handle = fopen($this->filename, 'w');
    fwrite($handle, $list_string);
    fclose($handle);
    }

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    private function read_csv()
    {
      $book = [];

    $handle = fopen($this->filename, 'r');
    while(!feof($handle)) {
      $row = fgetcsv($handle);
      if (is_array($row)) {
          $book[] = $row;
      }
    }
    fclose($handle);
    return $book;
    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    private function write_csv($array)
    {
      if (is_writable($this->filename)) {
      $handle = fopen($this->filename, 'w');
      foreach($array as $newData) {
        fputcsv($handle, $newData);
      }
    }
    fclose($handle);
  }

}
?>



