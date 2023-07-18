## Symfony advanced ++ ##
### double auth (form + jwt) ###
- classic login auth :
  - make:user / make:auth / make:registration-form
- jwt auth : 
  - install openssl : https://slproweb.com/products/Win32OpenSSL.html
  - suivre doc : https://symfony.com/bundles/LexikJWTAuthenticationBundle/current/index.html
  - url de connexion bearer : https://127.0.0.1:8000/api/login_check
    - bien rajouter dans le header de la requete : Content-Type application/json
    - json_exemple : {"username":"jules@drosalys.fr","password":"Drosalys63@"}

                les routes du controller doivent commencer ensuite par /api pour gérer la connexion token
                bearer avec postamn -> onglet auth, type : Bearer Token (value sans cote !)
  - fichier ajouter/modifer après installation : 
    - config/packages/security.yaml (firewall login & api)
    - src/Controller/HomeController

### heritage d'entité ###
- Ajouter au dessus de la mère : #[MappedSuperclass]
    - use Doctrine\ORM\Mapping\MappedSuperclass;
    - propriété en protected

### lifecycle simple ###
- Au dessus de la class : #[ORM\HasLifecycleCallbacks]
- function a rajouté pour exemple : 
`
#[ORM\PrePersist]
public function setCreatedAtValue(): void
{
$this->createdAt = new \DateTime();
} `

### doctrine listener avancé TODO ###
TODO

### nested_from + prototype + formListener ###
- Voir full exemple dans : 
  - src/Controller/GameController
  - src/Form/GameType
  - templates/game/index.html.twig

### validation form ###
- exemple sur src/Entity/Product
- https://symfony.com/doc/current/reference/constraints/Length.html

### brevo ###
- creation de compte : https://app.brevo.com/
- doc api : https://developers.brevo.com/docs/send-a-transactional-email
  - parametrer clef api puis conserver
  - voir full exemple dans src/Command/SendTestMailCommand

### serializer + groups ###
TODO

### translation ###
TODO

### form template ###
TODO