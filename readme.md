test-dev
Un stagiaire à créer le code contenu dans le fichier src/Controller/Home.php

Celui permet de récupérer des urls via un flux RSS ou un appel à l’API NewsApi. Celles ci sont filtrées (si contient une image) et dé doublonnées. Enfin, il faut récupérer une image sur chacune de ces pages.

Le lead dev n'est pas très satisfait du résultat, il va falloir améliorer le code.

Pratique :

Revoir complètement la conception du code (découper le code afin de pouvoir ajouter de nouveaux flux simplement)
Questions théoriques :


Que mettriez-vous en place afin d'améliorer les temps de réponses du script

les temps de réponses du script, voici quelques recommandations :

1. Utiliser le cache Symfony pour optimiser les performances en stockant temporairement les résultats de certaines opérations ou requêtes récurrentes.

2. Mettre en cache côté client pour réduire la charge sur le serveur en permettant aux navigateurs de stocker localement des ressources statiques.

3. Optimiser la base de données en :

    - Indexant correctement les tables pour accélérer les recherches et les jointures.

    - Optimisant les requêtes en utilisant des outils tels que le Symfony Profiler, EXPLAIN et Blackfire pour analyser et améliorer les performances des requêtes SQL.

4. Optimiser les assets en utilisant Webpack Encore pour regrouper, minimiser et compresser les fichiers CSS et JavaScript, réduisant ainsi le temps de chargement des pages web.


Comment aborderiez-vous le fait de rendre scalable le script (plusieurs milliers de sources et images)

Pour rendre un script scalable pour gérer plusieurs milliers de sources et images dans un projet Symfony, ElasticSearch peut être une solution puissante.