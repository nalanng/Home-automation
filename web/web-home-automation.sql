-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Haz 2023, 22:50:13
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `web-home-automation`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `airconditioner`
--

CREATE TABLE `airconditioner` (
  `DeviceID` int(11) NOT NULL,
  `State` varchar(255) DEFAULT NULL,
  `Program` varchar(255) DEFAULT NULL,
  `Mode` varchar(255) DEFAULT NULL,
  `Degree` int(11) DEFAULT NULL,
  `ConsumerID` int(11) DEFAULT NULL,
  `ProducerMail` varchar(255) DEFAULT NULL,
  `ConsumptionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `airconditioner`
--

INSERT INTO `airconditioner` (`DeviceID`, `State`, `Program`, `Mode`, `Degree`, `ConsumerID`, `ProducerMail`, `ConsumptionID`) VALUES
(1, 'Off', 'Fan', 'Auto', 20, 1, 'nalangelir@gmail.com', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `alarm`
--

CREATE TABLE `alarm` (
  `DeviceID` int(11) NOT NULL,
  `State` varchar(255) DEFAULT NULL,
  `DoorState` varchar(255) DEFAULT NULL,
  `ConsumerID` int(11) DEFAULT NULL,
  `ProducerMail` varchar(255) DEFAULT NULL,
  `ConsumptionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `alarm`
--

INSERT INTO `alarm` (`DeviceID`, `State`, `DoorState`, `ConsumerID`, `ProducerMail`, `ConsumptionID`) VALUES
(1, 'Off', 'Open', 1, 'nalangelir@gmail.com', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `consumerinfo`
--

CREATE TABLE `consumerinfo` (
  `ConsumerID` int(11) NOT NULL,
  `ConsumerNameSurname` varchar(255) DEFAULT NULL,
  `ConsumerEmail` varchar(255) DEFAULT NULL,
  `ConsumerPhoneNumber` varchar(255) DEFAULT NULL,
  `ConsumerPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `consumerinfo`
--

INSERT INTO `consumerinfo` (`ConsumerID`, `ConsumerNameSurname`, `ConsumerEmail`, `ConsumerPhoneNumber`, `ConsumerPassword`) VALUES
(1, 'Nalan Gelir', 'nalangelir@gmail.com', '05069305765', 'password123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `consumption`
--

CREATE TABLE `consumption` (
  `ConsumptionID` int(11) NOT NULL,
  `ConsumerID` int(11) DEFAULT NULL,
  `ProducerEmail` varchar(255) DEFAULT NULL,
  `AirCons` int(11) DEFAULT NULL,
  `AlarmCons` int(11) DEFAULT NULL,
  `LightCons` int(11) DEFAULT NULL,
  `ThermCons` int(11) DEFAULT NULL,
  `OvenCons` int(11) DEFAULT NULL,
  `VacuumCons` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `consumption`
--

INSERT INTO `consumption` (`ConsumptionID`, `ConsumerID`, `ProducerEmail`, `AirCons`, `AlarmCons`, `LightCons`, `ThermCons`, `OvenCons`, `VacuumCons`) VALUES
(1, 1, 'nalangelir@gmail.com', 1980, 55, 140, 41, 976, 450);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lights`
--

CREATE TABLE `lights` (
  `DeviceID` int(11) NOT NULL,
  `LivingRoom` varchar(255) DEFAULT NULL,
  `Kitchen` varchar(255) DEFAULT NULL,
  `Bedroom` varchar(255) DEFAULT NULL,
  `Bathroom` varchar(255) DEFAULT NULL,
  `ConsumerID` int(11) DEFAULT NULL,
  `ProducerMail` varchar(255) DEFAULT NULL,
  `ConsumptionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `lights`
--

INSERT INTO `lights` (`DeviceID`, `LivingRoom`, `Kitchen`, `Bedroom`, `Bathroom`, `ConsumerID`, `ProducerMail`, `ConsumptionID`) VALUES
(1, 'On', 'Off', 'Off', 'On', 1, 'nalangelir@gmail.com', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oven`
--

CREATE TABLE `oven` (
  `DeviceID` int(11) NOT NULL,
  `Program` varchar(255) DEFAULT NULL,
  `Degree` int(11) DEFAULT NULL,
  `State` varchar(255) DEFAULT NULL,
  `ConsumerID` int(11) DEFAULT NULL,
  `ProducerMail` varchar(255) DEFAULT NULL,
  `ConsumptionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `oven`
--

INSERT INTO `oven` (`DeviceID`, `Program`, `Degree`, `State`, `ConsumerID`, `ProducerMail`, `ConsumptionID`) VALUES
(1, '', 32, 'Off', 1, 'nalangelir@gmail.com', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `producerinfo`
--

CREATE TABLE `producerinfo` (
  `ProducerEmail` varchar(255) NOT NULL,
  `ProducerPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `producerinfo`
--

INSERT INTO `producerinfo` (`ProducerEmail`, `ProducerPassword`) VALUES
('nalangelir@gmail.com', 'password123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `thermostat`
--

CREATE TABLE `thermostat` (
  `DeviceID` int(11) NOT NULL,
  `Mode` varchar(255) DEFAULT NULL,
  `WaterLevel` varchar(255) DEFAULT NULL,
  `Degree` int(11) DEFAULT NULL,
  `State` varchar(255) DEFAULT NULL,
  `ConsumerID` int(11) DEFAULT NULL,
  `ProducerMail` varchar(255) DEFAULT NULL,
  `ConsumptionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `thermostat`
--

INSERT INTO `thermostat` (`DeviceID`, `Mode`, `WaterLevel`, `Degree`, `State`, `ConsumerID`, `ProducerMail`, `ConsumptionID`) VALUES
(1, 'Fan', '1.3', 43, 'On', 1, 'nalangelir@gmail.com', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vacuumcleaner`
--

CREATE TABLE `vacuumcleaner` (
  `DeviceID` int(11) NOT NULL,
  `State` varchar(255) DEFAULT NULL,
  `Program` varchar(255) DEFAULT NULL,
  `Charge` int(11) DEFAULT NULL,
  `ConsumerID` int(11) DEFAULT NULL,
  `ProducerMail` varchar(255) DEFAULT NULL,
  `ConsumptionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `vacuumcleaner`
--

INSERT INTO `vacuumcleaner` (`DeviceID`, `State`, `Program`, `Charge`, `ConsumerID`, `ProducerMail`, `ConsumptionID`) VALUES
(1, 'On', 'Regular', 70, 1, 'nalangelir@gmail.com', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `airconditioner`
--
ALTER TABLE `airconditioner`
  ADD PRIMARY KEY (`DeviceID`),
  ADD KEY `ConsumerID` (`ConsumerID`),
  ADD KEY `ProducerMail` (`ProducerMail`),
  ADD KEY `ConsumptionID` (`ConsumptionID`);

--
-- Tablo için indeksler `alarm`
--
ALTER TABLE `alarm`
  ADD PRIMARY KEY (`DeviceID`),
  ADD KEY `ConsumerID` (`ConsumerID`),
  ADD KEY `ProducerMail` (`ProducerMail`),
  ADD KEY `ConsumptionID` (`ConsumptionID`);

--
-- Tablo için indeksler `consumerinfo`
--
ALTER TABLE `consumerinfo`
  ADD PRIMARY KEY (`ConsumerID`);

--
-- Tablo için indeksler `consumption`
--
ALTER TABLE `consumption`
  ADD PRIMARY KEY (`ConsumptionID`),
  ADD KEY `ConsumerID` (`ConsumerID`),
  ADD KEY `ProducerEmail` (`ProducerEmail`);

--
-- Tablo için indeksler `lights`
--
ALTER TABLE `lights`
  ADD PRIMARY KEY (`DeviceID`),
  ADD KEY `ConsumerID` (`ConsumerID`),
  ADD KEY `ProducerMail` (`ProducerMail`),
  ADD KEY `ConsumptionID` (`ConsumptionID`);

--
-- Tablo için indeksler `oven`
--
ALTER TABLE `oven`
  ADD PRIMARY KEY (`DeviceID`),
  ADD KEY `ConsumerID` (`ConsumerID`),
  ADD KEY `ProducerMail` (`ProducerMail`),
  ADD KEY `ConsumptionID` (`ConsumptionID`);

--
-- Tablo için indeksler `producerinfo`
--
ALTER TABLE `producerinfo`
  ADD PRIMARY KEY (`ProducerEmail`);

--
-- Tablo için indeksler `thermostat`
--
ALTER TABLE `thermostat`
  ADD PRIMARY KEY (`DeviceID`),
  ADD KEY `ConsumerID` (`ConsumerID`),
  ADD KEY `ProducerMail` (`ProducerMail`),
  ADD KEY `ConsumptionID` (`ConsumptionID`);

--
-- Tablo için indeksler `vacuumcleaner`
--
ALTER TABLE `vacuumcleaner`
  ADD PRIMARY KEY (`DeviceID`),
  ADD KEY `ConsumerID` (`ConsumerID`),
  ADD KEY `ProducerMail` (`ProducerMail`),
  ADD KEY `ConsumptionID` (`ConsumptionID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `airconditioner`
--
ALTER TABLE `airconditioner`
  MODIFY `DeviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `alarm`
--
ALTER TABLE `alarm`
  MODIFY `DeviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `consumerinfo`
--
ALTER TABLE `consumerinfo`
  MODIFY `ConsumerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `consumption`
--
ALTER TABLE `consumption`
  MODIFY `ConsumptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `lights`
--
ALTER TABLE `lights`
  MODIFY `DeviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `oven`
--
ALTER TABLE `oven`
  MODIFY `DeviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `thermostat`
--
ALTER TABLE `thermostat`
  MODIFY `DeviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `vacuumcleaner`
--
ALTER TABLE `vacuumcleaner`
  MODIFY `DeviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `airconditioner`
--
ALTER TABLE `airconditioner`
  ADD CONSTRAINT `airconditioner_ibfk_1` FOREIGN KEY (`ConsumerID`) REFERENCES `consumerinfo` (`ConsumerID`),
  ADD CONSTRAINT `airconditioner_ibfk_2` FOREIGN KEY (`ProducerMail`) REFERENCES `producerinfo` (`ProducerEmail`),
  ADD CONSTRAINT `airconditioner_ibfk_3` FOREIGN KEY (`ConsumptionID`) REFERENCES `consumption` (`ConsumptionID`);

--
-- Tablo kısıtlamaları `alarm`
--
ALTER TABLE `alarm`
  ADD CONSTRAINT `alarm_ibfk_1` FOREIGN KEY (`ConsumerID`) REFERENCES `consumerinfo` (`ConsumerID`),
  ADD CONSTRAINT `alarm_ibfk_2` FOREIGN KEY (`ProducerMail`) REFERENCES `producerinfo` (`ProducerEmail`),
  ADD CONSTRAINT `alarm_ibfk_3` FOREIGN KEY (`ConsumptionID`) REFERENCES `consumption` (`ConsumptionID`);

--
-- Tablo kısıtlamaları `consumption`
--
ALTER TABLE `consumption`
  ADD CONSTRAINT `consumption_ibfk_1` FOREIGN KEY (`ConsumerID`) REFERENCES `consumerinfo` (`ConsumerID`),
  ADD CONSTRAINT `consumption_ibfk_2` FOREIGN KEY (`ProducerEmail`) REFERENCES `producerinfo` (`ProducerEmail`);

--
-- Tablo kısıtlamaları `lights`
--
ALTER TABLE `lights`
  ADD CONSTRAINT `lights_ibfk_1` FOREIGN KEY (`ConsumerID`) REFERENCES `consumerinfo` (`ConsumerID`),
  ADD CONSTRAINT `lights_ibfk_2` FOREIGN KEY (`ProducerMail`) REFERENCES `producerinfo` (`ProducerEmail`),
  ADD CONSTRAINT `lights_ibfk_3` FOREIGN KEY (`ConsumptionID`) REFERENCES `consumption` (`ConsumptionID`);

--
-- Tablo kısıtlamaları `oven`
--
ALTER TABLE `oven`
  ADD CONSTRAINT `oven_ibfk_1` FOREIGN KEY (`ConsumerID`) REFERENCES `consumerinfo` (`ConsumerID`),
  ADD CONSTRAINT `oven_ibfk_2` FOREIGN KEY (`ProducerMail`) REFERENCES `producerinfo` (`ProducerEmail`),
  ADD CONSTRAINT `oven_ibfk_3` FOREIGN KEY (`ConsumptionID`) REFERENCES `consumption` (`ConsumptionID`);

--
-- Tablo kısıtlamaları `thermostat`
--
ALTER TABLE `thermostat`
  ADD CONSTRAINT `thermostat_ibfk_1` FOREIGN KEY (`ConsumerID`) REFERENCES `consumerinfo` (`ConsumerID`),
  ADD CONSTRAINT `thermostat_ibfk_2` FOREIGN KEY (`ProducerMail`) REFERENCES `producerinfo` (`ProducerEmail`),
  ADD CONSTRAINT `thermostat_ibfk_3` FOREIGN KEY (`ConsumptionID`) REFERENCES `consumption` (`ConsumptionID`);

--
-- Tablo kısıtlamaları `vacuumcleaner`
--
ALTER TABLE `vacuumcleaner`
  ADD CONSTRAINT `vacuumcleaner_ibfk_1` FOREIGN KEY (`ConsumerID`) REFERENCES `consumerinfo` (`ConsumerID`),
  ADD CONSTRAINT `vacuumcleaner_ibfk_2` FOREIGN KEY (`ProducerMail`) REFERENCES `producerinfo` (`ProducerEmail`),
  ADD CONSTRAINT `vacuumcleaner_ibfk_3` FOREIGN KEY (`ConsumptionID`) REFERENCES `consumption` (`ConsumptionID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
