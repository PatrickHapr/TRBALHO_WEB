Tecnologia em Análise e Desenvolvimento de Sistemas

Setor de Educação Profissional e Tecnológica - SEPT

Universidade Federal do Paraná - UFPR

---

*DS122 - Desenvolvimento Web 1*

1. Patrick Alves Bastos - GRR20230996
2. Helena Rigoni dos Santos - GRR20235519



# Trabalho Prático 01/2023 -  Sistema de Jogo de Luta por Turnos - Fantasy Fight

Implementação de um jogo de digitação utilizando Javascript e usando PHP para armazenar e exibir quadros de pontuação.

## Para executar o jogo, siga os seguintes passos iniciais: 

1. Realizar o clone do projeto na pasta raiz do seu servidor web;
2. Alterar o arquivo 'db_credentials.php' com os dados do seu MySQL;
3. Acessar o arquivo 'create_db_tables.php' pelo navegador para que o banco de dados seja criado;
4. Acessar o arquivo 'index.php' pelo navegador.

## Descrição

O sistema desenvolvido é um jogo de luta por turnos que combina elementos de digitação para realizar ataques. Os jogadores controlam uma heroína e devem escolher os golpes ou itens desejados por meio de digitação. Em seguida, selecionam o inimigo alvo e digitam palavras exibidas na tela para concretizar o ataque.

## Funcionamento

- **Registro de Usuário:**
  - Durante o registro, o usuário deve fornecer nome, e-mail, escolher o ranking, senha e confirmar a senha;
  - A senha deve ter no mínimo 8 caracteres, incluindo letras maiúsculas, minúsculas e, ao menos, um carácter especial;
  - O sistema faz a validação tanto no front-end quanto no back-end.
- **Banco de Dados:**
  - São criadas duas tabelas:
    - Tabela de Usuários:
      - Campos: id, nome, e-mail (único), senha e liga.
    - Tabela de Pontuação:
      - Campos: id (chave estrangeira da tabela de Usuários), pontuação e data da pontuação.
- **Mecânica de Digitação:**
  - O jogador pode digitar em qualquer lugar da tela, sem a necessidade de um campo específico;
  - Seleciona o inimigo alvo digitando o nome dele;
  - Durante a digitação, se o jogador acertar o tipo de ataque desejado ou o nome do vilão, o texto digitado fica verde para indicar acerto;
  - Por fim, é necessário digitar uma certa quantidade de palavras que aparecem na tela para efetuar o ataque;
  - Cada letra digitada corretamente é destacada em verde para indicar acerto;
  - Quanto mais rápido o jogador concluir a digitação, mais pontos serão ganhos.
- **Pontuação e Resultados:**
  - Se o jogador for derrotado, não ganhará pontos. Em seguida, aparecerá a tela de "Game Over";
  - Ao derrotar os três inimigos, a pontuação é enviada.
- **Histórico de Partidas:**
  - São mostradas as 10 últimas partidas do usuário no histórico.
- **Rankings:**
  - Os rankings exibem os 10 melhores jogadores de cada categoria escolhida.
- **Design:**
  - Para auxiliar no design, foi utilizado o framework Bootstrap.

*Este projeto foi desenvolvido como parte do Trabalho Prático 01/2023 da disciplina DS122.*
