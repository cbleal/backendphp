DROP TABLE IF EXISTS backup;

CREATE TABLE `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `funcionario` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS cargos;

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO cargos VALUES("2","Gerente");
INSERT INTO cargos VALUES("3","Administrador");
INSERT INTO cargos VALUES("4","Funcionario");
INSERT INTO cargos VALUES("5","Tesoureiro");
INSERT INTO cargos VALUES("6","Tecnico");


DROP TABLE IF EXISTS clientes;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

INSERT INTO clientes VALUES("16","maur�cio","(89) 99942-3456","avenida 1","gggg@ggg.com","111","2019-09-06");
INSERT INTO clientes VALUES("22","andr�","(89) 99979-3434","rua guabiraba sn","teste2@gmail.com","222111","2019-09-07");
INSERT INTO clientes VALUES("23","genival","(89) 34223-388","avenida lobo","lobo@bol.com.br","333","2019-09-07");
INSERT INTO clientes VALUES("24","aparecido simon","(89) 99459-8721","rua das mangas","aparecidos@gmail.com","234.568.901-23","2019-09-07");
INSERT INTO clientes VALUES("25","Afranio Sá","(89) 99983-8328","Av, Sen. Helvidio Nunes","afraniosa@hotmail.co","555.555.555-55","2019-09-24");


DROP TABLE IF EXISTS compras;

CREATE TABLE `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `produto` varchar(100) NOT NULL,
  `funcionario` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO compras VALUES("2","120.00","Memória 4GB DDR3 Desktop","Felipe","2019-09-27","Efetuada");
INSERT INTO compras VALUES("3","4.75","Mouse USB Fortrek","Claudinei","2019-10-01","Efetuada");


DROP TABLE IF EXISTS funcionarios;

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `cargo` varchar(20) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO funcionarios VALUES("2","Claudinei","527.389.143-49","(89) 99942-3456","rua santa filomena, 655","Administrador","2019-09-07");
INSERT INTO funcionarios VALUES("3","Nubia","111.111.111-12","(89) 99979-2135","rua filomena portela","Gerente","2019-09-08");
INSERT INTO funcionarios VALUES("5","Felipe","222.222.222-22","(22) 22222-2222","rua 4","Tesoureiro","2019-09-08");
INSERT INTO funcionarios VALUES("6","Hallan Santos","333.333.333-33","(33) 33333-3333","sao jose do piaui","T�cnico","2019-09-08");
INSERT INTO funcionarios VALUES("7","Lady-Anne","444.444.444-44","(44) 44444-4444","santana do piaui","Funcionario","2019-09-08");


DROP TABLE IF EXISTS gastos;

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `funcionario` varchar(50) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO gastos VALUES("16","58.62","conta set-2019 agua","Claudinei","2019-09-25");


DROP TABLE IF EXISTS movimentacoes;

CREATE TABLE `movimentacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  `movimento` varchar(20) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `funcionario` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `id_gasto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO movimentacoes VALUES("9","Saida","Gasto","58.62","Claudinei","2019-09-25","16");
INSERT INTO movimentacoes VALUES("10","Entrada","Venda","220.00","Felipe","2019-09-27","1");
INSERT INTO movimentacoes VALUES("11","Saida","Compra","120.00","Felipe","2019-09-27","1");
INSERT INTO movimentacoes VALUES("12","Saida","Compra","120.00","Felipe","2019-09-27","2");
INSERT INTO movimentacoes VALUES("13","Entrada","Servico","80.00","Hallan Santos","2019-09-27","6");
INSERT INTO movimentacoes VALUES("14","Saida","Pagamento","120.00","Felipe","2019-09-29","1");
INSERT INTO movimentacoes VALUES("15","Saida","Compra","4.75","Claudinei","2019-10-01","3");
INSERT INTO movimentacoes VALUES("16","Entrada","Venda","12.00","Claudinei","2019-10-01","2");


DROP TABLE IF EXISTS orcamentos;

CREATE TABLE `orcamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(15) NOT NULL,
  `tecnico` varchar(50) NOT NULL,
  `produto` varchar(50) NOT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `problema` varchar(255) NOT NULL,
  `laudo` varchar(255) DEFAULT NULL,
  `observacoes` varchar(255) DEFAULT NULL,
  `valor_servico` decimal(10,2) DEFAULT NULL,
  `pecas` varchar(255) DEFAULT NULL,
  `valor_pecas` decimal(10,2) DEFAULT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `desconto` decimal(10,2) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `pgto_tipo` varchar(20) DEFAULT NULL,
  `data_abertura` date NOT NULL,
  `data_geracao` date DEFAULT NULL,
  `data_aprovacao` date DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO orcamentos VALUES("2","111","6","Celular Xiaomi 64GB","65498328","Não liga","a bateria estava com defeito, por isso foi trocada.","nenhuma","80.00","bateria original","200.00","280.00","0.00","280.00","Dinheiro","2019-09-10","2019-09-19","2019-09-19","Aprovado");
INSERT INTO orcamentos VALUES("3","222111","6","Notebook Samsung","2098764560123","OS travando","Sistema Operacional está corrompido","Notebook + Fonte","80.00","sem pecas","20.00","100.00","10.00","90.00","Dinheiro","2019-09-10","2019-09-12","2019-09-16","Cancelado");
INSERT INTO orcamentos VALUES("4","333","6","Notebook Samsung","96954325123","OS travando","foi substituido o cabo da fonte","notebook veio com a fonte","15.00","Fonte Notebook","20.00","35.00",NULL,"35.00",NULL,"2019-09-11","2019-09-14",NULL,"Cancelado");
INSERT INTO orcamentos VALUES("6","333","6","CPU Desktop","2346587981","Não liga","Placa mãe foi substituída.","Precisa de uma limpeza","50.00","Placa-mãe","250.00","300.00","30.00","270.00","Dinheiro","2019-09-12","2019-09-12","2019-09-17","Cancelado");
INSERT INTO orcamentos VALUES("7","333","6","dfasfasdf","fadsfafa","fsfsafa","troca do cabo flat","fasfasfa","120.00","cabo flat","30.00","150.00","15.00","135.00","Dinheiro","2019-09-12","2019-09-19","2019-09-19","Aprovado");
INSERT INTO orcamentos VALUES("8","555","6","Notebook Compaq","124579346","Não liga","foi trocada a placa mãe","notebook + carregador","50.00","Placa-mãe","250.00","300.00","0.00","300.00","Dinheiro","2019-09-24","2019-09-24","2019-09-24","Aprovado");
INSERT INTO orcamentos VALUES("9","111","6","CPU Desktop","24356897","Sistema corrompido","sistema reinstalado","muito sujo","80.00","sem pecas","0.00","80.00","0.00","80.00","Dinheiro","2019-09-27","2019-09-27","2019-09-27","Aprovado");


DROP TABLE IF EXISTS os;

CREATE TABLE `os` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_orc` int(11) NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `produto` varchar(50) NOT NULL,
  `tecnico` varchar(50) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_abertura` date NOT NULL,
  `data_fechamento` date DEFAULT NULL,
  `garantia` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO os VALUES("1","3","222111","Notebook Samsung","6","90.00","2019-09-16","2019-09-17",NULL,"Fechada");
INSERT INTO os VALUES("2","6","333","CPU Desktop","6","270.00","2019-09-17","0000-00-00",NULL,"Cancelada");
INSERT INTO os VALUES("3","2","111","Celular Xiaomi 64GB","6","280.00","2019-09-19","2019-09-19",NULL,"Fechada");
INSERT INTO os VALUES("4","7","333","dfasfasdf","6","135.00","2019-09-19",NULL,NULL,"Aberta");
INSERT INTO os VALUES("5","8","555","Notebook Compaq","6","300.00","2019-09-24","2019-09-24",NULL,"Fechada");
INSERT INTO os VALUES("6","9","111","CPU Desktop","6","80.00","2019-09-27","2019-09-27",NULL,"Fechada");


DROP TABLE IF EXISTS pagamentos;

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `funcionario` varchar(50) NOT NULL,
  `tesoureiro` varchar(50) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO pagamentos VALUES("1","120.00","Lady-Anne","Felipe","2019-09-29");


DROP TABLE IF EXISTS produtos;

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `unidade` varchar(10) NOT NULL,
  `valor_compra` decimal(10,2) NOT NULL,
  `valor_venda` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO produtos VALUES("1","Memória 4GB DDR3 Desktop","Un","120.00","220.00","2019-09-27");
INSERT INTO produtos VALUES("2","Mouse USB Fortrek","Un","4.75","12.00","2019-10-01");


DROP TABLE IF EXISTS usuarios;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO usuarios VALUES("1","Claudinei","admin","123","Administrador","2");
INSERT INTO usuarios VALUES("2","N�bia","nubia","123","Gerente","3");
INSERT INTO usuarios VALUES("3","Felipe","felipe","123","Tesoureiro","5");
INSERT INTO usuarios VALUES("14","Hallan Santos","hallan","123","Funcionario","6");
INSERT INTO usuarios VALUES("15","Lady-Anne","ladyanne","123","Funcionario","7");


DROP TABLE IF EXISTS vendas;

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) NOT NULL,
  `produto` varchar(100) NOT NULL,
  `funcionario` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO vendas VALUES("1","220.00","Memória 4GB DDR3 Desktop","Felipe","2019-09-27","Efetuada");
INSERT INTO vendas VALUES("2","12.00","Mouse USB Fortrek","Claudinei","2019-10-01","Efetuada");


