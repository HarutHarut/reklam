@extends('layouts.app')
@push('styles')
    <link href="/assets/css/pages/page.css" rel="stylesheet">
@endpush

@section('content')
    <div class="cw">

        <div class="page-heading flx">
            <h1>Pogosta <span>vprašanja</span></h1>
        </div>

        <div id="subpage-container" class="flx">
            <div id="subpage">
                <div class="content tile">
                    <h2>Prijava in registracija</h2>

                    <div class="heading-pin">
                        <span>1.</span>
                        <h3>Ali se moram pred oddajo oglasa registrirati?</h3>
                    </div>

                    <p class="brd">
                        Ne, pred oddajo oglasa se vam ni potrebno registrirati (postati uporabnik). Kot fizična oseba lahko
                        oglas oddate na hitrejši in enostavnejši način -
                        <a href="#" class="lnk">VPIS OGLASA BREZ PRIJAVE</a>
                        . Oglas oddan na ta način bo objavljen 99 dni a ga po oddaji žal ni več možno urejati. Samo
                        registrirani uporabniki imajo možnost urejanja oglasov, zato vam priporočamo da postanete
                        registrirani uporabnik.
                    </p>

                    <div class="heading-pin">
                        <span>2.</span>
                        <h3>Kaj storiti, če sem pozabil-a geslo?</h3>
                    </div>

                    <p>
                        Če ste pozabili geslo, kliknite pozabil sem geslo, nakar vnesite E-poštni naslov s katerim ste se
                        registrirali. Nanj vam bomo avtomatsko poslal novo naključno generirano geslo.
                    </p>

                    <h2>Oddaja oglasa</h2>

                    <div class="heading-pin">
                        <span>1.</span>
                        <h3>Ali se moram pred oddajo oglasa registrirati?</h3>
                    </div>

                    <p>
                        Ne, pred oddajo oglasa se vam ni potrebno registrirati (postati uporabnik). Kot fizična oseba lahko
                        oglas oddate na hitrejši in enostavnejši način -
                        <a href="#" class="lnk">VPIS OGLASA BREZ PRIJAVE</a>
                        . Oglas oddan na ta način bo objavljen 99 dni a ga po oddaji žal ni več možno urejati. Samo
                        registrirani uporabniki imajo možnost urejanja oglasov, zato vam priporočamo da postanete
                        registrirani uporabnik.
                    </p>


                    <h2>Oglaševanje na Oglasi.si</h2>

                    <div class="heading-pin">
                        <span>1.</span>
                        <h3>Ali je oglaševanje na www.oglasi.si brezplačno?</h3>
                    </div>

                    <p class="last">
                        Da, oglaševanje je za fizične osebe brezplačno. Pravne osebe oglašujejo prvi mesec brezplačno, po
                        preteku jim pošljemo letno fakturo po ceniku, glede na število objavljenih oglasov.
                    </p>
                </div>

                <div class="help flx sub-tile tile">
                    <strong>Imate dodatno vprašanje?</strong>
                    <div class="option">
                        <a href="#"><i class="fas fa-phone fa-flip-horizontal"></i> 041 886 000</a>
                        <p>PON - PET: 8:00 - 14:00</p>
                    </div>
                    <div class="option">
                        <a href="#"><i class="fas fa-envelope"></i> info@oglasi.si</a>
                        <p>VSAK DAN: 00:00 - 24:00</p>
                    </div>
                </div>

                <div class="create-post sub-tile tile">
                    <p>Želite oddati nov oglas?</p>
                    <a class="btn oval blue" href="/nov-oglas/">Oddaj oglas <i class="far fa-plus"></i></a>
                </div>

            </div>

            <div id="subpage-banner">
                <div class="banner"></div>
            </div>

        </div>
    </div>
@endsection
