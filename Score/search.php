<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $QUERY_SID = @$_POST["sid"];
    $QUERY_CID = @$_POST["cid"];
    if ($QUERY_SID == null || $QUERY_CID == null) {
        die("request invalid");
    }

    $sql = "SELECT * FROM `demodb`.`Score` WHERE `sno`='$QUERY_SID' and `cno`='$QUERY_CID'";
    $conn = mysqli_connect('localhost', 'root', "root") or die("连接数据库失败！");
    mysqli_set_charset($conn, 'utf8mb4');
    $status = mysqli_select_db($conn, "demodb");
    if ($status != true) {
        $conn->close();
        die("选择数据库失败！");
    }

    $info = null;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $info = $row;
        }
    }

    if ($info == null) {
        http_response_code(404);
        die();
    }

    $index = 1;
    $content = sprintf('
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
            ', $index, $info['sno'], $info['cno'], $info['grade'], $info['sno'], $info['cno'], $info['sno'], $info['cno']);
    echo trim($content);

    die();
}

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
                                    <h3 class="card-title">查询学生信息</h3>
                                    <!-- <form> -->
                                    <div class="input-group col">
                                        <div class="input-group-prepend bg-primary border-primary">
                                            <span class="input-group-text bg-transparent text-white">
                                                学生学号
                                            </span>
                                        </div>
                                        <input type="text" name="sid" class="form-control" placeholder="输入学号" id="searchSID">
                                        <div class="input-group-prepend bg-primary border-primary">
                                            <span class="input-group-text bg-transparent text-white">
                                                课程号
                                            </span>
                                        </div>
                                        <input type="text" name="cid" class="form-control" placeholder="输入课程号" id="searchCID">

                                        <span class="input-group-append">
                                            <button class="btn btn-info btn-block" type="button" id="searchButton">Search</button>
                                        </span>
                                    </div>
                                    <!-- <div class="col d-flex justify-content-center"> -->
                                    <!-- </div> -->
                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card" id="content-panel" style="display: none;">
								<div class="card-body"></div>
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
    <script>
        $("#searchButton").click(function () {
            var sid = $('#searchSID').val().trim()
            var cid = $('#searchCID').val().trim()
            if (sid != "" && cid != "") {
                $.post("/score/search.php", { sid: sid, cid: cid }, function (data) {
                    $('#content-panel .card-body').html(data)
                    $('#content-panel').show()
                }).fail(function () {
                    $('#content-panel .card-body').html('<div class="d-flex justify-content-center"><h2>Not Found<h2></div>')
                    $('#content-panel').show()
                })
            }
        })
    </script>
	<!-- END -->
</body>

</html>
