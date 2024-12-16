<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "u299560388_651227"; // Change to your username
$password = "LK3508Hk"; // Change to your password
$dbname = "u299560388_651227"; // Database name

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if StuID is set
if (!isset($_GET['StuID'])) {
    die("กรุณาระบุรหัสนักเรียนที่ต้องการแก้ไข");
}

$stu_id = $_GET['StuID'];

// Fetch student data for the form
$stmt = $conn->prepare("SELECT StuID, Prefix, StudentName, StudentLastName, StudentNameEng, StudentLastNameEng, Age, DepID, CityID, Address, Domicile, PhoneNumber, SubjectID, YearID FROM tbl_Student WHERE StuID = ?");
$stmt->bind_param("i", $stu_id);
$stmt->execute();
$stmt->bind_result($StuID, $Prefix, $StudentName, $StudentLastName, $StudentNameEng, $StudentLastNameEng, $Age, $DepID, $CityID, $Address, $Domicile, $PhoneNumber, $SubjectID, $YearID);
$stmt->fetch();

if (!$StuID) {
    die("ไม่พบนักเรียนที่ต้องการแก้ไข");
}

// Store data in an array for the form
$student = [
    'StuID' => $StuID,
    'Prefix' => $Prefix,
    'StudentName' => $StudentName,
    'StudentLastName' => $StudentLastName,
    'StudentNameEng' => $StudentNameEng,
    'StudentLastNameEng' => $StudentLastNameEng,
    'Age' => $Age,
    'DepID' => $DepID,
    'CityID' => $CityID,
    'Address' => $Address,
    'Domicile' => $Domicile,
    'PhoneNumber' => $PhoneNumber,
    'SubjectID' => $SubjectID,
    'YearID' => $YearID
];

// Close statement
$stmt->close();

// Prepare select options from the database
$genders = ['นาย', 'นางสาว'];

// Fetch data from tables
$departments = [];
$dep_result = $conn->query("SELECT DepID, Department FROM tbl_Department");
while ($row = $dep_result->fetch_assoc()) {
    $departments[$row['DepID']] = $row['Department'];
}

$cities = [];
$city_result = $conn->query("SELECT CityID, CityName FROM tbl_City");
while ($row = $city_result->fetch_assoc()) {
    $cities[$row['CityID']] = $row['CityName'];
}

$subjects = [];
$subject_result = $conn->query("SELECT SubjectID, SubjectName FROM tbl_Subject");
while ($row = $subject_result->fetch_assoc()) {
    $subjects[$row['SubjectID']] = $row['SubjectName'];
}

$years = [];
$year_result = $conn->query("SELECT YearID, YearName FROM tbl_Year");
while ($row = $year_result->fetch_assoc()) {
    $years[$row['YearID']] = $row['YearName'];
}

$hobbies = [];
$hobby_result = $conn->query("SELECT HobbyID, HobbyName FROM tbl_Hobby");
while ($row = $hobby_result->fetch_assoc()) {
    $hobbies[$row['HobbyID']] = $row['HobbyName'];
}

// Fetch student hobbies
$student_hobbies = [];
$hobby_stmt = $conn->prepare("SELECT HobbyID FROM tbl_Student_Hobby WHERE StuID = ?");
$hobby_stmt->bind_param("i", $stu_id);
$hobby_stmt->execute();
$hobby_stmt->bind_result($hobby_id);
while ($hobby_stmt->fetch()) {
    $student_hobbies[] = $hobby_id; // Store HobbyID in an array
}
$hobby_stmt->close();

// Form submission handling
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Prefix = $_POST['Prefix'];
    $name_th = $_POST['StudentName'];
    $surname_th = $_POST['StudentLastName'];
    $name_en = $_POST['StudentNameEng'];
    $surname_en = $_POST['StudentLastNameEng'];
    $age = $_POST['Age'];
    $department = $_POST['DepID'];
    $city = $_POST['CityID'];
    $address = $_POST['Address'];
    $hometown = $_POST['Domicile'];
    $phone = $_POST['PhoneNumber'];
    $subject = $_POST['SubjectID'];
    $year = $_POST['YearID'];
    $hobby_ids = isset($_POST['HobbyID']) ? $_POST['HobbyID'] : [];

    if (empty($hobby_ids)) {
        die("กรุณาเลือกงานอดิเรกอย่างน้อยหนึ่งรายการ");
    }

    // Begin transaction
    $conn->begin_transaction();
    try {
        // Update student data
        $stmt = $conn->prepare("UPDATE tbl_Student SET Prefix = ?, StudentName = ?, StudentLastName = ?, StudentNameEng = ?, StudentLastNameEng = ?, Age = ?, DepID = ?, CityID = ?, Address = ?, Domicile = ?, PhoneNumber = ?, SubjectID = ?, YearID = ? WHERE StuID = ?");
        $stmt->bind_param("sssssiissssiii", $Prefix, $name_th, $surname_th, $name_en, $surname_en, $age, $department, $city, $address, $hometown, $phone, $subject, $year, $stu_id);
        if (!$stmt->execute()) {
            throw new Exception("Error updating student: " . $stmt->error);
        }

        // Delete old hobbies
        $conn->query("DELETE FROM tbl_Student_Hobby WHERE StuID = $stu_id");

        // Insert new hobbies
        $stmt_hobby = $conn->prepare("INSERT INTO tbl_Student_Hobby (StuID, HobbyID) VALUES (?, ?)");
        foreach ($hobby_ids as $hobby_id) {
            $stmt_hobby->bind_param("ii", $stu_id, $hobby_id);
            if (!$stmt_hobby->execute()) {
                throw new Exception("Error inserting student hobby: " . $stmt_hobby->error);
            }
        }

        // Commit transaction
        $conn->commit();
        echo "<script>alert('แก้ไขข้อมูลนักเรียนเรียบร้อยแล้ว'); window.location.href='master.php';</script>";
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลนักเรียน</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-image: url('path/to/your/background-image.jpg'); /* Change to your background image */
            background-size: cover;
            padding: 20px;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #f0c3b5;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #d0a490;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>แก้ไขข้อมูลนักเรียน</h1>
        <form method="post">
            <label for="Prefix">คำนำหน้าชื่อ:</label>
            <select id="Prefix" name="Prefix" required>
                <?php foreach ($genders as $gender): ?>
                    <option value="<?php echo htmlspecialchars($gender); ?>" <?php echo $gender == $student['Prefix'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($gender); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="StudentName">ชื่อ:</label>
            <input type="text" id="StudentName" name="StudentName" value="<?php echo htmlspecialchars($student['StudentName']); ?>" required>

            <label for="StudentLastName">นามสกุล:</label>
            <input type="text" id="StudentLastName" name="StudentLastName" value="<?php echo htmlspecialchars($student['StudentLastName']); ?>" required>

            <label for="StudentNameEng">ชื่อ (ภาษาอังกฤษ):</label>
            <input type="text" id="StudentNameEng" name="StudentNameEng" value="<?php echo htmlspecialchars($student['StudentNameEng']); ?>" required>

            <label for="StudentLastNameEng">นามสกุล (ภาษาอังกฤษ):</label>
            <input type="text" id="StudentLastNameEng" name="StudentLastNameEng" value="<?php echo htmlspecialchars($student['StudentLastNameEng']); ?>" required>

            <label for="Age">อายุ:</label>
            <input type="number" id="Age" name="Age" value="<?php echo htmlspecialchars($student['Age']); ?>" required>

            <label for="DepID">แผนก:</label>
            <select id="DepID" name="DepID" required>
                <?php foreach ($departments as $dep_id => $dep_name): ?>
                    <option value="<?php echo htmlspecialchars($dep_id); ?>" <?php echo $dep_id == $student['DepID'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($dep_name); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="CityID">จังหวัด:</label>
            <select id="CityID" name="CityID" required>
                <?php foreach ($cities as $city_id => $city_name): ?>
                    <option value="<?php echo htmlspecialchars($city_id); ?>" <?php echo $city_id == $student['CityID'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($city_name); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="Address">ที่อยู่:</label>
            <input type="text" id="Address" name="Address" value="<?php echo htmlspecialchars($student['Address']); ?>" required>

            <label for="Domicile">ภูมิลำเนา:</label>
            <input type="text" id="Domicile" name="Domicile" value="<?php echo htmlspecialchars($student['Domicile']); ?>" required>

            <label for="PhoneNumber">หมายเลขโทรศัพท์:</label>
            <input type="text" id="PhoneNumber" name="PhoneNumber" value="<?php echo htmlspecialchars($student['PhoneNumber']); ?>" required>

            <label for="SubjectID">วิชาโปรด:</label>
            <select id="SubjectID" name="SubjectID" required>
                <?php foreach ($subjects as $subject_id => $subject_name): ?>
                    <option value="<?php echo htmlspecialchars($subject_id); ?>" <?php echo $subject_id == $student['SubjectID'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($subject_name); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="YearID">ปีการศึกษา:</label>
            <select id="YearID" name="YearID" required>
                <?php foreach ($years as $year_id => $year_name): ?>
                    <option value="<?php echo htmlspecialchars($year_id); ?>" <?php echo $year_id == $student['YearID'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($year_name); ?></option>
                <?php endforeach; ?>
            </select>

            <label>งานอดิเรก:</label>
            <div>
                <?php foreach ($hobbies as $hobby_id => $hobby_name): ?>
                    <label>
                        <input type="checkbox" name="HobbyID[]" value="<?php echo htmlspecialchars($hobby_id); ?>" <?php echo in_array($hobby_id, $student_hobbies) ? 'checked' : ''; ?>>
                        <?php echo htmlspecialchars($hobby_name); ?>
                    </label><br>
                <?php endforeach; ?>
            </div>

            <input type="submit" value="บันทึกข้อมูล">
        </form>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
