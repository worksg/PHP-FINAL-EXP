<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sno = @$_POST['sno'];
    $cno = @$_POST['cno'];
    $grade = @$_POST['grade'];

    $sql = "INSERT INTO `demodb`.`Score` VALUES ('$sno','$cno', '$grade')";
    $conn = mysqli_connect('localhost', 'root', "root") or die("连接数据库失败！");
    mysqli_set_charset($conn, 'utf8mb4');
    $status = mysqli_select_db($conn, "demodb");
    if ($status != true) {
        $conn->close();
        die("选择数据库失败！");
    }

    header('Content-Type:application/json; charset=utf-8');
    if ($conn->query($sql) == true){
        echo urldecode(json_encode(array("status"=>true)));
    }else{
        echo urldecode(json_encode(array("status"=>false,"msg"=>"插入失败, 请检查字段属性")));
    }
    $conn->close();

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
									<h3 class="card-title">增加成绩信息</h3>
									<form id="addScoreForm" modelAttribute="Score" method="post">
										<div class="form-group">
											<label>学号</label>
											<input type="text" class="form-control" name="sno" />
										</div>
										<div class="form-group">
											<label>课程名</label>
											<input type="text" class="form-control" name="cno" />
										</div>
										<div class="form-group">
											<label>成绩</label>
											<input type="text" class="form-control" name="grade" />
										</div>
										<div class="d-flex justify-content-center">
											<!-- <button type="submit" class="btn btn-primary btn-block">增加</button> -->
											<input type="button" class="btn btn-primary btn-block" value="增加" onClick='submitDetailsForm()'>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
		
		        <!-- 模态框 -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="info-preview"
            hidden></button>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">提示信息</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="modal-body-content"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
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
    function submitDetailsForm() {
		$('form#addScoreForm').serializeArray().reduce(function (obj, item) {
			if (typeof item.value === 'undefined' || item.value === null  || item.value === "" ){
				$('div#modal-body-content').html('arguments invalid')
				$('button#info-preview').click()
				throw new Error(item.name + ' is empty');
			}
		}, {});
		$.post('/Score/add.php', $('form#addScoreForm').serialize(), function (data) {
			if (data['status']) {
				window.location.href='/Score.php'
			} else {
				$('div#modal-body-content').html(data['msg'])
				$('button#info-preview').click()
			}
			return
		}, 'json').fail(function (response) {
			$('div#modal-body-content').html(response.responseText)
			$('button#info-preview').click()
			return
		});
    }
    </script>
	<!-- END -->
</body>

</html>