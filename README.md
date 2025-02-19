# Projekta Uzstādīšana

Šis projekts izmanto Docker konteinerizācijai

## Docker Palaišana

Pārejiet uz `docker` mapi un palaidiet sekojošo komandu:

```sh
docker compose up -d --build
```

vai

```sh
docker-compose up -d --build
```

gadījumā, ja tev ir vecāka Docker versija

## Pēc Uzstādīšanas

Pēc uzstādīšanas pārliecinieties, ka visas migrācijas ir izpildītas. `app` mapē izveidojiet kopiju no `.env.example` un pārdēvējiet to uz `.env`.

### Backend

```sh
docker exec -it app composer install
docker exec -it app php artisan migrate
docker exec -it app php artisan key:generate
```

### Frontend

```sh
docker exec -it frontend npm i
docker exec -it frontend npm run dev
```

Dažos gadījumos frontend konteiners nepalaižas. Šajā gadījumā jums manuāli jāinstalē atkarības ar `npm i` un pēc tam jāpalaiž izstrādes vide ar `npm run dev`.


Lai piekļūtu projektam dodies uz `localhost` no jebkura pārlūka. (vai arī uz `localhost:port`, ja esi mainījis nginx konfigurāciju)

### Code Explanation

- Koda bāze ir Laravel Jetstream
- Priekš Frontend tiek lietots Vue3
- HTTP pieprasījumiem tiek lietots Axios
- Validācijai Frontend daļā tiek lietota bibliotēka yup
- Backend daļā tiek izmantots Factory princips, jo visticamāks, šīs nav pēdējais solis kredīta saņemšanai un nāksies vēl papildināt ar KYC, AML, rekvizīti u.t.t. Manā praksē, tādi soļi šādam tipa projektam var būt no 4 līdz 8.
- Loan modelis ir viegli paplašinājams. 
- Frontend ir veidots pievilcīgi, bet minimāli un ar iespēju katru moduli rediģēt. Par cik klientam nav konkrētas dizaina prasības un tiek prasīta "sava vīzija", manuprāt, jāsāk ar minimālo, lai turpmāk varētu "pataustot", izdomāt labāku risinājumu.
- Frontend daļu var izpētīt `/app/resources/Components/Calculator` mapē.
- Backend daļa ir iekš `/app/app` vairākās vietās.