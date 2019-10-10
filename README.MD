#### Downloaden van het project
1. Ga naar C:\xampp\htdocs
2. houdt shift ingedrukt en druk rechtermuisknop > open powershell venster hier
3. Type `git pull https://github.com/Mordo95/powercomputertrainees.git`
4. Git maakt een nieuwe map aan genaamd powercomputertrainees. met het project.

#### Opstarten
1. Open de aangemaakte map in je favorite IDE.
2. Open een terminal venster indien deze nog niet geopend is
3. Type `composer install` en wacht tot alles geïnstalleerd is
4. Type `npm install` en wacht tot alles geïnstalleerd is.
5. Kopieer het bestand `.env.example` naar `.env`
6. Type `php artisan key:generate` in je powershell venster.

#### Instellen .env en database
1. Open .env in je favorite editor
2. Verander de naam onder `DB_DATABASE` naar de database die je gaat gebruiken voor dit project.  
Geen database? maak deze aan op http://localhost/phpmyadmin
3. In je poweshell venster, voer `php artisan migrate` uit.

Nu heb je een opstartbare laravel instantie met een gekoppelde database.

#### Belangerijke mappen
##### App/
`app/` is je applicatie map. Deze map heeft je controllers (in `app/http/controllers`) en alle php gerelateerde code.

##### resources/
In je `resources/` map staan een paar submappen. 
* `views/` is waar je de blade views en je HTML code in opslaat. Groepeer deze in submappen die gelijk staan aan de naam van je controller. (bijvoorbeeld: `Usercontroller` wordt de map `views/users`)
* `js/` is de map waarin je Javascript code gaat. Deze kan je compileren via `npm run dev`
* `sass/` is je stylesheet map. Hierin staat je CSS/SCSS code. Deze kan je compileren via `npm run dev`

*Na het compileren van deze bestanden kan je ze vinden in public/js en public/css*

#### public/
Alle frontend gerelateerde code gaat hier. Deze map hoef je alleen te vullen met afbeeldingen die nodig zijn voor de site.

##### database/
Je database map bevat de database-definities. Voor nu is alleen de map ` migrations` van belang. Om een migratie te maken voer je `php artisan make:migration {{NAAM}}` uit.

##### routes/
In de routes map worden alle routes voor de controllers ingericht. Op het moment gebruik je **alleen** web.php. De andere bestanden zijn niet relevant.

#### make-commando's
*Alle make commando's beginnen met `php artisan`*
* `make:controller {{NAAM}} --resource` maak een resource controller aan.  
Voorbeeld: `php artisan make:controller ProductController --resource`
* `make:view {{NAAM}} ` maakt een view aan onder het pad {{NAAM}}.  
Voorbeeld: `php artisan make:view users/overview`
* `make:request {{NAAM}}` maakt een request aan met de opgegeven naam.  
voorbeeld: `php artisan make:request ProductRequest`

#### Onduidelijkheden?
Laat het me weten via discord of via de whatsapp groep.
