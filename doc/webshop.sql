-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2018. Feb 18. 13:51
-- Kiszolgáló verziója: 10.1.29-MariaDB
-- PHP verzió: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `webshop`
--
CREATE DATABASE IF NOT EXISTS `webshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `webshop`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin_userek`
--

CREATE TABLE `admin_userek` (
  `auid` int(11) NOT NULL,
  `nev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `aktiv` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `admin_userek`
--

INSERT INTO `admin_userek` (`auid`, `nev`, `email`, `jelszo`, `aktiv`) VALUES
(1, 'Kis Bubu', 'kisbubu@webshop.hu', '*667F407DE7C6AD07358FA38DAED7828A72014B4E', 1),
(2, 'Nagy Géza', 'nagygeza@freemail.hu', '*667F407DE7C6AD07358FA38DAED7828A72014B4E', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cikkat`
--

CREATE TABLE `cikkat` (
  `kid` int(11) NOT NULL,
  `knev` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `szkid` int(11) NOT NULL DEFAULT '1',
  `aktiv` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `cikkat`
--

INSERT INTO `cikkat` (`kid`, `knev`, `szkid`, `aktiv`) VALUES
(0, 'Kategóriák', 0, 1),
(2, 'Fényképezőgépek', 0, 1),
(3, 'LCD tévék', 0, 1),
(4, 'Mosogatógépek', 0, 1),
(5, 'Klíma berendezések', 0, 1),
(12, 'Mobiltelefonok', 0, 1),
(13, 'Tabletek', 0, 1),
(14, 'Hűtőgépek', 0, 1),
(15, 'Mikrohullámú sütők', 0, 1),
(16, 'Kerékpárok', 0, 1),
(17, 'Hajszárítók', 0, 1),
(18, 'Takarítógépek', 0, 1),
(19, 'Kerti bútorok', 0, 1),
(20, 'Kompakt', 2, 1),
(21, 'Tükörreflexes', 2, 1),
(22, 'Cserélhető objektíves', 2, 1),
(23, 'Mountain bike', 16, 1),
(24, 'City kerékpár', 16, 1),
(25, 'Elektromos kerékpár', 16, 1),
(26, 'BMX', 16, 1),
(32, 'Koala', 16, 1),
(33, 'GPS', 0, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cikkek`
--

CREATE TABLE `cikkek` (
  `cid` int(11) NOT NULL,
  `cszam` varchar(20) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `cnev` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `ckid` int(11) NOT NULL,
  `car` int(11) NOT NULL,
  `akciosar` int(11) NOT NULL,
  `akcios` int(11) NOT NULL,
  `cinfo` text COLLATE utf8_hungarian_ci,
  `aktiv` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `cikkek`
--

INSERT INTO `cikkek` (`cid`, `cszam`, `cnev`, `ckid`, `car`, `akciosar`, `akcios`, `cinfo`, `aktiv`) VALUES
(0, NULL, 'Szállítási díj', 0, 0, 0, 0, NULL, 0),
(10, '1', 'DHS Jumper 2005 (2016) Kerékpár', 26, 58760, 0, 0, 'Gyártó: DHS, Típus: 2005 Jumper, Váz (férfi/női): férfi, Váz: acél, Villa: DHS acél, merev villa, Kormány: DHS acél / acél, Nyereg: DDK City, Nyeregcső: acél, Hajtómű: 36T, Fogaskoszorú: 16T, Lánc: KMC, Hátsó agy: DHS, acél, 48H, Első fék: -, Hátsó fék: V-Fék, alu, Első váltó: -, Hátsó váltó: -, Váltókar: -, Sebesség: 1, Felni: DHS, alu BMX, 48H-20, Felni méret: 20, Külső gumi: Kenda 20, Súly: 14,75 kg, Évjárat: 2016', 1),
(11, '2', 'DEMA STING Kerékpár', 26, 59990, 0, 0, 'FRAME DEMA BMX Hi-Ten FORK Hi-Ten BRAKES Alloy V-Brake CHAINWHEEL SS-902(32 zubov) FREEWHEEL Steel (16 zubov) CHAIN KMC Z410 STEM ITC-7230 HANDLEBAR HS 550 Steel GRIPS CB-3411 Kraton SEAT POST ITC-SP8 25.4mm SADDLE DEMA FM-248 HUBS oceľové S01E-14/S01F-14 RIMS P-8T Alloy Anodised TYRES Kenda K-905 16x2.125 PEDALS CS-975 SPEED 1 SIZES UNI WEIGHT 10,6 kg', 1),
(12, '3', 'Total BMX Charlatan (2015) Kerékpár', 26, 129900, 0, 0, 'Az Charlatan modell egy középhaladó szintet képvisel, a KillBee váz geometriáját kapta. Eltávilítható fék-hardware rendszer, iparis hátsó agy és középrész, full integrált fejcsapágyazás és megannyi extra.', 1),
(13, '4', 'Haibike Noot RC Kerékpár', 26, 115990, 0, 0, 'Fork HiTen BMX Crankset Prism 3pcs. CroMo, 175mm Bottom bracket Prism sealed Sprocket Single sheet 25 teeth Chain 1/2 - 1/8 Brake lever BMX aluminum lever Brake (front) Aluminum road brake caliper Brake (rear) Aluminum U-Brake Tires KHE MVP 26x2,35 Rim KHE Singlewall Alu Hub (front) Steell 36 hole, 10mm axle Hub (rear) Steel 36 holes, 14mm axle Spokes CP 2,0mm Handlebar BMX steel 730mm Grips BMX Stem Toploader 1 1/8 Headset Affix Internal Rotor Saddle KHE MVP FAT Seatpost KHE MVP FAT Pedals Prism BMX permissible total weight 80 kg Frame High Tensile Steel, Affix Rotor.', 1),
(14, '5', 'Haibike Noot RX Kerékpár', 26, 125290, 0, 0, 'Fork HiTen BMX Crankset Prism 3pcs. CroMo, 175mm Bottom bracket Prism sealed Sprocket Single sheet 25 teeth Chain 1/2 - 1/8 Brake lever BMX aluminum lever Brake (front) Aluminum road brake caliper Brake (rear) Aluminum U-Brake Tires KHE MVP 26x2,35 Rim KHE Singlewall Alu Hub (front) Steel 36 hole, 10mm axle, sealed Hub (rear) steel 36 hole, 14mm axle, sealed Spokes CP 2,0mm Handlebar BMX steel 730mm Grips BMX Stem Toploader 1 1/8 Headset Affix Internal Rotor Saddle KHE MVP FAT Seatpost KHE MVP FAT Pedals Prism BMX permissible total weight 80 kg Frame High Tensile Steel, Affix Rotor.', 1),
(15, '6', 'DHS Jumper 2005-1V (2015) Kerékpár', 26, 50570, 30000, 1, 'Gyártó: DHS Típus:2005 Jumper Váz (férfi/női): férfi Váz: acél Villa: DHS acél, merev villa Kormány: DHS acél / acél Nyereg: DDK City Nyeregcső: acél Hajtómű: 36T Fogaskoszorú: 16T Lánc: KMC Hátsó agy: DHS, acél, 48H Első fék: U-Fék, alu Hátsó fék: U-Fék, alu Első váltó: - Hátsó váltó: - Váltókar: - Sebesség: 1 Felni: DH S, alu BMX, 48H-20 Felni méret: 20 Külső gumi: Kenda 20 Súly: 14,75 kg Évjárat: 2015 Lámpa: -', 1),
(16, '7', 'Total BMX Mark Webb Replica Kerékpár', 26, 159990, 0, 0, 'A legmagasabb kategóriás komplett BMX a Totaltól. Full iparis agyak, CrMo váz/villa/kormány, Alienation felnik és megannyi extra. Mark Webb signature vázának geója.', 1),
(17, '8', 'Total BMX Alex Coleborn Replica Kerékpár', 26, 154900, 0, 0, 'Alex Coleborn váz geometriáján alapulú kezdő/középhaladó komplett bmx. Rövid láncvillája, alacsony átlépőmagassága, lehetővé teszi rengeteg trükk gyors elsajátítását!', 1),
(18, '9', 'Zinc Echo Kerékpár', 26, 105230, 0, 0, 'ZINC ECHO BMX FREESTYLE KERéKPáR MAG KEREKEKKEL KASZKADőR CSöVEKKEL - UNISEXZINC ECHO 20 COLOS BMX BIKE - UNISEX. CSÚCS MINŐSÉGŰ FREESTYLE BMX_ÚJ-GENERáCIóS FREESTYLE KERéKPáR, ROTOROS BMX, TECHNIKAI SPORTRA ALKALMAZHATó, A KASZKADőR CSöVEKEN KíVüL A VáZA IS MEGERőSíTETT ACéLVáZAS. A KERéK PONTOS MEGNEVEZéSE: 360 GYRO MAG KEREKEK, GIROSZKóPOS 360 FOKBAN MOZGó KEREKEK éS VáZ.  _BMX kerékpár erős minőségi anyagból készült és sokoldalú. Használható akadálypályán, terepen, ügyességi pályán és, görkorcsolya parkban. A kerék kialakítása különleges új design. Fehér gyöngyház acél váz. 360 Gyro váz. Az első és a hátsó V-típusú fékek. 2 első és hátsó kaszkadőr csövek. Tömege 15 kg teljesen összeszerelve. 28cm / 11 colos méretű váz. 51cm / 20 colos kerékméret. Alkalmas a 56-63cm / 22-24 hüvelykes belső láb méretre. Alkalmas korosztály 7 és 14 éves. BMX stílusú gumikkal.', 1),
(19, '10', 'WETHEPEOPLE Volta 21.0TT (2016) Kerékpár', 26, 307300, 0, 0, 'Frame: 4130 full sanko, tapered SS & CS, removable pivots & guides, intg. chain tensioner - See more at: wethepeoplebmx. de/volta#sthash. lTjERkLr. dpuf Fork: SALTPLUS Magic V2 fork, sanko tubing, cnc steerer, inv. cast dropouts, 33mm offset - See more at: wethepeoplebmx. de/volta#sthash. lTjERkLr. dpuf Bars full 4130 crmo bar Grips SALTPLUS XL Vex compound grips Stem WETHEPEOPLE Hydra cnc alloy top loading stem, 27mm rise, 50mm reach - See more at: wethepeoplebmx. de/volta#sthash. lTjERkLr. dpuf Headset SALTPLUS Echo int. headset, sealed bearing Gyro no / holes for removable gyro tabs Lever SALTPLUS Geo hinged alloy brake lever Brakes SALTPLUS Geo XL alloy u-brake rear Cranks WETHEPEOPLE Royal, tubular 3pc crank crmo, 175mm, 48 spline - See more at: wethepeoplebmx. de/volta#sthash. lTjERkLr. dpuf BB SALTPLUS Echo, mid 19mm, press fit, sealed bearing - See more at: wethepeoplebmx. de/volta#sthash. lTjERkLr. dpuf Pedals ÉCLAT CONTRA nylon/fiberglass pedals, removable pins - See more at: wethepeoplebmx. de/volta#sthash. lTjERkLr. dpuf Chain SALTPLUS WARLOCK halflink chain Sprocket WETHEPEOPLE 4Star 6061-T6 alloy, 27t sprocket Driver 9t, 1pccassette driver, L&R switch drive, full bushing - See more at: wethepeoplebmx. de/volta#sthash. lTjERkLr. dpuf Front Hub ÉCLAT Pulse hub, sb, 3/8 female bolts, 36h Rear Hub ÉCLAT Pulse cassette, sb hub, 9t L&R switch drive, 14mm female bolts, 36h - See more at: wethepeoplebmx. de/volta#sthash. lTjERkLr. dpuf Hubguards - Front Rim SALTPLUS Summit straight double wall rim, 36h Rear Rim SALTPLUS Summit straight double wall rim, 36h Seat WTP Volta mid padded pivotal seat Seat Post SALT AM pivotal seat post, alloy, 150mm Seat Clamp integratedseat clamp Tires ÉCLAT Fireball 2.4 front & 2.3 rear Pegs - Weight 11.5kg (25.3lbs) w/o pegs & brakes.', 1),
(20, '11', 'Total BMX Oracle (2015) Kerékpár', 26, 99900, 0, 0, 'Az Oracle modell egy kezdő modell a Total BMX-ek közül. Minden kezdőnek vagy egy jobb kategóriás BMX-re vágyóknak ajánljuk. Rengeteg olyan alkatrész található benne, mely igen növeli a BMX tartósságát, mint például a full ipari csapágyazott hátsó agy és középrész.', 1),
(21, '12', 'WETHEPEOPLE Seed 15.75TT (2016) Kerékpár', 26, 128800, 0, 0, 'Frame: 1020 hi-ten Fork: SALT Junior fork, 1020 hi-ten , 4130 crmo steerer, 28mm offset Bars 1020 hi-ten Grips WETHEPEOPLE Arrow 115 Vex compound grips Stem SALT Junior V2 top loading stem, 40mm reach Headset SALT AM A-headset, loose ball Gyro no / holes for removable gyro tabs Lever SALT Junior alloy brake lever Brakes SALT AM alloy caliper brake front / SALT AM alloy u-brake rear - See more at: //wethepeoplebmx. de/seed#sthash. kjruzFMJ. dpuf Cranks SALT Junior tubular 3pc TSS crank crmo 140mm, 8 spline - See more at: //wethepeoplebmx. de/seed#sthash. kjruzFMJ. dpuf BB SALT Spanish 19mm, press fit, sealed bearing Pedals SALT Junior PRO nylon/fiberglass pedals Chain SALT AM chain, 510h type Sprocket SALT Pro 6061 T6 alloy, 25t sprocket Driver 10t, 1pc cassette driver, sealed bearing Front Hub SALT AM alloy hub, loose ball 3/8s axle, 28h Rear Hub SALT AM cassette hub, semi sealed, 10t, 3/8s, 28h - See more at: //wethepeoplebmx. de/seed#sthash. kjruzFMJ. dpuf Hubguards - Front Rim SALT Valon rim, straight single wall, 28h Rear Rim SALT Valon rim, straight single wall, 28h Seat WETHEPEOPLE Seed V2 combo seat Seat Post - Seat Clamp SALT AM alloy seat clamp Tires SALT Strike 2.2 front & rear Pegs SALT AM 85mm steel pegs (1 pair) Weight 9.0kg (19.84lbs) w/o pegs & front brake Így is ismerheti: Seed 15 75 TT 2016, Seed1575TT2016, Seed 15.75TT ( 2016)', 1),
(22, '13', 'WETHEPEOPLE Trust 20.5TT (2016) Kerékpár', 26, 223300, 0, 0, 'Frame: 4130 full crmo, tapered SS & CS, removable pivots & guides, invest cast dropout with intg. chain tensioner - See more at: //wethepeoplebmx. de/trust#sthash. Y3WTT430. dpuf Fork: SALTPLUS EX fork, full 4130 crmo , 1pc formed crmo steerer 28mm offset Bars full 4130 crmo bar Grips SALTPLUS XL Vex compound grips Stem SALTPLUS Field cnc alloy top loading stem, 50mm reach - See more at: //wethepeoplebmx. de/trust#sthash. Y3WTT430. dpuf Headset SALT PRO int. headset, sealed bearing Gyro no / holes for removable gyro tabs Lever SALTPLUS Geo hinged alloy brake lever Brakes SALT Moto XL alloy u-brake rear Cranks SALTPLUS PRO48 (L&R) tubular 3pc crank crmo 170mm, 48 spline - See more at: //wethepeoplebmx. de/trust#sthash. Y3WTT430. dpuf BB SALT Mid 19mm, press fit, sealed bearing Pedals ÉCLAT Slash nylon/fiberglass pedals Chain SALT AM chain, 510h type Sprocket SALTPLUS Trident 6061-T6 alloy, 26t sprocket Driver 9t, 1pc cassette driver, L&R switch drive, sealed bearing - See more at: //wethepeoplebmx. de/trust#sthash. Y3WTT430. dpuf Front Hub SALT EX hub, sb, 3/8s female bolts, 36h Rear Hub SALTPLUS Trapez cassette hub, sb, 9t L&R switch drive, 14mm hollow axle, 36h - See more at: //wethepeoplebmx. de/trust#sthash. Y3WTT430. dpuf Hubguards SALTPLUS PRO Nylon/Fibreglass front & rear hubguards - See more at: //wethepeoplebmx. de/trust#sthash. Y3WTT430. dpuf Front Rim ÉCLAT Trippin XL straight double wall rim, 36h Rear Rim ÉCLAT Trippin XL straight double wall rim, 36h Seat WETHEPEOPLE Trust thick padded pivotal seat Seat Post SALT AM pivotal seat post, alloy, 150mm Seat Clamp integratedseat clamp Tires SALTPLUS Pitch Slick 2.35 front / 2.25 rear Pegs SALT Pro Steel/Nylon sleeve pegs (1 pair) Weight 11.5kg (25.3lbs) w/o pegs & brakes.', 1),
(23, '14', 'WETHEPEOPLE Curse 20.25TT Kerékpár', 26, 132300, 0, 0, 'Frame: 4130 crmo down tube, 1020 hi-ten Fork: SALT AM 20 fork, 1020 hi-ten , 4130 crmo steerer, 28mm offset Bars 1020 hi-ten Grips WETHEPEOPLE Arrow 146 Vex compound grips Stem SALT PRO V2 top loading stem, 50mm reach Headset SALT PRO int. headset, sealed bearing Gyro no / holes for removable gyro tabs Lever SALT AM alloy brake lever Brakes SALT AM alloy u-brake rear Cranks SALT Rookie tubular 3pc crank crmo 170mm, 8 Spline - See more at: //wethepeoplebmx. de/curse#sthash. TGqp9Hny. dpuf BB SALT Spanish 19mm, press fit, sealed bearing Pedals ÉCLAT Surge nylon/fiberglass pedals Chain SALT AM chain, 510h type Sprocket SALT AM steel 26t sprocket Driver 9t, 1pc cassette driver, sealed bearing Front Hub SALT AM alloy hub, loose ball 3/8s axle, 36h Rear Hub SALT AM cassette hub, full sealed, 9t, 14mm axle, 36h - See more at: //wethepeoplebmx. de/curse#sthash. TGqp9Hny. dpuf Hubguards - Front Rim SALT Valon rim, straight single wall, 36h Rear Rim SALT Valon rim, straight single wall, 36h Seat WETHEPEOPLE CURSE 20 pivotal seat Seat Post SALT AM pivotal seat post Seat Clamp SALT AM alloy seat clamp Tires SALT Strike 2.35 front / Strike 2.2 rear Pegs SALT AM steel pegs (1 pair) Weight 11.8kg (26lbs) w/o pegs & front brake.', 1),
(24, '15', 'Schwinn-Csepel King of Street Kerékpár', 26, 55900, 0, 0, 'King of Street BMX kerékpár acél vázzal, elöl-hátul U fékkel.\r\nVáz: HI-TEN acél\r\nVilla: HI-TEN acél\r\nSebességek száma: 1\r\nHajtómű: Acél BMX HEXA 9/16 165 mm\r\nKözépcsapágy: Acél BMX garnitúra\r\nFelni: HT BMX\r\nGumi: Kenda K-205\r\nElső agy: Dotek 48H BMX\r\nHátsó agy: Dotek 48H BMX\r\nElső fék: GM alu U-fék\r\nHátsó fék: GM alu U-fék\r\nFékkar: GM BMX fekete\r\nKormányfej: BMX Freestyle\r\nKormánycsapágy: A-HEAD 1 1/8 ROTOR\r\nKormány: Promax BMX\r\nNyeregcső: Acél 25,4×400 mm\r\nNyereg: Büchel Allroad Twin Dirt', 1),
(25, '16', 'MALI Tyrant Kerékpár', 26, 49900, 0, 0, 'Váz Hi-ten minőségi acél Villa Hi-ten minőségi acél kilépő 4db acél Fék első/hátsó Tektro U-fék Fékkar Tektro szabadonfutó Menetes 16T racsni Hajtómű 3 részes acél Kerekek 48l acél agyak, alu felnik Kormány Zombie Drive Kormánycsapágy 1-1/8 acél Kormányszár Mali alumínium Középrész amerikai szabvány Külso első/hátsó Mali Bikes Innova 20x1,95 Lánc KMC Z150 fékrotor van Nyereg Mali Nyeregszár 25,4mm acél Súly - Kerékpár (pedál nélkül, Kg) markolat Mali Zombie Pedál műanyag.', 1),
(26, '', 'abc', 26, 2000, 0, 0, '', 1),
(27, 'gps001', 'WayteQ x995 MAX + Sygic 3D GPS navigáció', 33, 37375, 0, 0, 'Kijelző: 7 1024x600 kapacitív, nagy fényerejű LCD érintőképernyő Processzor: MediaTek MT8127 Quad-Core 1,3 GHz négymagos Memória: 1 GB RAM, 8 GB tárhely, MicroSD bővítés Nagy érzékenységű GPS vevő, nagy teljesítményű hangszóró Android 4.4 KitKat, WiFi, Bluetooth 4.0, FM transmitter Beépített, 5000 mAh Lithium-Ion akkumulátor, autós készlet és Sígic aktiváló kód a dobozban MINDENNAPI MUNKÁHOZ TERVEZVE Buszt, kamiont, teherautót vagy taxit vezet? Vagy egyszerűen csak egy jól látható, nagy kijelzővel rendelkező, könnyen kezelhető GPS-t keres az autójába? Van egy tippünk! A WayteQ X995 MAX feladja a leckét a vetélytársaknak: a készülék kifejezetten a professzionális GPS felhasználóknak készült, speciálisan az ő igényeikhez tervezve az első lépéstől. Egy kompakt, 7-os GPS készülék Android rendszerrel, és a felhasználók által kedvelt funkciókkal. Évek óta gyűjtjük a felhasználói észrevételeket, igényeket, az X995 MAX-ot pedig ennek mentén terveztük meg és gyártottuk le. KIEMELKEDŐ FUNKCIÓK A beépített GPS antenna egy nagy érzékenységű, különálló porcelán modul, amely kiváló jelerősséget biztosít akár épületek között is. A kijelző egy nagy felbontású IPS panel, kapacitív érintőpanellel: támogatja az ujjbeggyel történő kezelést és a kétujjas nagyítást is. Az akkumulátor elképesztő, 5000 mAh kapacitással rendelkezik, amely órákig elég a készülék áramellátásához tápforrás nélkül. A beépített hangszóró nagy teljesítményű, így kiválóan hallhatók a navigáció közbeni hangutasítások. Az X995 MAX hátlapi kamerájának és az előre telepített alkalmazásnak köszönhetően menetrögzítő kameraként is használható, akár navigáció közben is. A dobozban megtalálható minden, ami a használatba vételhez szükséges: jó minőségű, nagyméretű tapadókorongos tartó kar, készülék bölcső és autós töltő is, amely természetesen 12/24 V kompatibilis. VEZETÉK NÉLKÜL A Bluetooth funkció headsetekre, fülhallgatókra vagy hangszórókra tudja továbbítani a készülék hangját, vagy fájlcserélésre is alkalmas. A WiFi vevő és a böngésző alkalmazás segítségével az internetre kapcsolódni és szörfözni is gyerekjáték. A beépített FM transmitter segítségével a készülék hangja könnyedén átvihető az autórádióra, vezeték nélkül. Már csak az autórádiót kell a megfelelő frekvenciára hangolni és kedvenc zenéink, videoklipünk vagy akár a navigációs szoftver hangja szólal meg az autó hifin. STABIL SZOFTVER Az Android rendszer magas fokú rugalmasságot biztosít a használható navigációs szoftverek tekintetében. A stabil alapokat a bevált MediaTek SoC biztosítja, 1 GB RAM-mal és 8 GB tárhellyel, amely természetesen microSD memóriakártyával bővíthető. Az X995 MAX egyedi bejelentkező kezelőfelülettel van ellátva, így a használata az autóban nagyon egyszerű: a leggyakrabban használt programok egy főképernyőre vannak gyűjtve, és nagyméretű ikonokkal vannak ellátva, így nagyon kényelmes és egyszerű használatot biztosítanak. Kijelző: 7 IPS 1024x600 kapacitív érintőképernyő Processzor: MediaTek MT8127 ARM Cortex-A7 Quad-Core 1,3 GHz Processzor: Beépített, MT6627, kerámia antenna Grafika: ARM Mali-400 MP1 Memória: 1 GB RAM DDR3 8 GB tárhely (ebből kb. 2 GB programok telepítésére, kb. 4 GB adattárolásra használható) Bővítés: MicroSD memóriakártya bővítés max. 32 GB WiFi: 802.11 a/b/g Bluetooth: Van FM transmitter: Van, kikapcsolható Menetrögzítő: Van, beépített kamera Hangszóró: Beépített, nagy teljesítményű Mikrofon: Beépített Fülhallgató: 3,5 mm sztereó jack csatlakozó aljzat Csatlakozó: miniUSB 2.0 Kamera: Beépített, 2 MP NT99141 chipset a menetrögzítő kamera funkcióhoz Akkumulátor: Beépített, Lithium-Ion 5000 mAh Rendszer: Android 4.4. 2 KitKat, egyedi kezdőképernyő, magyar nyelv Töltőáram: DC 5V / 2 A Autós töltő: DC 12-24V/2,5A – 5V/2A Extrák: Számológép, fájlkezelő, hangrögzítő, email, böngésző, ébresztőóra, stopper, menetrögzítő Méret: 186 x 114 x 13,3 mm Csomag tartalma: WayteQ X995 MAX GPS készülék Autós töltő USB kábel Autós tartó kar Készülék bölcső Használati útmutató Sygic aktiváló kód Így is ismerheti: x 995 MAX Sygic 3 D, x995MAXSygic3D, x995 MAX + Sygic 3 D ', 1),
(28, 'gps002', 'Navon N490 Plus GPS navigáció', 33, 18100, 0, 0, 'Kijelző mérete: 4,3&#34; Sík kijelző&#13;&#10;Processzor frekvencia: MSTAR ARM9 550MHz&#13;&#10;GPS vevő: MSTAR 64 csatornás&#13;&#10;Memória bővítés: microSD, microSDHC max. 16GB&#13;&#10;Memória: 4GB ROM/128 MB DDR3 RAM&#13;&#10;Kijelző felbontása: 480 x 272 pixel&#13;&#10;Típus: autós navigáció&#13;&#10;Kijelző típusa: színes&#13;&#10;Csatlakozás: Micro USB&#13;&#10;Audio: beépített hangszóró&#13;&#10;Multimédia funkciók: film-zenelejátszó, fotónézegető&#13;&#10;Tápellátás: Li-Ion akkumulátor&#13;&#10;Súly: 129 g', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `fizmodok`
--

CREATE TABLE `fizmodok` (
  `fid` int(11) NOT NULL,
  `fnev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `leiras` varchar(200) COLLATE utf8_hungarian_ci NOT NULL,
  `felar` int(11) NOT NULL DEFAULT '0',
  `aktiv` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `fizmodok`
--

INSERT INTO `fizmodok` (`fid`, `fnev`, `leiras`, `felar`, `aktiv`) VALUES
(1, 'Banki átutalással', 'Fizetés előre egy összegben banki átutalással, kiszállítás futárszolgálattal.', 1500, 1),
(2, 'Utánvéttel', 'Kiszállítás futárszolgálattal, fizetés az áru átvételekor a futárnak készpénzben.', 1250, 1),
(3, 'Személyesen üzletünkben', 'Átvétel személyesen üzletünkben, fizetés az áru átvételekor.', 0, 1),
(4, 'PayPal', 'Fizess egyszerűen PayPallal!', 500, 1);

-- --------------------------------------------------------

--
-- A nézet helyettes szerkezete `kimit`
-- (Lásd alább az aktuális nézetet)
--
CREATE TABLE `kimit` (
`rfuid` int(11)
,`rtcid` int(11)
);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rfej`
--

CREATE TABLE `rfej` (
  `rfid` int(11) NOT NULL,
  `rfrendelesszam` varchar(20) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `rfuid` int(11) NOT NULL,
  `rffid` int(11) NOT NULL,
  `rfdatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rfallapot` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `rfej`
--

INSERT INTO `rfej` (`rfid`, `rfrendelesszam`, `rfuid`, `rffid`, `rfdatum`, `rfallapot`) VALUES
(20, '0000020/2016', 1, 2, '2016-09-08 10:33:36', 0),
(21, '0000021/2016', 2, 1, '2016-09-08 13:32:23', 0),
(22, '0000022/2016', 2, 3, '2017-02-08 14:32:48', 0),
(23, '0000023/2017', 2, 3, '2017-02-24 12:16:49', 1),
(24, '0000024/2017', 1, 3, '2017-02-24 14:51:47', 1),
(25, '0000025/2017', 1, 1, '2017-06-11 09:12:10', 1),
(26, '0000026/2017', 1, 2, '2017-06-11 12:13:40', 1),
(27, '0000027/2018', 1, 1, '2018-02-18 12:43:59', 0),
(28, '0000028/2018', 1, 1, '2018-02-18 12:47:59', 0),
(29, '0000029/2018', 1, 1, '2018-02-18 12:49:27', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rtetel`
--

CREATE TABLE `rtetel` (
  `rtid` int(11) NOT NULL,
  `rtrfid` int(11) NOT NULL DEFAULT '0',
  `rtcid` int(11) NOT NULL,
  `rtar` int(11) NOT NULL,
  `rtmenny` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `rtetel`
--

INSERT INTO `rtetel` (`rtid`, `rtrfid`, `rtcid`, `rtar`, `rtmenny`) VALUES
(40, 20, 11, 59990, 1),
(41, 20, 0, 1250, 1),
(42, 21, 25, 49900, 1),
(43, 21, 24, 55900, 1),
(44, 21, 0, 1500, 1),
(45, 22, 13, 115990, 1),
(46, 22, 11, 59990, 1),
(47, 22, 13, 159990, 2),
(48, 23, 11, 59990, 1),
(49, 24, 11, 59990, 2),
(50, 24, 13, 115990, 2),
(51, 25, 10, 58760, 2),
(52, 25, 0, 1500, 1),
(53, 26, 10, 58760, 1),
(54, 26, 0, 1250, 1),
(55, 27, 0, 1500, 1),
(56, 28, 0, 1500, 1),
(57, 29, 10, 58760, 1),
(58, 29, 15, 30000, 1),
(59, 29, 0, 1500, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `userek`
--

CREATE TABLE `userek` (
  `uid` int(11) NOT NULL,
  `nev` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `datum_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datum_utolso` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datum_update` date NOT NULL DEFAULT '0000-00-00',
  `aktiv` int(11) NOT NULL DEFAULT '0',
  `aid` int(11) NOT NULL,
  `szla_nev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `szla_irszam` varchar(5) COLLATE utf8_hungarian_ci NOT NULL,
  `szla_varos` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `szla_utcahaz` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `szall_nev` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `szall_irszam` varchar(5) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `szall_varos` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `szall_utcahaz` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `telefon` varchar(20) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `userek`
--

INSERT INTO `userek` (`uid`, `nev`, `email`, `jelszo`, `datum_reg`, `datum_utolso`, `datum_update`, `aktiv`, `aid`, `szla_nev`, `szla_irszam`, `szla_varos`, `szla_utcahaz`, `szall_nev`, `szall_irszam`, `szall_varos`, `szall_utcahaz`, `telefon`) VALUES
(1, 'Kis Bubu', 'kisbubu@webshop.hu', '*667F407DE7C6AD07358FA38DAED7828A72014B4E', '2014-11-12 16:31:11', '2018-02-18 12:43:31', '0000-00-00', 1, 0, 'Bubu Bt.', '1041', 'Budapest', 'Zebra. u. 67.', '', '', '', '', '+3612345678'),
(2, 'Nagy Katalin', 'nk@freemail.hu', '*667F407DE7C6AD07358FA38DAED7828A72014B4E', '2017-02-24 14:05:16', '0000-00-00 00:00:00', '0000-00-00', 1, 0, '', '', '', '', NULL, NULL, NULL, NULL, ''),
(3, 'Kovács Ferenc', 'kf@freemail.hu', '*667F407DE7C6AD07358FA38DAED7828A72014B4E', '2017-02-24 14:49:10', '0000-00-00 00:00:00', '0000-00-00', 1, 0, '', '', '', '', NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Nézet szerkezete `kimit`
--
DROP TABLE IF EXISTS `kimit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kimit`  AS  select distinct `rfej`.`rfuid` AS `rfuid`,`rtetel`.`rtcid` AS `rtcid` from (`rfej` join `rtetel`) where ((`rfej`.`rfid` = `rtetel`.`rtrfid`) and (`rtetel`.`rtcid` > 0)) ;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin_userek`
--
ALTER TABLE `admin_userek`
  ADD PRIMARY KEY (`auid`),
  ADD UNIQUE KEY `iEmail` (`email`);

--
-- A tábla indexei `cikkat`
--
ALTER TABLE `cikkat`
  ADD PRIMARY KEY (`kid`),
  ADD UNIQUE KEY `knev` (`knev`);

--
-- A tábla indexei `cikkek`
--
ALTER TABLE `cikkek`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cnev` (`cnev`),
  ADD UNIQUE KEY `cszam` (`cszam`);

--
-- A tábla indexei `fizmodok`
--
ALTER TABLE `fizmodok`
  ADD PRIMARY KEY (`fid`),
  ADD UNIQUE KEY `fnev` (`fnev`);

--
-- A tábla indexei `rfej`
--
ALTER TABLE `rfej`
  ADD PRIMARY KEY (`rfid`),
  ADD KEY `rfvevoid` (`rfuid`),
  ADD KEY `rffid` (`rffid`);

--
-- A tábla indexei `rtetel`
--
ALTER TABLE `rtetel`
  ADD PRIMARY KEY (`rtid`),
  ADD KEY `rtrfid` (`rtrfid`),
  ADD KEY `rtcid` (`rtcid`);

--
-- A tábla indexei `userek`
--
ALTER TABLE `userek`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin_userek`
--
ALTER TABLE `admin_userek`
  MODIFY `auid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `cikkat`
--
ALTER TABLE `cikkat`
  MODIFY `kid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT a táblához `cikkek`
--
ALTER TABLE `cikkek`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT a táblához `fizmodok`
--
ALTER TABLE `fizmodok`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `rfej`
--
ALTER TABLE `rfej`
  MODIFY `rfid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT a táblához `rtetel`
--
ALTER TABLE `rtetel`
  MODIFY `rtid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT a táblához `userek`
--
ALTER TABLE `userek`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
