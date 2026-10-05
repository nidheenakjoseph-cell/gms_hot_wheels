-- Create user_branch_access table
CREATE TABLE IF NOT EXISTS `user_branch_access` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `branch_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_branch_unique` (`user_id`, `branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed access for active users to all active branches by default so no access is lost
INSERT IGNORE INTO `user_branch_access` (`user_id`, `branch_id`)
SELECT u.id, b.branch_id
FROM `users` u
CROSS JOIN `branches` b
WHERE b.is_active = 1;
