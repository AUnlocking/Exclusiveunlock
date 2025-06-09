<!-- Modal -->
<div class="modal fade" id="mdl-add-reg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form id="form-add-reg" name="form-add-reg" accept-charset="utf-8" enctype="multipart/form-data">
				<div class="modal-header bg-mdl-add p-2">
					<h5 class="modal-title"><i class="fa fa-pencil"></i> Agregando</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center" id="div-cnt-msg-add-reg"></div>
					</div>
					<div class="row">
						<div class="col-md-12 mb-3">
							<div class="form-group input-group">
								<span class="has-float-label">
									<input type="text" class="form-control" name="txt-nom-add" id="txt-nom-add" placeholder="Nombre" required="required" value="" autocomplete="off">
									<label for="txt-nom-add">Nombre</label>
								</span>
							</div>
						</div>
						<div class="col-md-12 mb-3">
							<div class="mb-3">
								<label for="txt-desc-add" class="form-label">Contenido</label>
								<textarea class="form-control txt-desc" name="txt-desc-add" id="txt-desc-add" rows="3"></textarea>
							</div>
							<!--div class="form-group input-group">
								<span class="has-float-label">
									<input type="text" class="form-control" name="txt-desc-add" id="txt-desc-add" placeholder="Descripción" required="required" value="" autocomplete="off">
									<label for="txt-desc-add">Descripción</label>
								</span>
							</div-->
						</div>
						<div class="col-md-6 mb-3">
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input form-control" id="file-ajx" name="file"  required="required" onchange="readURL(this, 'div-cnt-img-ajx');" accept=".png, .jpg, .jpeg">
								</div>
							</div>
						</div>
						<div class="col-md-6 p-1">
							<div id="div-cnt-img-ajx"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-close-mdl-add-reg" name="btn-close-form-add-reg">
						<i class="fa fa-times"></i> Cancelar
					</button>
					<button type="submit" class="btn btn-primary" id="btn-add-reg" name="btn-add-reg">
						<i class="fa fa-check"></i> Agregar
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade app-mdl" id="mdl-del-regs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-mdl-del p-2">
				<h5 class="modal-title"><i class="fa fa-trash-alt"></i> Eliminando</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form class="form" method="post" id="form-del-regs" name="form-del-regs">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center" id="div-cnt-del-list-regs"></div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center" id="div-cnt-del-regs"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="btn-close-mdl-del-regs" class="btn btn-secondary" data-bs-dismiss="modal">
						<i class="fa fa-times"></i> Cerrar
					</button>
					<button type="submit" class="btn btn-danger" id="btn-del-regs">
						<i class="fa fa-trash-alt"></i> Eliminar
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade app-mdl" id="mdl-del-reg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-mdl-del p-2">
				<h5 class="modal-title"><i class="fa fa-trash-alt"></i> Eliminando</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form class="form" method="post" id="form-del-reg" name="form-del-reg">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 text-center" id="div-cnt-del-reg"></div>
					</div>
					<input type="hidden" id="txt-id-reg-del" name="txt-id-reg" readonly="" value="0">
					<div class="row">
						<div class="col-md-12 text-center" id="div-cnt-del-reg">
							<h5>
								¿Está seguro de eliminar <b class="text-danger" id="txt-nom-reg"></b>?
							</h5>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="btn-close-mdl-del-reg" class="btn btn-secondary" data-bs-dismiss="modal">
						<i class="fa fa-times"></i> Cerrar
					</button>
					<button type="submit" class="btn btn-danger" id="btn-del-reg">
						<i class="fa fa-trash-alt"></i> Eliminar
					</button>
				</div>
			</form>
		</div>
	</div>
</div>