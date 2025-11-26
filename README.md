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


