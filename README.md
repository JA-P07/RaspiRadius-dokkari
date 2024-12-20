## Radius projekti:

Tarvittavat työkalut: 
-raspi tai joku muu linuxia hyödyntävä järjestelmä
-usb-tikku tai sd kortti (riippuu järjestelmästä)
-käyttöjärjestelmän asennusohjelma (Rufus, Raspberry PI imager...)

Huomioita:
-Debian pohjaisilla käyttöjärjestelmillä on vähemmän tukia radiukseen liittyvien sovellusten kanssa, suosittelen käyttämään Ubuntun server-versiota.

Seurasin beamnetworks.dev -sivustolle julkaistua ohjetta radiuksen ja daloradiuksen konfiguroinnissa.
Linkki: https://docs.beamnetworks.dev/en/linux/networking/freeradius-daloradius 

Ohjeen jälkeen lisäsin kaksi tiedostoa osoitteeseen /var/www/html tiedostojen nimet ovat register.html ja register.php, molempien tiedostojen koodi löytyy tästä reposta. Kyseisten tiedostojen tarkoituksena on luoda käyttäjä, jota voidaan käyttää kirjautumaan verkkoon, jossa kyseinen radius-palvelin pyörii.

Mikäli jatkat siitä mihin minä jäin, Raspin nimi on "raspberryRadius", sen käyttäjänimi on "admin" ja salasana puolestaan "salakala". 