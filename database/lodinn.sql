-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Már 15. 19:20
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `lodinn`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ar`
--

CREATE TABLE `ar` (
  `kategoriaAr_ID` int(11) NOT NULL,
  `foglAr_ID` int(11) NOT NULL,
  `kutyaAr_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `arai`
--

CREATE TABLE `arai` (
  `kategoria_ID` int(11) NOT NULL,
  `panzio_ID` int(11) NOT NULL,
  `ar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `arak`
--

CREATE TABLE `arak` (
  `kategoriaID` int(11) NOT NULL,
  `kategoriaNev` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozok`
--

CREATE TABLE `dolgozok` (
  `dolgozoID` int(11) NOT NULL,
  `vezNev` varchar(50) NOT NULL,
  `kerNev` varchar(50) NOT NULL,
  `felh_ID` int(11) NOT NULL,
  `panzio_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `felhID` int(11) NOT NULL,
  `felhNev` varchar(50) NOT NULL,
  `jelszo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalasok`
--

CREATE TABLE `foglalasok` (
  `foglID` int(11) NOT NULL,
  `rogzites` datetime DEFAULT current_timestamp(),
  `panzio_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hirek`
--

CREATE TABLE `hirek` (
  `hirID` int(11) NOT NULL,
  `cim` varchar(50) NOT NULL,
  `leiras` varchar(1000) NOT NULL,
  `datum` date DEFAULT NULL,
  `panzio_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kepek`
--

CREATE TABLE `kepek` (
  `kepID` int(11) NOT NULL,
  `kepNev` varchar(50) NOT NULL,
  `kepUtvonal` varchar(100) NOT NULL,
  `panzio_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kutyak`
--

CREATE TABLE `kutyak` (
  `kutyaID` int(11) NOT NULL,
  `kutyaNev` varchar(30) NOT NULL,
  `kor` int(11) DEFAULT NULL,
  `fajta` varchar(30) DEFAULT NULL,
  `vendeg_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `linkek`
--

CREATE TABLE `linkek` (
  `linkID` int(11) NOT NULL,
  `linkNev` varchar(50) NOT NULL,
  `link` varchar(2050) NOT NULL,
  `panzio_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `panziok`
--

CREATE TABLE `panziok` (
  `panzioID` int(11) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `telszam` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kapacitas` int(11) NOT NULL,
  `megye` varchar(50) NOT NULL,
  `varos` varchar(50) NOT NULL,
  `utca` varchar(50) DEFAULT NULL,
  `hazszam` varchar(10) DEFAULT NULL,
  `bemutatkozas` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tartozik`
--

CREATE TABLE `tartozik` (
  `kezdoDatum` date NOT NULL,
  `vegDatum` date NOT NULL,
  `szallitas` tinyint(1) NOT NULL,
  `specialisIgenyek` varchar(1000) DEFAULT NULL,
  `kutya_ID` int(11) NOT NULL,
  `fogl_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vendegek`
--

CREATE TABLE `vendegek` (
  `vendegID` int(11) NOT NULL,
  `vezNev` varchar(50) NOT NULL,
  `kerNev` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telszam` varchar(20) NOT NULL,
  `felh_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `ar`
--
ALTER TABLE `ar`
  ADD PRIMARY KEY (`kategoriaAr_ID`,`foglAr_ID`,`kutyaAr_ID`),
  ADD KEY `foglAr_ID` (`foglAr_ID`),
  ADD KEY `kutyaAr_ID` (`kutyaAr_ID`);

--
-- A tábla indexei `arai`
--
ALTER TABLE `arai`
  ADD PRIMARY KEY (`kategoria_ID`,`panzio_ID`),
  ADD KEY `panzio_ID` (`panzio_ID`);

--
-- A tábla indexei `arak`
--
ALTER TABLE `arak`
  ADD PRIMARY KEY (`kategoriaID`);

--
-- A tábla indexei `dolgozok`
--
ALTER TABLE `dolgozok`
  ADD PRIMARY KEY (`dolgozoID`),
  ADD UNIQUE KEY `felh_ID` (`felh_ID`),
  ADD KEY `panzio_ID` (`panzio_ID`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`felhID`);

--
-- A tábla indexei `foglalasok`
--
ALTER TABLE `foglalasok`
  ADD PRIMARY KEY (`foglID`),
  ADD KEY `panzio_ID` (`panzio_ID`);

--
-- A tábla indexei `hirek`
--
ALTER TABLE `hirek`
  ADD PRIMARY KEY (`hirID`),
  ADD KEY `panzio_ID` (`panzio_ID`);

--
-- A tábla indexei `kepek`
--
ALTER TABLE `kepek`
  ADD PRIMARY KEY (`kepID`),
  ADD KEY `panzio_ID` (`panzio_ID`);

--
-- A tábla indexei `kutyak`
--
ALTER TABLE `kutyak`
  ADD PRIMARY KEY (`kutyaID`),
  ADD KEY `vendeg_ID` (`vendeg_ID`);

--
-- A tábla indexei `linkek`
--
ALTER TABLE `linkek`
  ADD PRIMARY KEY (`linkID`),
  ADD KEY `panzio_ID` (`panzio_ID`);

--
-- A tábla indexei `panziok`
--
ALTER TABLE `panziok`
  ADD PRIMARY KEY (`panzioID`);

--
-- A tábla indexei `tartozik`
--
ALTER TABLE `tartozik`
  ADD PRIMARY KEY (`kutya_ID`,`fogl_ID`),
  ADD KEY `fogl_ID` (`fogl_ID`);

--
-- A tábla indexei `vendegek`
--
ALTER TABLE `vendegek`
  ADD PRIMARY KEY (`vendegID`),
  ADD UNIQUE KEY `felh_ID` (`felh_ID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `arak`
--
ALTER TABLE `arak`
  MODIFY `kategoriaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `dolgozok`
--
ALTER TABLE `dolgozok`
  MODIFY `dolgozoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `felhID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `foglalasok`
--
ALTER TABLE `foglalasok`
  MODIFY `foglID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `hirek`
--
ALTER TABLE `hirek`
  MODIFY `hirID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `kepek`
--
ALTER TABLE `kepek`
  MODIFY `kepID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `kutyak`
--
ALTER TABLE `kutyak`
  MODIFY `kutyaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `linkek`
--
ALTER TABLE `linkek`
  MODIFY `linkID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `panziok`
--
ALTER TABLE `panziok`
  MODIFY `panzioID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `vendegek`
--
ALTER TABLE `vendegek`
  MODIFY `vendegID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `ar`
--
ALTER TABLE `ar`
  ADD CONSTRAINT `ar_ibfk_1` FOREIGN KEY (`kategoriaAr_ID`) REFERENCES `arak` (`kategoriaID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ar_ibfk_2` FOREIGN KEY (`foglAr_ID`) REFERENCES `tartozik` (`fogl_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ar_ibfk_3` FOREIGN KEY (`kutyaAr_ID`) REFERENCES `tartozik` (`kutya_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `arai`
--
ALTER TABLE `arai`
  ADD CONSTRAINT `arai_ibfk_1` FOREIGN KEY (`kategoria_ID`) REFERENCES `arak` (`kategoriaID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `arai_ibfk_2` FOREIGN KEY (`panzio_ID`) REFERENCES `panziok` (`panzioID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `dolgozok`
--
ALTER TABLE `dolgozok`
  ADD CONSTRAINT `dolgozok_ibfk_1` FOREIGN KEY (`felh_ID`) REFERENCES `felhasznalok` (`felhID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dolgozok_ibfk_2` FOREIGN KEY (`panzio_ID`) REFERENCES `panziok` (`panzioID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `foglalasok`
--
ALTER TABLE `foglalasok`
  ADD CONSTRAINT `foglalasok_ibfk_1` FOREIGN KEY (`panzio_ID`) REFERENCES `panziok` (`panzioID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `hirek`
--
ALTER TABLE `hirek`
  ADD CONSTRAINT `hirek_ibfk_1` FOREIGN KEY (`panzio_ID`) REFERENCES `panziok` (`panzioID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `kepek`
--
ALTER TABLE `kepek`
  ADD CONSTRAINT `kepek_ibfk_1` FOREIGN KEY (`panzio_ID`) REFERENCES `panziok` (`panzioID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `kutyak`
--
ALTER TABLE `kutyak`
  ADD CONSTRAINT `kutyak_ibfk_1` FOREIGN KEY (`vendeg_ID`) REFERENCES `vendegek` (`vendegID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `linkek`
--
ALTER TABLE `linkek`
  ADD CONSTRAINT `linkek_ibfk_1` FOREIGN KEY (`panzio_ID`) REFERENCES `panziok` (`panzioID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `tartozik`
--
ALTER TABLE `tartozik`
  ADD CONSTRAINT `tartozik_ibfk_1` FOREIGN KEY (`kutya_ID`) REFERENCES `kutyak` (`kutyaID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tartozik_ibfk_2` FOREIGN KEY (`fogl_ID`) REFERENCES `foglalasok` (`foglID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `vendegek`
--
ALTER TABLE `vendegek`
  ADD CONSTRAINT `vendegek_ibfk_1` FOREIGN KEY (`felh_ID`) REFERENCES `felhasznalok` (`felhID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
