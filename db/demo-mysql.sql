CREATE DATABASE `demodb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- set character_set_server = 'utf8';
-- show variables like 'character%';
-- show variables like 'collation%';

USE `demodb`;

CREATE TABLE `Student` (
    `sno` VARCHAR(9) NOT NULL, -- 6/2 * 3 学号
    `sname` VARCHAR(12) NOT NULL, -- 8/2 * 3 姓名
    `ssex`  VARCHAR(3) NOT NULL, -- 2/2 * 3 性别
    `sbirthday`  DATE NOT NULL, -- 出生日期
    `speciality`  VARCHAR(18), -- 12/2 * 3 专业
    `sclass`  VARCHAR(9), -- 6/2 * 3 班号
    `tc`  INT, -- 总学分
    PRIMARY KEY (`sno`)
);

CREATE TABLE `Course` (
    `cno` VARCHAR(6) NOT NULL, -- 4/2 * 3 课程号
    `cname` VARCHAR(24) NOT NULL, -- 16/2 * 3 课程名
    `credit`  INT, -- 学分
    `tno` VARCHAR(9), -- 6/2 * 3 教师编号
    PRIMARY KEY (`cno`)
);

CREATE TABLE `Score` (
    `sno` VARCHAR(9) NOT NULL, -- 6/2 * 3 学号
    `cno` VARCHAR(6) NOT NULL, -- 4/2 * 3 课程号
    `grade`  INT, -- 成绩
   PRIMARY KEY (`sno`,`cno`)
);

INSERT INTO `demodb`.`Student` (`sno`, `sname`, `ssex`, `sbirthday`, `speciality`, `sclass`, `tc`) VALUES ('0001', 'TEST1', '男', '2018-12-14', 'math', '001', '101');
INSERT INTO `demodb`.`Student` (`sno`, `sname`, `ssex`, `sbirthday`, `speciality`, `sclass`, `tc`) VALUES ('0002', 'TEST2', '男', '2018-12-15', 'english', '002', '102');
INSERT INTO `demodb`.`Student` (`sno`, `sname`, `ssex`, `sbirthday`, `speciality`, `sclass`, `tc`) VALUES ('0003', 'TEST3', '女', '2018-12-16', 'computer', '003', '103');
INSERT INTO `demodb`.`Student` (`sno`, `sname`, `ssex`, `sbirthday`, `speciality`, `sclass`, `tc`) VALUES ('0004', 'TEST4', '女', '2018-12-17', 'language', '004', '104');
INSERT INTO `demodb`.`Student` (`sno`, `sname`, `ssex`, `sbirthday`, `speciality`, `sclass`, `tc`) VALUES ('0005', 'TEST5', '女', '2018-12-18', 'physical', '005', '105');
INSERT INTO `demodb`.`Student` (`sno`, `sname`, `ssex`, `sbirthday`, `speciality`, `sclass`, `tc`) VALUES ('0006', 'TEST6', '女', '2018-12-19', 'music', '006', '106');

INSERT INTO `demodb`.`Course` (`cno`, `cname`, `credit`, `tno`) VALUES ('C01', 'CN-01', '1', 'T001');
INSERT INTO `demodb`.`Course` (`cno`, `cname`, `credit`, `tno`) VALUES ('C02', 'CN-02', '2', 'T002');
INSERT INTO `demodb`.`Course` (`cno`, `cname`, `credit`, `tno`) VALUES ('C03', 'CN-03', '3', 'T003');
INSERT INTO `demodb`.`Course` (`cno`, `cname`, `credit`, `tno`) VALUES ('C04', 'CN-04', '4', 'T004');
INSERT INTO `demodb`.`Course` (`cno`, `cname`, `credit`, `tno`) VALUES ('C05', 'CN-05', '5', 'T005');

INSERT INTO `demodb`.`Score` (`sno`, `cno`, `grade`) VALUES ('0001', 'C01', '61');
INSERT INTO `demodb`.`Score` (`sno`, `cno`, `grade`) VALUES ('0002', 'C02', '62');
INSERT INTO `demodb`.`Score` (`sno`, `cno`, `grade`) VALUES ('0003', 'C03', '63');
INSERT INTO `demodb`.`Score` (`sno`, `cno`, `grade`) VALUES ('0004', 'C04', '64');
INSERT INTO `demodb`.`Score` (`sno`, `cno`, `grade`) VALUES ('0005', 'C05', '65');