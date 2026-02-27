# StudyBuddy – Studieplanner voor studenten

StudyBuddy is een gebruiksvriendelijke webapplicatie waarmee studenten hun studie beter kunnen organiseren: persoonlijke taken beheren, studiegroepen aanmaken, afspraken plannen en aanwezigheid registreren. 

## Belangrijkste functionaliteiten

- Account aanmaken en inloggen (studenten & admins)   
- Persoonlijke taken: aanmaken, bewerken, prioriteit instellen, status bijhouden en deadlines beheren   
- Studiegroepen aanmaken en joinen via een unieke code   
- Afspraken plannen binnen studiegroepen   
- Aanwezigheidsregistratie per afspraak (ja / misschien / nee)   
- Dashboard met overzicht van openstaande taken, voltooiingspercentage en eerstvolgende afspraak   
- Admin-paneel om gebruikers te beheren (blokkeren, rol wijzigen)   

## Technische stack

- PHP 8.1+   
- Laravel 12.x   
- MySQL / MariaDB (of SQLite voor lokale tests)   
- Vite (voor asset build: CSS & JavaScript)   
- Bootstrap 5 voor front-end styling   
- Ingebouwde Laravel-authenticatie   

## Vereisten

- PHP ≥ 8.1   
- Composer   
- Node.js + npm   
- MySQL / MariaDB (of SQLite)   
- Git   

## Installatie

### 1. Project clonen

```bash
git clone https://github.com/jouw-github-gebruikersnaam/studybuddy.git
cd studybuddy
```

### 2. Afhankelijkheden installeren

```bash
composer install
npm install
```

### 3. Omgevingsbestand aanmaken

Kopieer het voorbeeld .env-bestand en genereer een applicatiesleutel:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database configureren

Pas in .env de database-instellingen aan:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=studybuddy
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Database aanmaken en vullen

Voer de migraties en seeders uit:

```bash
# Tabellen aanmaken
php artisan migrate

# Testdata toevoegen (1 admin + studenten + groepen + taken + afspraken)
php artisan db:seed
```

### 6. Assets compileren

Voor ontwikkeling (met hot-reloading):

```bash
npm run dev
```

Voor productie of bij deployment:

```bash
npm run build
```

### 7. Server starten

Start de Laravel development server en open de applicatie in je browser:

```bash
php artisan serve
```

Ga vervolgens naar: http://127.0.0.1:8000 

```bash
http://127.0.0.1:8000
```