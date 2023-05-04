-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 04, 2023 at 07:09 PM
-- Server version: 8.0.30
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `gamers`
--

CREATE TABLE `gamers` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` int NOT NULL,
  `prize` int NOT NULL,
  `status` varchar(255) NOT NULL,
  `getted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gamers`
--

INSERT INTO `gamers` (`id`, `name`, `level`, `prize`, `status`, `getted`) VALUES
(5, 'Ando Smith', 6, 10000, 'Waiting', 0),
(7, 'Tony Smith', 1, 1000, 'Canceled', 0),
(9, 'Ando Smith', 2, 1500, 'Waiting', 0),
(11, 'Tony Smith', 13, 100000, 'Finished', 0),
(15, 'user', 1, 100, 'Canceled', 0),
(18, 'Vazgen', 1, 100, 'waiting', 0),
(19, 'Ann', 1, 100, 'waiting', 0),
(21, 'asdasd', 1, 100, 'waiting', 0),
(22, 'Mher', 4, 500, 'waiting', 0),
(23, 'Mher', 4, 500, 'waiting', 0),
(24, 'user', 1, 100, 'waiting', 0),
(27, 'Mher', 1, 100, 'waiting', 0),
(28, 'Mher', 1, 100, 'waiting', 0),
(30, 'Maa', 1, 100, 'waiting', 0),
(31, 'Maa', 1, 100, 'waiting', 0),
(32, 'Maa', 1, 100, 'waiting', 0),
(33, 'Maa', 1, 100, 'waiting', 0),
(34, 'Maa', 1, 100, 'waiting', 0),
(35, 'Maa', 1, 100, 'waiting', 0),
(36, 'Mher', 1, 100, 'waiting', 0),
(37, 'Mher', 1, 100, 'waiting', 0),
(38, 'Mher', 2, 200, 'waiting', 0),
(40, 'Mher', 1, 100, 'waiting', 0),
(41, 'Mher', 6, 2000, 'waiting', 0),
(42, '0', 0, 0, '0', 0),
(46, 'Mher', 1, 0, 'waiting', 0),
(47, 'Mher', 3, 300, 'waiting', 0),
(48, 'Mher', 3, 300, 'waiting', 0),
(49, 'Mher', 1, 0, 'waiting', 0),
(50, 'Mher', 7, 1000, 'waiting', 0),
(56, 'Mher', 3, 300, 'waiting', 0),
(57, 'Mher', 1, 100, 'waiting', 0),
(58, 'Mher', 1, 100, 'waiting', 0),
(59, 'Mher', 1, 100, 'waiting', 0),
(60, 'Mher', 1, 100, 'waiting', 0),
(61, 'Mher', 1, 100, 'waiting', 0),
(64, 'admin', 1, 100, 'waiting', 0);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int NOT NULL,
  `en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `hy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `en`, `hy`, `name`, `url`) VALUES
(1, 'Who wants to be a millionaire?', 'Ով է ուզում դառնալ միլիոնատեր', 'home_title', 'home'),
(2, 'Start playing now!', 'Սկսիր խաղալ հենց հիմա', 'home_info', 'home'),
(3, 'Start', 'Սկսել', 'home_button', 'home'),
(4, 'Main page', 'Գլխավոր էջ', 'main_page', 'header'),
(5, 'Play', 'Խաղալ', 'play', 'header'),
(6, 'Admin panel', 'Ադմին պանել', 'admin_panel', 'header'),
(7, 'Login', 'Մուտք', 'login', 'header'),
(8, 'Registration', 'Գրանցվել', 'registration', 'header'),
(9, 'Profile', 'Պրոֆիլ', 'profile', 'header'),
(10, 'Log Out', 'Դուրս գալ', 'logout', 'header'),
(11, 'Log in', 'Մուտք գործել', 'login_title', 'login'),
(12, 'Username', 'Մուտքանուն', 'input_login', 'login'),
(13, 'Password', 'Գաղտնաբառ', 'input_password', 'login'),
(14, 'Login', 'Մուտք', 'login_button', 'login'),
(15, 'Registration', 'Գրանցում', 'registration_title', 'register'),
(16, 'Login', 'Մուտքանուն', 'input_login', 'register'),
(17, 'Password', 'Գաղտնաբառ', 'input_password', 'register'),
(18, 'Repeat password', 'կրկնեք գաղտնաբառը', 'input-rep-pass', 'register'),
(19, 'Name', 'Անուն', 'input_name', 'register'),
(20, 'Surname', 'Ազգանուն', 'input_sname', 'register'),
(21, 'Age', 'Տարիք', 'input_age', 'register'),
(22, 'Minimum', 'Առնվազն', 'input_danger_minimum', 'register'),
(23, 'Register', 'Գրանցվել', 'input_button_register', 'register'),
(24, 'Your balance', 'ձեր հաշիվը', 'balance', 'profile'),
(25, 'Name', 'Անուն', 'table_name', 'profile'),
(26, 'Question', 'Հարց', 'table_question', 'profile'),
(27, 'Prize', 'Գումար', 'table_prize', 'profile'),
(28, 'status', 'Կարգավիճակ', 'table_status', 'profile'),
(29, '#id', '#id', 'table_id', 'profile'),
(30, 'All games', 'Բոլոր խաղերը', 'table_all_games', 'profile'),
(31, 'Page', 'Էջ', 'table_page', 'profile'),
(32, 'Get', 'Վերցնել', 'table_prize_button', 'profile'),
(33, 'Canceled', 'Չեղարկված', 'game_status_canceled', 'profile'),
(34, 'in process', 'Ընթացքի մեջ', 'game_status_waiting', 'profile'),
(35, 'The game consists of 15 parts, for each correct answer you will receive a sum, if you answer incorrectly, you will lose all your winnings and have to start the game again, you can also stop the game and take the money.', 'Խաղը բաղկացած է 15 մասերից, յուրաքանչյուր ճիշտ պաստասխանի համար կստանաք գումարար, սխալ պատասխանելու դեպքում ձեր ողջ շահած գումարը կպարտվեք և խաղը պետք է սկսել նորից, նաև կարող եք կանգնեցնել խաղը և վերցնել գումարը։', 'game_info', 'game'),
(36, 'Start', 'Սկսել', 'game_button', 'game'),
(37, 'Stop the game and collect the winnings', 'Ավարտել խաղը և վերցնել շահած գումարը', 'end_game', 'play'),
(38, 'Who wants to be a millionaire?', 'Ով է ուզում դառնալ միլիոնատեր', 'muted_title', 'play'),
(39, 'Game over, it is your winnings', 'Խաղը ավարտված է, ձեր շահած գումարն է', 'game_stop_prize', 'play'),
(40, 'You lost your victory', 'Դուք պարտվեցիք ձեր հաղթանակը ', 'game_lost_noprize', 'play'),
(41, 'You lost, try again', 'Դուք պարտվեցիք, փորձեք կրկին ', 'game_lost_prize', 'play'),
(42, ': main page', '։ Գլխավոր էջ', 'game_main_page_button', 'play'),
(43, 'You have no winnings, game over', 'Դուք չունեք հաղթած գումար, խաղը ավարտված է', 'game_stop_noprize', 'play'),
(44, 'Main Dashboard', 'Հիմնական վահանակ', 'main_dashboard', 'admin_header'),
(45, 'Go to HomePage', 'Գնալ Գլխավոր էջ', 'go_to_main_page', 'admin_header'),
(46, 'logout', 'Դուրս գալ', 'log_out_btn', 'admin_header'),
(47, 'Main', 'Հիմնական', 'menu_title', 'admin_header'),
(48, 'Game', 'Խաղ', 'menu_game_chapter', 'admin_header'),
(49, 'Games', 'Խաղեր', 'menu_game_chapter_games', 'admin_header'),
(50, 'Questions', 'Հարցեր', 'menu_game_chapter_questions', 'admin_header'),
(51, 'Admin tooles', 'Ադմինի գործիքներ', 'menu_admint_chapter', 'admin_header'),
(52, 'Documentation', 'Դոկումենտացիա', 'menu_admint_chapter_documentation', 'admin_header'),
(53, 'Users', 'Օգտատերներ', 'menu_admint_chapter_users', 'admin_header'),
(54, 'Logged in as:', 'Ադմինի անուն։', 'menu_admint_chapter_admin_name', 'admin_header'),
(55, 'Who want to be a millionaire', 'Ով է ուզում դառնալ միլիոնատեր', 'title', 'admin/home'),
(56, 'Professionall admin panel', 'Պրոֆեսիոնալ ադմինիստրատորի վահանակ', 'title_info', 'admin/home'),
(57, 'Wins up 5 level', 'Հաղթանակները 5 հարցից ավել', 'win_up_5', 'admin/home'),
(58, 'All games', 'Բոլոր խաղերը', 'all_games', 'admin/home'),
(59, 'Documentation', 'Դոկումենտացիա', 'documentation', 'admin/home'),
(60, 'Documentation of game', 'Խաղի Դոկումենտացիան', 'documentation_of_game', 'admin/home'),
(61, 'Who want to be a millionaire', 'Ով է ուզում դառնալ միլիոնատեր', 'title', 'admin_header'),
(62, 'All games is here', 'Բոլոր խաղերը այսեղ են', 'all_games', 'admin/gamers'),
(63, 'You can edit the gamer and change status of gamer or delete gamer', 'Դուք կարող եք խմբագրել խաղերը և փոխել խաղի կարգավիճակը կամ ջնջել խաղը', 'game_info', 'admin/gamers'),
(64, 'All games', 'Բոլոր խաղերը', 'all_games_table', 'admin/gamers'),
(65, 'login', 'Անուն', 'table_login', 'admin/gamers'),
(66, 'level', 'Փուլ', 'table_lvl', 'admin/gamers'),
(67, 'prize', 'Հաղթանակ', 'table_prize', 'admin/gamers'),
(68, 'status', 'կարգավիճակ', 'table_status', 'admin/gamers'),
(69, '#id', '#Հ', 'table_num', 'admin/gamers'),
(70, 'all games', 'Բոլոր խաղերը', 'table_count', 'admin/gamers'),
(71, 'Games', 'Խաղեր', 'title', 'admin/gamers'),
(72, 'Delete', 'Ջնջել', 'table_delete', 'admin/gamers'),
(73, 'Finished', 'Ավարտած', 'table_status_finished', 'admin/gamers'),
(74, 'Canceled', 'չեղարկված', 'table_status_canceled', 'admin/gamers'),
(75, 'In process', 'Ընթացքի մեջ', 'table_status_in_process', 'admin/gamers'),
(76, 'Page:', 'Էջ:', 'table_page', 'admin/gamers'),
(86, 'Questions', 'Հարցեր', 'title', 'admin/questions'),
(87, 'All questions is here', 'Բոլոր հարցերն այստեղ են', 'question_title', 'admin/questions'),
(88, 'You can edit the questions and change difficulty of question', 'Դուք կարող եք խմբագրել հարցերը և փոխել հարցի բարդությունը', 'question_info', 'admin/questions'),
(89, 'Page:', 'Էջ:', 'table_page', 'admin/questions'),
(90, 'All questions:', 'Բոլոր հարցերը:', 'table_count', 'admin/questions'),
(91, '#number', '#համար', 'table_num', 'admin/questions'),
(92, 'Question', 'Հարց', 'table_question', 'admin/questions'),
(93, 'Right answer', 'Ճիշտ պատասխան', 'table_right_ans', 'admin/questions'),
(94, 'difficulty', 'Բարդություն', 'table_diff', 'admin/questions'),
(95, 'Edit', 'Խմբագրել', 'table_edit', 'admin/questions'),
(96, 'Normal', 'Նորմալ', 'table_diff_n', 'admin/questions'),
(97, 'Easy', 'Հեշտ', 'table_diff_e', 'admin/questions'),
(98, 'Hard', 'Բարդ', 'table_diff_h', 'admin/questions'),
(100, 'Documentation', 'Դոկումենտացիա', 'title', 'admin/documentation'),
(101, 'All users', 'Բոլոր օգտատերերը', 'title', 'admin/users'),
(102, 'All users are here', 'Բոլոր օգտատերերը այստեղ են', 'users_title', 'admin/users'),
(103, 'Here you can add new users or edit that', 'Այստեղ դուք կարող եք ավելացնել նոր օգտատերերի կամ խմբագրել նրանց', 'users_info', 'admin/users'),
(104, 'All', 'Բոլորը', 'table_select_all', 'admin/users'),
(105, 'User', 'օգտատեր', 'table_select_user', 'admin/users'),
(106, 'Admin', 'Ադմին', 'table_select_admin', 'admin/users'),
(107, 'Page:', 'Էջ:', 'table_page', 'admin/users'),
(108, 'All questions:', 'Բոլոր հարցերը:', 'table_count', 'admin/users'),
(109, '#id', '#Համար', 'table_num', 'admin/users'),
(110, 'login', 'Լոգին', 'table_login', 'admin/users'),
(111, 'name', 'Անուն', 'table_name', 'admin/users'),
(112, 'balance', 'Հաշիվ', 'table_balance', 'admin/users'),
(113, 'role', 'Դեր', 'table_role', 'admin/users'),
(114, 'Action', 'Գործողություն', 'table_action', 'admin/users'),
(115, 'Create user', 'Ստեղծել օգտատեր', 'title', 'admin/users/add'),
(116, 'You can create user here', 'Այստեղ կարող եք օգտատեր ստեղծել', 'add_title', 'admin/users/add'),
(117, 'Here you can add new users and give them role', 'Այստեղ դուք կարող եք ավելացնել նոր օգտատեր և նրանց դեր տալ', 'add_info', 'admin/users/add'),
(118, 'Name', 'Անուն', 'select_name', 'admin/users/add'),
(119, 'Sname ', 'Ազգանուն', 'select_sname', 'admin/users/add'),
(120, 'Balance ', 'հաշիվ', 'select_balance', 'admin/users/add'),
(121, 'Age ', 'Տարիք', 'select_age', 'admin/users/add'),
(122, 'Login', 'Լոգին', 'select_login', 'admin/users/add'),
(123, 'Password', 'Գաղտնաբառ', 'select_pass', 'admin/users/add'),
(124, 'Role', 'Դեր', 'select_role', 'admin/users/add'),
(125, 'User', 'Օգտատեր', 'select_role_user', 'admin/users/add'),
(126, 'Admin', 'Ադմին', 'select_role_admin', 'admin/users/add'),
(127, 'Create a user', 'ստեղծել', 'select_btn', 'admin/users/add'),
(128, '( Min: 3 sybhols )', '(Նվազագույնը՝ 3 սիբհոլ)', 'min3sym', 'admin/users/add'),
(129, '( Min: 18 year )', '(Նվազագույնը: 18 տարի)', 'min18year', 'admin/users/add'),
(130, '(Automatically it is 0 you can skip this input)', ' (Ավտոմատ կերպով դա 0 է դուք կարող եք բաց թողնել այս մուտքագրումը)', 'auto', 'admin/users/add'),
(131, 'Please check form again', 'Խնդրում ենք կրկին ստուգել ձեր գրածը', 'please_check', 'admin/users/add'),
(132, '( Min: 4 sybhols )', '(Նվազագույնը՝ 4 սիբհոլ)', 'min4sym', 'admin/users/add'),
(133, 'Select a role', 'ընտրեք դերը', 'select_role_btn', 'admin/users/add'),
(134, 'This name of user already exists', 'Այս օգտվողի անունը արդեն գոյություն ունի', 'exist_user', 'admin/users/add'),
(135, 'User is created', 'օգտատերը ստեղծված է', 'user_created', 'admin/users/add'),
(136, 'role', 'Դեր', 'select_role_text', 'admin/users_add'),
(137, 'Edit user', 'Խմբագրել օգտատիրոջը', 'title', 'admin/user/edit'),
(138, 'Here you can edit you question and save it', 'Այստեղ դուք կարող եք խմբագրել ձեր օգտատիրոջը', 'title_info', 'admin/user/edit'),
(139, 'User Details -', 'օգտատեր -', 'user_info', 'admin/user/edit'),
(140, 'Name', 'Անուն', 'select_name', 'admin/user/edit'),
(141, 'Sname ', 'Ազգանուն', 'select_sname', 'admin/user/edit'),
(142, 'Balance ', 'հաշիվ', 'select_balance', 'admin/user/edit'),
(143, 'Age ', 'Տարիք', 'select_age', 'admin/user/edit'),
(144, 'Role', 'Դեր', 'select_role', 'admin/user/edit'),
(145, 'User', 'Օգտատեր', 'select_role_user', 'admin/user/edit'),
(146, 'Admin', 'Ադմին', 'select_role_admin', 'admin/user/edit'),
(147, 'Create a user', 'Փոխել', 'select_btn', 'admin/user/edit'),
(148, '( Min: 3 sybhols )', '(Նվազագույնը՝ 3 սիբհոլ)', 'min3sym', 'admin/user/edit'),
(149, '( Min: 18 year )', '(Նվազագույնը: 18 տարի)', 'min18year', 'admin/user/edit'),
(150, 'Select a role', 'ընտրեք դերը', 'select_role_btn', 'admin/user/edit'),
(151, 'role', 'Դեր', 'select_role_text', 'admin/user/edit'),
(152, 'Save chnages', 'Պահպանված է', 'save_changes', 'admin/user/edit'),
(153, 'you cant change user, because it\'s you', 'Դուք չեք կարող փոխել օգտվողին, քանի որ դա դուք եք', 'error1', 'admin/user/edit'),
(154, 'you cant change admin, because admins count is 1', 'Դուք չեք կարող փոխել ադմինիստրատորը, քանի որ ադմինների թիվը 1 է', 'error2', 'admin/user/edit'),
(155, 'age is not correct', 'տարիքը ճիշտ չէ', 'error3', 'admin/user/edit'),
(156, 'please fill all', 'խնդրում եմ լրացնել բոլորը', 'error4', 'admin/user/edit'),
(159, 'Create question', 'Ստեղծել հարց', 'title', 'admin/questions/create'),
(160, 'You can create the questions', 'Դուք կարող եք ստեղծել հարցերը', 'title_info', 'admin/questions/create'),
(161, 'Question', 'Հարց', 'form_title', 'admin/questions/create'),
(162, 'Armenian', 'Հայերեն', 'form_armenian', 'admin/questions/create'),
(163, 'English', 'Անգլերեն', 'form_english', 'admin/questions/create'),
(164, 'Question', 'Հարց', 'select_question', 'admin/questions/create'),
(165, 'Right answer', 'Ճիշտ հարց', 'select_right_ans', 'admin/questions/create'),
(166, 'Other variant', 'Ուրիշ տարբերակ', 'select_other_ans', 'admin/questions/create'),
(167, 'difficulty', 'Բարդություն', 'select_diff', 'admin/questions/create'),
(168, 'Normal', 'Նորմալ', 'select_diff_n', 'admin/questions/create'),
(169, 'Easy', 'Հեշտ', 'select_diff_e', 'admin/questions/create'),
(170, 'Hard', 'Բարդ', 'select_diff_h', 'admin/questions/create'),
(171, 'Active', 'Ակտիվ', 'select_active', 'admin/questions/create'),
(172, 'on', 'Այո', 'select_active_on', 'admin/questions/create'),
(173, 'off', 'Ոչ', 'select_active_off', 'admin/questions/create'),
(174, 'Create', 'Ստեղծել', 'select_btn', 'admin/questions/create'),
(175, 'Select a diff:', 'ԸՆտրեք բարդությունը', 'select_diff_place', 'admin/questions/create'),
(176, 'Select a active:', 'ԸՆտրեք հասանելիությունը', 'select_active_place', 'admin/questions/create'),
(177, 'please fill all', 'Լրացրեք բոլոր բաց թողնված տեղերը', 'error1', 'admin/questions/create'),
(178, 'You crate a question.', 'Հարցը ստեղծված է', 'error2', 'admin/questions/create'),
(179, 'Edit question', 'Փոխել հարցը', 'title', 'admin/questions/edit'),
(180, 'You can edit the questions and change difficulty of question', 'Դուք կարող եք խմբագրել հարցերը և փոխել հարցի դժվարությունը', 'title_info', 'admin/questions/edit'),
(181, 'Question', 'Հարց', 'form_title', 'admin/questions/edit'),
(182, 'Armenian', 'Հայերեն', 'form_armenian', 'admin/questions/edit'),
(183, 'English', 'Անգլերեն', 'form_english', 'admin/questions/edit'),
(184, 'Question', 'Հարց', 'select_question', 'admin/questions/edit'),
(185, 'Right answer', 'Ճիշտ հարց', 'select_right_ans', 'admin/questions/edit'),
(186, 'Other variant', 'Ուրիշ տարբերակ', 'select_other_ans', 'admin/questions/edit'),
(187, 'difficulty', 'Բարդություն', 'select_diff', 'admin/questions/edit'),
(188, 'Normal', 'Նորմալ', 'select_diff_n', 'admin/questions/edit'),
(189, 'Easy', 'Հեշտ', 'select_diff_e', 'admin/questions/edit'),
(190, 'Hard', 'Բարդ', 'select_diff_h', 'admin/questions/edit'),
(191, 'Active', 'Ակտիվ', 'select_active', 'admin/questions/edit'),
(192, 'on', 'Այո', 'select_active_on', 'admin/questions/edit'),
(193, 'off', 'Ոչ', 'select_active_off', 'admin/questions/edit'),
(194, 'Create', 'Ստեղծել', 'select_btn', 'admin/questions/edit'),
(195, 'Select a diff:', 'ԸՆտրեք բարդությունը', 'select_diff_place', 'admin/questions/edit'),
(196, 'Select a active:', 'ԸՆտրեք հասանելիությունը', 'select_active_place', 'admin/questions/edit'),
(197, 'please fill all', 'Լրացրեք բոլոր բաց թողնված տեղերը', 'error1', 'admin/questions/edit'),
(198, 'You crate a question.', 'Հարցը ստեղծված է', 'error2', 'admin/questions/edit');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `hy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `right_answer_hy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `wrong_answer_hy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `difficulty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `en` varchar(255) NOT NULL,
  `right_answer_en` varchar(255) NOT NULL,
  `wrong_answer_en` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `hy`, `right_answer_hy`, `wrong_answer_hy`, `difficulty`, `active`, `en`, `right_answer_en`, `wrong_answer_en`) VALUES
(1, 'Ո՞ր օրն է համարվում շաբաթվա առաջին օրը Իսրայելում', 'Կիրակի', 'Երկուշաբթի, Շաբաթ, Ուրբաթ', 'normal', 1, 'What day is considered the first day of the week in Israel?', 'Sunday', 'Monday, Saturday, Friday'),
(2, 'Ո՞ր քիմիական տարրի հայտնագործման պատվին են Ֆրանսիայում 19-րդ դարում հատել Ապոլոնի պատկերով մեդալ․', 'Հելիում', 'Տիտան, Ռադիում, Ջրածին', 'normal', 1, 'In honor of the discovery of which chemical element, a medal with the image of Apollo was minted in France in the 19th century.', 'Helium', 'Titanium, Radium, Hydrogen'),
(3, 'Ըստ իր խոստովանության ինչի՞ աստվածն էր Օլե Լուկոյեն՝ Անդերսենի համանուն հեքիաթից․', 'Երազների', 'Հեքիաթների, Մանկության, Գիշերվա', 'normal', 1, 'According to his confession, what god was Ole Lukoye from Andersen\'s fairy tale of the same name?', 'Of dreams', 'Fairy tales, childhood, night'),
(4, 'Ավանդաբար ի՞նչ են անում երաժիշտները Հայդնի «Հրաժեշտի սիմֆոնիան» նվագելիս․', 'Հանգցնում են մոմերը', 'Երգում են, Գլխարկ են հագնում, Օդային համբույրներ են ուղարկում', 'normal', 1, 'What do musicians traditionally do when playing Haydn\'s Farewell Symphony?', 'They put out the candles', 'They sing, they wear hats, they send air kisses'),
(5, 'Ո՞վ էր Հենրի Թեյթը, ում անունով է կոչվում Լոնդոնի պատկերասրահը․', 'Բարերար', 'Ծովահեն, Նկարիչ, Ճարտարապետ', 'normal', 1, 'Who was Henry Tait, after whom the gallery in London is named?', 'Benefactor', 'Pirate, Artist, Architect'),
(6, 'Ո՞ւմ են պարգևատրում Ֆյոդոր Պլևակոի անվան մեդալով', 'Փաստաբաններին', 'Լուսանկարիչներին, Բժիշկներին, Լրագրողներին', 'normal', 1, 'Who is awarded the medal named after Fyodor Plevako?', 'To the lawyers', 'Photographers, Doctors, Journalists'),
(7, 'Ի՞նչպես է կոչվում մարդկային մարմնի մոդելը՝ բժիշկների ուսուցման իրազննականության համար', 'Ֆանտոմ', 'Ուրվական, Ոգի, Խրտվիլակ', 'normal', 1, 'What is a model of the human body called for the accuracy of training doctors?', 'Phantom', 'Ghost, Spirit, Scarecrow'),
(8, 'Ո՞ր օրն է համարվում շաբաթվա առաջին օրը Իսրայելում', 'Կիրակի', 'Երկուշաբթի, Շաբաթ, Ուրբաթ', 'normal', 1, 'What day is considered the first day of the week in Israel?', 'Sunday', 'Monday, Saturday, Friday'),
(9, 'Ո՞ր քիմիական տարրի հայտնագործման պատվին են Ֆրանսիայում 19-րդ դարում հատել Ապոլոնի պատկերով մեդալ․', 'Հելիում', 'Տիտան, Ռադիում, Ջրածին', 'normal', 1, 'In honor of the discovery of which chemical element, a medal with the image of Apollo was minted in France in the 19th century.', 'Helium', 'Titanium, Radium, Hydrogen'),
(10, 'Ըստ իր խոստովանության ինչի՞ աստվածն էր Օլե Լուկոյեն՝ Անդերսենի համանուն հեքիաթից․', 'Երազների', 'Հեքիաթների, Մանկության, Գիշերվա', 'normal', 1, 'According to his confession, what god was Ole Lukoye from Andersen\'s fairy tale of the same name?', 'Of dreams', 'Fairy tales, childhood, night'),
(11, 'Ո՞ր օրն է համարվում շաբաթվա առաջին օրը Իսրայելում', 'Կիրակի', 'Երկուշաբթի, Շաբաթ, Ուրբաթ', 'hard', 1, 'What day is considered the first day of the week in Israel?', 'Sunday', 'Monday, Saturday, Friday'),
(12, 'Ո՞ր քիմիական տարրի հայտնագործման պատվին են Ֆրանսիայում 19-րդ դարում հատել Ապոլոնի պատկերով մեդալ․', 'Հելիում', 'Տիտան, Ռադիում, Ջրածին', 'normal', 1, 'In honor of the discovery of which chemical element, a medal with the image of Apollo was minted in France in the 19th century.', 'Helium', 'Titanium, Radium, Hydrogen'),
(13, 'Ըստ իր խոստովանության ինչի՞ աստվածն էր Օլե Լուկոյեն՝ Անդերսենի համանուն հեքիաթից․', 'Երազների', 'Հեքիաթների, Մանկության, Գիշերվա', 'normal', 1, 'According to his confession, what god was Ole Lukoye from Andersen\'s fairy tale of the same name?', 'Of dreams', 'Fairy tales, childhood, night'),
(14, 'Ավանդաբար ի՞նչ են անում երաժիշտները Հայդնի «Հրաժեշտի սիմֆոնիան» նվագելիս․', 'Հանգցնում են մոմերը', 'Երգում են, Գլխարկ են հագնում, Օդային համբույրներ են ուղարկում', 'normal', 1, 'What do musicians traditionally do when playing Haydn\'s Farewell Symphony?', 'They put out the candles', 'They sing, they wear hats, they send air kisses'),
(15, 'Ո՞վ էր Հենրի Թեյթը, ում անունով է կոչվում Լոնդոնի պատկերասրահը․', 'Բարերար', 'Ծովահեն, Նկարիչ, Ճարտարապետ', 'normal', 1, 'Who was Henry Tait, after whom the gallery in London is named?', 'Benefactor', 'Pirate, Artist, Architect'),
(32, 'asdfa', 'asdfsaa', 'asdf,asfd,asdf', 'normal', 0, '', '', ''),
(33, 'asdfa', 'asdfsaa', 'asdf,asfd,asdf', 'normal', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `balance` int NOT NULL,
  `Role` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `sname`, `age`, `balance`, `Role`) VALUES
(1, 'Mher', '25f9e794323b453885f5181f1b624d0b', 'mher', 'Barseghyan', 18, 4200, 'Admin'),
(2, 'asdf', '912ec803b2ce49e4a541068d495ab570', 'asdfa', 'asdf', 18, 0, 'User'),
(3, 'Vazgen', 'e10adc3949ba59abbe56e057f20f883e', 'Vazgen', 'Petrosyan', 18, 0, 'User'),
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Admin', 18, 0, 'Admin'),
(5, 'asdfa', '912ec803b2ce49e4a541068d495ab570', 'asdf', 'asdf', 18, 0, 'User'),
(6, 'asdfa', '912ec803b2ce49e4a541068d495ab570', 'asdf', 'asdf', 18, 0, 'Admin'),
(7, 'asdfa', '912ec803b2ce49e4a541068d495ab570', 'asdf', 'asdf', 18, 0, 'Admin'),
(8, 'asdfss', '912ec803b2ce49e4a541068d495ab570', 'asdf', 'asdfasdf', 18, 0, 'User'),
(9, 'asdfaa', 'aa41efe0a1b3eeb9bf303e4561ff8392', 'asfa', 'asdfs', 18, 0, 'User'),
(10, 'asdfasdf', '6a204bd89f3c8348afd5c77c717a097a', 'asdfasdf', 'asdfasdf', 18, 0, 'User'),
(11, 'asdfsa', '6a204bd89f3c8348afd5c77c717a097a', 'asdfasdf', 'asdfasdf', 18, 0, 'User'),
(12, 'asdfsdsa', '6a204bd89f3c8348afd5c77c717a097a', 'asdfasdf', 'asdfasdf', 18, 0, 'User'),
(13, 'Anna', '97a9d330e236c8d067f01da1894a5438', 'Anna', 'Poghosyan', 18, 0, 'User'),
(14, 'asdddd', '5deb466b0e4c0c313bc6ac950d4247c4', 'asdddd', 'asdddd', 19, 0, 'User'),
(15, 'Artur', 'e10adc3949ba59abbe56e057f20f883e', 'Artur', 'Baghdasaryan', 18, 0, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gamers`
--
ALTER TABLE `gamers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gamers`
--
ALTER TABLE `gamers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
