=== Plugin Name ===
Contributors: RIPU Com
Donate link: http://www.ripucom.de/
Tags: plugin, wordpress, kontakt, manager, vcard, export, contact, manager, exportieren
Requires at least: 2.0.2
Tested up to: 2.7
Stable tag: 1.1

Plugin zum Verwalten von Kontakten

== Description ==

**Wichtig:

Damit dieses Plugin benutzt werden kann, muss das [RIPU Com Wordpress Plugin Framework](http://www.ripucom.de/opensource/ripu-com-plugin-framework) installiert sein!**






Mit dem Kontakt Manager von RIPU Com kann man Kontakte einfach verwalten und für Outlook oder ähnliches als vCard exportieren.

Mehr Informationen zum Plugin findet man auf der [RIPU Com Webseite](http://www.ripucom.de/) oder direkt auf der Seite [RIPU Com Wordpress Kontakt Manager](http://www.ripucom.de/opensource/ripu-com-kontakt-manager)

Thanks to famfamfam for the icons!

== Screenshots ==
[Wordpress Kontakt Manager - Screenshot #1](http://www.ripucom.de/wp-content/lab-e280ba-kontakt-manager-ubersicht-e28094-wordpress_12234664452381.png)

[Wordpress Kontakt Manager - Screenshot #2](http://www.ripucom.de/wp-content/lab-e280ba-kategorie-verwaltung-e28094-wordpress_12234664556312.png)

[Wordpress Kontakt Manager - Screenshot #3](http://www.ripucom.de/wp-content/lab-e280ba-kategorie-verwaltung-e28094-wordpress_12234664556312.png)

== Installation ==

**Wichtig:

Damit dieses Plugin benutzt werden kann, muss das [RIPU Com Wordpress Plugin Framework](http://www.ripucom.de/opensource/ripu-com-plugin-framework) installiert sein!**

SQL Installation

Folgender SQL-Befehl ist zum Aufsetzen der Datenbank-Struktur, die das Wordpress Plugin benötigt, von Nöten:

CREATE TABLE `cm_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
)

--
-- Tabellenstruktur für Tabelle `cm_contacts`
--

CREATE TABLE `cm_contacts` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `image` varchar(100) collate latin1_general_ci NOT NULL,
  `name` varchar(100) collate latin1_general_ci NOT NULL,
  `surname` varchar(100) collate latin1_general_ci NOT NULL,
  `sex` varchar(100) collate latin1_general_ci NOT NULL,
  `street` varchar(100) collate latin1_general_ci NOT NULL,
  `zip` varchar(5) collate latin1_general_ci NOT NULL,
  `town` varchar(100) collate latin1_general_ci NOT NULL,
  `country` varchar(100) collate latin1_general_ci NOT NULL,
  `phone` varchar(100) collate latin1_general_ci NOT NULL,
  `mobile` varchar(100) collate latin1_general_ci NOT NULL,
  `fax` varchar(100) collate latin1_general_ci NOT NULL,
  `email` varchar(100) collate latin1_general_ci NOT NULL,
  `website` varchar(100) collate latin1_general_ci NOT NULL,
  `notice` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
);

Das Archiv in den Ordner

/wp-content/plugins/

entpackt und aus dem Adminmenü von Wordpress aus aktiviert.

Danach die Verzeichnisse

/wp-content/plugins/ripu-com-kontaktmanager/vcards/

/wp-content/plugins/ripu-com-kontaktmanager/images/

CHMOD 777 setzen.

== Changelog ==

Version 1.0

    * Hinzufügen/Bearbeiten von Kategorien
    * Hinzufügen/Bearbeiten von Kontakten
    * vCard Export