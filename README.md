# NFE102 - Seedly

## Pré-requis
* Avoir une version de docker à jour : `>= 1.12`

* Avoir une version de docker-compose à jour : `>= 1.9`


## Installation des containers docker

```bash
git clone https://github.com/kermit6000/nfe102-ecom-project.git ~/projets/nfe102-ecom
cd ~/projets/nfe102-ecom

docker-compose up -d
```

## Installation de la base de donnée

```bash
cat ~/projets/nfe102-ecom/bin/scripts/ecom.sql | docker exec -i -u www-data ecom_web_1 mysql -uroot -proot -hdb ecom
``` 

