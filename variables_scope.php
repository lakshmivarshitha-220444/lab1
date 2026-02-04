<?php
echo "<h2>Datatypes</h2>";
$name="Varshitha";
echo "String:$name<br>";
$age=19;
echo "Integer:$age<br>";
$percentage=89.5;
echo "Float:$percentage<br>";
$sub=array("maths","physics","chemistry");
print_r ($sub);
$isstudent=TRUE;
var_dump($isstudent);

echo "<h2>Variable Scope</h2>";
$x=10; //global variable
function globalscope(){
    global $x; 
    echo "Global variable inside function: $x<br>";
}
globalscope();
function localscope(){
    $y=20; //local variable
    echo "Local variable: $y<br>";
}
localscope();
function staticscope(){
    static $z=0; //static variable
    $z++;
    echo "Static variable: $z<br>";
}
staticscope();
staticscope();
staticscope();
?>



