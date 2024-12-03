# 📚 Gestió de Llibres - Documentació del Projecte  

Aquest projecte és una aplicació web per gestionar llibres i usuaris en una base de dades. Els usuaris poden registrar-se, iniciar sessió, crear, modificar i eliminar llibres, així com veure llistats de llibres amb funcionalitats de paginació i ordenació.  

## 🎯 Objectius del projecte  
- Facilitar la gestió de llibres per part d'administradors i usuaris.  
- Garantir una interfície intuïtiva i una experiència d'usuari agradable.  
- Implementar bones pràctiques de desenvolupament amb l'arquitectura MVC.  

## 🛠️ Tecnologies utilitzades  
- **Backend:** PHP (amb PDO per a la base de dades).  
- **Frontend:** HTML, CSS.  
- **Base de dades:** MySQL.  
- **Llibreries externes:**  
  - PHPMailer per enviar correus electrònics.  
  - HybridAuth per a l’autenticació social.  



# Estructura del projecte
<pre>
C:.
│   .gitignore
│   .htaccess
│   env.php
│   index.php
│   README.md
│   
├───Controlador
│       comprovacionsToken.php
│       comprovacionsUsers.php
│       comprovmodificarLlibre.php
│       controlPaginacio.php
│       eliminarLlibre.php
│       eliminarUsuari.php
│       hybridAuth.php
│       hybridAuth_Controller.php
│       insertarLlibre.php
│       llistatAdmin.php
│       logout.php
│       modificarLlibre.php
│       ordenarArticles.php
│       timeout.php
│       verificarPasswordToken.php
│       verificarUsuari.php
│       
├───lib
│   ├───hybridauth-3.11.0
│   └───PHPMailer-master
├───Model
│       connexio.php
│       llibres.php
│       usuari.php
│
└───Vista
    ├───estils.css
    │
    ├───articles
    │       articles.css
    │       articles.php
    │
    ├───assets
    │   ├───fotosUsuaris
    │   │       a.png
    │   │       dios.jpg
    │   │       Horari.jpg
    │   │       mono.jpg
    │   │       sazed.jpg
    │   │       sazed1.jpeg
    │   │
    │   └───images-work
    │           bibl.jpg
    │           eliminar.png
    │           logo.png
    │           lupa.png
    │           modificar.png
    │
    ├───barra_Busqueda
    │       barra.css
    │       barra.php
    │
    ├───canvi_Contrasenya
    │       canviContrasenya.css
    │       canviContrasenya.php
    │
    ├───canvi_Contrasenya_Token
    │       passwordToken.css
    │       passwordToken.php
    │
    ├───desplegable_Articles
    │       desplegable.css
    │       desplegable.php
    │
    ├───error
    │       error401.css
    │       error401.html
    │       error404.css
    │       error404.html
    │
    ├───header
    │       header.css
    │       header.php
    │
    ├───insert_Articles
    │       insert.css
    │       insert.php
    │
    ├───login
    │       login.css
    │       login.php
    │
    ├───login_Token
    │       correu.css
    │       correu.php
    │       vistaCorreu.html
    │
    ├───modificar_Articles
    │       modificar.css
    │       modificar.php
    │
    ├───modificar_Compte
    │       modificarCompte.css
    │       modificarCompte.php
    │
    ├───ordenacio_Articles
    │       ordenacio.css
    │       ordenacio.php
    │
    ├───paginacio
    │       paginacio.css
    │       paginacio.php
    │
    ├───signup
    │       signup.css
    │       signup.php
    │
    └───vista_Admin
            admin.css
            admin.php
</pre>

## Model - Vista - Controlador (MVC)  

El projecte està desenvolupat seguint l'arquitectura **Model-Vista-Controlador (MVC)**, que permet organitzar el codi en tres components principals:  

- **Model**  
  - Gestiona la interacció amb la base de dades.  
  - S'encarrega de les operacions de CRUD:  
    - **C**rear (inserir dades).  
    - **R**ecuperar (llegir dades).  
    - **U**pdate (actualitzar dades).  
    - **D**elete (eliminar dades).  
  - Garanteix una comunicació eficient i segura amb la base de dades.  

- **Vista**  
  - Responsable de mostrar les dades a l'usuari final.  
  - Genera la interfície d'usuari de manera visual i intuïtiva.  
  - Rep la informació del controlador i la presenta de forma clara.  

- **Controlador**  
  - Actua com a intermediari entre el model i la vista.  
  - Gestiona la lògica de negoci i les verificacions necessàries.  
  - Processa les sol·licituds de l'usuari i determina la resposta adequada.  
  - Passa les dades al model per interactuar amb la base de dades i proporciona els resultats a la vista.  

Aquesta estructura assegura una separació clara de responsabilitats, millorant la mantenibilitat, l'escalabilitat i l'organització del projecte.  

## Arrel del projecte  

A l'arrel del projecte hi trobem:  
- **4 carpetes**:  
  - **Model**: Conté els arxius responsables de la comunicació amb la base de dades.  
  - **Vista**: Inclou les plantilles i els arxius necessaris per mostrar la informació a l'usuari.  
  - **Controlador**: Gestiona la lògica de l'aplicació i les sol·licituds dels usuaris.  
  - **Lib**: Emmagatzema les llibreries necessàries, com **PHPMailer** per a l'enviament de correus i **HybridAuth** per a l'autenticació social.  

- **4 arxius**:  
  - **`.gitignore`**: Assegura que certs fitxers sensibles o innecessaris no es pugin al repositori de GitHub.  
  - **`.htaccess`**: Utilitzat per a gestionar rutes amigables, redirigir en cas d'errors i enmascarar les rutes del projecte.  
  - **`env.php`**: Emmagatzema informació sensible com usuaris, contrasenyes o claus d'accés de manera segura.  
  - **`index.php`**: L'arxiu principal del projecte, que importa modularment les vistes necessàries per mostrar contingut a l'usuari de la pàgina web.  

Aquesta estructura permet mantenir el codi organitzat, escalable i fàcil de gestionar.  


## Model

Model conté un total de tres arxius:
- **`connexio.php`**: Configura la connexió amb la base de dades. Utilitza PDO per establir una connexió segura i estable amb la base de dades.
- **`llibres.php`**: S'encarrega de tot el relacionat amb els llibres. Conté diverses funcions per realitzar operacions.

  - **`obtenirArticles()`**: Realitza una consulta a la base de dades per obtenir tots els articles de la taula `taula_articles`. Retorna un array associatiu amb tots els llibres disponibles.
  
  - **`obtenirArticlesUsuari($correuUsuari)`**: Obté tots els articles creats per un usuari específic, utilitzant el correu electrònic per filtrar la consulta. Retorna els articles associats al correu de l'usuari.
  
  - **`insertLlibre($isbn, $titol, $cos, $correuUsuari)`**: Insereix un nou llibre a la base de dades. Utilitza l'ISBN, el títol, la descripció (cos) i el correu de l'usuari com a paràmetres per crear un nou registre de llibre a la taula `taula_articles`.
  
  - **`eliminarLlibre($isbn)`**: Elimina un llibre de la base de dades mitjançant l'ISBN com a identificador.
  
  - **`comprovarLlibre($isbn)`**: Comprova si un llibre amb un ISBN determinat ja existeix a la base de dades. Retorna un registre associat amb el llibre si existeix, o `false` si no es troba.
  
  - **`obtenirLlibre($isbn)`**: Obté un llibre específic de la base de dades mitjançant el seu ISBN. Retorna el registre associat amb aquest ISBN.
  
  - **`actualitzarLlibre($isbn, $titol, $cos)`**: Actualitza les dades d'un llibre a la base de dades utilitzant l'ISBN com a identificador. Permet actualitzar el títol i la descripció (cos) del llibre especificat.
  
  - **`obtenirArticlesAsc($correu = null)`**: Obté tots els articles de la taula `taula_articles` ordenats per títol de manera ascendent. Si es passa un correu electrònic, només es mostraran els llibres creats per aquest usuari.
  
  - **`obtenirArticlesDesc($correu = null)`**: Obté tots els articles de la taula `taula_articles` ordenats per títol de manera descendent. Al igual que amb `obtenirArticlesAsc`, si es passa un correu, només es retornaran els llibres d'aquest usuari.

- **`usuari.php`**: S'encarrega de tot el relacionat amb els usuaris. Conté diverses funcions per realitzar operacions.

  - **`correuExisteix($correu)`**: Verifica si un correu ja existeix a la base de dades.
  
  - **`obtenirUsuari($correu)`**: Obté la informació d'un usuari a partir del seu correu electrònic.
  
  - **`afegirUsuari($nom, $correu, $contrasenya_hashed)`**: Afegix un nou usuari a la base de dades amb el nom, correu i contrasenya.
  
  - **`actualitzarContrasenya($correu, $nova_hashed)`**: Actualitza la contrasenya d'un usuari a la base de dades.
  
  - **`actualitzarNomUsuari($correu, $nouNom)`**: Actualitza el nom d'un usuari a la base de dades.
  
  - **`actualitzarFotoUsuari($correu, $rutaFoto)`**: Actualitza la foto d'un usuari a la base de dades.
  
  - **`obtenirUsuaris()`**: Obté tots els usuaris de la base de dades, mostrant el correu i el nom.
  
  - **`eliminarUsuari($correu)`**: Elimina un usuari de la base de dades.
  
  - **`guardarToken($correu, $token)`**: Desa el token de recuperació de contrasenya a la base de dades.
  
  - **`enviarCorreuRecuperacio($correu, $token)`**: Envia un correu de recuperació de contrasenya a l'usuari amb un token.
  
  - **`verificarToken($token)`**: Verifica si un token de recuperació de contrasenya és vàlid i retorna el correu associat.
  
  - **`eliminarToken($correu, $token)`**: Elimina el token de recuperació de contrasenya de l'usuari.
  
  - **`obtenirTempsToken($token)`**: Obtén el temps de creació d'un token de recuperació.
  
  - **`insertUsuariHybrid($nom, $correu, $foto, $provider)`**: Insereix un nou usuari mitjançant un proveïdor d'autenticació externa (com GitHub o Google). Es desaran el nom, correu, foto i el proveïdor d'autenticació.


## Controlador

- **`comprovacionsToken.php`**: Valida el correu electrònic, genera un token i envia un correu amb el token per a la recuperació de la contrasenya.
  
- **`comprovacionsUsers.php`**: Comprova si l'usuari ha iniciat sessió com a administrador o no.

- **`comprovmodificarLlibre.php`**: Verifica si existeix un ISBN per obtenir totes les dades del llibre i mostrar-les a la vista de modificació.

- **`controlPaginacio.php`**: Gestiona la paginació de la pàgina juntament amb els valors de cerca passats per GET.

- **`eliminarLlibre.php`**: Comprova si existeix un ISBN per poder eliminar el llibre de la base de dades.

- **`eliminarUsuari.php`**: Verifica que el correu electrònic de l'usuari estigui registrat abans de poder eliminar-lo.

- **`hybridAuth.php`**: Gestiona les dades obtingudes de l'autenticació mitjançant HybridAuth per realitzar la inserció a la base de dades.

- **`hybridAuth_Controller.php`**: Implementa l'autenticació OAuth mitjançant les dades obtingudes del servei de HybridAuth per a l'autenticació de l'usuari.

- **`insertarLlibre.php`**: Verifica que els camps obligatoris no estiguin buits i que almenys es proporcioni un ISBN per poder inserir el llibre a la base de dades.

- **`llistatAdmin.php`**: Crida la funció per llistar els usuaris i desa la informació en una variable per a la visualització.

- **`logout.php`**: Quan l'usuari decideix tancar la sessió, es destrueixen les sessións i es redirigeix a la pàgina d'inici.

- **`modificarLlibre.php`**: Comprova que els camps obligatoris no estiguin buits abans de realitzar l'actualització de les dades del llibre.

- **`ordenarArticles.php`**: Segons l'opció seleccionada a la llista, executa la funció per ordenar els articles de manera ascendent o descendent.

- **`timeout.php`**: Realitza un compte enrere per tancar la sessió de l'usuari si no ha realitzat cap acció durant un període determinat.

- **`verificarPasswordToken.php`**: Comprova que el token per a la recuperació de contrasenya existeixi a la base de dades i que no hagi caducat (més de 2 dies).

- **`verificarUsuari.php`**: Aquest fitxer conté diverses funcions per verificar i gestionar les accions relacionades amb els usuaris. Realitza comprovacions en diferents aspectes del registre, inici de sessió, canvi de contrasenyes, actualització de dades personals, entre altres. Les funcions estan dissenyades per assegurar que els usuaris introdueixin informació vàlida, mantenir la seguretat de les comptes i gestionar les seves dades de manera eficient.

### Funcions en `verificarUsuari.php`

#### **`signup`**
Funció per registrar un nou usuari. Realitza diverses comprovacions:
- Verifica que tots els camps estiguin complets.
- Valida el format de l'adreça de correu electrònic.
- Comprova que la contrasenya compleixi els requisits de seguretat (mínim 8 caràcters, majúscules, minúscules, números i símbols).
- Verifica que les contrasenyes coincideixin.
- Assegura que el correu no estigui ja registrat a la base de dades.
- Si tot és correcte, realitza el registre de l'usuari a la base de dades.

#### **`login`**
Funció per iniciar sessió. Realitza les següents comprovacions:
- Verifica que els camps de correu electrònic i contrasenya no estiguin buits.
- Valida que el correu existeixi a la base de dades.
- Si hi ha 3 o més intents fallits, activa el reCAPTCHA per evitar atacs de força bruta.
- Comprova que la contrasenya introduïda sigui correcta mitjançant `password_verify`.
- Si l'inici de sessió és correcte, desa la informació de l'usuari a la sessió (nom, correu, foto, etc.) i redirigeix l'usuari.

#### **`canviarContrasenya`**
Funció per canviar la contrasenya de l'usuari. Comprovacions que realitza:
- Verifica que els camps de la contrasenya antiga, nova i repetida no estiguin buits.
- Valida que la nova contrasenya compleixi els requisits de seguretat.
- Comprova que la nova contrasenya i la repetida coincideixin.
- Compara la contrasenya antiga amb la emmagatzemada a la base de dades.
- Si tot és correcte, actualitza la contrasenya a la base de dades.

#### **`actualitzarNom`**
Funció per actualitzar el nom de l'usuari:
- Verifica que el camp del nou nom no estigui buit.
- Assegura que el nou nom no sigui el mateix que l'actual.
- Actualitza el nom de l'usuari a la base de dades i a la sessió.

#### **`actualitzarFoto`**
Funció per actualitzar la foto de perfil de l'usuari:
- Verifica que no hi hagi errors en pujar la foto.
- Valida que el tipus de fitxer sigui JPEG o PNG.
- Mou la foto a la carpeta de destí al servidor.
- Actualitza la ruta de la foto a la base de dades i a la sessió.

#### **`actualitzarTot`**
Funció per actualitzar tant el nom com la foto de perfil de l'usuari:
- Realitza les mateixes comprovacions que `actualitzarNom` i `actualitzarFoto`.
- Actualitza tant el nom com la foto a la base de dades i a la sessió.


## Vista

Dins de la carpeta **Vista**, hi ha una estructura organitzada en carpetes per mantenir el projecte net i modular. Aquesta organització permet gestionar millor els estils i optimitzar la càrrega del CSS en cada pàgina.

### Organització

- Cada fitxer PHP dins de la vista té el seu propi fitxer CSS associat. 
- Aquest sistema facilita el manteniment del projecte, ja que els estils específics d'una pàgina es troben agrupats i són fàcils de localitzar i modificar.

### Funcionament dels CSS

1. **CSS individual per pàgina**:
   - Cada carpeta inclou un fitxer CSS exclusiu per gestionar els estils particulars d'aquella vista.
   - Això evita la sobrecàrrega d'estils innecessaris a les pàgines que no els requereixen.

2. **CSS principal**:
   - Existeix un fitxer CSS principal que importa els estils dels CSS individuals quan sigui necessari.
   - Això permet centralitzar estils comuns per mantenir la coherència visual a tot el projecte.
   - Exemples d'usos:
     - Estils globals (tipografia, colors generals, enllaços, etc.).
     - Classes reutilitzables en diverses pàgines.

3. **Importació dinàmica**:
   - Quan una pàgina requereix estils específics, només importa els CSS rellevants des del CSS principal.
   - Això optimitza el rendiment de la càrrega de la pàgina i facilita la personalització.

### Avantatges

- **Modularitat**: Cada pàgina és independent i pot tenir els seus estils personalitzats sense interferir amb altres pàgines.
- **Mantenibilitat**: Si cal modificar un estil, només s'ha d'editar el fitxer CSS específic o el principal, segons el cas.
- **Rendiment**: Només es carreguen els estils necessaris, cosa que redueix el temps de càrrega.
- **Escalabilitat**: Afegir noves pàgines o modificar les existents és fàcil i no afecta altres parts del projecte.

### Gestió de dades

Cadascuna de les vistes s'encarrega de gestionar les dades de l'usuari:
- Envia informació mitjançant **mètodes POST o GET** per ser validada al controlador.
- Això garanteix una interacció segura i eficient amb la pàgina web, permetent validar, processar i retornar respostes o missatges personalitzats segons sigui necessari.

## Seguretat

La seguretat és una part fonamental del projecte, i per això s'han implementat diverses mesures per protegir tant la funcionalitat com la informació del sistema.

### Implementació de `.htaccess`

- L'arxiu `.htaccess` s'utilitza per ocultar les rutes del projecte, de manera que els usuaris no poden veure les estructures internes del sistema des de la barra de navegació.
- Aquest fitxer ajuda a gestionar la seguretat i l'accés al projecte amb regles específiques:
  - Redireccions.
  - Control d'accés a directoris.
  - Protecció de fitxers sensibles.

### Gestió d'errors

S'han configurat respostes personalitzades per als següents errors HTTP:

1. **Error 401: Unauthorized**
   - Aquest error es mostra quan un usuari intenta accedir a una pàgina o recurs restringit sense tenir les credencials adequades.
   - Això assegura que només els usuaris autoritzats puguin accedir a certes parts del projecte.

2. **Error 404: Not Found**
   - Aquest error es retorna quan la ruta o el fitxer sol·licitat no existeix al servidor.
   - S'ha personalitzat una pàgina d'error per millorar l'experiència de l'usuari i guiar-lo cap a recursos útils o tornar-lo a la pàgina inicial.

### Avantatges de la implementació

- **Privadesa**: L'ús de `.htaccess` oculta detalls interns de la infraestructura del projecte.
- **Control d'accés**: Es limita l'accés a determinades parts del projecte basant-se en permisos.
- **Experiència d'usuari millorada**: Les pàgines d'error personalitzades proporcionen informació clara en cas de problemes.
- **Seguretat millorada**: Es redueix la possibilitat d'explotació de rutes o fitxers visibles no autoritzats.
