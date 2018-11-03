drop TABLE if exists tb_presenca;
drop TABLE if EXISTS tb_dia_letivo;

create table tb_dia_letivo(
    id int(11) not null auto_increment,
    data date not null unique,
    
    primary key (id)
);

create TABLE tb_presenca(
  id int(11) not null AUTO_INCREMENT,
  id_data int(11) not null,
  /*id_professor int(11) not null,*/
  id_turma int(11) not null,
  
  alunos_id varchar(680) not null,
  presencas varchar(380) not null,
  
  PRIMARY KEY (id),
  foreign key (id_data) references tb_dia_letivo(id),
  /*foreign key (id_professor) REFERENCES tb_professor(idtb_professor),*/ /* Talvez não seja necessário, até porque já se pode obter com a turma quando achar o aluno */
  foreign key (id_turma) REFERENCES tb_turma(idtb_turma) /* Acho que não seja necessário, já q quando obtem os alunos tem a turma tbm */
);

#Ajeitar banco de dados
set FOREIGN_KEY_CHECKS=0;

alter IGNORE table tb_aluno
drop FOREIGN KEY  fk_tb_aluno_tb_curso1,
drop index fk_tb_aluno_tb_curso1_idx,
drop FOREIGN KEY  fk_tb_aluno_tb_pagamento1,
drop index fk_tb_aluno_tb_pagamento1_idx;

alter IGNORE table tb_aluno
drop column tb_curso_idtb_curso,
drop column tb_pagamento_idtb_pagamento;

alter IGNORE table tb_turma_aluno
drop FOREIGN KEY  fk_tb_turma_aluno_tb_professor1,
drop index fk_tb_turma_aluno_tb_professor1_idx;

alter IGNORE table tb_turma_aluno
drop column tb_professor_idtb_professor,
add column tb_pagamento_idtb_pagamento int(11) not null,
add FOREIGN KEY (tb_pagamento_idtb_pagamento) REFERENCES tb_pagamento(idtb_pagamento);

set FOREIGN_KEY_CHECKS=1;