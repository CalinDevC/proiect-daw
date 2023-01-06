# proiect-daw
Structura aplicatiei web

Structura fisiere
\-- shoppingcart
|-- functions.php
|-- index.php
|-- home.php
|-- products.php
|-- product.php
|-- cart.php
|-- placeorder.php
|-- style.css
\-- imgs
|-- acac.jpg
|-- dada.jpg
|-- xzxzx.jpg
|-- dfdff.jpg
|-- rtrr.jpg

Fiecare fișier/director va conține următoarele:
1.	functions.php — Acest fișier va conține toate funcțiile de care avem nevoie pentru sistemul shopping cart (header, footer și funcțiile de conectare a bazei de date). Probabil tot aici voi implementa sistemul de login sau voi crea un nou users.php si admin.php si cusomers.php. vad cum ma duce proiectul, cat de complex va fi.

UPDATE(voi continua in engleza pentru o similaritate mai mare cu real projects):  I'll be including this file in a majority of PHP files. Instead of writing the same template code repeatedly, I can easily execute the function name.

2.	index.php - Acest fișier va conține teamplate pentru pagina principala și rutarea de bază, astfel încât să putem include paginile de mai jos.
3.	home.php - Acest fișier va fi pagina de pornire care va conține o imagine prezentată și 4 produse adăugate recent.
4.	products.php — Acest fișier va fi pentru afișarea tuturor produselor.
5.	product.php — Acest fișier va afișa un produs (depinde de solicitarea GET) și va conține un formular care va permite clientului să schimbe cantitatea și să adauge în coș produsul.
6.	cart.php — Pagina cosului de cumparaturi care va popula toate produsele care au fost adaugate in cos, impreuna cu cantitatile, preturile totale si pretul subtotal.
7.	placeorder.php — Un mesaj care va fi afișat utilizatorului atunci când plasează o comandă.
8.	style.css — style sheet (CSS3) pe care o voi folosi pentru magazinul online
9.	IMGS - Director care va conține toate imaginile pentru magazinul online (imagini recomandate, imagini de produs, etc). 



