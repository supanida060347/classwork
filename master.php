<?php
// ข้อมูลสำหรับเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "u299560388_651227";
$password = "LK3508Hk";
$dbname = "u299560388_651227";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบการลบข้อมูลนักเรียน
if (isset($_POST['delete'])) {
    $stu_id = $_POST['StuID'];

    // ตรวจสอบว่า StuID ไม่ว่าง
    if (empty($stu_id)) {
        echo "<script>alert('StuID ไม่ถูกต้อง');</script>";
    } else {
        // ลบข้อมูลใน tbl_Student_Hobby ก่อน
        $delete_hobby_stmt = $conn->prepare("DELETE FROM tbl_Student_Hobby WHERE StuID = ?");
        $delete_hobby_stmt->bind_param("i", $stu_id);
        $delete_hobby_stmt->execute();
        $delete_hobby_stmt->close();

        // ลบข้อมูลใน tbl_Student
        $delete_stmt = $conn->prepare("DELETE FROM tbl_Student WHERE StuID = ?");
        $delete_stmt->bind_param("i", $stu_id);

        if ($delete_stmt->execute()) {
            if ($delete_stmt->affected_rows > 0) {
                echo "<script>alert('ลบข้อมูลนักเรียนเรียบร้อยแล้ว');</script>";
            } else {
                echo "<script>alert('ไม่พบข้อมูลนักเรียนที่ต้องการลบ');</script>";
            }
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการลบข้อมูลนักเรียน: " . $delete_stmt->error . "');</script>";
        }

        $delete_stmt->close();
    }
}

// ดึงข้อมูลนักศึกษา โดยเรียงจาก StuID น้อยไปมาก
$sql = "SELECT s.StuID, s.Prefix, s.StudentName, s.StudentLastName, s.StudentNameEng, s.StudentLastNameEng, s.Age, d.Department, y.YearName
        FROM tbl_Student s
        JOIN tbl_Department d ON s.DepID = d.DepID
        JOIN tbl_Year y ON s.YearID = y.YearID
        ORDER BY s.StuID ASC"; // เรียงตาม StuID น้อยไปมาก
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <!-- Import Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Import Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZvI7UVQ9TRwUeWFO6EwF/10J9S/hbJoz/90M9DlmSB4UpJULxZ7kP9d6/tqDzd" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8; /* เบาะสีฟ้าอ่อน */
            margin: 0;
            padding: 20px;
            color: #333;
        }

        /* Navigation Bar Styles */
        .nav-bar {
            display: flex; /* Change to flex for better alignment */
            justify-content: center; /* Center the links */
            background-color: #3498db; /* สีน้ำเงิน */
            border-radius: 30px; /* Capsule shape */
            padding: 10px; /* Adjust padding */
            margin: 0 auto 20px; /* Center the navbar */
            width: fit-content; /* Adjust width to fit the content */
            box-shadow: 0 4px 10px rgba(0,0,0,0.2); /* Shadow for navbar */
        }

        .nav-link {
            color: white;
            text-decoration: none;
            padding: 10px 20px; /* Adjust padding to fit the text */
            border-radius: 20px; /* Capsule shape for links */
            transition: background-color 0.3s, transform 0.3s; /* Transition effect */
            margin: 0 5px; /* Reduce space between links */
            font-size: 18px; /* ขนาดตัวอักษร */
        }

        .nav-link:hover {
            background-color: #2980b9; /* Background color on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
        }

        h1 {
            text-align: center;
            color: #333; /* สีน้ำเงินเข้ม */
            margin-bottom: 20px; /* เพิ่มระยะห่างด้านล่าง */
        }

        table {
            width: 80%;
            margin: 0 auto; /* Center the table */
            border-collapse: collapse;
            background-color: #fff; /* ขาว */
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); /* Shadow for table */
            border-radius: 15px; /* เพิ่มโค้งให้กับมุม */
            overflow: hidden; /* เพื่อให้มุมโค้งทำงานได้ */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd; /* สีเทาสำหรับเส้นขอบ */
        }

        th {
            background-color: #2980b9; /* สีน้ำเงิน */
            color: #fff; /* ขาว */
            font-size: 18px; /* ขนาดตัวอักษร */
        }

        td {
            color: #2c3e50; /* สีตัวอักษรในตาราง */
        }

        button {
            background-color: transparent; /* ไม่มีพื้นหลัง */
            border: none;
            cursor: pointer;
            transition: transform 0.3s; /* Transition effect */
        }

        button:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
        }

        .delete-button {
            color: #e74c3c; /* สีแดง */
        }

        .delete-button:hover {
            color: #c0392b; /* สีแดงเข้ม */
        }

        .no-records {
            text-align: center;
            color: #e74c3c; /* Red color for no records */
            font-size: 18px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <div class="nav-bar">
        <a href="master.php" class="nav-link">Home</a>
        <a href="register.php" class="nav-link">Add Information</a>
    </div>

    <h1>Student List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>English Name</th>
                <th>Age</th>
                <th>Department</th>
                <th>Year</th>
                <th>Details</th>
                <th>Edit</th>
                <th>Delete</th> <!-- เพิ่มคอลัมน์สำหรับปุ่ม Delete -->
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['StuID']); ?></td>
                        <td><?php echo htmlspecialchars($row['Prefix'] . " " . $row['StudentName'] . " " . $row['StudentLastName']); ?></td>
                        <td><?php echo htmlspecialchars($row['StudentNameEng'] . " " . $row['StudentLastNameEng']); ?></td>
                        <td><?php echo htmlspecialchars($row['Age']); ?></td>
                        <td><?php echo htmlspecialchars($row['Department']); ?></td>
                        <td><?php echo htmlspecialchars($row['YearName']); ?></td>
                        <td>
                            <a href="detail.php?id=<?php echo htmlspecialchars($row['StuID']); ?>">
                                <button>
                                    <i class="fas fa-info-circle"></i> View Details
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="edit.php?StuID=<?php echo htmlspecialchars($row['StuID']); ?>">
                                <button>
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </a>
                        </td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="StuID" value="<?php echo htmlspecialchars($row['StuID']); ?>">
                                <button type="submit" name="delete" class="delete-button">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="no-records">ไม่พบข้อมูลนักเรียน</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php $conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล ?>
</body>
</html>
