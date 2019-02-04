create table employees
(
  employeeId int auto_increment,
  name       VARCHAR(256) null,
  birthdate  DATE         null,
  ssn        decimal      null,
  current    bool         null,
  email      varchar(128) null,
  phone      decimal(11)  null,
  address    varchar(256) null,
  constraint employees_pk
    primary key (employeeId)
);

create table employees_following_info
(
  infId        int auto_increment,
  employeeId   int      not null,
  lang         CHAR(2)  not null,
  introduction TINYTEXT null,
  previousWork TINYTEXT null,
  education    TINYTEXT null,
  constraint employees_following_info_pk
    primary key (infId)
);
create index employees_following_info_employeeId
  on employees_following_info (employeeId);

create table employees_log_info
(
  infId      int auto_increment,
  employeeId int                          not null,
  type       ENUM ('created', 'modified') not null,
  date       DATETIME                     not null,
  constraint employees_log_info_pk
    primary key (infId)
);
create index employees_log_info_employeeId
  on employees_log_info (employeeId);

INSERT INTO `homestead`.`employees` (`name`, `birthdate`, `ssn`, `current`, `email`, `phone`, `address`)
VALUES ('Admin', '1980-01-13', 99999, 1, 'com@com.com', 799879879, 'Tallinn');
INSERT INTO `homestead`.`employees` (`name`, `birthdate`, `ssn`, `current`, `email`, `phone`, `address`)
VALUES ('George Green', '1983-03-03', 6546465464, 1, 'tito.egor@gmail.com', 30977837502, 'Kyiv');

INSERT INTO `employees_following_info` (`employeeId`, `lang`, `introduction`, `previousWork`, `education`)
VALUES (1, 'EN', 'EN PHP developer', 'BetInvest', 'KPI');
INSERT INTO `employees_following_info` (`employeeId`, `lang`, `introduction`, `previousWork`, `education`)
VALUES (1, 'FR', 'FR PHP developer', 'BetInvest', 'KPI');
INSERT INTO `employees_following_info` (`employeeId`, `lang`, `introduction`, `previousWork`, `education`)
VALUES (1, 'SP', 'SR PHP developer', 'BetInvest', 'KPI');

INSERT INTO `homestead`.`employees_log_info` (`employeeId`, `type`, `date`)
VALUES (1, 'created', '2019-01-04 02:30:25');
INSERT INTO `homestead`.`employees_log_info` (`employeeId`, `type`, `date`)
VALUES (1, 'modified', '2019-02-04 02:30:25');


explain select employees.name, fInfo.lang, fInfo.introduction
from employees
inner join employees_following_info as fInfo on employees.employeeId = fInfo.employeeId;