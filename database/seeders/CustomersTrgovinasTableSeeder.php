<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTrgovinasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers_trgovinas')->delete();
        
        \DB::table('customers_trgovinas')->insert(array (
            0 => 
            array (
                'c_id' => 326,
                'category_id' => 17,
                'davcna' => 45257230,
                'delovni_cas' => 'pon. - pet.  07 - 18ure ; sob.  08 - 13ure',
                'id' => 1764,
                'logo' => '',
                'nacin_prevzema' => 'plačilo po predračunu - po pošti, FCO Maribor, FCO kupec (Maribo',
                    'slogan' => 'THS . . . oni vedo . . .',
                    'spletna_stran' => 'www.ths.si',
                    'tocen_naziv' => 'THS d.o.o.',
                'trgovina_opis' => 'THS je podjetje, ki se ukvarja s prodajo vodovodne in plinske instalacije, centralne kurjave ter sanitarne keramike. Velik poudarek dajemo področju alternativnih virov (toplotne črpalke, kamini, solarni sistemi).',
                    'xml_uvoz' => 'http://www.oglasi.si/xml/THS/ths.xml',
                ),
                1 => 
                array (
                    'c_id' => 327,
                    'category_id' => 19,
                    'davcna' => 72596465,
                    'delovni_cas' => '',
                    'id' => 1765,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => 'http://www.agrokomerc.si',
                    'tocen_naziv' => 'AGROKOMERC d.o.o., sedež Ul.Franca Kramarja 2, Šempeter pri Gorici',
                    'trgovina_opis' => 'PRODAJA, POSREDOVANJE IN SERVIS KMETIJSKE MEHANIZACIJE',
                    'xml_uvoz' => '',
                ),
                2 => 
                array (
                    'c_id' => 303,
                    'category_id' => 24,
                    'davcna' => 21612242,
                    'delovni_cas' => '',
                    'id' => 1766,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => 'Dovolite si ljubiti in biti ljubljeni. Dovolite si biti srečni.',
                    'spletna_stran' => '',
                    'tocen_naziv' => 'Simona Joras s.p., PE Ženitna posredovalnica Astara',
                    'trgovina_opis' => 'Zaslužite si najboljše! S svojimi sanjami in željami sezite po zvezdah in ne sklepajte kompromisov!',
                    'xml_uvoz' => '',
                ),
                3 => 
                array (
                    'c_id' => 321,
                    'category_id' => 24,
                    'davcna' => 26064693,
                    'delovni_cas' => 'Od ponedeljka do petka od 10h do 17h. Ob sobotah od 10h do 13h.',
                    'id' => 1769,
                    'logo' => '',
                    'nacin_prevzema' => 'Oglasite se lahko v poslovalnici v MS ali v LJ.',
                    'slogan' => 'Posredujemo partnerje za občasna srečanja ali resno zvezo, izključno za nevezane in resne člane iz vse Slovenije.',
                    'spletna_stran' => 'http://www.zdravilnidotik.si',
                    'tocen_naziv' => 'MAJDA ŠIFTAR S.P.',
                    'trgovina_opis' => 'Ali smo dejansko najbolj resna posredovalnica? Prepričajte se v posredovalnici z nad 13.000 člani iz vse Slovenije!',
                    'xml_uvoz' => '',
                ),
                4 => 
                array (
                    'c_id' => 340,
                    'category_id' => 19,
                    'davcna' => 59431652,
                    'delovni_cas' => 'Pon - Pet: 8.00 do 16.00 in Sob: 8.00 do 12.00',
                    'id' => 1772,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => 'Trgovina, ki ji lahko zaupate!',
                    'spletna_stran' => 'http://www.agrometal.si',
                    'tocen_naziv' => 'Agrometal d.o.o., sedež Črni Vrh 4, Polhov Gradec',
                    'trgovina_opis' => 'AGROMETAL - Edini pooblaščeni generalni zastopnik in serviser traktorjev Case IH za Slovenijo! 

Zagotovljena garancija, servis in rezervni deli!',
                    'xml_uvoz' => '',
                ),
                5 => 
                array (
                    'c_id' => 343,
                    'category_id' => 24,
                    'davcna' => 41057082,
                    'delovni_cas' => '',
                    'id' => 1773,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => 'Samo ljubljeni smo srečni!',
                    'spletna_stran' => 'https://www.minimum.si/kocka-7-d-o-o/',
                    'tocen_naziv' => 'Kocka7 d.o.o., sedež Trg Maršala Tita 13, Tolmin',
                    'trgovina_opis' => 'Morda jo iščeš in ona te išče , a kaj ko v vrtincu življenja hodita drug mimo drugega kot tujca… saj so želje in misli skrite… Pokliči in našla se bosta! Na tej poti niste sami… premnoge, premnogi te iščejo!! Morda pa že tukaj izbereš srečo - ljubezen svojega življenja. Na potezi si, pridruži se in najdi …..!! 
(resne zveze, prijateljevanja, zveze on-on, ona-ona)',
                    'xml_uvoz' => '',
                ),
                6 => 
                array (
                    'c_id' => 345,
                    'category_id' => 19,
                    'davcna' => 16676548,
                    'delovni_cas' => '8-12, 13-16 30',
                    'id' => 1774,
                    'logo' => '',
                    'nacin_prevzema' => 'Osebni dvig, dostava',
                    'slogan' => '',
                    'spletna_stran' => 'www.kubota.si',
                    'tocen_naziv' => 'KOMTEH d.o.o.',
                    'trgovina_opis' => 'Prodajamo in servisiramo svetovno priznane blagovne znamke Kubota - traktorji od 14 do 140 Ks in profesionalni komunalni stroji, ECO strojni pometalni sistemi, plužne deske, posipalci peska in soli, sesalci listja, trave in ostalih odpadkov ter pralno namakalni sistemi, Muratori-zemeljske freze, finišerji, mulčerji, priklopni viličarji in kose, PROCOMAS-mulčerji nabrežin in obcestnih jarkov, OMA-priklopne minibager roke, plužne deske do 3,6 m širine in čelni nakladalci',
                    'xml_uvoz' => '',
                ),
                7 => 
                array (
                    'c_id' => 366,
                    'category_id' => 20,
                    'davcna' => 21696250,
                    'delovni_cas' => '07h-15h',
                    'id' => 1776,
                    'logo' => '',
                    'nacin_prevzema' => 'lasten ali dostava',
                    'slogan' => 'dvigujemo vaš posel',
                    'spletna_stran' => 'https://vilicarji.si/',
                    'tocen_naziv' => 'STROJEGRADNJA HORVAT d.o.o.',
                    'trgovina_opis' => 'PRODAJA NAJEM IN SERVIS VILIČARJEV, PRODAJA REZERVNIH DELOV IN REGENERACIJA BATERIJ',
                    'xml_uvoz' => '',
                ),
                8 => 
                array (
                    'c_id' => 372,
                    'category_id' => 4,
                    'davcna' => 64893014,
                    'delovni_cas' => '',
                    'id' => 1778,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => '',
                    'tocen_naziv' => 'EVROAKTIV d.o.o.',
                    'trgovina_opis' => '',
                    'xml_uvoz' => '',
                ),
                9 => 
                array (
                    'c_id' => 382,
                    'category_id' => 11,
                    'davcna' => 18748511,
                    'delovni_cas' => '',
                    'id' => 1780,
                    'logo' => '',
                    'nacin_prevzema' => 'po dogovoru',
                    'slogan' => '',
                    'spletna_stran' => 'http://www.pasjaoprema-sp.si',
                    'tocen_naziv' => 'NATAŠA PUNTAR S.P.',
                    'trgovina_opis' => 'Smo podjetje ki se ukvarja s prodajo pasjih ut in pesjakov,vrtnih ut,ut za muce,hiške za račke',
                    'xml_uvoz' => '',
                ),
                10 => 
                array (
                    'c_id' => 392,
                    'category_id' => 4,
                    'davcna' => 70842370,
                    'delovni_cas' => 'po. - čet. od 9 - 16 h, v petek od 9-14 h',
                    'id' => 1781,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => 'www.simak.si',
                    'tocen_naziv' => 'Simak d.o.o.',
                'trgovina_opis' => 'Pravno svetovanje in promet z nepremičninami (prodaja in nakup)',
                    'xml_uvoz' => '',
                ),
                11 => 
                array (
                    'c_id' => 397,
                    'category_id' => 15,
                    'davcna' => 37590774,
                    'delovni_cas' => '7-19',
                    'id' => 1782,
                    'logo' => '',
                    'nacin_prevzema' => 'DOSTAVA',
                    'slogan' => 'VEDNO DOSEGLJIVI',
                    'spletna_stran' => 'http://www.tkpmost1.si',
                    'tocen_naziv' => 'TKP MOST, d.o.o.',
                    'trgovina_opis' => 'VSE IZ MARMORJA, GRANITA, KERAMIKE IN LESA',
                    'xml_uvoz' => '',
                ),
                12 => 
                array (
                    'c_id' => 415,
                    'category_id' => 19,
                    'davcna' => 89982029,
                    'delovni_cas' => '',
                    'id' => 1784,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => 'http://www.bonum.si',
                    'tocen_naziv' => 'BONUM d.o.o.',
                    'trgovina_opis' => 'Podjetje Bonum d. o. o., ki je generalni uvoznik, zastopnik in distributer za izdelke podjetij AS-Motor, Benassi, Grillo in Faga, je pričelo svoje poslovanje v letu 1993. Specializirani smo za profesionalne delovne stroje primerne za zahtevnejše terene ter opravila v vašem vrtu in okolici.

Osrednje poslanstvo našega podjetja je zagotavljanje najkvalitetnejših izdelkov za zahtevne kupce. Naša naravnanost nas spodbuja k nenehnemu izboljševanju ponudbe, saj se zavedamo, da je edina pot do dolgoročnega uspeha podjetja zadovoljstvo naših strank.',
                    'xml_uvoz' => '',
                ),
                13 => 
                array (
                    'c_id' => 419,
                    'category_id' => 4,
                    'davcna' => 87619601,
                    'delovni_cas' => '',
                    'id' => 1785,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => 'http://www.real.si',
                    'tocen_naziv' => 'GRAL REAL, nepremičninska agencija, d.o.o.',
                    'trgovina_opis' => '',
                    'xml_uvoz' => '',
                ),
                14 => 
                array (
                    'c_id' => 420,
                    'category_id' => 29,
                    'davcna' => 23373334,
                    'delovni_cas' => '24 h',
                    'id' => 1786,
                    'logo' => '',
                    'nacin_prevzema' => 'NAŠA DOSTAVA',
                    'slogan' => 'VEBO - spletni trgovski center za podjetja',
                    'spletna_stran' => 'www.vebo.si',
                    'tocen_naziv' => 'AG VEBO d.o.o.',
                    'trgovina_opis' => 'AG VEBO ponuja stole in mize za profesionalno rabo. Opremljamo gostinske lokale, pisarne, hotele, gostinske vrtove, menze, restavracije ... Naša ponudba je namenjena vsem poslovnim subjektom, ki želijo kvaklitetno in ugodno opremiti svoj lokal ali pisarno.',
                    'xml_uvoz' => '',
                ),
                15 => 
                array (
                    'c_id' => 421,
                    'category_id' => 4,
                    'davcna' => 84039418,
                    'delovni_cas' => 'pon., tor., čet. od 9-16.ure, sr. od 9-18.ure, pet. od 9-14.ure',
                    'id' => 1787,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => 'https://www.idila.com',
                    'tocen_naziv' => 'IDILA NEPREMIČNINE AGENCIJA ZA NEPREMIČNINE IN SVETOVANJE DAMIJAN KOKOL S.P.',
                    'trgovina_opis' => 'posredovanje pri prometu z nepremičninami, sestava vseh vrst pogodb, priprava zemljiškoknjižnih predlogov,...',
                    'xml_uvoz' => '',
                ),
                16 => 
                array (
                    'c_id' => 433,
                    'category_id' => 28,
                    'davcna' => 46554289,
                    'delovni_cas' => '',
                    'id' => 1789,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => '',
                    'tocen_naziv' => 'TIANA, TANJA MLAKER S.P.',
                    'trgovina_opis' => '',
                    'xml_uvoz' => '',
                ),
                17 => 
                array (
                    'c_id' => 434,
                    'category_id' => 18,
                    'davcna' => 48423874,
                    'delovni_cas' => '',
                    'id' => 1790,
                    'logo' => '',
                    'nacin_prevzema' => 'pošta, TNT',
                    'slogan' => '',
                    'spletna_stran' => 'www.garrett.si',
                    'tocen_naziv' => 'Trgovsko in storitveno podjetje Nomadis, d.o.o.',
                    'trgovina_opis' => '',
                    'xml_uvoz' => '',
                ),
                18 => 
                array (
                    'c_id' => 445,
                    'category_id' => 26,
                    'davcna' => 66004900,
                    'delovni_cas' => '9-17.00',
                    'id' => 1791,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => 'Kolesarska potovanja in pohodne ture za vsakogar',
                    'spletna_stran' => 'www.chebulint.si',
                    'tocen_naziv' => 'KlanB d.o.o.',
                    'trgovina_opis' => 'Turistična agencija, specializirana za aktivne počitnice in potovanja',
                    'xml_uvoz' => '',
                ),
                19 => 
                array (
                    'c_id' => 499,
                    'category_id' => 19,
                    'davcna' => 59607394,
                    'delovni_cas' => 'od 8. do 17.ure',
                    'id' => 1792,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => 'http://www.agroservis-vode.si',
                    'tocen_naziv' => 'Agroservis Vode Maksimiljan s.p.',
                    'trgovina_opis' => 'Podjetje Agroservis Vode se ukvarja s prodajo in popravilom kmetijske mehanizacije.

Ponuja Vam najmodernejšo tehnologijo na področju Zelene tehnike. Stroji in pripomočki različnih znamk najvišje kakovosti vam zagotavljajo dolgo in zadovoljno uporabo. V Agroservisu Vode lahko kupite vse od traktorjev, motokultivatorjev do ročnih kosilnic ter rezervnih delov za vaš stroj.

Ponujamo Vam tudi servis, kjer bomo omogočili nadaljnjo delovanje vašega stroja.


Naše najbolj prodajane znamke so:
- Labinprogres: motokultivatorji s priključki
- Ibea: vrtne rotacijske kosilnice in kose na laks
- R2: freze za urejanje okolice – finišerji in sejalnice trave
- Caravaggi: drobilci vej',
                    'xml_uvoz' => '',
                ),
                20 => 
                array (
                    'c_id' => 448,
                    'category_id' => 19,
                    'davcna' => 34386033,
                    'delovni_cas' => 'Pon - Pet 8h - 17h, Sob 8h - 13h',
                    'id' => 1793,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => 'http://www.vzorec-raka.si',
                    'tocen_naziv' => 'VZOREC Raka d.o.o.',
                    'trgovina_opis' => '',
                    'xml_uvoz' => '',
                ),
                21 => 
                array (
                    'c_id' => 450,
                    'category_id' => 23,
                    'davcna' => 71732934,
                    'delovni_cas' => '8.00 do 15.00',
                    'id' => 1794,
                    'logo' => '',
                    'nacin_prevzema' => 'obisk na domu',
                    'slogan' => 'Na Ptuju in v Mariboru',
                    'spletna_stran' => 'www.racunovodstvo-tusek.si',
                    'tocen_naziv' => 'RAČUNOVODSTVO TUŠEK D.O.O.',
                'trgovina_opis' => 'Opravljamo računovodske storitve za družbe in samostojne podjetnike. Dokumente prevzamemo pri vas in vam jih po potrebi takoj vrnemo. Določene storitve lahko opravljamo dnevno (npr. zapiranje računov).

Nahajamo se na Osojnikovi 9, 2250 Ptuj (nad ABANKO).',
                    'xml_uvoz' => '',
                ),
                22 => 
                array (
                    'c_id' => 478,
                    'category_id' => 28,
                    'davcna' => 41402740,
                    'delovni_cas' => 'drseči',
                    'id' => 1795,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => 'Sem najboljša, vendar nič boljša od vas!',
                    'spletna_stran' => 'www.taisha.si',
                    'tocen_naziv' => 'TAISHA KAŠLIK TANJA S.P.',
                    'trgovina_opis' => 'JASNOVIDNOST, JASNOČUTNOST, JASNOVEDNOST ali MEDIALNO SVETOVANJE
Če svojemu problemu ne vidite konca, vam ponujam možnost profesionalnega posveta. Združujem znanje alternativne medicine, ezoterike in drugih ved. Pokličite, ne bo vam žal. Jaz sem tukaj, čas pa je na vaši strani!',
                    'xml_uvoz' => '',
                ),
                23 => 
                array (
                    'c_id' => 519,
                    'category_id' => 27,
                    'davcna' => 24217697,
                    'delovni_cas' => 'vsak dan razen nedelje',
                    'id' => 1797,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => 'www.prevozklemen.com',
                    'tocen_naziv' => 'KLEMEN LIBANOV S.P.',
                    'trgovina_opis' => 'UKVARJAMO SE S PREVOZI IN ODVOZI GRADBENEGA IN KOSOVNEGA ODPADNEGA MATERIALA.ODVAŽAMO ODSLUŽENO BELO TEHNIKO, ODPADNO POHIŠTVO IN STANOVANJSKO OPREMO NA SMETIŠČE.S KAMIONOM LAHKO PREVAZAMO TUDI PESEK, BETON, ZEMLJO ZA VRT IN RAZSUT ODPADNI MATERIAL.UKVARJAMO SE TUDI S ČIŠČENJEM PODSTREŠIJ, KLETI, GARAŽ IN PRAZNENJEM CELIH STANOVANJ PRED SELITVIJO ALI ADAPTACIJA.NAREDIMO TUDI MANJŠE SELITVE, KOMBI PREVOZE IN KAMIONSKE KIPERSKE PREVOZE.DELA NAREDIMO S SVOJIMI ALI VAŠIMI LJUDMI IN SICER STROKOVNO, HITRO IN POD UGODNIMI POGOJI.',
                    'xml_uvoz' => '',
                ),
                24 => 
                array (
                    'c_id' => 531,
                    'category_id' => 24,
                    'davcna' => 81508557,
                    'delovni_cas' => '',
                    'id' => 1798,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => 'http://www.sms-randi.si',
                    'tocen_naziv' => 'LAVRENA d.o.o.',
                    'trgovina_opis' => '',
                    'xml_uvoz' => '',
                ),
                25 => 
                array (
                    'c_id' => 533,
                    'category_id' => 15,
                    'davcna' => 63666685,
                    'delovni_cas' => 'pon.-pet. 7.00-17.00, sob. 8.00-12.00',
                    'id' => 1799,
                    'logo' => '',
                    'nacin_prevzema' => 'Lasten prevzem ali dostava',
                    'slogan' => '',
                    'spletna_stran' => 'http://www.tehnoles.si',
                    'tocen_naziv' => 'TEHNOLES d.o.o.',
                    'trgovina_opis' => '',
                    'xml_uvoz' => '',
                ),
                26 => 
                array (
                    'c_id' => 568,
                    'category_id' => 23,
                    'davcna' => 33957959,
                    'delovni_cas' => 'PON. - PET. 8.30 - 16 , SOBOTA 9.00 - 12.00',
                    'id' => 1803,
                    'logo' => '',
                    'nacin_prevzema' => 'Osebni dvig v trgovini ali po pošti',
                    'slogan' => 'VSE ZA PROSTI ČAS',
                    'spletna_stran' => '',
                    'tocen_naziv' => 'ZBIRALEC, Robert Rozman s.p.',
                    'trgovina_opis' => 'PRODAJA VSE ZBIRATELJSKE OPREME ZNAMKE SAFE IN LEUCHTTURM.ALBUMI ZA KOVANCE,ZNAMKE,ZNAČKE, MEDALJE,RAZGLEDNICE,KINDER FIGURICE,SLIČICE YUGIOH...NA ZALOGI SO VEDNO ČISTILA ZA VSE VRSTE KOVANCEV,POVEČEVALNA STEKLA ...V TRGOVINI DOBITE VSE VRSTE KOVANCEV OD PRILOŽNOSTNIH EURO KOVANCEV KOVANCE IZ KOMPLETNEGA EURO OBMOČJA....',
                    'xml_uvoz' => '',
                ),
                27 => 
                array (
                    'c_id' => 574,
                    'category_id' => 23,
                    'davcna' => 54973562,
                    'delovni_cas' => '07.00 - 18.00',
                    'id' => 1804,
                    'logo' => '',
                    'nacin_prevzema' => 'osebno ali po dogovoru',
                    'slogan' => 'Hvalitetno, ažuvno in cenovno ugodno',
                    'spletna_stran' => 'www.mskkonto.si',
                    'tocen_naziv' => 'MSK-KONTO d.o.o.',
                    'trgovina_opis' => 'RAČUNOVODSKE STORITVE
KNJIGOVODSKE STORITVE
DAVČNO SVETOVANJE',
                    'xml_uvoz' => '',
                ),
                28 => 
                array (
                    'c_id' => 589,
                    'category_id' => 28,
                    'davcna' => 47973692,
                    'delovni_cas' => 'vsak dan 24ur',
                    'id' => 1805,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => 'Nasveti za lažjo prihodnost',
                    'spletna_stran' => 'http://www.sites.google.com/site/vedezevalecvalteraleks/',
                    'tocen_naziv' => 'VALTER GAJZER S.P.',
                    'trgovina_opis' => 'VEDEŽEVANJE IN JASNOVIDNOST
090/142-415 VEDEŽEVANJE - JASNOVIDNOST U ŽIVO 090/ 142-415 24 UR-VSAK DAN VEDEŽEVALEC IN JASNOVIDEC VALTER ALEKS, TAROT-CIGANSKE IN EGIPTOVSKE KARTE SO LAHKO VAŠA SLIKA PRIHODNOSTI.DELO-ZDRAVJE-DENAR-LJUBEZEN TER VSE OSTALO KAR VAS TEŽI. POKLIČITE 090/142-415 1.99€/MIN MOBITEL-DEBITEL-IZIMOBIL-TUŠTELEKOM- TELELKOM SLOVENIJE, TER SIMOBILA 090/142-415!

CENA 1.99€/MIN, OZ. PO CENIKU OPERATERJA

090/ 142-415',
                    'xml_uvoz' => '',
                ),
                29 => 
                array (
                    'c_id' => 604,
                    'category_id' => 21,
                    'davcna' => 37098209,
                    'delovni_cas' => '',
                    'id' => 1806,
                    'logo' => '',
                    'nacin_prevzema' => 'osebni,Pošta,DPD',
                    'slogan' => '',
                    'spletna_stran' => 'www.loparji.si',
                    'tocen_naziv' => 'R&S LINE, ALEŠ NARAGLAV S.P.',
                    'trgovina_opis' => '',
                    'xml_uvoz' => '',
                ),
                30 => 
                array (
                    'c_id' => 616,
                    'category_id' => 28,
                    'davcna' => 36111139,
                    'delovni_cas' => '24 ur',
                    'id' => 1807,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => 'VEDEŽEVANJE IN JASNOVIDNI POGLED V VAŠO PRIHODNOST-SVETOVANJE-MAGIČNI UROKI-POMOČ NA DALJAVO,ENERGETSKO-ČIŠČENJE-REGRESIJA...',
                    'spletna_stran' => 'http://www.orakelj.si',
                    'tocen_naziv' => 'ORAKELJ, MANUELA DIKAUČIČ S.P.',
                    'trgovina_opis' => 'VEDEŽEVANJE IN JASNOVIDNI POGLED V VAŠO PRIHODNOST pri Oraklju. Ste se znašli v začaranem krogu in ne vidite izhoda zaradi težav v ljubezen, ste v dvomih za partnerja ima še čustva, ločitev, vrnitev-partner, služba-delo v tujini, finančne in uradne zadeve, družina, zdravje, loto. št., avanture, prijateljevanje, želja po NARAŠČAJU zaradi vsakdanjih skrbi ne gre, imaste storjen UROK, itd., NUDIM VAM POMOČ – NA DALJAVO IN ENERGETSKO ČIŠČENJE – ČAKER, da ponovno pride nova notranja moč, sreča. ODSTRANJEVANJE IN ČIŠČENJE – UROKOV, MAGIČNI OBREDI ZA; LJUBEZEN, VRNITEV-PARTNERJA, SREČO, DENAR, ZDRAVJE … PREROKOVANJE IZ KAVNE USEDLINE IN DLANI, TALISMANI ZA SREČO in ZAŠČITE PROTI UROKOM, ANGELSKO - ZDRAVLJENJE, REGRESIJA ZA PREJŠNJO ŽIVLJENJE Z SEANSO, kaj vam je vaša KARMA prinesla, ..itd,. Svetovanje in pomoč v stiski po tel. ali osebni obisk na domu. Telekom: 090/41-77, 1.99 EUR/min., Mobitel: 090/64-47, 1.69 EUR/min. Ceno zveze iz ostalih omrežij določa vaš operater. Osebni obisk sprejema na 041/751-924 cena dogovorjena po ceniku na domu pri Oraklju. www.orakelj.si',
                    'xml_uvoz' => '',
                ),
                31 => 
                array (
                    'c_id' => 619,
                    'category_id' => 20,
                    'davcna' => 85531057,
                    'delovni_cas' => '7-17',
                    'id' => 1808,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => 'www.vilboss.si',
                    'tocen_naziv' => 'VILBOSS d.o.o.',
                    'trgovina_opis' => 'prodaja in servisiranje viličarjev, najem',
                    'xml_uvoz' => '',
                ),
                32 => 
                array (
                    'c_id' => 689,
                    'category_id' => 7,
                    'davcna' => 26942151,
                    'delovni_cas' => '9-16.ure',
                    'id' => 1811,
                    'logo' => '',
                    'nacin_prevzema' => 'osebno, po pošti',
                    'slogan' => 'Ugodno in kvalitetno!',
                    'spletna_stran' => 'www.harmonike-plohl.si',
                    'tocen_naziv' => 'HARMONIKE PLOHL, Martina Plohl s.p.',
                    'trgovina_opis' => 'Izdelava , prodaja ter servis diatoničnih harmonik. Izdelujemo diatonične harmonike PLOHL. Prodajamo nove in rabljene diatonične harmonike, nudimo poučevanje, ter igranje z ansamblom POMLADNI ZVOKI',
                    'xml_uvoz' => '',
                ),
                33 => 
                array (
                    'c_id' => 691,
                    'category_id' => 26,
                    'davcna' => 33541965,
                    'delovni_cas' => '',
                    'id' => 1812,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => 'Odyssei uresničuje vaše želje.',
                    'spletna_stran' => 'www.odyssei-travel.net',
                    'tocen_naziv' => 'TEČAJ d.o.o.',
                    'trgovina_opis' => 'Turistična agencija Odyssei nudi vse vrste počitnic in potovanj: v Sloveniji, na Jadranu in Mediteranu, ob daljnih toplih morjih, pa na evropskih smučiščih, letalske karte.
Smo specialist za Zahodno Afriko, ture in počitnice.',
                    'xml_uvoz' => '',
                ),
                34 => 
                array (
                    'c_id' => 709,
                    'category_id' => 25,
                    'davcna' => 86888056,
                    'delovni_cas' => '',
                    'id' => 1813,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => '',
                    'tocen_naziv' => 'FRANC KROŠELJ s.p.',
                    'trgovina_opis' => '',
                    'xml_uvoz' => '',
                ),
                35 => 
                array (
                    'c_id' => 733,
                    'category_id' => 25,
                    'davcna' => 35411872,
                    'delovni_cas' => '',
                    'id' => 1815,
                    'logo' => '',
                    'nacin_prevzema' => '',
                    'slogan' => '',
                    'spletna_stran' => '',
                    'tocen_naziv' => 'SLIKOPLESKARSTVO JEREB MARJAN JEREB S.P.',
                    'trgovina_opis' => 'Pleskarska, fasaderska, suhomontažna dela!',
                    'xml_uvoz' => '',
                ),
                36 => 
                array (
                    'c_id' => 749,
                    'category_id' => 25,
                    'davcna' => 53380983,
                    'delovni_cas' => '24 UR',
                    'id' => 1816,
                    'logo' => '',
                    'nacin_prevzema' => 'Lasten prevzem ali naša dostava',
                    'slogan' => 'Vedno korak pred vlago!',
                    'spletna_stran' => 'http://www.senzal.si',
                    'tocen_naziv' => 'SENZAL d.o.o.',
                    'trgovina_opis' => 'Podjetje Senzal d.o.o. je specializirano na področju meritev vlage in osuševanja notranjih prostorov. Naša ekipa je strokovno usposobljena za takšno delo in pripravljena na spopad z vlago v vašem objektu. Sedež podjetja je v Mariboru, vendar delujemo na širšem območju.',
                    'xml_uvoz' => '',
                ),
                37 => 
                array (
                    'c_id' => 764,
                    'category_id' => 9,
                    'davcna' => 67576010,
                    'delovni_cas' => '',
                    'id' => 1817,
                    'logo' => '',
                    'nacin_prevzema' => 'Brezplačna dostava po Sloveniji',
                    'slogan' => 'Ratan pohištvo in oprema',
                    'spletna_stran' => 'http://www.ratan.si',
                    'tocen_naziv' => 'GO - GO d.o.o.',
                    'trgovina_opis' => 'Prodaja umetnega in naravnega ratana ter gostinske opreme iz aluminija, kovine in plastike. Ratan stoli in mize, mizna podnožja in mizne plošče, podi za terase, senčniki, ležalniki, frizerska oprema, vrtni žari, pisarniška oprema in oprema in pohištvo za dom, kuhinje, spalnice, dnevne sobe, predsobe, jogiji in posteljni vložki, stoli in kuhinjske mize itd...',
                    'xml_uvoz' => '',
                ),
                38 => 
                array (
                    'c_id' => 834,
                    'category_id' => 16,
                    'davcna' => 77264517,
                    'delovni_cas' => '',
                    'id' => 1820,
                    'logo' => '',
                    'nacin_prevzema' => 'Po dogovoru',
                    'slogan' => '',
                    'spletna_stran' => 'www.avtomobilski-nadstreski.si',
                    'tocen_naziv' => 'Armat d.o.o., sedež Krmelj 37 a, 8296 Krmelj',
                    'trgovina_opis' => 'Za enostavno in varno zaščito vašega avtomobila pred vremenskimi vplivi, kot so dež, toča, sonce, sneg in led, vam po vaši želji izdelamo avtomobilski nadstrešek, primeren za vaše dvorišče. 

Izdelujemo tipske avtomobilske nadstreške z jekleno konstrukcijo iz pocinkanih krivljenih profilov s polikarbonatno kritino in kritino Armaterm SO ali leseno podkonstrukcijo v več videznih inačicah za lepšo skladnost z vašim objektom. 

Poleg avtomobilskih nadstreškov, ponujamo tudi vrtne in terasne nadstreške, vrtne ute, dvoriščne ograje in dvoriščna vrata. Na ta način zaokrožamo našo ponudbo malih objektov in kupcu ponujamo celostne rešitve pri oblikovanju domačega okolja. Zelo velik poudarek namenjamo modernemu arhitekturnemu pristopu in individualnosti na način, da v oblikovanje v čim večji meri vključimo želje kupcev. 
S čim boljšim izkoriščanjem visokega tehnološkega nivoja naše proizvodnje, pa kupcu ponujamo vrhunsko kakovost tudi s tehničnega vidika. 

Veseli bomo vašega povpraševanja na igor.lazanski@armat.si ali 051-373 304. 
Hvala.',
                    'xml_uvoz' => '',
                ),
                39 => 
                array (
                    'c_id' => 848,
                    'category_id' => 19,
                    'davcna' => 34546049,
                    'delovni_cas' => '',
                    'id' => 1822,
                    'logo' => '',
                    'nacin_prevzema' => 'Po povzetju, v trgovini',
                    'slogan' => '',
                    'spletna_stran' => 'http://www.viltech.net',
                    'tocen_naziv' => 'Viltech, Gašper Osterman s.p.',
                    'trgovina_opis' => 'Servis traktorjev, viličarjev in kmetijske mehanizacije
Trgovina z rezervnimi deli za traktorje, viličarje in kmetijsko mehanizacijo (Kočevje, Tomšičeva 13)',
                    'xml_uvoz' => '',
                ),
            ));
        
        
    }
}