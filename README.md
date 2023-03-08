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
| /api/users         | POST    | Création d'un utilisateur (Inscription) Doit contenir les champs "nickname", "email" et "password". Role par défaut: User | YES      |
| /api/users/check   | GET     | Vérifie si le token est expiré. Si expiré: "401 Expired JWT Token", sinon "200 JWT Token still valid"                     | YES      |
| /api/video-clips   | GET     | Récupérer la liste des video clips                                                                                        | YES      |
| /api/apply         | POST    | Créer une candidature dans la base de donnée.  Doit contenir les champs "name", "email", "phoneNumber", "presentation".   | NO       |
| /api/users         | PATCH   | Changer les infosrmations d'un user.  Doit contenir l'un des 3 champs ou les 3 champs: "email", "password", "nickname",   | YES      |
| /api/users         | DELETE  | Supprimer un user.  Doit contenir les champs "email", "password",                                                         | NO       |
| /api/users         | PATCH   | Changer les infosrmations d'un user.  Doit contenir l'un des 3 champs ou les 3 champs: "email", "password", "nickname",   | YES      |
| /api/users         | DELETE  | Supprimer un user.                                                                                                        | NO       |
