# StudyBuddy – Studieplanner voor studenten

StudyBuddy is een eenvoudige, gebruiksvriendelijke webapplicatie waarmee studenten van hun studie beter kunnen organiseren: persoonlijke taken beheren, studiegroepen aanmaken, afspraken plannen en aanwezigheid aangeven.

## Belangrijkste functionaliteiten

- Account aanmaken en inloggen (studenten & admins)
- Persoonlijke taken: aanmaken, bewerken, prioriteit, status, deadline
- Studiegroepen aanmaken en joinen via unieke code
- Afspraken plannen binnen groepen
- Aanwezigheidsregistratie (ja/misschien/nee) per afspraak
- Dashboard met overzicht open taken, voltooiingspercentage en volgende afspraak
- Admin-paneel om gebruikers te beheren (blokkeren, rol wijzigen)

## Technische stack

- PHP 8.1+
- Laravel 12.x
- MySQL / MariaDB
- Vite (voor assets: CSS + JS)
- Bootstrap 5 (front-end styling)
- Laravel authentication (ingebouwd)

## Vereisten

- PHP ≥ 8.1
- Composer
- Node.js + npm
- MySQL / MariaDB (of SQLite voor lokale tests)
- Git

## Installatie

### 1. Project clonen


```bash
git clone https://github.com/JOUW-GITHUB/studybuddy.git
cd studybuddy


### 2. Afhankelijkheden installeren
Bashcomposer install
npm install

### 3. Omgevingsbestand aanmaken
Kopieer het voorbeeld .env-bestand:
Bashcp .env.example .env
Genereer een unieke applicatiesleutel:
Bashphp artisan key:generate

### 4. Database configureren
Pas in .env de database-gegevens aan:
env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=studybuddy
DB_USERNAME=root
DB_PASSWORD=

### 5. Database aanmaken & vullen
Bash
# Tabellen aanmaken
php artisan migrate

# Testdata toevoegen (1 admin + studenten + groepen + taken + afspraken)
php artisan db:seed

### 6. Assets compileren
Voor ontwikkeling (hot-reloading):
Bashnpm run dev
Voor productie (éénmalig of bij deploy):
Bashnpm run build

### 7. Server starten
Start de Laravel development server:
Bashphp artisan serve
Open in je browser:
→ http://127.0.0.1:8000