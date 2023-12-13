-- TRIGGER LOG RECEITA

CREATE TRIGGER after_insert_transacoes_log
AFTER INSERT
ON receita 	FOR EACH ROW
INSERT INTO logs (descricao, id_usuario, data, hora)
VALUES (CONCAT('Receita cadastrado, codigo - ', NEW.id_receita, ' descricao - ', NEW.nome), NEW.id_usuario, CURRENT_DATE, CURTIME())


CREATE TRIGGER after_update_transacoes_log
AFTER update
ON receita 	FOR EACH ROW
INSERT INTO logs (descricao, id_usuario, data, hora)
VALUES (CONCAT('Receita alterado, codigo - ', NEW.id_receita, ' descricao - ', NEW.nome), NEW.id_usuario, CURRENT_DATE, CURTIME())


CREATE TRIGGER after_delete_transacoes_log
AFTER delete
ON receita 	FOR EACH ROW
INSERT INTO logs (descricao, id_usuario, data, hora)
VALUES (CONCAT('Receita deletado, codigo - ', old.id_receita, ' descricao - ', old.nome), old.id_usuario, CURRENT_DATE, CURTIME())

-- TRIGGER LOG CARTAO

CREATE TRIGGER after_delete_transacoes_log_cartao 
AFTER DELETE 
ON cartao FOR EACH ROW 
INSERT INTO logs (descricao, id_usuario, data, hora)
VALUES (CONCAT('Cartao deletado, codigo - ', old.id_cartao, ' descricao - ', old.nome), old.id_usuario, CURRENT_DATE, CURTIME())

CREATE TRIGGER after_insert_transacoes_log_cartao 
AFTER INSERT 
ON cartao FOR EACH ROW 
INSERT INTO logs (descricao, id_usuario, data, hora)
VALUES (CONCAT('Cartao cadastrado, codigo - ', NEW.id_cartao, ' descricao - ', NEW.nome), NEW.id_usuario, CURRENT_DATE, CURTIME())

CREATE TRIGGER after_update_transacoes_log_cartao
AFTER UPDATE 
ON cartao FOR EACH ROW 
INSERT INTO logs (descricao, id_usuario, data, hora)
VALUES (CONCAT('Cartao alterado, codigo - ', NEW.id_cartao, ' descricao - ', NEW.nome), NEW.id_usuario, CURRENT_DATE, CURTIME())

