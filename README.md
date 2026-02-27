# Artikli – Mini MVC Aplikacija

## Uporabljene tehnologije

- PHP 8+
- cURL (za pridobivanje podatkov iz zunanjega API-ja)
- HTML5
- CSS3
- Vanilla JavaScript (ES6)
- XAMPP (Apache) za lokalni razvoj

---

## Opis pristopa

Aplikacija je sestavljena iz backend in frontend dela.

### Backend

Backend je implementiran v PHP in deluje kot posrednik med zunanjim API-jem in frontend aplikacijo.

- S pomočjo cURL se pridobijo podatki iz zunanjega API-ja.
- Podatki se obdelajo in po potrebi sortirajo glede na podan parameter `sortPrice`.
- Rezultat se vrne frontend delu v obliki JSON odgovora.

Struktura backend dela sledi osnovnim principom MVC:

- Vsebuje router, controller in model
- `Article` (Model) skrbi za pridobivanje in pripravo podatkov.
- `ArticleDTO` definira strukturo posameznega artikla.
- `SortUtils` vsebuje logiko za sortiranje.
- API endpoint sprejema query parameter `sortPrice` za določanje načina sortiranja po ceni.

---

### Frontend

Frontend je implementiran z uporabo Vanilla JavaScript brez dodatnih knjižnic.

- Ob nalaganju strani se preko `fetch()` metode pokliče backend API.
- Pridobljeni podatki se shranijo v lokalni array.
- Artikli se dinamično generirajo in prikažejo v DOM.
- Ob spremembi sortiranja se izvede nov API klic z ustreznim parametrom.
- Implementirano je tudi prikazovanje indikatorja nalaganja ter osnovna obravnava napak.

---

## Povzetek

Rešitev temelji na enostavni in razširljivi arhitekturi:

- Backend skrbi za komunikacijo z zunanjim sistemom in obdelavo podatkov.
- Frontend skrbi za prikaz in interakcijo z uporabnikom.
- Komunikacija med njima poteka preko JSON formata.