CREATE EXTENSION isn;

CREATE TABLE users (
    email       VARCHAR(128) PRIMARY KEY,
    name        VARCHAR(128) NOT NULL,
    password    VARCHAR(256) NOT NULL
);

CREATE TABLE books (
    isbn         ISBN13 PRIMARY KEY,
    title        VARCHAR(128) NOT NULL,
    description  VARCHAR(4096) NOT NULL,
    author       VARCHAR(128) REFERENCES users,
    price        INTEGER NOT NULL,
    path         VARCHAR(128) NOT NULL
);

CREATE TABLE orders (
    book         ISBN13 REFERENCES books,
    customer     VARCHAR(128) REFERENCES users,
    ordered      BOOLEAN NOT NULL
);
