# BDoctors (Back-office) #
Il progetto prevedeva di realizzare un sito web gestionale per strutture mediche private.

## Prima pagina ##
Verrà chiesto all'utente di accedere, infatti essendo questo il back-office, è pensato esclusivamente per essere utilizzato dai medici.

## Home ##
Nella home è presente la lista di tutti i medici iscritti alla piattaforma.

## Profilo ##
Nel profilo si troveranno tutti i dati del dottore che ha fatto l'accesso al sito. Se è la prima volta che il dottore si trova in questa pagina, al dottore verrà chiesto di compilare un form con i dati che poi verranno visualizzati nel profilo.

### Sponsorizzazione ###
All'interno della pagina sarà possibile scegliere di sponsorizzare il proprio profilo, per avere più possibilità di visite da parte degli utenti.

### Recensioni e messaggi ###
All'interno della pagina del profilo vengono mostrati anche i dati che sono stati aggiunti dagli utenti, ovvero recensioni e messaggi.
Vengono visualizzati solamente gli ultimi 3 messaggi e le ultime 3 recensioni, ma è possibile anche aprire una pagina che mostri tutti i messaggi, stessa cosa per le recensioni.
Messaggi e recensioni mostrano nome utente, email e contenuto del messaggio o della recensione, e data. Sono ordinati dal più recente al meno recente.

# Progettazione #
Il sito è stato realizzato utilizzando Laravel, utilizzando Bootstrap e CSS plain per realizzare lo stile del sito.
Il sito non rappresenta solamente il back-office, ma rappresenta anche l'API sulla quale si agganciera il front-office.
Il caricamento delle immagini è stato ottimizzato, per fare in modo che nel momento in cui un dottore aggiorni la propria immagine, la vecchia immagine venga cancellata.
Tutto il sito è validato sia lato Back-end, sia Front-end.
