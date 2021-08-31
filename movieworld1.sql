-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 31 Αυγ 2021 στις 01:46:18
-- Έκδοση διακομιστή: 10.4.20-MariaDB
-- Έκδοση PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `movieworld1`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(10) NOT NULL,
  `movie_title` varchar(255) NOT NULL,
  `movie_description` varchar(255) NOT NULL,
  `movie_upload_date` date NOT NULL,
  `movie_user_id` int(10) NOT NULL,
  `movie_likes` int(10) NOT NULL,
  `movie_hates` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_title`, `movie_description`, `movie_upload_date`, `movie_user_id`, `movie_likes`, `movie_hates`) VALUES
(17, 'Ο Άγνωστος ', 'Ένας Αμερικανός βιολόγος πηγαίνει στο Βερολίνο με τη γυναίκα του για ένα συνέδριο. Ένα τροχαίο θα τον ρίξει σε κώμα^ όταν ξυπνήσει από αυτό, θα διαπιστώσει ότι κανείς δεν τον αναγνωρίζει, ενώ κάποιος άγνωστος έχει οικειοποιηθεί την ταυτότητά του.', '2021-08-30', 15, 0, 2),
(18, 'Suits', 'On the run from a drug deal gone bad, brilliant college dropout Mike Ross finds himself working with Harvey Specter, one of New York City&#039;s best lawyers.', '2021-08-30', 15, 2, 0),
(19, 'Ο Άνθρωπος του Θεού ', 'Αφού χάνει τη θέση του επισκόπου Πενταπόλεως και εκδιώκεται από την Αλεξάνδρεια, ο Άγιος Νεκτάριος επιστρέφει στην Ελλάδα για να συνεχίσει την ιερή αποστολή του παρά τις αντιξοότητες.', '2021-08-30', 17, 1, 1),
(20, 'Bacurau ', 'Στο κοντινό μέλλον, σε ένα απομονωμένο σημείο της βραζιλιάνικης επαρχίας, μια αυτοοργανωμένη κοινότητα δέχεται ένοπλες επιθέσεις από αγνώστους με απροσδιόριστες προθέσεις, ώσπου οι κάτοικοι αποφασίζουν να προστατευτούν με κάθε κόστος.', '2021-08-30', 17, 2, 0),
(21, 'Candyman ', 'Ένας καλλιτέχνης μετακομίζει σε πολυτελές λοφτ πρώην εργατικής συνοικίας, όπου και ανακαλύπτει τον αστικό μύθο μιας βίαιης οντότητας, η οποία των εμπνέει να παραγάγει μια σειρά από έργα αγνοώντας τα αιματηρά γεγονότα που πρόκειται να προκαλέσουν.', '2021-08-30', 18, 0, 1),
(22, 'M.A.S.H ', 'Κατά τη διάρκεια του πολέμου της Κορέας,μια ομάδα Αμερικανών χειρουργών-στρατιωτών, προκειμένου να αντεπεξέλθει στη φρίκη των αιματοχυσιών, περνά το χρόνο της φλερτάροντας, πίνοντας και, ενίοτε, κάνοντας επεμβάσεις σε τραυματίες.', '2021-08-30', 18, 1, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_surname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_email`, `user_password`) VALUES
(15, 'chris', 'chalkiopoulos', 's@s.gr', 'K054NnFKcUNkNTdSMXhiM1V0ZDRhZz09Ojq9q73+K6t/umWEwLbfMMS1'),
(17, 'Christos', 'Chalkiopoulos', 'chris@gmail.com', 'K054NnFKcUNkNTdSMXhiM1V0ZDRhZz09Ojq9q73+K6t/umWEwLbfMMS1'),
(18, 'Nikos', 'Alex', 'nick@nick.gr', 'bjJuZ0hSR0M3NHEvY20xWTl2ZDhLQT09Ojr4xOblzin2ViDkoKYKqcqD');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `user_votes`
--

CREATE TABLE `user_votes` (
  `user_id` int(10) NOT NULL,
  `movie_id` int(10) NOT NULL,
  `rating_action` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `user_votes`
--

INSERT INTO `user_votes` (`user_id`, `movie_id`, `rating_action`) VALUES
(17, 17, 'Hate'),
(17, 18, 'Like'),
(18, 17, 'Hate'),
(18, 18, 'Like'),
(18, 19, 'Hate'),
(18, 20, 'Like'),
(15, 21, 'Hate'),
(15, 22, 'Like'),
(15, 19, 'Like'),
(15, 20, 'Like');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `movies_ibfk_1` (`movie_user_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`movie_user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
