<?php
$conn = mysqli_connect('localhost', 'root', "root") or die("连接数据库失败！");
mysqli_set_charset($conn, 'utf8mb4');
$status = mysqli_select_db($conn, "demodb");
if ($status != true) {
    $conn->close();
    die("选择数据库失败！");
}

$sql = "SELECT * FROM `demodb`.`Score`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $info_list = array();
    while ($row = $result->fetch_assoc()) {
        array_push($info_list, $row);
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
                                    <h3 class="card-title">全部成绩信息</h3>
									<div class="table-responsive">
										<table class="table table-bordered table-dark table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>学号</th>
													<th>课程号</th>
													<th>成绩</th>
													<th>功能</th>
												</tr>
											</thead>
											<tbody>
                                                <?php
                                                $index = 0;
                                                foreach ($info_list as $item) {
                                                    $index++;
                                                    $content = sprintf('
                                                <tr>
                                                <td>%d</td>
                                                <td>%s</td>
                                                <td>%s</td>
                                                <td>%s</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <form action="/score/update.php">
                                                            <input type="text" name="sid" value="%s" hidden />
                                                            <input type="text" name="cid" value="%s" hidden />
                                                            <button type="submit" class="btn btn-outline-warning btn-rounded btn-fw btn-sm">修改</button>
                                                        </form>
                                                        <form action="/score/delete.php" method="post">
                                                            <input type="text" name="sid" value="%s" hidden />
                                                            <input type="text" name="cid" value="%s" hidden />
                                                            <button type="submit" class="btn btn-outline-danger btn-rounded btn-fw btn-sm">删除</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                </tr>
                                                ', $index, $item['sno'], $item['cno'], $item['grade'], $item['sno'], $item['cno'], $item['sno'], $item['cno']);
                                                    echo trim($content);
                                                }?>
											</tbody>
										</table>
									</div>
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
