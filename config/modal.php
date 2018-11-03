<!--Modal cadastro de Curso-->


<!-- Apresentação de Curso-->
<?php if (isset($ln['idtb_curso'])) { ?>

<?php } ?>
<!-- Apresentação de Curso-->
<?php if (isset($ln['delete_curso'])) { ?>

<?php } ?>

<!--Cadastro de Modulo de curso --> 


<?php if (isset($ln['idtb_curso'])) {?>

<?php } ?>

<!-- Cadastro de Professor-->


<!-- Apresentação do professor -->


<div class="modal mymodal fade bd-example-modal-sm" tabindex="-1" role="dialog" id="mymodalProf_img">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Adcione Uma Imagem</h5>
			</div>
			<div class="modal-body">
				<form action="" method="post">                      
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<label for="Curso">Nome oCmpleto<em>*</em></label>
							<input type="text" class="form-control" name="nome" required autofocus>
						</div>
						<div class="col-sm-4 col-md-6">
							<label for="Carga Horária">CPF<em>*</em></label>
							<input type="tel" class="form-control" name="cpf" title="CPF" required autofocus>
						</div>
						<div class="col-sm-4 col-md-6">
							<label for="Valor">RG<em>*</em></label>
							<input type="tel" class="form-control" name="rg" title="RG" required autofocus>
						</div>
						<div class="col-sm-12 col-md-12">
							<label for="">E-mail</label>
							<input type="email" class="form-control" placeholder="example@example.com" name="email">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary" name="registerprof" value="registerprof">Cadastrar</button>						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>