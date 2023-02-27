# RCL eSport Team

## Description

## Routes

| Route              | Méthode | Description                                                                                                               | Usable ? |
|--------------------|---------|---------------------------------------------------------------------------------------------------------------------------|----------|
| /api/articles      | GET     | Récupérer la liste des articles                                                                                           | YES      |
| /api/articles/{id} | GET     | Récupérer un article spécifique                                                                                           | YES      |
| /api/comments      | POST    | Créer un commentaire <br/> Doit contenir les champs "article" (id de l'article) et "message" (message du commentaire)     | NO       |
| /api/matches       | GET     | Récupérer la liste des matchs                                                                                             | YES      |
| /api/members       | GET     | Récupérer la liste des membres de notre équipe                                                                            | YES      |
| /api/users         | POST    | Création d'un utilisateur (Inscription) Doit contenir les champs "username", "email" et "password". Role par défaut: User | YES      |
| /api/video-clips   | GET     | Récupérer la liste des video clips                                                                                        | YES      |
| /api/apply         | POST    | Créer une candidature dans la base de donnée.  Doit contenir les champs ?.                                                | NO       |
