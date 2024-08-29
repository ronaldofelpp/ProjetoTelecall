-- ABRIR O ARQUIVO MODELO E SINCRONIZÁ-LO NO MYSQL

use mydb;

-- Insert para criar um usuário master
	insert into ENDERECO values (null,'00000000','Rua Master','00','Bairro Master','Cidade Master','PB');
    SET @idendereco = LAST_INSERT_ID();
    insert into CONTATO values (null,'0000000000','0000000000');
	SET @idcontato = LAST_INSERT_ID();
	insert into USUARIO () values (null,'Master da Silva','00000000000','Masculino','2000-10-10','MãeMaster','master','12345678','Ativo',current_timestamp(),current_timestamp(),@idendereco,@idcontato,2);


-- Insert na tabela de UF, com todos as unidades federativas e suas descrições
insert into UF (Cod_uf, desc_uf)
values ('AC','Acre'),('AL','Alagoas'),('AP','Amapá'),('AM','Amazonas'),('BA','Bahia'),('CE','Ceará'),('DF','Distrito-ederal'),
('ES','Espírito-Santo'),('GO','Goiás'),('MA','Maranhão'),('MT','Mato-Grosso'),('MS','Mato-Grosso do Sul'),
('MG','Minas-Gerais'),('PA','Pará'),('PB','Paraíba'),('PR','Paraná'),('PE','Pernambuco'),('PI','Piauí'),('RJ','Rio de Janeiro'),
('RN','Rio-Grande do Norte'),('RS','Rio-Grande do Sul'),('RO','Rondônia'),('RR','Roraima'),('SC','Santa Catarina'),
('SP','São Paulo'),('SE','Sergipe'),('TO','Tocantins');

-- Insert na tabela do TIPO, com o número e a descrição do tipo do usuário
insert into TIPO (idTIPO,TIPO)
values (1,'Comum'),(2,'Master');
