CREATE TABLE comentarios (
	id SERIAL NOT NULL PRIMARY KEY,
	nome VARCAHR(100),
	mensagem TEXT,
	id_postagem INTEGER
);

CREATE TABLE postagem (
	id SERIAL NOT NULL PRIMARY KEY,
	titulo VARCHAR(100),
	conteudo TEXT
);