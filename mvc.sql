-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 24 2023 г., 20:45
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Структура таблицы `gamers`
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
-- Дамп данных таблицы `gamers`
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
(43, 'Mher', 3, 300, 'waiting', 0),
(46, 'Mher', 1, 0, 'waiting', 0),
(47, 'Mher', 3, 300, 'waiting', 0),
(48, 'Mher', 3, 300, 'waiting', 0),
(49, 'Mher', 1, 0, 'waiting', 0),
(50, 'Mher', 7, 1000, 'waiting', 0),
(56, 'Mher', 3, 300, 'waiting', 0),
(57, 'Mher', 1, 100, 'waiting', 0),
(58, 'Mher', 1, 100, 'waiting', 0),
(59, 'Mher', 1, 100, 'waiting', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE `languages` (
  `id` int NOT NULL,
  `en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `hy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `languages`
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
(43, 'You have no winnings, game over', 'Դուք չունեք հաղթած գումար, խաղը ավարտված է', 'game_stop_noprize', 'play');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
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
-- Дамп данных таблицы `questions`
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
-- Структура таблицы `users`
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
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `sname`, `age`, `balance`, `Role`) VALUES
(1, 'Mher', '25f9e794323b453885f5181f1b624d0b', 'Mher', 'Barseghyan', 18, 3900, 'User'),
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
(14, 'asdddd', '5deb466b0e4c0c313bc6ac950d4247c4', 'asdddd', 'asdddd', 19, 0, 'User');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gamers`
--
ALTER TABLE `gamers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `gamers`
--
ALTER TABLE `gamers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
