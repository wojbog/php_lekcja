-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 31 Mar 2022, 23:12
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `dziennik`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `id` int(11) NOT NULL,
  `id_ucznia` int(11) NOT NULL,
  `id_przedmiotu` int(11) NOT NULL,
  `ocena` int(11) NOT NULL,
  `data_dodania` date NOT NULL DEFAULT current_timestamp(),
  `data_aktualizacji` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `oceny`
--

INSERT INTO `oceny` (`id`, `id_ucznia`, `id_przedmiotu`, `ocena`, `data_dodania`, `data_aktualizacji`) VALUES
(2, 8, 2, 3, '2022-03-18', '2022-03-18'),
(3, 8, 2, 3, '2022-03-18', '2022-03-18'),
(4, 8, 4, 1, '2022-03-18', '2022-03-26'),
(6, 8, 2, 3, '2022-03-19', '2022-03-19'),
(7, 10, 4, 4, '2022-03-19', '2022-03-19'),
(11, 8, 3, 4, '2022-03-31', '2022-03-31'),
(12, 8, 1, 1, '2022-03-31', '2022-03-31'),
(13, 10, 3, 5, '2022-03-31', '2022-03-31'),
(14, 10, 5, 3, '2022-03-31', '2022-03-31'),
(15, 8, 2, 3, '2022-03-31', '2022-03-31'),
(16, 8, 3, 4, '2022-03-31', '2022-03-31'),
(17, 8, 1, 1, '2022-03-31', '2022-03-31'),
(18, 8, 1, 1, '2022-03-31', '2022-03-31'),
(19, 8, 1, 1, '2022-03-31', '2022-03-31');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmioty`
--

CREATE TABLE `przedmioty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `przedmioty`
--

INSERT INTO `przedmioty` (`id`, `nazwa`) VALUES
(1, 'język polski'),
(2, 'matematyka'),
(3, 'język angielski'),
(4, 'fizyka'),
(5, 'geagrafia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `imie` varchar(30) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `data_urodzenia` date NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `typ` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `imie`, `nazwisko`, `data_urodzenia`, `haslo`, `email`, `typ`) VALUES
(6, 'stefarrr', 'Nowak', '2022-03-16', '$2y$10$deQsS4nLJpFkuUNNwyHtBOsA5Ena6f0Z3vV5DKTHU.ncywnjS5HAW', 'stefan@wp.pl', 'nauczyciel'),
(7, 'wojtek', 'bo', '2022-03-17', '$2y$10$D9D3tJsVsgzmh8BZfprifuG1c0RvUMHvChUhq1E.4aPub5zZTXH3e', 'w@wp.pl', 'admin'),
(8, 'bartek', 'kacz', '2022-03-18', '$2y$10$yK2.YTCiCRVMQZpqVCvnbuaVhS8bC/f0UaCuOyHzEM1v.Vn2uUeuK', 'b@wp.pl', 'uczen'),
(9, 'stefarrr', 'sfsdfd', '2022-03-17', '$2y$10$kAbHKlW2EliZY07ICe.wH.efW4iqDohkUhOu4vIvF0A7Ltuge2o7S', 's@wp.pl', 'uczen'),
(10, 'sadsd', 'asdasd', '2022-03-10', '$2y$10$XKi9oF/qfW7yJulJLJmUPO9FCmwSySHMBRX1JSLnJR66YbGtWEO8C', 'asds@wp.pl', 'uczen'),
(13, 'Wdfg', 'Wcxfgd', '2022-03-16', '$2y$10$nGmk.oaGAQLQxO28d5w8DOmf2JJhvOv904yndz1yr1gFXOoXezif2', 'drgdfg@sdf.pl', 'admin'),
(14, 'sdfsdf', 'Sfgdfg', '2022-03-02', '$2y$10$HlpzSCI30vGPHX/vVUX8XOnk2lJgkEE5PxWcO5Sz1xvRz9XzZ9LMi', 'asdasd@asdasd.pl', 'admin'),
(15, 'Wfsdf', 'Rdfsdf', '2022-03-15', '$2y$10$Y.P3ERiBd58CH61NWCziD.72YdLrfjzHrDQbaIETq8P/YCMXfFrIi', 'asda@dfsas.pl', 'admin'),
(16, 'Asdas', 'Aasdasd', '2022-03-09', '$2y$10$SSiihSQ/b2Ez6YeS2uiLUOxbwE0M6hoglihSvigEbcYRVZcCbLxQ6', 'asd@asda.pl', 'admin'),
(17, 'adam', 'adam', '2022-03-08', '$2y$10$tvKmIhxl5eqW8s4HczX3GuBx9Yh6PF0JdYYKoR.6znBIsKZjc.cNu', 'aaa@wp.pl', 'uczen'),
(18, 'Saasdasd', 'Asdasd', '2022-03-15', '$2y$10$wggo9Jmx/jaBm1h0CY.91udgomzlN.RU/AKtFfzk3toqz7EYKhFp2', 'asda@asd.pl', 'admin'),
(19, 'Saasdasd', 'Asdasd', '2022-03-15', '$2y$10$FLe.9bhmGqTA4iNfK4Qlfu0ZsUqun4aZ8vtiNQ0mb2F3dAbaDhK8W', 'asda@asd.pl', 'admin'),
(20, 'Saasdasd', 'Asdasd', '2022-03-15', '$2y$10$EkIETyCb2lBEfMej/w7jK.lEzgBgvQMMAK90MyJRNbnYcs5h3IiyC', 'asda@asd.pl', 'admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ucznia` (`id_ucznia`),
  ADD KEY `id_przedmiotu` (`id_przedmiotu`);

--
-- Indeksy dla tabeli `przedmioty`
--
ALTER TABLE `przedmioty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `oceny`
--
ALTER TABLE `oceny`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `przedmioty`
--
ALTER TABLE `przedmioty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD CONSTRAINT `oceny_ibfk_1` FOREIGN KEY (`id_ucznia`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `oceny_ibfk_2` FOREIGN KEY (`id_przedmiotu`) REFERENCES `przedmioty` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
