create database Moodly;
use Moodly;
-- Prontuário será o email. No PHP limitar essa entrada para o modelo @
-- apelido é o nome que o individuo quer que apareça no sistema
create table Usuario (
	id_usuario int auto_increment primary key,
	nome varchar(255) not null,
	email varchar(255) not null unique,
	senha varchar(255) not null,
	apelido varchar(255),
	imagem_usuario varchar(255) default "img/cat1.png",
	acesso ENUM('Professor','Aluno','Administrador') not null default "Aluno"
);


CREATE TABLE Curso (
    id_curso int auto_increment primary key,
    titulo_curso varchar(255) not null,
    descricao_curso text,
    dataInicio date,
    dataFim date,
    id_professor_responsavel int,
    foreign key (id_professor_responsavel) references Usuario(id_usuario),
    INDEX (id_professor_responsavel)
);


create table Conteudo (
	id_conteudo int auto_increment primary key,
	titulo_conteudo varchar(255) not null,
	descricao text not null,
	status varchar(255),
	nomeCurso varchar(255) not null,
	tipo ENUM('Matéria','Atividade','Avaliação') not null,
	data_final date,
	id_curso int,
	foreign key (id_curso) references Curso(id_curso),
	INDEX (id_curso)
);

CREATE TABLE Inscricao (
    id_inscricao INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_curso INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

-- procurar codigo de data de envio que pegue do dia que foi enviado, luciene fez isso no banco dela
CREATE TABLE Respostas (
	id_resposta int auto_increment PRIMARY KEY,
	envio_atividade text,
	envio_arquivo blob,
	data_envio datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	status ENUM('Não Enviado','Enviado','Corrigido','Anulado'),
	nota DEC(10,2),
	id_curso int,
	id_conteudo int,
	id_usuario int,
	foreign key (id_curso) references Curso(id_curso),
	foreign key (id_conteudo) references Conteudo(id_conteudo),
	foreign key (id_usuario) references Usuario(id_usuario),
	INDEX (id_curso, id_conteudo, id_usuario)
);

CREATE TABLE Finalizacao (
	conceitoFinal DEC(10,2),
	statusFinal ENUM('Cursando','Aprovado','Reprovado','Pendente'),
	id_curso int,
	id_resposta int,
	id_usuario int,
	foreign key (id_curso) references Curso(id_curso),
	foreign key (id_resposta) references Respostas(id_resposta),
	foreign key (id_usuario) references Usuario(id_usuario),
	INDEX (id_curso, id_resposta, id_usuario)
);

CREATE TABLE Calendario (
 	id_evento int auto_increment primary key,
    titulo_evento varchar(255) not null,
    descricao_evento text,
    data_evento datetime not null,
    id_curso int,
    foreign key (id_curso) references Curso(id_curso),
    INDEX (id_curso)
);

CREATE TABLE SolicitarInscricao (
    id_solicitacao INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_curso INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);


INSERT INTO Usuario (nome, email, senha, apelido, acesso) 
VALUES ('Marcos Antonio', 'm@m', 'mmm', 'Marquinho', 'Aluno'),
       ('Renan', 'r@r', 'rrr', '', 'Professor'),
       ('Thiago', 't@t', 'ttt', 'THIAGO', 'Administrador');
      
INSERT INTO Usuario (nome, email, senha, apelido, acesso) 
VALUES ('Marcos ', 'm@s', 'mmm', 'Marquinho', 'Aluno');

INSERT INTO Curso (titulo_curso, descricao_curso, dataInicio, dataFim) 
VALUES ('Introdução à Programação', 'Aprenda os conceitos básicos de programação pós Era Antônio.', '2024-05-01', '2024-07-01'),
       ('Web Design Avançado', 'Aprofunde seus conhecimentos em design web e se torne uma LGBT+ completa.', '2024-06-15', '2024-08-15'),
       ('Gestão de Projetos', 'Domine as técnicas de gestão de projetos.', '2024-07-01', '2024-09-01');
      
INSERT INTO Conteudo (titulo_conteudo, descricao, status, nomeCurso, tipo, id_curso) 
VALUES ('Introdução ao HTML', 'Aprenda os fundamentos do HTML.', 'Ativo', 'Introdução à Programação', 'Matéria', 4),
       ('Projeto Prático', 'Desenvolva um projeto prático de um site estático.', 'Ativo', 'Introdução à Programação', 'Atividade', 4),
       ('Avaliação Final', 'Avalie seu conhecimento sobre HTML.', 'Ativo', 'Introdução à Programação', 'Avaliação', 4);
      
INSERT INTO Respostas (envio_atividade, envio_arquivo, status, nota, id_curso, id_conteudo, id_usuario) 
VALUES ('Resposta da atividade 1', NULL, 'Enviado', 8.5, 1, 2, 1),
       ('Resposta da atividade 2', NULL, 'Enviado', 9.0, 1, 2, 2),
       ('Resposta da avaliação final', NULL, 'Enviado', 7.0, 1, 3, 3);

INSERT INTO Finalizacao (conceitoFinal, statusFinal, id_curso, id_resposta, id_usuario) 
VALUES (8.5, 'Aprovado', 1, 1, 1),
       (9.0, 'Aprovado', 1, 2, 2),
       (7.0, 'Aprovado', 1, 3, 3);
      
insert into inscricao (id_usuario, id_curso)
values (1, 2);

SELECT id_curso, titulo_curso, descricao_curso FROM Curso;
select * from usuario;
