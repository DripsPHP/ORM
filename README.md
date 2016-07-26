# ORM

[![Build Status](https://travis-ci.org/Prowect/ORM.svg)](https://travis-ci.org/Prowect/ORM)
[![Code Climate](https://codeclimate.com/github/Prowect/ORM/badges/gpa.svg)](https://codeclimate.com/github/Prowect/ORM)
[![Test Coverage](https://codeclimate.com/github/Prowect/ORM/badges/coverage.svg)](https://codeclimate.com/github/Prowect/ORM/coverage)
[![Latest Release](https://img.shields.io/packagist/v/drips/ORM.svg)](https://packagist.org/packages/drips/orm)

Object-Relational-Mapper basierend auf [Propel](http://propelorm.org)

 - **Konfiguration:** siehe [Database-Konfiguration](https://github.com/Prowect/Database#konfiguration)
 - **Verwendung:** siehe [Propel-Dokumentation](http://propelorm.org/documentation/)
 
> **Anmerkungen**
>
> - Ist wird automatisch installiert
> - Konfiguration erfolgt mithilfe [Config](https://github.com/Prowect/Config) von Drips
> - `php propel` anstelle von `propel` zum Ausführen verwenden
> - Beim `php propel reverse` muss die generierte `schema.xml` ins `src`-Verzeichnis kopiert werden!
> - Unbedingt beim Reverse den Namespace angeben: `php propel reverse --namespace=\\models`