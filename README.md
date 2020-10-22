# Projektuppgift
### DT173G - Webbutveckling III
---
Detta är projektuppgiften för kursen [Webbutveckling III](https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=18690) på mittuniversitet HT -20.

Uppgiften går ut på att skapa en REST-webbtjänst med php och sedan skapa en klient som konsumerar webbtjänsten, till det ska vi konstruera ett admin-gränssnitt med full CRUD-möjlighet.
Projektet ska resultera i en webbapplikation som visar utbildningar jag gått, arbetserfarenheter samt referensarbeten jag gjort.
För att kunna ansluta mot webbtjänsten krävs användarnamn och lösenord samt autentisering med basic authentication. Webbtjänsten tillåter dessutom endast anslutningar från samma domän.

REST-webbtjänsten har tre anrop:
* https://webicon.se/tweug/dt173g/projekt/rest/portfolio.php
* https://webicon.se/tweug/dt173g/projekt/rest/education.php
* https://webicon.se/tweug/dt173g/projekt/rest/experience.php

Varje anrop har stöd för CRUD med samma upplägg:
* GET - https://webicon.se/tweug/dt173g/projekt/rest/portfolio.php
* GET - https://webicon.se/tweug/dt173g/projekt/rest/portfolio.php?id=1
* POST - https://webicon.se/tweug/dt173g/projekt/rest/portfolio.php
* PUT - https://webicon.se/tweug/dt173g/projekt/rest/portfolio.php?id=1
* DELETE - https://webicon.se/tweug/dt173g/projekt/rest/portfolio.php?id=1

Webbapplikationen går att testa på [https://webicon.se/tweug/dt173g/projekt/client](https://webicon.se/tweug/dt173g/projekt/client).