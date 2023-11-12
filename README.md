# Instalação
Após baixar ou clonar repositório é necessário seguir algumas para funcionamento da School API:

1º Passo: Rodar o comando <b>composer install --no-dev</b>.
2º Passo: Rodar o comando <b>composer update</b>.
3º Passo: Configuração de Database (passo detalhado no tópico abaixo).

# Database Config
É necessário configurar seu banco de dados MySQLi. Para isso é necessário alguns passos.

1º Download do banco de dados: https://drive.google.com/drive/folders/1FdcJuJtq9bdy-UQhGkjSsz6Y0E0o73DJ?usp=sharing
2º Subir os arquivos baixados para o banco mysql local;
3º Configurar o arquivo .env com os dados do seu banco: hostname, database (nome do database com os arquivos baixados), username, password;
4º Configurar o arquivo 'app/config/Database.php' com os dados do seu banco: hostname, database (nome do database com os arquivos baixados), username, password. <br>
As informações devem ser incluidas no arquivo public array $defaul.;

# Rodar Aplicação
Para rodar a aplicação basta digitar o comando <b>php spark serve</b>.
<b>Atenção:</b></b>
A porta deve ser a <b>http://localhost:8080</b>, para rodar nesta porta especifica pode rodar o comando php spark serve --port=8080.

# Configurações de Desenvolvimento
Versão do PHP: PHP 8.2.12
Versão do Composer:  2.6.5
