CREATE DATABASE IF NOT EXISTS todo;
USE todo;

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(10) PRIMARY KEY AUTO_INCREMENT,
  `task` varchar(250) NOT NULL,
  `status` varchar(30) NOT NULL
);

INSERT INTO `task` (`task`, `status`) VALUES
('Read an article on React.js', 'Done'),
('Organize a meeting', 'Pending');

