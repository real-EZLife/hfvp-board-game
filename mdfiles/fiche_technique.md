# Fiche technique avancement

## Ce qui fonctionne dans le code PHP

### Le jeu

- Un systeme de tours
- Un objet lobby (ou partie) permettant de piloter les autres objets composants le jeu
- La possibilité d'identifier une partie par rapport à un id de partie
- Persistance des données

PS: Une fois la vrai base de donnée mise en place les fonctionnalités de sauvegardes seront à refondre 

### Card Manager

- Fonctionnel excepté pour la partie permettant d'enregistrer les modications en base de données
- Surement à refondre en même temps que la sortie de la vraie bdd

## Ce qui est en route

- Séparation des préoccupations via implémentation d'une archi MVC pour les fichiers du jeu
- Doc complète via des commentaires

## Ce qui ne fonctionne pas

- Intéractivité du joueur via l'interface (excepté le bouton fin de tour haha)

## Durées

- Card Manager: 2 semaines
- Refontes: 1 mois
- Interface et interactivité du jeu: 2 mois
- Debug: 2 mois