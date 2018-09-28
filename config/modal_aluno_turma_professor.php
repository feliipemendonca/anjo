<div class="modal fade" tabindex="-1" role="dialog" id="verturma<?php echo $id;?>" style="opacity: 1; padding-top: 11em;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Alunos Matrículados</h5>
            </div>
            <div class="modal-body">
                <div class="col-12 col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <?php
                            $sq = $mysqli->query("SELECT *FROM tb_aluno WHERE idtb_aluno = '$idtb_aluno' ") or die($mysqli->error);

                            $t = $mysqli->query("SELECT nome FROM tb_turma WHERE idtb_turma = '$id'"); ?>

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                while ($r = $sq->fetch_assoc()) {

                                    ?>
                                    <tr>
                                        <td><?php echo $r['idtb_aluno']; ?></td>
                                        <td><?php echo $r['nome']; ?></td>
                                        <td><?php echo $r['cpf']; ?></td>
                                        <td>
                                            <a href='' data-toggle='modal' data-target="#ver<?php echo $ln['idtb_aluno'];?>" title="Ver aluno?"><i class="fa fa-fw fa-eye"></i></a>
                                            <a href='' data-toggle='modal' data-target="#update<?php echo $ln['idtb_aluno'];?>" title="Atualizar Turma?"><i class="fa fa-fw fa-edit"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="margin-top: 5em!important;">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" name="delete_turma" value="delete_turma">Continuar</button>
            </div>
        </div>
    </div>
</div>