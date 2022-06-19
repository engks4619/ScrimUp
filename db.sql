-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 20-10-25 22:45
-- 서버 버전: 10.4.14-MariaDB
-- PHP 버전: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `userdb`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `lolindividualscrim`
--

CREATE TABLE `lolindividualscrim` (
  `lsid` int(11) NOT NULL,
  `redTop` int(11) DEFAULT NULL,
  `redMid` int(11) DEFAULT NULL,
  `redBot` int(11) DEFAULT NULL,
  `redSupport` int(11) DEFAULT NULL,
  `redJungle` int(11) DEFAULT NULL,
  `blueTop` int(11) DEFAULT NULL,
  `blueMid` int(11) DEFAULT NULL,
  `blueBot` int(11) DEFAULT NULL,
  `blueSupport` int(11) DEFAULT NULL,
  `blueJungle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `lolindividualscrim`
--

INSERT INTO `lolindividualscrim` (`lsid`, `redTop`, `redMid`, `redBot`, `redSupport`, `redJungle`, `blueTop`, `blueMid`, `blueBot`, `blueSupport`, `blueJungle`) VALUES
(22, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `lolteamscrim`
--

CREATE TABLE `lolteamscrim` (
  `lsid` int(11) NOT NULL,
  `redTeam` int(11) DEFAULT NULL,
  `blueTeam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `lolteamscrim`
--

INSERT INTO `lolteamscrim` (`lsid`, `redTeam`, `blueTeam`) VALUES
(15, 3, NULL),
(16, 3, 5);

-- --------------------------------------------------------

--
-- 테이블 구조 `overwatchtier`
--

CREATE TABLE `overwatchtier` (
  `oid` int(11) NOT NULL,
  `battletag` varchar(255) NOT NULL,
  `isSecret` tinyint(4) DEFAULT NULL,
  `TankerTierName` varchar(255) NOT NULL,
  `TankerScore` varchar(255) NOT NULL,
  `DealerTierName` varchar(255) NOT NULL,
  `DealerScore` varchar(255) NOT NULL,
  `HealerTierName` varchar(255) NOT NULL,
  `HealerScore` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `overwatchtier`
--

INSERT INTO `overwatchtier` (`oid`, `battletag`, `isSecret`, `TankerTierName`, `TankerScore`, `DealerTierName`, `DealerScore`, `HealerTierName`, `HealerScore`) VALUES
(1, 'choibu7#1214', 0, 'Unranked', 'Unranked', 'Master', '3651', 'Diamond', '3391'),
(2, '날개#3249', 1, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `ow33individualscrim`
--

CREATE TABLE `ow33individualscrim` (
  `osid` int(11) NOT NULL,
  `redTank1` int(11) DEFAULT NULL,
  `redTank2` int(11) DEFAULT NULL,
  `redTank3` int(11) DEFAULT NULL,
  `redHeal1` int(11) DEFAULT NULL,
  `redHeal2` int(11) DEFAULT NULL,
  `redHeal3` int(11) DEFAULT NULL,
  `blueTank1` int(11) DEFAULT NULL,
  `blueTank2` int(11) DEFAULT NULL,
  `blueTank3` int(11) DEFAULT NULL,
  `blueHeal1` int(11) DEFAULT NULL,
  `blueHeal2` int(11) DEFAULT NULL,
  `blueHeal3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `ow222individualscrim`
--

CREATE TABLE `ow222individualscrim` (
  `osid` int(11) NOT NULL,
  `redTank1` int(11) DEFAULT NULL,
  `redTank2` int(11) DEFAULT NULL,
  `redDeal1` int(11) DEFAULT NULL,
  `redDeal2` int(11) DEFAULT NULL,
  `redHeal1` int(11) DEFAULT NULL,
  `redHeal2` int(11) DEFAULT NULL,
  `blueTank1` int(11) DEFAULT NULL,
  `blueTank2` int(11) DEFAULT NULL,
  `blueDeal1` int(11) DEFAULT NULL,
  `blueDeal2` int(11) DEFAULT NULL,
  `blueHeal1` int(11) DEFAULT NULL,
  `blueHeal2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `ow222individualscrim`
--

INSERT INTO `ow222individualscrim` (`osid`, `redTank1`, `redTank2`, `redDeal1`, `redDeal2`, `redHeal1`, `redHeal2`, `blueTank1`, `blueTank2`, `blueDeal1`, `blueDeal2`, `blueHeal1`, `blueHeal2`) VALUES
(6, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, NULL, NULL, 2, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `ownolimitindividualscrim`
--

CREATE TABLE `ownolimitindividualscrim` (
  `osid` int(11) NOT NULL,
  `red1` int(11) DEFAULT NULL,
  `red2` int(11) DEFAULT NULL,
  `red3` int(11) DEFAULT NULL,
  `red4` int(11) DEFAULT NULL,
  `red5` int(11) DEFAULT NULL,
  `red6` int(11) DEFAULT NULL,
  `blue1` int(11) DEFAULT NULL,
  `blue2` int(11) DEFAULT NULL,
  `blue3` int(11) DEFAULT NULL,
  `blue4` int(11) DEFAULT NULL,
  `blue5` int(11) DEFAULT NULL,
  `blue6` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `ownolimitindividualscrim`
--

INSERT INTO `ownolimitindividualscrim` (`osid`, `red1`, `red2`, `red3`, `red4`, `red5`, `red6`, `blue1`, `blue2`, `blue3`, `blue4`, `blue5`, `blue6`) VALUES
(11, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `owteamscrim`
--

CREATE TABLE `owteamscrim` (
  `osid` int(11) NOT NULL,
  `redTeam` int(11) DEFAULT NULL,
  `blueTeam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `owteamscrim`
--

INSERT INTO `owteamscrim` (`osid`, `redTeam`, `blueTeam`) VALUES
(5, NULL, NULL),
(9, NULL, 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `scrims`
--

CREATE TABLE `scrims` (
  `sid` int(11) NOT NULL,
  `scrimName` varchar(255) NOT NULL,
  `scrimGenerator` varchar(255) NOT NULL,
  `scrimDesc` varchar(255) DEFAULT NULL,
  `gameCategory` varchar(255) NOT NULL,
  `gameProceed` varchar(255) NOT NULL,
  `scrimTime` datetime NOT NULL,
  `scrimType` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `scrims`
--

INSERT INTO `scrims` (`sid`, `scrimName`, `scrimGenerator`, `scrimDesc`, `gameCategory`, `gameProceed`, `scrimTime`, `scrimType`) VALUES
(5, '주말 스크림할 팀 구합니다', '독쿠', '주말 저녁에 스크림할 팀 구합니다', '오버워치', '2탱 2딜 2힐', '2020-10-24 21:30:00', 1),
(6, '토요일 저녁 스크림', '독쿠', '토요일 저녁 7시 스크림할 사람?', '오버워치', '2탱 2딜 2힐', '2020-11-13 19:00:00', 0),
(9, '즐겜하실 스크림 팀 구합니다', '독쿠', '즐겜할 스크림 팀 구합니다.', '오버워치', '2탱 2딜 2힐', '2020-11-14 15:00:00', 1),
(11, '역할 제한 없는 스크림', '독쿠', '역할제한 없는 스크림할 사람 구해요', '오버워치', '제한 없음', '2020-11-14 17:30:00', 0),
(15, '대회 연습 스크림', '독쿠', '진지하게 대회 연습할 상대팀 찾습니다.', '리그오브레전드', '기본', '2020-11-19 19:00:00', 1),
(16, '챌린저현진님에게 버스탈승객괌', '킹차니탓 ㅇㅈㅇㅈ', '이 스크림은 이미 캐리머신이 정해져 있습니다. 그저 챌린저 멋쟁이 현진님에게 버스 탈 승객만 구할 뿐이죠 ㅎ 안전벨트 잘 매는 사람을 구한다~ 이말입니다 촤핳 하핳 하핳', '리그오브레전드', '기본', '2020-10-31 19:00:00', 1),
(17, '점심 나가서 먹을거 같아 점심 나가서 먹을거같', '킹차니탓 ㅇㅈㅇㅈ', '이예찬의 졸작 교실입니다 찡긋 -★', '오버워치', '2탱 2딜 2힐', '2020-10-30 03:19:00', 0),
(18, 'xtw', '독쿠', 'zxdasdasd', '오버워치', '2탱 2딜 2힐', '2020-10-26 05:34:00', 0),
(19, '213123123', '독쿠', '123123123123', '오버워치', '제한 없음', '2020-10-26 05:55:00', 0),
(20, '12312312', '독쿠', '3123123123123', '오버워치', '제한 없음', '2020-10-29 05:55:00', 0),
(21, '1312312313', '독쿠', '123123123123', '오버워치', '2탱 2딜 2힐', '2020-10-29 05:57:00', 0),
(22, '13231', '독쿠', '23123123', '리그오브레전드', '기본', '2020-10-28 06:08:00', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `teams`
--

CREATE TABLE `teams` (
  `tid` int(11) NOT NULL,
  `teamName` varchar(255) NOT NULL,
  `teamLeader` int(11) NOT NULL,
  `gameCategory` varchar(255) NOT NULL,
  `teamDesc` longtext DEFAULT NULL,
  `imgFullNameTeam` longtext DEFAULT NULL,
  `orderTeam` longtext NOT NULL,
  `platform_discord` tinyint(4) DEFAULT NULL,
  `platform_battlenet` tinyint(4) DEFAULT NULL,
  `regtime` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `teams`
--

INSERT INTO `teams` (`tid`, `teamName`, `teamLeader`, `gameCategory`, `teamDesc`, `imgFullNameTeam`, `orderTeam`, `platform_discord`, `platform_battlenet`, `regtime`) VALUES
(2, '대진다이너스티', 2, '오버워치', '상생정신', '대진다이너스티5f90faeb226e58.84492091.jpg', '1', 1, 1, '2020-10-22'),
(3, '대진골드', 2, '리그오브레전드', '너 내 동료가 되라!', '대진골드5f95d63bb23cf5.56711533.png', '5', 1, NULL, '2020-10-26'),
(4, '손현진까는팀', 7, '오버워치', '현진이탓 하는 팀입니다.', '손현진까는팀5f95c6f144fa05.30679386.jpg', '3', NULL, NULL, '2020-10-26'),
(5, '안녕하세요 예찬이탓 전문팀', 6, '리그오브레전드', '졸업 유예맛 좀 볼래?', '안녕하세요_예찬이탓_전문팀5f95c746ba8b42.12340140.jpg', '4', NULL, NULL, '2020-10-26'),
(6, '야 너두 옵치 할 수 있어ㅎ', 6, '오버워치', '너 내 팀 해라 찡긋 -★', '야_너두_옵치_할_수_있어ㅎ5f95d082cffc74.79002284.jpg', '5', NULL, NULL, '2020-10-26');

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userprofile` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `regtime` datetime NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `activate` tinyint(4) NOT NULL DEFAULT 1,
  `discordname` varchar(255) DEFAULT NULL,
  `battlenetname` varchar(255) DEFAULT NULL,
  `owTid` int(11) DEFAULT NULL,
  `lolTid` int(11) DEFAULT NULL,
  `discord_refreshtoken` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `userprofile`, `salt`, `regtime`, `is_admin`, `activate`, `discordname`, `battlenetname`, `owTid`, `lolTid`, `discord_refreshtoken`) VALUES
(1, 'admin', 'EQdh9Lw5hmjYHMbQAohDo/aRiKjSO0KTY5swXtZU3ovYJEzeWsWNK8FFIPhuB9pSV8IKvA04CVa8of8J0YnbUQ==', '관리자', '1785ba7734ca6e649dcf499beb2554e7fc15f7e3f57031f89a9b0bdf0d2b8f60', '2020-10-22 11:36:22', 1, 1, NULL, NULL, 4, NULL, NULL),
(2, 'dogcu', 'DYDrgt5hr5FBYI8DXEj/ei4SGYXayY0WE0P/BFaFAVeaUqn4hwGZOSMHSAN3N7lP588jgKk4fJBmHgtXQZ+A2A==', '독쿠', '5f1a93e7f42012e14530c5295cf639f22cfa0d4b1abab5965ffa069f4844e9bf', '2020-10-22 11:49:20', 0, 0, '이예찬#4352', 'choibu7#1214', 2, 3, 'Pfd3ZgqT1IBOif5OTcUKEppmvVcTKn'),
(3, 'test', '/G92t/ED1eFUMdzi9aAt0HvM5JCnF3teIyfDAwAhh7J6esNw98H95sVYXw/67ICTPUJ2SFBA5zX6TiD8KHabRg==', '테스트', 'a190f2c7f0af705ad5db0538d71d90eb06da29e23e76ac6c0e23a0fd01681c28', '2020-10-23 12:53:59', 0, 1, NULL, NULL, 2, NULL, NULL),
(4, '1q2w3e4r', 'a6whOVHHblCB9Bf5vOcHCvLaXiUuucswM+O0wPW5GkM0wlgytrGiogMTVpG5rSirUvcuYkZUtJDcU1UaFSMM8Q==', '123123', '553a06b9ebc4aa453012d7113ea6c8cab69eee8201abfe33c6df67a5f499f444', '2020-10-25 22:38:24', 0, 1, '초록색이범인임#2018', '날개#3249', 2, NULL, 'oLjqv7h1sxH2pqB2AkM4kmLtepM8Vv'),
(5, 'hi', 'iR+H7f/NyiokZ9vK10MKmXKlhsrjT5koIoH4pAMXoP1aF+rcoPZ7H8XvwBHJMS2FUgAdZhBQpfL48u40dz1yew==', '하이', 'e6169585abcdae260470602f68654c32cf56ae6e4abfd50f405fccbba34b13a4', '2020-10-26 02:41:30', 0, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'guswlssla', 'nN6frCs07t/DleuyPi8qrirSNWzV5XJkEhesHv03Qq+t4O8qHsR6uL+3Z6uiBJYAVimVkHMj667iagoSiFeaKw==', '챌린저 5학년 현진님', '9883de47564bb03321f891c165ac9544ec120ee5f20af343f0742cd7bf9c15ae', '2020-10-26 03:40:11', 0, 0, 'HJ_S#4917', NULL, 6, 5, 'zMqPekKtsKXZzxUzD5jVIYShAvVPUW'),
(7, 'guswls123', 'DD2k8qdy7m7lIX9yHL6K6VAzL8cZck8yhIIs1l83NbGo5utWXsEsNuGXFWNUyON7C90qjgyfUUN6MEmm6M/k7Q==', '현진바보', '6f9e39ae8d5761e66423c2eb89fe4de698949cc5d5f37b12b0c79914a7638523', '2020-10-26 03:40:46', 0, 1, NULL, NULL, 4, NULL, NULL);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `lolindividualscrim`
--
ALTER TABLE `lolindividualscrim`
  ADD KEY `lsid` (`lsid`);

--
-- 테이블의 인덱스 `lolteamscrim`
--
ALTER TABLE `lolteamscrim`
  ADD KEY `lsid` (`lsid`);

--
-- 테이블의 인덱스 `overwatchtier`
--
ALTER TABLE `overwatchtier`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `battletag` (`battletag`);

--
-- 테이블의 인덱스 `ow33individualscrim`
--
ALTER TABLE `ow33individualscrim`
  ADD KEY `osid` (`osid`);

--
-- 테이블의 인덱스 `ow222individualscrim`
--
ALTER TABLE `ow222individualscrim`
  ADD KEY `osid` (`osid`);

--
-- 테이블의 인덱스 `ownolimitindividualscrim`
--
ALTER TABLE `ownolimitindividualscrim`
  ADD KEY `osid` (`osid`);

--
-- 테이블의 인덱스 `owteamscrim`
--
ALTER TABLE `owteamscrim`
  ADD KEY `osid` (`osid`);

--
-- 테이블의 인덱스 `scrims`
--
ALTER TABLE `scrims`
  ADD PRIMARY KEY (`sid`);

--
-- 테이블의 인덱스 `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `teamLeader` (`teamLeader`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `battlenetname` (`battlenetname`),
  ADD KEY `owTid` (`owTid`,`lolTid`),
  ADD KEY `constraint_lolTid` (`lolTid`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `overwatchtier`
--
ALTER TABLE `overwatchtier`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `scrims`
--
ALTER TABLE `scrims`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 테이블의 AUTO_INCREMENT `teams`
--
ALTER TABLE `teams`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `lolindividualscrim`
--
ALTER TABLE `lolindividualscrim`
  ADD CONSTRAINT `constraint_lolIndividualScrim` FOREIGN KEY (`lsid`) REFERENCES `scrims` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `lolteamscrim`
--
ALTER TABLE `lolteamscrim`
  ADD CONSTRAINT `constraint_lolTeamScrim` FOREIGN KEY (`lsid`) REFERENCES `scrims` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `ow33individualscrim`
--
ALTER TABLE `ow33individualscrim`
  ADD CONSTRAINT `constraint_owscrim4` FOREIGN KEY (`osid`) REFERENCES `scrims` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `ow222individualscrim`
--
ALTER TABLE `ow222individualscrim`
  ADD CONSTRAINT `constraint_owscrim3` FOREIGN KEY (`osid`) REFERENCES `scrims` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `ownolimitindividualscrim`
--
ALTER TABLE `ownolimitindividualscrim`
  ADD CONSTRAINT `constraint_owscrim2` FOREIGN KEY (`osid`) REFERENCES `scrims` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `owteamscrim`
--
ALTER TABLE `owteamscrim`
  ADD CONSTRAINT `constraint_owscrim` FOREIGN KEY (`osid`) REFERENCES `scrims` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `constraint_lolTid` FOREIGN KEY (`lolTid`) REFERENCES `teams` (`tid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `constraint_owTid` FOREIGN KEY (`owTid`) REFERENCES `teams` (`tid`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
