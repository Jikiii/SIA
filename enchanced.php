<?php
declare(strict_types=1);


// FUNCTION WITH STRICT TYPES
function addNumbers(int $a, int $b): int {
    return $a + $b;
}

echo "<h2>PHP Fundamentals Demo</h2>";
echo "<hr>";

echo "<h3>1. Functions</h3>";
echo "Sum: " . addNumbers(5, 5) . "<br>";


// STRINGS
echo "<h3>2. Strings</h3>";

$txt = "Hello World";
echo $txt . "<br>";

$txt1 = "Department";
$txt2 = " of Information Technology";
echo $txt1 . $txt2 . "<br>";

// String functions
echo "Length of 'Hello': " . strlen("Hello") . "<br>";
echo "'World' position in 'Hello World': " . strpos("Hello World", "World") . "<br>";


// USER FUNCTION
echo "<h3>3. Custom Function</h3>";

function writeMyName(string $fname): void {
    echo "My name is " . $fname . "<br>";
}

writeMyName("Vince");
writeMyName("Isaac");
writeMyName("Kyrie");


// DATE EXAMPLES
echo "<h3>4. Date Formats</h3>";

echo date("Y/m/d") . "<br>";
echo date("Y.m.d") . "<br>";
echo date("Y-m-d") . "<br>";
echo date("D-M-Y") . "<br>";
echo date("l dS \\of F Y") . "<br>";


// IF ELSE STATEMENTS
echo "<h3>5. Conditional Statements</h3>";

$day = date("D");

if ($day == "Mon") {
    echo "Hello!<br>";
    echo "Have a nice weekend!<br>";
    echo "See you on Monday!<br>";
} else {
    echo "Today is " . $day . "<br>";
}

if ($day == "Fri") {
    echo "Have a nice weekend!<br>";
} else {
    echo "Have a nice day!<br>";
}


// WHILE LOOP
echo "<h3>6. While Loop</h3>";

$i = 1;
while ($i <= 5) {
    echo "The number is " . $i . "<br>";
    $i++;
}


// FOR LOOP
echo "<h3>7. For Loop</h3>";

for ($i = 1; $i <= 5; $i++) {
    echo "Hello World!<br>";
}


// FOREACH LOOP
echo "<h3>8. Foreach Loop</h3>";

$arr = array("one", "two", "three");

foreach ($arr as $value) {
    echo "Value: " . $value . "<br>";
}
?>

?>
<h2>Student Grade Calculator</h2>
<hr>

<form method="post">
    Enter Student Name:
    <input type="text" name="student_name" required><br><br>

    Enter number of subjects:
    <input type="number" name="subject_count" min="1" required><br><br>

    <input type="submit" name="start" value="Generate Inputs">
</form>

<?php
if (isset($_POST['start'])) {
    $studentName = $_POST['student_name'];
    $subjectCount = (int) $_POST['subject_count'];
?>

    <h3>Enter Grades for <?php echo $studentName; ?></h3>
    <form method="post">
        <input type="hidden" name="student_name" value="<?php echo $studentName; ?>">
        <input type="hidden" name="subject_count" value="<?php echo $subjectCount; ?>">

        <?php
        for ($i = 1; $i <= $subjectCount; $i++) {
            echo "Subject $i Grade: ";
            echo "<input type='number' name='grades[]' min='0' max='100' required><br><br>";
        }
        ?>

        <input type="submit" name="calculate" value="Calculate Average">
    </form>

<?php
}

if (isset($_POST['calculate'])) {
    $studentName = $_POST['student_name'];
    $grades = $_POST['grades'];

    $sum = 0;

    foreach ($grades as $grade) {
        $sum += $grade;
    }

    $average = $sum / count($grades);

    echo "<h3>Result for $studentName</h3>";
    echo "Average Grade: " . number_format($average, 2) . "<br>";

    if ($average >= 75) {
        echo "Status: Passed ✅";
    } else {
        echo "Status: Failed ❌";
    }
}
?>