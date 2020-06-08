
OBJETIVO DO TESTE

Este aplicativo web mostra produtos à venda em uma loja. 
Um produto tem um nome, um preço, um período de inicio e fim para uma promoção e um preço para quando estiver em promoção. 
O produto pode ser vendido em vários países, por isso, seu nome e preço variam de acordo com a nacionalidade / língua do browser do cliente. 
Atualmente o aplicativo web é exibido em português com preços em reais, em inglês com preço em dólar e em francês com preço em euro. 

O aplicativo mostra todos os produtos que estão cadastrados com seus respectivos preços para uma determinada nacionalidade / língua. Para os produtos em promoção,
ele mostra quanto o usuário esta ganhando (precoAntigo - preçoNovo) e indica que o produto está em promoção.

Existe também uma API que mostra o produto mais vendido em uma determinada nacionalidade / língua 


Desenvolver as seguintes funcionalidades no aplicativo web:

a) Precisamos adicionar duas novas linguas: Espanhol e Russo

b) Atualmente os dados são inseridos via query em banco de dados, precisamos criar uma forma de adicionar novos produtos e alterar os produtos já existentes.

c) Para uma possível manutenção futura, precisamos que sejam criados testes unitários automatizados para garantir as funcionalidades existentes.


PRE-REQUISITO

1) Reformular a aplicação da melhor forma usando as melhores práticas.
2) Considere que o banco de dados pode ser trocado no futuro.
3) E caso a aplicação tenha muitos acessos simultâneos, precisamos prever uma arquitetura escalável para esta aplicação.


OBSERVAÇÃO

* Não utilizar ferramentas de terceiros a não ser para a escrita dos testes unitários. 



Prova 2:

Contextualização:

Implementar uma loja web com alguns produtos para vender. Um produto tem um nome, preço, um período de inicio e fim para uma promoção e um preço para quando estiver em promoção.

O produto pode ser vendido em vários países, por isso, seu nome e preço variam de acordo com a nacionalidade / língua do browser do cliente.

Atualmente o aplicativo web é exibido em português com preços em reais, em inglês com preço em dólar e em francês com preço em euro.

O aplicativo deve mostrar todos os produtos que estão cadastrados com seus respectivos preços para uma determinada nacionalidade / língua. Para os produtos em promoção, ele mostra quanto o usuário esta ganhando (precoAntigo - precoNovo) e indica que o produto está em promoção.

Existe também uma API que mostra o produto mais vendido em uma determinada nacionalidade / língua.

Desenvolver as seguintes funcionalidades no aplicativo web:

a) Adicionar duas novas línguas: Espanhol e Russo;
b) Atualmente os dados são inseridos via query em banco de dados, criar uma forma/mecanismo de adicionar novos produtos e alterar os produtos já existentes;
c) Criar os testes unitários automatizados para garantir as funcionalidades existentes.

Dicas:

Fique a vontade para reformular a aplicação - se preferir, pode reescreve-la ou fazer um refactoring.
Considere que o banco de dados pode ser trocado no futuro
Projetar a solução considerando um acesso massivo ao site


## Instalando e configurando ambiente

Foi realizada a refatoração do código conforme as especificações

## Requisitos

Você deve ter instalado Git, Docker, Docker-compose e Make para rodar com um comando.

A seguinte porta precisa estar disponivel:
- 8888 (api)

## Instalação

Acessar a pasta e rodar:


```
make up
```

O processo é bem rápido, mas pode demorar de acordo com a configuração do computador.

Após finalizar, devemos preparar o banco de dados, rode o seguinte comando:


```
make db_up
```

Para rodar os tests unitarios execute:


```
make tests_up
```


Será executado o script inicial do db e depois o migration do idioma

Após finalizar, basta acessar:

``
http://localhost:8888/
``


Obs.: Esta instação deve ser executada apenas 1x.

Os testes serão executados no final do processo.

