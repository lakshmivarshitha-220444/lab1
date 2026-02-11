<?php

$file = "demo.txt";


// Write to file

$fp = fopen($file, "w");
fwrite($fp, "PHP File Handling\n");
fclose($fp);


// Read file

if (file_exists($file)) {
    $fp = fopen($file, "r");
    echo "<b>File Content:</b><br>";
    echo fread($fp, filesize($file));
    fclose($fp);
}


// File Information
echo "<br><br><b>File Information:</b><br>";
echo "Exists: " . (file_exists($file) ? "Yes" : "No") . "<br>";
echo "Size: " . filesize($file) . " bytes<br>";
echo "Type: " . filetype($file) . "<br>";
echo "Last Access: " . date("d-m-Y H:i:s", fileatime($file)) . "<br>";
echo "Last Modified: " . date("d-m-Y H:i:s", filemtime($file)) . "<br>";
echo "Created: " . date("d-m-Y H:i:s", filectime($file)) . "<br>";


// Directory Listing

echo "<br><b>Directory Files:</b><br>";
$files = scandir(".");
foreach ($files as $f) {
    echo $f . "<br>";
}


// Create Folder (Safe)

if (!is_dir("testfolder")) {
    mkdir("testfolder");
    echo "<br>Folder Created!";
} else {
    echo "<br>Folder Already Exists!";
}


// Copy File

if (file_exists($file)) {
    copy($file, "copy.txt");
    echo "<br>File Copied!";
}


// Rename File

if (file_exists("copy.txt")) {
    rename("copy.txt", "newcopy.txt");
    echo "<br>File Renamed!";
}


// Delete File

if (file_exists("newcopy.txt")) {
    unlink("newcopy.txt");
    echo "<br>File Deleted!";
}


// File Modes Demonstration 

$file2 = "modes.txt";

// Open in different modes 
fopen($file2, "w");    
fopen($file2, "a");   
fopen($file2, "r");   
fopen($file2, "r+");  
fopen($file2, "w+");  
fopen($file2, "a+");  

// Create new files  using x and x+
if (!file_exists("newfile.txt")) {
    fopen("newfile.txt", "x");
}

if (!file_exists("newfile2.txt")) {
    fopen("newfile2.txt", "x+");
}

?>
