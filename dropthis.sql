CREATE TABLE `dropthis` (
  `ID` varchar(6) NOT NULL PRIMARY KEY,
  `fileName` varchar(60) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;