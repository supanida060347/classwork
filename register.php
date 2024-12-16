<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// เริ่มเซสชัน
session_start();

// Database connection details
$servername = "localhost";
$username = "u299560388_651227"; 
$password = "LK3508Hk"; 
$dbname = "u299560388_651227"; 

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare gender options
$genders = ['นาย', 'นางสาว'];

// Function to fetch data from a table
function fetchData($conn, $query) {
    $data = [];
    $result = $conn->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[$row['ID']] = $row['Name'];
        }
    } else {
        die("Error fetching data: " . $conn->error);
    }
    return $data;
}

// Fetch data from Department, City, Subject, Year, Hobby
$departments = fetchData($conn, "SELECT DepID AS ID, Department AS Name FROM tbl_Department");
$cities = fetchData($conn, "SELECT CityID AS ID, CityName AS Name FROM tbl_City");
$subjects = fetchData($conn, "SELECT SubjectID AS ID, SubjectName AS Name FROM tbl_Subject");
$years = fetchData($conn, "SELECT YearID AS ID, YearName AS Name FROM tbl_Year");
$hobbies = fetchData($conn, "SELECT HobbyID AS ID, HobbyName AS Name FROM tbl_Hobby");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receive form values
    $Prefix = $_POST['Prefix'];
    $name_th = $_POST['StudentName'];
    $surname_th = $_POST['StudentLastName'];
    $name_en = $_POST['StudentNameEng'];
    $surname_en = $_POST['StudentLastNameEng'];
    $age = (int)$_POST['Age']; // Ensure age is treated as an integer
    $department = (int)$_POST['DepID']; // Ensure department is treated as an integer
    $city = (int)$_POST['CityID']; // Ensure city is treated as an integer
    $address = $_POST['Address'];
    $hometown = $_POST['Domicile'];
    $phone = $_POST['PhoneNumber'];
    $subject = (int)$_POST['SubjectID']; // Ensure subject is treated as an integer
    $year = (int)$_POST['YearID']; // Ensure year is treated as an integer
    $hobby_ids = isset($_POST['HobbyID']) ? $_POST['HobbyID'] : [];

    // Validate that at least one hobby is selected
    if (empty($hobby_ids)) {
        die("กรุณาเลือกงานอดิเรกอย่างน้อยหนึ่งรายการ");
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        // Fetch the maximum StuID
        $result = $conn->query("SELECT MAX(StuID) AS max_stu_id FROM tbl_Student");
        $row = $result->fetch_assoc();
        $new_stu_id = $row['max_stu_id'] + 1; // Generate new StuID

        // Insert data into tbl_Student with the new StuID
        $stmt = $conn->prepare("INSERT INTO tbl_Student (StuID, Prefix, StudentName, StudentLastName, StudentNameEng, StudentLastNameEng, Age, DepID, CityID, Address, Domicile, PhoneNumber, SubjectID, YearID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        // Correctly bind parameters
        $stmt->bind_param("isssssiissssii", $new_stu_id, $Prefix, $name_th, $surname_th, $name_en, $surname_en, $age, $department, $city, $address, $hometown, $phone, $subject, $year);
        if (!$stmt->execute()) {
            throw new Exception("Error inserting student: " . $stmt->error);
        }

        // Insert data into tbl_Student_Hobby for each selected hobby
        $stmt_hobby = $conn->prepare("INSERT INTO tbl_Student_Hobby (StuID, HobbyID) VALUES (?, ?)");
        if (!$stmt_hobby) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        foreach ($hobby_ids as $hobby_id) {
            // Check if this HobbyID exists in tbl_Hobby
            if (array_key_exists($hobby_id, $hobbies)) {
                $stmt_hobby->bind_param("ii", $new_stu_id, $hobby_id);
                if (!$stmt_hobby->execute()) {
                    throw new Exception("Error inserting student hobby: " . $stmt_hobby->error);
                }
            } else {
                throw new Exception("HobbyID $hobby_id does not exist in tbl_Hobby");
            }
        }

        // Commit transaction
        $conn->commit();
        
        // Set session message for success
        $_SESSION['success_message'] = "บันทึกข้อมูลนักเรียนเรียบร้อยแล้ว";
        
        // Redirect to master.php after successful insertion
        header("Location: master.php");
        exit(); // Make sure to exit after the redirect

    } catch (Exception $e) {
        // Rollback transaction if an error occurs
        $conn->rollback();
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียนนักเรียน</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Prompt', sans-serif;
            background: linear-gradient(to bottom, #a8d8ff, #ffffff);
            overflow-y: scroll;
        }
        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="number"],
        input[type="tel"],
        input[type="email"],
        select,
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="tel"]:focus,
        input[type="email"]:focus,
        select:focus,
        textarea:focus {
            border-color: #00aaff;
            border-width: 2px;
            outline: none;
        }
        input[type="submit"] {
            background-color: #00aaff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0088cc;
        }
        .hobbies-label {
            margin: 15px 0;
            font-weight: bold;
        }
        .hobbies-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .hobbies-column {
            width: 46%;
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        .hobbies-column:hover {
            border-color: #00aaff;
        }
        .hobby-checkbox {
            margin-right: 10px;
        }
        .hobby-label {
            flex-grow: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ลงทะเบียนนักเรียน</h1>
        <form method="POST" action="">
            <label for="Prefix">คำนำหน้า</label>
            <select name="Prefix" id="Prefix" required>
                <option value="">เลือกคำนำหน้า</option>
                <?php foreach ($genders as $gender): ?>
                    <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="StudentName">ชื่อ (ภาษาไทย)</label>
            <input type="text" id="StudentName" name="StudentName" required>

            <label for="StudentLastName">นามสกุล (ภาษาไทย)</label>
            <input type="text" id="StudentLastName" name="StudentLastName" required>

            <label for="StudentNameEng">ชื่อ (ภาษาอังกฤษ)</label>
            <input type="text" id="StudentNameEng" name="StudentNameEng" required>

            <label for="StudentLastNameEng">นามสกุล (ภาษาอังกฤษ)</label>
            <input type="text" id="StudentLastNameEng" name="StudentLastNameEng" required>

            <label for="Age">อายุ</label>
            <input type="number" id="Age" name="Age" required min="1" max="100">

            <label for="DepID">ภาควิชา</label>
            <select name="DepID" id="DepID" required>
                <option value="">เลือกภาควิชา</option>
                <?php foreach ($departments as $id => $name): ?>
                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="CityID">จังหวัด</label>
            <select name="CityID" id="CityID" required>
                <option value="">เลือกจังหวัด</option>
                <?php foreach ($cities as $id => $name): ?>
                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="Address">ที่อยู่</label>
            <input type="text" id="Address" name="Address" required>

            <label for="Domicile">ภูมิลำเนา</label>
            <input type="text" id="Domicile" name="Domicile" required>

            <label for="PhoneNumber">หมายเลขโทรศัพท์</label>
            <input type="tel" id="PhoneNumber" name="PhoneNumber" required pattern="[0-9]{10}">

            <label for="SubjectID">วิชาโปรด</label>
            <select name="SubjectID" id="SubjectID" required>
                <option value="">เลือกวิชาโปรด</option>
                <?php foreach ($subjects as $id => $name): ?>
                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="YearID">ปีการศึกษา</label>
            <select name="YearID" id="YearID" required>
                <option value="">เลือกปีการศึกษา</option>
                <?php foreach ($years as $id => $name): ?>
                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>

            <label class="hobbies-label">งานอดิเรก</label>
            <div class="hobbies-wrapper">
                <?php foreach ($hobbies as $id => $name): ?>
                    <div class="hobbies-column">
                        <input type="checkbox" class="hobby-checkbox" name="HobbyID[]" value="<?php echo $id; ?>">
                        <span class="hobby-label"><?php echo $name; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <input type="submit" value="บันทึกข้อมูล">
        </form>
    </div>
</body>
</html>
