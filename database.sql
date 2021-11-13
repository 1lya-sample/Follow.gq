DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registerDate` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(255) NOT NULL DEFAULT '',
  `discord` varchar(255) NOT NULL DEFAULT '',
  `telegram` varchar(255) NOT NULL DEFAULT '',
  `vk` varchar(255) NOT NULL DEFAULT '',
  `git` varchar(255) NOT NULL DEFAULT '',
  `badge` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;