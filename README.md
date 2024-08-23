# 💻 Stack Utilizada

- Este projeto utiliza o [PHP](https://www.php.net/) na versão 8.2.
- Para os testes, é utilizado o [PHPUnit](https://phpunit.de) na versão 10.
- Para o versionamento, foi utilizado o [Git](https://git-scm.com).
- Para o set-up no ambiente de desenvolvimento, foi utilizado o [Docker](https://www.docker.com).

# ⚡️ Como Instalar

- Acesse algum diretório de sua preferência e baixe o projeto, usando:
```
git clone https://github.com/CmoratoJ/loteria-api.git
```
- Acesse o diretório monetizze-api:
```
cd loteria-api/  
```
- O projeto roda utilizando o docker portanto certifique-se de tê-lo instalado:

- Com o docker instalado rode o comando
```
docker-compose up -d
```
- Acesse o container com o comando:
```
docker exec -it monetizze-loteria bash
```
- Execute o comando:
```
composer install
```
✅ Pronto! Agora você está pronto para usar o projeto na sua máquina com essas etapas simples.

- Para gerar os tickets basta acessar a rota alterando os parâmetros para a quantidade de bilhetes e numero de dezenas que deseja:
```
http://localhost:8000/generate?quantity=5&num_dezenas=6
```
- Para verificar os acertos basta acessar a rota alterando os parâmetros para a quantidade de bilhetes e numero de dezenas que deseja:
```
http://localhost:8000/compare?quantity=5&num_dezenas=6
```

- Para a execução dos testes unitários basta acessar o container com o comando:
```
docker exec -it monetizze-loteria bash
```
- Após acessar o container execute o comando:
```
php vendor/bin/phpunit tests
```
