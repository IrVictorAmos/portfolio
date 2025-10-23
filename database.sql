-- Create visits table for tracking portfolio visits
CREATE TABLE IF NOT EXISTS `visits` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `visit_date` DATE NOT NULL,
  `visit_month` VARCHAR(7) NOT NULL,
  `visit_count` INT DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `unique_date_month` (`visit_date`, `visit_month`),
  INDEX `idx_visit_date` (`visit_date`),
  INDEX `idx_visit_month` (`visit_month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create users table for authentication
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user (password: admin123 hashed)
INSERT INTO `users` (`username`, `password`, `email`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@example.com')
ON DUPLICATE KEY UPDATE `username` = `username`;

-- Create about table for portfolio about section
CREATE TABLE IF NOT EXISTS `about` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `content` TEXT NOT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default about content
INSERT INTO `about` (`content`) VALUES
('Bienvenue sur mon portfolio. Je suis un développeur passionné par la création d\'applications web innovantes.')
ON DUPLICATE KEY UPDATE `content` = `content`;

-- Create projects table for portfolio projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `image_url` VARCHAR(255),
  `project_url` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample projects
INSERT INTO `projects` (`title`, `description`, `image_url`, `project_url`) VALUES
('Projet 1', 'Description du projet 1', 'images/project1.jpg', 'https://example.com/project1'),
('Projet 2', 'Description du projet 2', 'images/project2.jpg', 'https://example.com/project2')
ON DUPLICATE KEY UPDATE `title` = `title`;

-- Create skills table for portfolio skills
CREATE TABLE IF NOT EXISTS `skills` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `level` INT DEFAULT 50,
  `category` VARCHAR(50),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample skills
INSERT INTO `skills` (`name`, `level`, `category`) VALUES
('HTML', 90, 'Frontend'),
('CSS', 85, 'Frontend'),
('JavaScript', 80, 'Frontend'),
('PHP', 75, 'Backend')
ON DUPLICATE KEY UPDATE `name` = `name`;

-- Insert sample data (optional)
INSERT INTO `visits` (`visit_date`, `visit_month`, `visit_count`) VALUES
(CURDATE(), DATE_FORMAT(CURDATE(), '%Y-%m'), 1)
ON DUPLICATE KEY UPDATE `visit_count` = `visit_count` + 1;
