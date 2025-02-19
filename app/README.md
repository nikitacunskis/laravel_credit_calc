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