# Sistema de concessionária de Veículos

Este projeto é um sistema concessionária de veículos desenvolvido para fins educacionais na disciplina de Programação III. Ele utiliza PHP, MySQL (PDO), HTML, CSS e jQuery/AJAX. Diferente de sistemas tradicionais, este projeto utiliza Requisições Assíncronas (AJAX) para realizar as operações de cadastro e edição em janelas modais, sem a necessidade de recarregar a página inteira, proporcionando uma experiência de usuário mais fluida.

# O sistema inclui

-Login/Logout com segurança avançada (hash de senha password_hash).

-Dashboard com estatísticas (total de veículos, carro mais novo, marcas populares).

-CRUD completo de veículos (adicionar, editar, excluir, listar) via Modal.

-Upload de Imagens com gerenciamento automático (exclusão de foto antiga ao atualizar/deletar).

-Pesquisa Dinâmica com filtros por ID, Marca ou Modelo(inicial de cada).

# Instalação e Configuração
 ## Importar banco de dados:
-Abra o phpMyAdmin ou sua ferramenta de SQL preferida.

-Crie um banco de dados chamado veiculos.

-Execute o script SQL contido no arquivo  bd.txt  para criar as tabelas e o usuário administrador.

##  Configurar conexão
-Abra o arquivo conecta.php.

-Verifique se as credenciais ($host, $user, $pass, $dbname) correspondem ao seu ambiente local (XAMPP/WAMP geralmente usam root e senha vazia).

## Permissões
-Certifique-se de que existe uma pasta chamada uploads/ na raiz do projeto.

-Garanta que essa pasta tenha permissão de escrita para salvar as imagens dos veículos.

# Estrutura do projeto

projeto_veiculos/
│
├─ uploads/                # Pasta onde as imagens dos veículos são salvas
├─ conecta.php             # Configuração de conexão com o banco (PDO)
├─ protecao.php            # Script de verificação de sessão (Segurança)
│
├─ login.php               # Tela de login
├─ cadastro_usuario.php    # Tela de criação de conta
├─ dashboard.php           # Painel de controle (Estatísticas)
├─ lista_editar.php        # Tabela principal (Listagem de veículos)
│
├─ formulario.php          # HTML do formulário de cadastro (carregado via Modal)
├─ editar.php              # HTML do formulário de edição (carregado via Modal)
├─ procurar.php            # HTML da tela de pesquisa
│
├─ inserir_ajax.php        # Backend: Processa inserção + Upload
├─ atualizar_ajax.php      # Backend: Processa edição + Troca de imagem
├─ deletar_ajax.php        # Backend: Exclui registro e arquivo de imagem
├─ buscar_veiculos_ajax.php # Backend: Filtra a pesquisa
├─ login_validar.php       # Backend: Valida senha e cria sessão
├─ inserir_usuario.php     # Backend: Cria novo usuário com Hash
│
├─ estilo.css              # Estilos gerais do sistema
└─ README.md               # Documentação do projeto

# Funcionalidades

Com certeza! Baseado em todo o código que desenvolvemos juntos (CRUD com AJAX, Upload de Imagens, Login com Hash e Dashboard), aqui está o README.md adaptado exatamente para o seu projeto, seguindo a estrutura do seu exemplo.

Você pode criar um arquivo chamado README.md na pasta do seu projeto e colar o conteúdo abaixo:

Sistema de Gerenciamento de Veículos
Descrição
Este projeto é um sistema de cadastro e gestão de veículos desenvolvido para fins educacionais. Ele utiliza PHP, MySQL (PDO), HTML, CSS e jQuery/AJAX. Diferente de sistemas tradicionais, este projeto utiliza Requisições Assíncronas (AJAX) para realizar as operações de cadastro e edição em janelas modais, sem a necessidade de recarregar a página inteira, proporcionando uma experiência de usuário mais fluida.

O sistema inclui:

Login/Logout com segurança avançada (hash de senha password_hash).

Dashboard com estatísticas (total de veículos, carro mais novo, marcas populares).

CRUD completo de veículos (adicionar, editar, excluir, listar) via Modal.

Upload de Imagens com gerenciamento automático (exclusão de foto antiga ao atualizar/deletar).

Pesquisa Dinâmica com filtros por ID, Marca ou Modelo.

Instalação e Configuração
1. Importar banco de dados:
Abra o phpMyAdmin ou sua ferramenta de SQL preferida.

Crie um banco de dados chamado veiculos.

Execute o script SQL abaixo (ou importe o arquivo .sql se houver) para criar as tabelas e o usuário administrador:

SQL

CREATE DATABASE IF NOT EXISTS veiculos;
USE veiculos;

-- Tabela de Usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de Veículos
CREATE TABLE IF NOT EXISTS veiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(100) NOT NULL,
    marca VARCHAR(100) NOT NULL,
    ano INT NOT NULL,
    imagem VARCHAR(255) NULL 
);

-- Usuário Padrão (Senha: 123)
INSERT IGNORE INTO usuarios (email, senha) VALUES 
('admin@teste.com', '$2y$10$tM2s8XFz/g8e.jCqC/gOZOj.5wXzQyKj.g/5.y5.y5.y5.y5.y5');
2. Configurar conexão:
Abra o arquivo conecta.php.

Verifique se as credenciais ($host, $user, $pass, $dbname) correspondem ao seu ambiente local (XAMPP/WAMP geralmente usam root e senha vazia).

3. Permissões:
Certifique-se de que existe uma pasta chamada uploads/ na raiz do projeto.

Garanta que essa pasta tenha permissão de escrita para salvar as imagens dos veículos.

Estrutura do projeto
Plaintext

projeto_veiculos/
│
├─ uploads/                # Pasta onde as imagens dos veículos são salvas
├─ conecta.php             # Configuração de conexão com o banco (PDO)
├─ protecao.php            # Script de verificação de sessão (Segurança)
│
├─ login.php               # Tela de login
├─ cadastro_usuario.php    # Tela de criação de conta
├─ dashboard.php           # Painel de controle (Estatísticas)
├─ lista_editar.php        # Tabela principal (Listagem de veículos)
│
├─ formulario.php          # HTML do formulário de cadastro (carregado via Modal)
├─ editar.php              # HTML do formulário de edição (carregado via Modal)
├─ procurar.php            # HTML da tela de pesquisa
│
├─ inserir_ajax.php        # Backend: Processa inserção + Upload
├─ atualizar_ajax.php      # Backend: Processa edição + Troca de imagem
├─ deletar_ajax.php        # Backend: Exclui registro e arquivo de imagem
├─ buscar_veiculos_ajax.php # Backend: Filtra a pesquisa
├─ login_validar.php       # Backend: Valida senha e cria sessão
├─ inserir_usuario.php     # Backend: Cria novo usuário com Hash
│
├─ estilo.css              # Estilos gerais do sistema
└─ README.md               # Documentação do projeto

# Funcionalidades

## Controle de Acesso
-Sistema de login protegido contra acesso direto via URL.

-Senhas criptografadas no banco de dados.

-Bloqueio de páginas internas para usuários não logados.

## Gestão de Veículos (CRUD)
-Adicionar: Cadastro via modal com upload de foto.

-Listar: Visualização em tabela com preview da imagem ao passar o mouse.

-Editar: Atualização de dados e substituição inteligente de imagem (apaga a antiga do servidor).

-Excluir: Remoção física da imagem e do registro no banco via AJAX.

## Dashboard e Pesquisa
-Painel visual com contadores e resumo de dados.

-Pesquisa em tempo real sem recarregar a página, filtrando por ID, Marca ou Modelo.




