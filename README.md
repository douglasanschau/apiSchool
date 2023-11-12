
# Instalação
Após baixar ou clonar repositório é necessário seguir algumas para funcionamento da School API:<br><br>

1º Passo: Rodar o comando <b>composer install --no-dev</b>.<br>
2º Passo: Rodar o comando <b>composer update</b>.<br>
3º Passo: Configuração de Database (passo detalhado no tópico abaixo).

# Database Config
É necessário configurar seu banco de dados MySQLi. Para isso é necessário alguns passos. <br><br>

1º Download do banco de dados: https://drive.google.com/drive/folders/1FdcJuJtq9bdy-UQhGkjSsz6Y0E0o73DJ?usp=sharing<br>
2º Subir os arquivos baixados para o banco mysql local;<br>
3º Configurar o arquivo .env com os dados do seu banco: hostname, database (nome do database com os arquivos baixados), username, password;<br>
4º Configurar o arquivo 'app/config/Database.php' com os dados do seu banco: hostname, database (nome do database com os arquivos baixados), username, password. <br>
As informações devem ser incluidas no arquivo public array $defaul.;

# Rodar Aplicação
Para rodar a aplicação basta digitar o comando <b>php spark serve</b>.<br>
<b>Atenção:</b></b><br>
A porta deve ser a <b>http://localhost:8080</b>, para rodar nesta porta especifica pode rodar o comando php spark serve --port=8080.

# Configurações de Desenvolvimento
Versão do PHP: PHP 8.2.12<br>
Versão do Composer:  2.6.5

# APP School
O App School é o front end desta aplicação, para poder testar todas as funcionalidades dessa API é necessário fazer download e instalação do APP.<br>
O link de instalação segue ao lado: https://github.com/douglasanschau/appSchool

