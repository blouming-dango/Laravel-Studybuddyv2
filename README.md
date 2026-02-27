# StudyBuddy – Studieplanner voor studenten

StudyBuddy is een gebruiksvriendelijke webapplicatie waarmee studenten hun studie beter kunnen organiseren: persoonlijke taken beheren, studiegroepen aanmaken, afspraken plannen en aanwezigheid registreren. [file:21]

## Belangrijkste functionaliteiten

- Account aanmaken en inloggen (studenten & admins) [file:21]  
- Persoonlijke taken: aanmaken, bewerken, prioriteit instellen, status bijhouden en deadlines beheren [file:21]  
- Studiegroepen aanmaken en joinen via een unieke code [file:21]  
- Afspraken plannen binnen studiegroepen [file:21]  
- Aanwezigheidsregistratie per afspraak (ja / misschien / nee) [file:21]  
- Dashboard met overzicht van openstaande taken, voltooiingspercentage en eerstvolgende afspraak [file:21]  
- Admin-paneel om gebruikers te beheren (blokkeren, rol wijzigen) [file:21]  

## Technische stack

- PHP 8.1+ [file:21]  
- Laravel 12.x [file:21]  
- MySQL / MariaDB (of SQLite voor lokale tests) [file:21]  
- Vite (voor asset build: CSS & JavaScript) [file:21]  
- Bootstrap 5 voor front-end styling [file:21]  
- Ingebouwde Laravel-authenticatie [file:21]  

## Vereisten

- PHP ≥ 8.1 [file:21]  
- Composer [file:21]  
- Node.js + npm [file:21]  
- MySQL / MariaDB (of SQLite) [file:21]  
- Git [file:21]  

## Installatie

### 1. Project clonen

```bash
git clone https://github.com/JOUW-GITHUB/studybuddy.git
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