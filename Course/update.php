<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $cno = @$_POST['cno'];
    $cname = @$_POST['cname'];
    $credit = @$_POST['credit'];
    $tno = @$_POST['tno'];

    $sql = "UPDATE `demodb`.`Course` SET `cname`='$cname', `credit`=$credit, `tno`='$tno' WHERE `cno`='$cno'";
    $conn = mysqli_connect('localhost', 'root', "root") or die("连接数据库失败！");
    mysqli_set_charset($conn, 'utf8mb4');
    $status = mysqli_select_db($conn, "demodb");
    if ($status != true) {
        $conn->close();
        die("选择数据库失败！");
    }
    $conn->query($sql);
    $conn->close();

    // echo var_dump($_POST);
    header("Location: /Course.php");
    die();
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    die("request invalid");
}

$UPDATE_ID = @$_GET["id"];
if ($UPDATE_ID == null) {
    die("request invalid");
}

$conn = mysqli_connect('localhost', 'root', "root") or die("连接数据库失败！");
mysqli_set_charset($conn, 'utf8mb4');
$status = mysqli_select_db($conn, "demodb");
if ($status != true) {
    $conn->close();
    die("选择数据库失败！");
}

$info = null;
$sql = "SELECT * FROM `demodb`.`Course` WHERE `cno`='$UPDATE_ID'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $info = $row;
    }
}

$conn->close();

// $info_list_count = count($info_list);
// if (count($info_list) > 0) {
//     echo var_dump($info_list);
// }

header("Content-Type: text/html;charset=utf-8");
?>


<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>学生成绩管理系统</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>

<body>
	<div class="container-scroller">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
			<a class="navbar-brand" href="/student.php">学生成绩管理系统</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse"
				data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item dropdown"><a
						class="nav-link dropdown-toggle" href="javascript:;"
						id="navbardrop" data-toggle="dropdown">学生模块 </a>
						<div class="dropdown-menu">
							<a class="dropdown-item"
								href="/student/list.php">全部学生信息</a> <a
								class="dropdown-item"
								href="/student/search.php">查询学生信息</a> <a
								class="dropdown-item"
								href="/student/add.php">增加学生信息</a>
						</div></li>
					<li class="nav-item dropdown"><a
						class="nav-link dropdown-toggle" href="javascript:;"
						id="navbardrop" data-toggle="dropdown">课程模块 </a>
						<div class="dropdown-menu">
							<a class="dropdown-item"
								href="/course/list.php">全部课程信息</a> <a
								class="dropdown-item"
								href="/course/search.php">查询课程信息</a> <a
								class="dropdown-item"
								href="/course/add.php">增加课程信息</a>
						</div></li>

					<li class="nav-item dropdown"><a
						class="nav-link dropdown-toggle" href="javascript:;"
						id="navbardrop" data-toggle="dropdown">成绩模块 </a>
						<div class="dropdown-menu">
							<a class="dropdown-item"
								href="/score/list.php">全部成绩信息</a> <a
								class="dropdown-item"
								href="/score/search.php">查询成绩信息</a> <a
								class="dropdown-item"
								href="/score/add.php">增加成绩信息</a>
						</div></li>
				</ul>
			</div>
        </nav>

        <div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="row">
						<div class="col">
							<div class="card">
								<div class="card-body">
									<h3 class="card-title">修改课程信息</h3>
									<form id="updateCourseForm" modelAttribute="Course" method="post">
										<div class="form-group">
											<label>课程号</label>
                                            <input type="text" class="form-control" name="cno" value="<?php echo $info['cno'] ?>" disabled/>
                                            <input type="text" class="form-control" name="cno" value="<?php echo $info['cno'] ?>" hidden/>
										</div>
										<div class="form-group">
											<label>课程名</label>
											<input type="text" class="form-control" name="cname" value="<?php echo $info['cname'] ?>" />
										</div>
										<div class="form-group">
											<label>学分</label>
											<input type="text" class="form-control" name="credit" value="<?php echo $info['credit'] ?>" />
										</div>
										<div class="form-group">
											<label>教师编号</label>
											<input type="text" class="form-control" name="tno" value="<?php echo $info['tno'] ?>"/>
										</div>
										<div class="d-flex justify-content-center">
											<button type="submit" class="btn btn-primary btn-block">修改</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.14.6/umd/popper.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/4.1.1/js/bootstrap.min.js" async defer></script>
	<!-- User Defined Script BEGIN -->
	<!-- <script src="./main.js" async defer></script> -->
	<!-- END -->
</body>

</html>