CREATE DATABASE biblioteca;
USE DATABASE biblioteca;

CREATE TABLE livros(
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    autor VARCHAR(100),
    descricao VARCHAR(100),
    categoria VARCHAR(100),
    arquivo VARCHAR(100)
);

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(100)
);

CREATE TABLE admin(
    id AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(100)
);

CREATE TABLE mensagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    texto TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
