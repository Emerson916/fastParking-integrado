## FastParking - Como testar a API

O arquivo para criar a estrutura do banco é o bd.sql

Clique aqui para acessa-lo -->
<a href="https://github.com/Emerson916/fastParking-integrado/blob/main/backend/bd.sql"> Banco de Dados </a>

------------------------------------------------

Caso queira configuar o vhosts é o hosts, assim não será preciso motivar a url nos arquivos de javaScript<br>

Acesse C:/xampp/apache/conf/extra/httpd-vhosts.conf 

Copie e cole nas últimas linhas dentro do httpd-vhosts.conf
```bash
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host2.fastparking.com.br
    DocumentRoot "C:\xampp\htdocs\fastParking-integrado\backend"
    ServerName api.fastparking.com.br
    ErrorLog "logs/api.fastparking.com.br-error.log"
    CustomLog "logs/api.fastparking.com.br-access.log" common
</VirtualHost>
```

Acesse C:/Windows/System32/drivers/etc/hosts

Copie e cole na últimas linhas dentro do hosts
```bash
127.0.0.1 api.fastparking.com.br
```
É preciso reiniciar o xampp, para funcionar!

Lembrando, depois de testar o projeto, é preciso apagar ou comentar o VirtualHost é o hosts, que acabamos de colocar, ou todo projeto que você abrir será redirecionado para o projeto do FastParking.
