-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Sep 28, 2023 at 11:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'PHP'),
(6, 'keisha');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `comment_post_id` int NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(4, 1, 'jerome', 'jerome@gmail.com', 'jerome is me dude', 'approved', '2022-11-02'),
(5, 5, 'jerome', 'jerom@gmail.com', 'I feel u dude, when you get complacent it bites u in the ass hard. Move on and keep going forward', 'approved', '2022-11-03'),
(6, 5, 'sanro', 'sandro@gmail.com', 'hi im sandro, u cant either choose to be good or be a shit stain forever. go on and learn and be better', 'unapproved', '2022-11-03'),
(7, 1, 'HUWEIRFHWER', 'sdf@gnak.com', 'bfikwebgfergverg', 'approved', '2022-11-04'),
(8, 1, 'HUWEIRFHWER', 'sdf@gnak.com', 'bfikwebgfergverg', 'approved', '2022-11-04'),
(9, 1, 'jalalalala', 'jfiewoj@gmail.com', 'wifgheoilrgverg', 'unapproved', '2022-11-05'),
(10, 8, 'q', 'q@gmail.com', 'erngftngw5yjr7lt', 'approved', '2023-01-15'),
(14, 11, 'John117', 'tudududu@gmail.com', 'tudududu dudududu dudududu ', 'approved', '2023-09-07'),
(15, 8, 'johny bravo', 'john123@gmail.com', 'johnyy bravo in da haus', 'approved', '2023-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int NOT NULL,
  `post_category_id` int NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `posts_views_count` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `posts_views_count`) VALUES
(8, 1, 'fevergv', 'Jerome', '2015-12-22', '275479623_4712048012239803_8483775668021393012_n.jpg', 'ernflvgjnrekibrhbvirhbikrbrgb', 'girls', 3, 'Published', 22),
(10, 2, 'I LOVE MYSELF', 'JOSEPH SALA', '2015-12-22', '317337988_702517861308167_9207034597188031804_n.jpg', '<p>I FUCKING LOVE MYSELF. EARLIER I WAS SAD BECAUSE I THOUGHT THAT I DIDNT WORK ON THE BULK OPTIONS THING. TURNS OUT I FUCKING FINISHED IT BEFORE WATCHING THE VIDEOS. MY PAST SELF DID THEM BEFORE WATCHING THE TUTORIAL. I LOVE MYSELF.</p>', 'self-love', 0, 'Published', 0),
(11, 1, 'Getting back into the groove', 'Joseph', '2002-01-23', 'people1-bg22.jpg', '<p>Im getting back into the dip. Turns out that Ive been walking away from my actual obligations and responsibilities by distracting myself with trivial problems like girls. Video games crept back as a coping mechanism for dealing with girl drama and shit. Better than worrying about girls but worse than working on myself.</p>', 'self-improvement', 0, 'Published', 9),
(12, 1, 'Cutting down the fat', 'Joseph', '2002-01-23', 'people1-bg22.jpg', 'A core part of self-improvement is cutting out the fat, whether they be from the body or from the mind and habits. I realized that I could keep going by just playing video games all the time or watching youtube or reading fanfic while going on my self-improvement journey, but the results would be mediocre and slow. I realized that men are made by sacrifices, whether it may be sacrificing boyhood comfort(video games), adolescent fantasies(being popular with girls, social media, porn), or low effort comfort( fanfiction, youtube). I choose to sacrifice those things to give me more time to do whatever I need to do to graduate.', 'self-improvement', 0, 'Published', 0),
(15, 6, 'test post', 'asd', '2002-01-23', 'people1-bg22.jpg', '<p>rbrtbntmkug.</p>', 'revg', 0, 'Published', 0),
(17, 1, 'Jerome is me', 'Jerome', '2006-06-23', 'profile_pic.jpg', '<p>Hi Im \"Jerome\", my alter self for interacting with girls on facebook. I ended up getting blocked because I used my Jerome persona to pretend to be more successful than what I actually was. I eventually got sick of not being able to meet them in person.</p>', 'gwapo', 0, 'Published', 0),
(18, 1, 'Getting back into the groove', 'Joseph', '2002-01-23', 'people1-bg22.jpg', '<p>Im getting back into the dip. Turns out that Ive been walking away from my actual obligations and responsibilities by distracting myself with trivial problems like girls. Video games crept back as a coping mechanism for dealing with girl drama and shit. Better than worrying about girls but worse than working on myself.</p>', 'self-improvement', 0, 'Published', 0),
(19, 1, 'Cutting down the fat', 'Joseph', '2002-01-23', 'people1-bg22.jpg', 'A core part of self-improvement is cutting out the fat, whether they be from the body or from the mind and habits. I realized that I could keep going by just playing video games all the time or watching youtube or reading fanfic while going on my self-improvement journey, but the results would be mediocre and slow. I realized that men are made by sacrifices, whether it may be sacrificing boyhood comfort(video games), adolescent fantasies(being popular with girls, social media, porn), or low effort comfort( fanfiction, youtube). I choose to sacrifice those things to give me more time to do whatever I need to do to graduate.', 'self-improvement', 0, 'Published', 0),
(20, 6, 'test post', 'asd', '2002-01-23', 'people1-bg22.jpg', '<p>rbrtbntmkug.</p>', 'revg', 0, 'Published', 0),
(21, 1, 'Jerome is me', 'Jerome', '2006-06-23', 'profile_pic.jpg', '<p>Hi Im \"Jerome\", my alter self for interacting with girls on facebook. I ended up getting blocked because I used my Jerome persona to pretend to be more successful than what I actually was. I eventually got sick of not being able to meet them in person.</p>', 'gwapo', 0, 'Published', 0),
(22, 1, 'POST 11', 'Jerome223', '2007-07-23', 'mine.jpg', '<p>joreifgegtbhyj</p>', 'Jerome', 0, 'Published', 0),
(23, 1, 'Post 12', 'Jerome', '2007-07-23', 'mine.jpg', '<p>trnhirenjghoirsthbrtynjtku</p>', 'rifojoerg', 0, 'Published', 0),
(24, 1, 'Yriwpoqjwwbj', 'JeromeisMe', '2007-07-23', 'mine.jpg', '<p>Dani Dani Dani</p>', 'rgrgoijegr', 0, 'Published', 0),
(26, 1, 'There is more to life than fapping', 'salanesh', '2007-09-23', '', 'There is more to life than orgasming I should say. Orgasm for what? For just pleasure? Fuck that', 'fap fap', 0, 'Published', 1),
(27, 1, 'I love myself 3', 'salanesh', '2007-09-23', 'Screenshot 2023-03-26 193528.png', '<p>If I did not love myself then would I even be doing this?</p>', 'Love', 0, 'Published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`) VALUES
(1, 'salanesh', '$2y$10$ilovemyselfburgerblaheCo3R4X8ktLMy11PaM8VtJc.NNLKF7yW', 'Jerome', 'Isaac', 'salanesh@gmail.com', NULL, 'admin'),
(3, 'charlesz', '$2y$10$ilovemyselfburgerblahee4YUZpwzvEeREKaFPL0KvPXOVyizaeW', 'wfiuhwfef', 'eifvndekifvev', 'wer@gmail.com', 'mine.jpg', 'admin'),
(4, 'karlohimenez', 'wakwakhahajeje', 'hernen', 'yoki', 'yokyok@gmail.com', 'negro.jpg', 'subscriber'),
(5, 'jerome123', 'jerome123123', 'jerjerome', 'jeromenimo', 'jerom@gmail.com', 'rwl5o5xm2tv71.webp', 'subscriber'),
(6, 'jerome223', 'jeromeisme', 'jerome isaac', 'clark', 'jerome@gmail.com', 'mine.jpg', 'admin'),
(7, 'someone123', 'someonenew', 'someone', 'new', 'someone@gmail.com', 'tianmei.jpg', 'admin'),
(8, 'hotgirlbummer', '$2y$10$ilovemyselfburgerblaheKCHaDsBnL1Q5i.8XB7IxHRCR3vTJyXK', 'Keisha', 'Bilatboto', 'hotgirl@gmail.com', NULL, 'subscriber');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(11, '', 1694100376);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
