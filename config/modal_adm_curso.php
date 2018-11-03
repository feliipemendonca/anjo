<div class="modal fade" tabindex="-1" role="dialog" id="requisito<?php echo $ln['idtb_curso']; ?>" style="opacity: 1; padding-top: 11em;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"><strong>Cadastrar Requisito de Curso</strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post" accept-charset="utf-8">
				<input type="hidden" name="id" value="<?php echo $ln['idtb_curso']; ?>">
				<div class="modal-body contato-form">
					<div class="form-group">
						<label for="">Requisito</label>
						<input type="text" class="form-control" name="requisito">			
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary" name="cadastra_requito" value="cadastra_requito">Cadastrar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modulo_curso<?php echo $ln['idtb_curso']; ?>" style="opacity: 1; padding-top: 11em;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"><strong>Cadastrar Módulo do Curso</strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post" accept-charset="utf-8">
				<input type="hidden" name="id" value="<?php echo $ln['idtb_curso']; ?>">
				<div class="modal-body contato-form">
					<div class="form-group">
						<label for="">Nome do Módulo</label>
						<input type="text" class="form-control" name="nome">											
					</div>
					<div class="form-group">
						<label for="">Descrição</label>
						<textarea class="form-control" rows="3" maxlength="250" name="descricao"></textarea>											
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary" name="cadastra_modulo" value="cadastra_modulo">Cadastrar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="update<?php echo $ln['idtb_curso']; ?>" style="opacity: 1; padding-top: 11em;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><strong>Atualizar <?php echo @$ln['curso']; ?></strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body contato-form">
				<form action="curso.php" method="post" enctype="multipart/form-data">                      
					<div class="row">
						<div class="col-sm-12 col-md-8">
							<label for="Curso">Curso<em>*</em></label>
							<input type="hidden" name="id" value="<?php echo $ln['idtb_curso'] ?>">
							<input type="text" class="form-control" name="curso" value="<?php echo $ln['curso']; ?>">
						</div>
						<div class="col-sm-12 col-md-4">
							<label for="Curso">Imagem<em>*</em></label>
							<input type="file" class="form-control" name="image">
						</div>
						<div class="col-sm-4 col-md-6">
							<label for="Carga Horária">Carga Horária<em>*</em></label>
							<input type="tel" class="form-control" name="carga" title="Carga Horária do Curso" value="<?php echo $ln['carga']; ?>">
						</div>
						<div class="col-sm-4 col-md-6">
							<label for="Valor">Valor<em>*</em></label>
							<input type="tel" class="form-control valor" name="valor" title="Valor do Curso" value="<?php echo $ln['valor']; ?>">
						</div>
						<div class="col-sm-12 col-md-12">
							<label for="">Publico Alvo</label>
							<input type="text" class="form-control" placeholder="Enfermeras.." name="alvo" value="<?php echo $ln['alvo']; ?>">
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="Sobre">Sobre o Curso<em>*</em><em><small class="caracteres"></small></em></label>
							<textarea name="sobre" class="form-control" rows="10" placeholder="Descreva o curso" id="sobre" required autofocus><?php echo $ln['sobre']; ?></textarea>											
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="Sobre">Mercado de Trabalho<em>*</em><em><small class="caracteres"></small></em></label>
							<textarea name="mercado" class="form-control" rows="10" placeholder="Apresente o Mercado de trabalho"  id="mercado" required autofocus><?php echo $ln['mercado']; ?></textarea>											
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
						<button type="submit" class="btn btn-primary" name="update_curso" value="up">Atualizar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade delete" tabindex="-1" role="dialog" id="delete<?php echo $ln['idtb_curso']; ?>" style="opacity: 1; padding-top: 11em;">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><strong>Tem certeza que quer excluir curso?</strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body contato-form">
				<form action="curso.php" method="post">  
					<label for="Curso">Confirme senha<em>*</em></label>
					<input type="hidden" name="idtb_curso" value="<?php echo $ln['idtb_curso']; ?>">
					<input type="password" class="form-control" name="senha">
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
						<button type="submit" class="btn btn-primary" name="delete_curso" value="delete_curso">Continuar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modulo_ver<?php echo $ln['idtb_curso']; ?>" style="opacity: 1; padding-top: 11em;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Módulos do curso</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">		
						<?php $modulo = $mysqli->query("SELECT *FROM tb_modulo WHERE tb_curso_idtb_curso = '".$ln['idtb_curso']."'");
						while($l = $modulo->fetch_assoc()){ ?>
							<div class="col-sm-12 col-md-6">
								<div class="img-thumbnail">
									<div class="breadcrumb">
										<strong><?php echo $l['nome']; ?></strong>
										<button type="button" class="close" data-toggle="modal" data-target="#delete_modulo<?php echo $l['idtb_modulo']; ?>" title="Excluir Módulo?">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<p class="sobre"><?php echo $l['descricao'] ;?></p>
								</div>
							</div>

							<div class="modal fade delete" tabindex="-1" role="dialog" id="delete_modulo<?php echo $l['idtb_modulo']; ?>" style="opacity: 1; padding-top: 4em;">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Tem certeza que quer excluir módulo?</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body contato-form">
											<form action="" method="post">  
												<label for="Curso">Confirme senha<em>*</em></label>
												<input type="hidden" name="idtb_modulo" value="<?php echo $l['idtb_modulo']; ?>">
												<input type="password" class="form-control" name="senha">
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
													<button type="submit" class="btn btn-primary" name="delete_modulo" value="delete_modulo">Continuar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>																	
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="requisito_ver<?php echo $ln['idtb_curso']; ?>" style="opacity: 1; padding-top: 11em;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">requisitos do curso</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">		
						<?php $modulo = $mysqli->query("SELECT *FROM tb_requisito WHERE tb_curso_idtb_curso = '".$ln['idtb_curso']."'");
						while($l = $modulo->fetch_assoc()){ ?>
							<div class="col-sm-12 col-md-6">
								<div class="img-thumbnail">
									<div class="breadcrumb">
										<strong><?php echo $l['requisito']; ?></strong>
										<button type="button" class="close" data-toggle="modal" data-target="#delete_requisito<?php echo $l['idtb_requisito']; ?>" title="Excluir Requisito?">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								</div>
							</div>

							<div class="modal fade delete" tabindex="-1" role="dialog" id="delete_requisito<?php echo $l['idtb_requisito']; ?>" style="opacity: 1; padding-top: 4em;">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Tem certeza que quer excluir módulo?</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body contato-form">
											<form action="" method="post">  
												<label for="Curso">Confirme senha<em>*</em></label>
												<input type="hidden" name="idtb_requisito" value="<?php echo $l['idtb_requisito']; ?>">
												<input type="password" class="form-control" name="senha">
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
													<button type="submit" class="btn btn-primary" name="delete_requisito" value="delete_requisito">Continuar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>																	
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>



<!-- img -->
<div class="modal fade delete" tabindex="-1" role="dialog" id="img<?php echo $ln['idtb_curso']; ?>" style="opacity: 1; padding-top: 11em;">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><strong>Albúm do curso</strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body contato-form">
				<form action="curso.php" method="post" enctype="multipart/form-data">  
					<label for="Curso">Imagem<em>*</em></label>
					<input type="hidden" name="idtb_curso" value="<?php echo $ln['idtb_curso']; ?>">
					<input type="file" name="image">
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
						<button type="submit" class="btn btn-primary" name="img_curso" value="img_curso">Continuar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="img_ver<?php echo $ln['idtb_curso']; ?>" style="opacity: 1; padding-top: 11em;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Imagens do curso</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">		
						<?php $img = $mysqli->query("SELECT *FROM tb_galeria WHERE tb_curso_idtb_curso = '".$ln['idtb_curso']."'");
						while($l = $img->fetch_assoc()){ ?>
							<div class="col-sm-12 col-md-6">
								<div class="img-thumbnail">
									<div class="breadcrumb">
										<img src="../upload/<?php echo $l['img']; ?>">
										<button type="button" class="close" data-toggle="modal" data-target="#delete_img<?php echo $l['idtb_galeria']; ?>" title="Excluir Requisito?">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								</div>
							</div>

							<div class="modal fade delete" tabindex="-1" role="dialog" id="delete_img<?php echo $l['idtb_galeria']; ?>" style="opacity: 1; padding-top: 4em;">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Tem certeza que quer excluir imagem?</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body contato-form">
											<form action="" method="post">  
												<label for="Curso">Confirme senha<em>*</em></label>
												<input type="hidden" name="idtb_galeria" value="<?php echo $l['idtb_galeria']; ?>">
												<input type="password" class="form-control" name="senha">
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
													<button type="submit" class="btn btn-primary" name="delete_img" value="delete_img">Continuar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>																	
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>