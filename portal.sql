-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(32) COLLATE latin2_croatian_ci NOT NULL,
  `prezime` varchar(32) COLLATE latin2_croatian_ci NOT NULL,
  `korisnicko_ime` varchar(32) COLLATE latin2_croatian_ci NOT NULL,
  `lozinka` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `razina` tinyint(1) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
('Bruno', 'Barac', 'bbarac', '$2y$10$MNnYAs6E8.76XmlRf6vvAOUBmuwmPpQ/PxOdCrWtU4qC4BkMOpjUK', 1),
('Marko', 'Kusec', 'mkusec', '$2y$10$8kCDKXSygyzyMWl3gaBVQOopr00HT4Y8aEwasFJ9XZieFFS1vPReS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `naslov` varchar(100) COLLATE latin2_croatian_ci NOT NULL,
  `ukratko` varchar(100) COLLATE latin2_croatian_ci NOT NULL,
  `sadrzaj` text COLLATE latin2_croatian_ci NOT NULL,
  `slika` varchar(100) COLLATE latin2_croatian_ci NOT NULL,
  `kategorija` varchar(100) COLLATE latin2_croatian_ci NOT NULL,
  `arhiva` tinyint(1) DEFAULT NULL,
  `dodano` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `naslov`, `ukratko`, `sadrzaj`, `slika`, `kategorija`, `arhiva`, `dodano`) VALUES
(1, 'Opsežna potraga za djetetom: Na terenu su sve raspoložive snage. Majka je uhićena', 'Uhićena majka koja je ušla s djetetom u Savu', 'ZAGREBAČKA policija se oglasila o potrazi za djetetom u Savi i potvrdila da je 34-godišnja majka uhićena zbog sumnje u počinjenje kaznenog djela teškog ubojstva bliske osobe. \r\n\r\n"Jučer, 15. siječnja oko 16.10 sati, policija je postupala po dojavi 34-godišnjakinje da je s djetetom u rukama ušla u rijeku Savu u blizini Jankomirskog mosta. Dojaviteljici je pružena liječnička pomoć dok su poduzete intenzivne mjere traganja s ciljem pronalaska djeteta. \r\n\r\nNakon liječničke obrade, 34-godišnjakinja je sinoć uhićena i dovedena u službene prostorije policije na kriminalističko istraživanje poradi sumnje u počinjenje kaznenog djela teškog ubojstva bliske osobe. Sinoć se nije odustajalo od intenzivne potrage čak i u uvjetima kada se moralo nastaviti i uz pomoć jakog osvjetljenja, međutim nažalost bezuspješno", navode iz zagrebačke policije.', 'potraga_sava.jpg', 'Crna kronika', 0, '2025-01-16 16:18:00'),
(2, 'Nema selidbe, Milanović ostaje na Pantovčaku', 'Milanović ostaje na Pantovčaku još jedan mandat! U 2. krugu izbora uvjerljivo je pobjedio.', 'Zoran Milanović i idućih će pet godina biti predsjednik države. Na ovim je izborima osvojio više nego na onima kada je prvi put osvojio mandat. Aktualni predsjednik Zoran Milanović u nedjelju je osvojio novi mandat sa 74.68 posto glasova, pobijedivši Dragana Primorca koji je osvojio 25.32 posto, što je najveća razlika u postocima između dva kandidata koji su ušli u drugi krug predsjedničkih izbora. \r\n\r\nMilanović je ovom pobjedom učvrstio svoju poziciju kao jedan od najpopularnijih predsjednika u povijesti države, dok je biračko tijelo jasno izrazilo povjerenje njegovom dosadašnjem radu. U pobjedničkom govoru, Milanović je zahvalio građanima na podršci, istaknuvši kako će nastaviti zastupati interese svih građana. \r\n\r\nS obzirom na uvjerljivu pobjedu, očekuje se da će Milanović u drugom mandatu nastaviti provoditi politike koje su ga učinile popularnim, ali i suočiti se s novim izazovima na domaćoj i međunarodnoj sceni.', 'zoki.jpg', 'Politika', 0, '2025-01-16 17:27:16'),
(3, 'Preminuo mladić (22), slučajno se zapalio benzinom u Kuzmincu', 'U općoj bolnici u Koprivnici je u utorak preminuo 22-godišnjak. Mladić je nastradao u Kuzmincu.', 'U općoj bolnici u Koprivnici je u utorak preminuo 22-godišnjak. Mladić je nastradao u Kuzmincu u nedjelju u večernjim satima kad je prilikom paljenja vatre dobio teške tjelesne ozlijede, piše ePodravina. "Koliko smo čuli, palili su vatru i mladić je navodno pokušao s benzinom ju potpiriti. Tom prilikom zapuhao je vjetar koji je puhnuo benzin prema mladiću te se on zapalio. Koliko smo čuli, opekotine su nastale na čak 90 posto tijela", kazao je prekjučer jedan od susjeda u Kuzmincu. Policijski službenici dostavit će izvješće nadležnom državnom odvjetništvu.', 'koprivnica.jpg', 'Crna kronika', 0, '2025-01-16 16:35:42'),
(4, 'Cameron Diaz se vraća u akciju', 'Nakon više od 10 godina, izlazi novi film s Cameron Diaz', 'Glumica Cameron Diaz je zadnji film snimila 2014. godine, a već sutra na Netflix stiže njezin prvi film nakon više od 10 godina, "Back in Action", u kojem joj je glumački partner Jamie Foxx. \r\n\r\nCameron Diaz se vraća u akciju! I to u filmu prigodnog naziva "Back in Action" koji će u petak izaći na Netflixu. Glumica, koja je nekoliko godina bila na pauzi od glume, pojavila se na crvenom tepihu s kolegom Jamiejem Foxxom u Berlinu u srijedu. \r\n\r\nKako navodi Page Six, to je prvi put nakon pet godina da se Diaz prošetala crvenim tepihom te više od 10 godina otkako je glumica bila na premijeri svog filma. Posljednji film koji je snimila bio je "Annie", koji je izašao 2014., a u kojem je također glumila s Foxxom. \r\n\r\nIpak, pojavila se 2019. na crvenom tepihu kada je došla podržati svoju kolegicu iz "Charliejevih anđela", Lucy Liu koja je tada dobila svoju "zvijezdu" na holivudskoj Stazi slavnih.  Za ovaj crveni tepih je odabrala jednostavnu kombinaciju - djelomično prozirnu crnu košulju, tamne traperice visokog struka te dugačak crni kaput.', 'cameron.jpg', 'Aktualno', 0, '2025-01-16 16:28:01'),
(5, 'Nova sezona serije Squid Game je 3. najgledanija sezona ikad na Netflixu', 'Gledanost nove sezone serije "Squid Game."', 'Krajem prošle godine je na Netflix stigla dugoočekivana 2. sezona serije "Squid Game". Postala je 3. najgledanija sezona serija na toj streaming platformi, a na istom je mjestu i po popularnosti u Hrvatskoj trenutno. \r\n\r\nDruga sezona popularne serije "Squid Game" treća je najgledanija sezona na Netflixu ikad, navodi Variety. Tek četiri dana nakon što je izašla na popularnoj streaming platformi, prešla je već 68 milijuna gledanja, a nakon 11 dana se taj broj popeo na čak 126,2 milijuna, što je više nego ijedna druga serija ikad na Netflixu. \r\n\r\nIako je vrlo popularna, nije prestigla prvu sezonu, koja se i dalje nalazi na samom vrhu najgledanijih sezona na Netflixu, dok je na drugom mjestu prva sezona serije "Wednesday", čija se nova sezona očekuje ove godine.', 'squidgame.jpg', 'Aktualno', 0, '2025-01-16 12:44:52'),
(6, 'Aleksandra Prijović je trudna', 'Prijović je dva mjeseca skrivala trudnoću', 'Popularna pjevačica Aleksandra Prijović iznenadila je cijelu regiju viješću o trudnoći nakon završetka svoje uspješne koncertne turneje "Od istoka do zapada". Kako Kurir navodi, pjevačica je svoju trudnoću skrivala čak dva mjeseca. \r\n\r\nSretnu vijest podijelila je, na početku, samo s najbližima. Za tu su priliku Aleksandra i suprug Filip organizirali intimnu proslavu na kojoj su bili pozvani samo najbliži prijatelji i članovi obitelji. \r\n\r\nFilip Živojinović razveselio se kada je saznao da će njihova obitelj postati veća, ali sreću su dijelili i svi članovi obje obitelji. Na sretnu vijest posebno emotivno su reagirali Aleksandrini baka i djed koji jedva čekaju svoje praunuče. Zbog vijesti o trudnoći, Aleksandra će se nakratko povući iz javnog života kako bi uživala u trudnoći.', 'prijovic.jpeg', 'Aktualno', 0, '2025-01-16 16:45:01'),
(7, 'Sudar dva auta kod Maksimira', 'U četvrtak ujutro, oko 7 sati, na Maksimirskoj cesti u Zagrebu sudarila su se dva automobila', 'U četvrtak ujutro, oko 7 sati, na Maksimirskoj cesti u Zagrebu sudarila su se dva automobila, a jedna je osoba ozlijeđena i prevezena u KB Dubravu. Težina ozljeda se još uvijek ne zna. \r\n\r\nZbog prometne nesreće, koja se dogodila kod tramvajske pruge, tramvajski je promet privremeno bio u zastoju, a ponovno je pušten u 7:33. Zbog sudara osobnih vozila na tramvajskoj pruzi na Maksimirskoj cesti kod Mašićeve ulice, linije 4,5,7,11 i 12 prometuju skraćeno do Kvaternikovog trga. Putnike između Dubrave i Kvaternikovog trga prevoze autobusi - javili su ranije iz ZET-a.', 'nesreca_maksimir.jpg', 'Crna kronika', 0, '2025-01-16 16:08:44'),
(8, 'Kod Križevaca teško ozlijeđeno dijete', 'Dijete je teško ozlijeđeno te je prevezeno u Opću bolnicu u Bjelovaru', 'Policija je danas oko 10 sati zaprimila obavijest da je liječnička pomoć pružena 12-godišnjem djetetu koje je ozlijeđeno na širem križevačkom području uslijed rukovanja za sada nepoznatim eksplozivnim sredstvom.', 'krizevci.jpg', 'Crna kronika', 0, '2025-01-16 16:29:56'),
(9, 'Za 72 sata mogli bi ukinuti TikTok u SAD-u, Washington je u panici', 'TikTok se gasi u Americi?', 'Kako se približava rok za potencijalnu zabranu TikToka, Washington je u žurbi da pronađe rješenje koje bi moglo spriječiti ozbiljne političke i pravne posljedice. Kontroverzni zakon, koji je prvotno imao snažnu dvostranačku podršku, sada izaziva podjele i paniku jer postoji prijetnja da bi njegovi učinci mogli poremetiti digitalni prostor i odnose s javnošću, piše Politico. \r\n\r\nAnalitičari upozoravaju da bi zabrana TikToka, platforme koju koristi više od 150 milijuna Amerikanaca, mogla izazvati reakciju mladih birača i pravne izazove, dok političari traže kompromis između nacionalne sigurnosti i slobode govora. \r\n\r\nZakonodavci traže načine za spas aplikacije, a Kongres i Bijela kuća našli su se na nepoznatom terenu. Grupa demokrata, uključujući čelnika senatske manjine Chucka Schumera, osobno je apelirala na Bijelu kuću predsjednika Joea Bidena da odgodi rok zakazan za 19. siječnja. TikTok je dobio nalog da se do tog datuma odvoji od kineske tvrtke ByteDance, koja ima sjedište u Pekingu, ili će se suočiti s uklanjanjem iz američkih trgovina aplikacijama. \r\n\r\nNovoizabrani predsjednik Donald Trump, koji je jednom pokušao zabraniti TikTok izvršnom naredbom, sada traži način da odgodi zabranu, što bi moglo staviti njegovo ministarstvo pravosuđa u poziciju da ne provodi savezni zakon. Čak su i neki političari koji su inače vrlo oštri prema Kini u Kongresu sada otvoreni za dogovore koji bi omogućili aplikaciji da ostane dostupna još neko vrijeme. "Jasno je da nam treba više vremena za pronalazak američkog kupca aplikacije kako se ne bi poremetili životi i prihodi milijuna Amerikanaca, posebice influencera koji su izgradili snažne mreže pratitelja. TikTok treba preživjeti, ali pod novim vlasništvom", izjavio je senator Chuck Schumer.', 'tiktok.jpg', 'Aktualno', 0, '2025-01-16 16:36:47'),
(10, 'Kerum se vraća u utrku za gradonačelnika', 'Željko Kerum najavio kako se planira opet kandidirati za to mjesto na nadolazećim lokalnim izborima.', 'Idemo na izbore u cijeloj županiji i u grad Split. Razlog zbog kojeg idem na izbore su građani. Razgovarajući s građanima, jasno je da žele da se vratim - kazao je Kerum. Poslije mene nije napravljeno ništa! Svi projekti koji su bili planirani, ništa nije pokrenuto - kritizirao je Kerum aktualnu gradsku vlast.\r\n\r\nGrađani me nisu kaznili. Ovo je peti put da idem na izbore - uvijek sam bio prvi, drugi ili treći. Sudjelujemo u gradskoj vlasti. Građani žele promjene, ali znaju da sada, za vrijeme ove vlasti, nije napravljen kvadrat asfalta.\r\n\r\nNa pitanje je li točno da je preusmjerio novac koji je bio namijenjen za Karepovac kaže: ''To su špekulacije, ne bih trošio energiju na suparnike. Ja smatram da sam bolji od njih i da će me građani prepoznat. Znaju tko sam i šta sam. Ja nudim projekte, grad stagnira''. \r\n\r\nImam dosta izjava i slogana, ali najvažniji je da ću riješiti sve što sam obećao, a to su ulaz i izlaz iz grada, trajektna luka i sve ostalo - poručio je.', 'kerum.jpg', 'Politika', 0, '2025-01-16 19:35:04'),
(11, 'Objavit će izvješće o Trumpovom utjecaju na manipulaciju izbora 2020', 'Očekuje se da će izvještaj detaljno opisati Trumpove napore da ospori rezultate izbora 2020', 'Federalna sutkinja Aileen Cannon odobrila je Ministarstvu pravosuđa objavu izvještaja o Donaldu Trumpu i njegovim naporima da poništi predsjedničke izbore 2020. godine, piše CNN. \r\n\r\nSutkinja, koju je imenovao sam Trump, odbila je zahtjev za produženje zabrane koja je sprječavala objavu izvještaja bivšeg posebnog tužitelja Jacka Smitha. Odluka znači da bi Ministarstvo pravosuđa moglo objaviti dio izvještaja koji se odnosi na slučaj izbornih manipulacija već od utorka. \r\n\r\nOčekuje se da će izvještaj detaljno opisati Trumpove napore da ospori rezultate izbora 2020., dokaze o lažnim tvrdnjama o izbornoj prijevari te događaje vezane uz nerede 6. siječnja 2021. Sutkinja je zakazala ročište za petak kako bi raspravila mogućnost ograničenog dijeljenja drugog dijela izvještaja s odabranim članovima Kongresa.', 'trump.jpg', 'Politika', 0, '2025-01-16 19:35:55'),
(12, 'Telemach među prvima testirao 5,5G', 'U Zagrebu postigli brzinu skidanja od ogromnih 10 Gbit/s', 'Ključne prednosti 5.5G tehnologije su još niža latencija i znatno veća učinkovitost u smislu potrošnje energije, a sve to zahvaljujući umjetnoj inteligenciji koja postaje sastavni dio mrežne infrastrukture. \r\n\r\nTelemach je objavio u utorak kako su među prvim operatorima u svijetu testirali mogućnosti 5.5G i pri tome postigli impresivnu brzinu preuzimanja podataka u mobilnoj mreži. Testiranje su proveli u Zagrebu na lokaciji podatkovnog centra Telemacha i predstavlja značajan iskorak u mogućnostima 5G mrežne tehnologije, navode iz kompanije i ističu da su postigli maksimalnu brzinu preuzimanja podataka od 10 Gbit/s. \r\n\r\nOsim boljih performansi, odnosno brzina prijenosa podataka, ključne prednosti 5.5G tehnologije su još niža latencija i znatno veća učinkovitost u smislu potrošnje energije, a sve to zahvaljujući umjetnoj inteligenciji koja postaje sastavni dio mrežne infrastrukture. Također, značajno povećanje kapaciteta omogućuje povezivanje do 10 puta više uređaja istovremeno u odnosu na 5G. \r\n\r\nPredsjednik Uprave Telemacha Adrian Ježina zaključio je: „Telemach je još jednom pokazao da je inovativna kompanija koja testira i ulaže u najmodernije tehnologije.', 'telemach.jpg', 'Tehnologija', 0, '2025-01-16 12:48:59'),
(13, 'Inovacije u sigurnosnim tehnologijama', 'Bitahon uvodi AI rješenja za bolju zaštitu', 'Tvrtka Bitahon, poznata po inovativnim sigurnosnim tehnologijama, predstavlja rješenja koja koriste umjetnu inteligenciju za unaprjeđenje tehničke zaštite. Posebno su usmjereni na poboljšanje funkcionalnosti kroz softver Mogen, napredni sustav temeljen na umjetnoj inteligenciji i strojnome učenju. Mogen omogućuje integraciju raznih sigurnosnih komponenti kao što su kamere, radari, senzori i dronovi, stvarajući cjelovitu zaštitnu mrežu. \r\n\r\nSoftver Mogen zaokružuje ponudu tvrtke Bitahon. Riječ je o sofisticiranom sustavu koji spaja AI tehnologiju s tehničkim komponentama kako bi pružio precizan nadzor, prepoznao moguće prijetnje i automatizirao sigurnosne reakcije. Mogen koristi algoritme strojnog učenja kako bi učio, pamtio i razmišljao samostalno, a ima razne mogućnosti poput prepoznavanja registarskih pločica i lica, omogućavajući identificiranje potencijalno sumnjivih aktivnosti. \r\n\r\nBitahon koristi dronove kao dodatnu mjeru sigurnosti. Dronovi su automatizirani i mogu brzo reagirati na alarme ili sumnjive aktivnosti, pružajući dodatnu perspektivu koja nadilazi tradicionalne sigurnosne sustave. Osim dronova, Bitahonovi sustavi koriste senzore koji prate promjene u okolišu npr. temperature, pokrete i zvukove, te radarsku tehnologiju za brzu i preciznu detekciju na štićenim objektima, a Bitahonovi radari sadrže dio komponente koja je osmišljena i izrađena kao komponenta za poznati Iron Dome.', 'bitahon.jpg', 'Tehnologija', 0, '2025-01-16 12:55:03'),
(14, 'Revolut uvodi ETF investicijske planove bez provizije i kod nas', 'Revolut ETF investicije bez prozivije', 'Revolut je u četvrtak objavio pokretanje usluge ETF investicijskih planova (ETF je kratica za fondove kojima se trguje na burzi), koji su sada dostupni diljem Europskog gospodarskog prostora (EGP), uključujući i Hrvatsku. Usluge ulaganja u EGP-u pruža Revolut Securities Europe UAB (Revolut). \r\n\r\nUz ETF investicijske planove bez provizije, Revolut navodi da želi olakšati pristup ulaganju većem broju korisnika koji mogu postaviti automatske ponavljajuće kupnje, npr. tjedno, već od 1 euro za više od 300 ETF-ova koji kotiraju na burzama unutar EU (uključujući BlackRock, Vanguard ili Amundi). Ova će se trgovanja izvršiti bez provizije i neće se računati unutar mjesečnog ograničenja plana pretplate. \r\n\r\nETF-ovi su investicijski fondovi koji prate indekse ili velike i raznovrsne kolekcije vrijednosnih papira ili plemenitih metala, te omogućuju trenutačnu diverzifikaciju ulaganjem u samo jedan proizvod. U 2024. godini, u kontinentalnoj je Europi svakog mjeseca izvršeno 10,8 milijuna trgovanja ETF investicijskim planovima, a obujam štednje je dosegao 17,6 milijardi eura.', 'revolut.jpg', 'Tehnologija', 0, '2025-01-16 12:59:41'),
(15, 'Tvrtka uvodi robotaksije za vožnju po Hong Kongu', 'Autonomna vožnja u Pekingu, Šangaju, Guanghouu i Shenzhenu.', 'Tvrtka za autonomnu vožnju Pony.ai Inc sa sjedištem u Guangzhouu nastoji pokrenuti svoje robotaxi usluge u Hong Kongu, pridružujući se Baiduu u utrci za pružanje usluga u gradu, dok želi proširiti svoje poslovanje na globalnoj razini. \r\n\r\nPony.ai planira pružati usluge prijevoza robotaxijima za osoblje zračne luke unutar međunarodne zračne luke Hong Kong prije nego što se proširi na druga urbana područja u gradu, objavila je tvrtka. Zasad nisu navedeni vremenski okvir za pokretanje usluge. \r\n\r\nKineski div umjetne inteligencije Baidu također razmišlja o pokretanju svoje taksi službe bez vozača u gradu nakon što je vlada Hong Konga odobrila njegovu prijavu za provođenje ispitivanja u sjevernom Lantauu u studenom.', 'robotaxi.jpg', 'Tehnologija', 0, '2025-01-16 13:01:33'),
(16, 'Andrej Plenković ne ide na Milanovićevu inauguraciju', 'Andrej Plenković dao izjavu za medije nakon sjednice Predsjedništva HDZ-a', 'Predsjednik Milanović pružio je ruku premijeru Plenkoviću, a ovaj je jučer doslovno ugrizao, poručivši kako ni on ni Jandroković neće ići na inauguraciju predsjednika države. Je li to sada političko samoubojstvo?\r\n\r\nNa prošlu inauguraciju Zorana Milanovića na Pantovčaku, pored četrdesetak uzvanika, pozvano je bilo mnoštvo HDZ-ovaca. Od premijera Andreja Plenkovića preko HDZ-ovih potpredsjednika Vlade i Sabora, pa sve do Kolinde Grabar Kitarović.\r\n\r\nPremijer Andrej Plenković poručuje da neće ići na drugu inauguraciju na Pantovčaku, baš kao ni predsjednik Sabora Gordan Jandroković. "Nismo odlučili čestitati zbog flagrantnog kršenja Ustava od strane Milanovića", kazao je jučer novinarima nakon sjednice stranačkih tijela. "Nećemo se izlagati apsurdnoj situaciji da slušamo prisegu na Ustav koji je više puta prekršen".\r\n\r\nOčekivalo bi se da će na valu ovakve oporbene pobjede Milanović biti taj koji će krenuti u zaoštravanje s premijerom, pa i inicirati akciju rušenja Plenkovića kako bi napokon doveo SDP na vlast', 'plenkovic.jpg', 'Politika', 0, '2025-01-16 18:07:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
