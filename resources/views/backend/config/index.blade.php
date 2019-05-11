<div class="content-panel">
	<div class="panel-navigation silver-gradient">
		<div class="panel-control align-center">
		<h3>
			<i class="icon fa fa-cogs"> </i>
			<strong> Configurações</strong>
		</h3>
		</div>
		<div class="panel-load-target scrollable" >
			<div class="navigable">
				<ul class="files-list mini open-on-panel-content">
					@can('config-module-view')
					<!--
						can('config-menu-permissions')
						Liberar esse can após resolver problemas de vesões
					-->
						<li class="with-right-arrow grey-arrow">
							<span class="icon folder-docs"></span>
							<b>Segurança e Permisões</b>
							<ul class="files-list mini">
								@can('config-module-view')
									<li>
										<a href="config/modulos" class="file-link">
											<span class="icon folder-program"></span>
											Modulos do sistema
										</a>
									</li>
								@endcan
								@can('config-profile-view')
									<li>
										<a href="config/perfis" class="file-link">
											<span class="icon folder-program"></span>
											Perfis dos Usuários
										</a>
									</li>
								@endcan
								@can('config-permission-view')
									<li>
										<a href="config/permissoes" class="file-link">
											<span class="icon folder-program"></span>
											Permissões Padrão
										</a>
									</li>
								@endcan
							</ul>
						</li>
					@endcan

					<li class="with-right-arrow grey-arrow">
						<span class="icon folder-net"></span>
						<b>Páginas do Site</b>



						<ul class="files-list mini">
							<!--can('config-module-view') -->
							<li class="with-right-arrow grey-arrow">
								<span class="icon folder-program"></span>
								<b>Página Home</b>
								<ul class="files-list mini">
									<li>
										<a href="/imagens/banner/banner-slider" class="file-link">
											<span class="icon file-dll"></span> Slider
										</a>
									</li>

								</ul>
							</li>
							<!--endcan -->
						</ul>
					</li>



					<li class="with-right-arrow grey-arrow">
						<span class="icon folder-docs"></span>
						<b>Padrões</b>
						<ul class="files-list mini">
							@can('config-site-view')
								<li>
									<a href="config/1/site" class="file-link">
										<span class="icon folder-program"></span>
										Padrão do Site
									</a>
								</li>
							@endcan
							@can('config-product-view')
								<li>
									<a href="config/1/produtos" class="file-link">
										<span class="icon folder-program"></span>
										Padrão dos Produtos
									</a>
								</li>
							@endcan
							@can('config-kit-view')
								<li>
									<a href="config/kits" class="file-link">
										<span class="icon folder-program"></span>
										Editar Kits
									</a>
								</li>
							@endcan
							@can('config-freight-view')
								<li>
									<a href="config/1/fretes" class="file-link">
										<span class="icon folder-program"></span>
										Frete (correio)
									</a>
								</li>
							@endcan
							@can('config-keyword-view')
								<li>
									<a href="config/keywords" class="file-link">
										<span class="icon file-ini"></span>
										Palavras Chaves (SEO)
									</a>
								</li>
							@endcan

								<li>
									<a href="config/cores/sistema" class="file-link">
										<span class="icon folder-piker"></span>
										Personalizar as Cores
									</a>
								</li>

						</ul>
					</li>


					<li class="with-right-arrow grey-arrow">
						<span class="icon folder-docs"></span>
						<b>Mensagens</b>
						<ul class="files-list mini">
							@can('config-subject-view')
								<li>
									<a href="config/contact-subjects" class="file-link">
										<span class="icon folder-program"></span>
										Contato do Site
									</a>
								</li>
							@endcan
						</ul>
					</li>


					
					<li class="with-right-arrow grey-arrow">
						<span class="icon folder-image"></span>
						<b>Imagens</b>
						<ul class="files-list mini">
							@can('config-manufacturer-view')
								<li>
									<a href="config/imagens/fabricantes" class="file-link">
										<span class="icon folder-image"></span>
										Fabricantes
									</a>
								</li>
							@endif
							@can('config-section-view')
								<li>
									<a href="config/imagens/secoes" class="file-link">
										<span class="icon folder-image"></span>
										Seções
									</a>
								</li>
							@endcan
							@can('config-category-update')			
								<li>
									<a href="config/imagens/categorias" class="file-link">
										<span class="icon folder-image"></span>
										Categorias
									</a>
								</li>
							@endcan
							@can('config-image-product-view')
								<li>
									<a href="config/images" class="file-link">
										<span class="icon folder-image"></span>
										Produtos
									</a>
								</li>
							@endcan
							@can('config-admin-view')
								<li>
									<a href="config/imagens/usuarios" class="file-link">
										<span class="icon folder-image"></span>
										Usuários
									</a>
								</li>
							@endcan
							@can('config-slider-view')
								<li>
									<a href="config/imagens/slider" class="file-link">
										<span class="icon folder-image"></span>
										Silder Home
									</a>
								</li>
							@endcan
							@can('config-color-group-view')
								<li>
									<a href="config/grupo-cores" class="file-link">
										<span class="icon folder-piker"></span>
										Grupo de Cores
									</a>
								</li>
							@endcan
						</ul>
					</li>
					@can('config-percent-view')
						<li>
							<a href="config/porcentagens" class="file-link">
								<span class="icon folder-program"></span>
								Editar Porcentagens
							</a>
						</li>
					@endcan
					@can('config-profile-client-view')
						<li>
							<a href="config/perfil-cliente" class="file-link">
								<span class="icon folder-program"></span>
								Perfil do Cliente
							</a>
						</li>
					@endcan
					@can('config-unit-measure-view')
						<li>
							<a href="config/metodos" class="file-link">
								<span class="icon folder-program"></span>
								Métodos de Envio
							</a>
						</li>
					@endcan
						<li>
							<a href="config/unidades" class="file-link">
								<span class="icon folder-program"></span>
								Unidade de Medida
							</a>
						</li>

						<li>
							<a href="config/status-pagamentos" class="file-link">
								<span class="icon folder-program"></span>
								Status Pagamentos
							</a>
						</li>

						<li>
							<a href="config/forma-pagamentos" class="file-link">
								<span class="icon folder-program"></span>
								Forma de Pagamentos
							</a>
						</li>


				</ul>

			</div>

		</div>

	</div>

	<div class="panel-content linen">
		<div class="panel-load-target scrollable with-padding" style="height:600px">
			<div class="navigable">
				<p class="message icon-info-round white-gradient">
				Utilizar os ícones abaixo ou barra lateral para navegar nos modulos.
				</p>
				<ul class="files-icons on-dark open-on-panel-content">
					@can('config-menu-permissions')
						<li>
							<a href="config/folders/security" class="file-link">
								<span class="icon folder-securrity"></span>
								Segurança e Permisões
							</a>
						</li>
					@endcan
					@can('config-product-view')
						<li>
							<a href="config/1/produtos" class="file-link">
								<span class="icon default-product"></span>
								Padrão dos Produtos
							</a>
						</li>
					@endcan
					@can('config-freight-view')
						<li>
							<a href="config/1/fretes" class="file-link">
								<span class="icon file-freight"></span>
								Frete (correio)
							</a>
						</li>
					@endcan
					@can('config-keywords-view')
						<li>
							<a href="config/keywords" class="file-link">
								<span class="icon file-ini"></span>
								Palavras Chaves (SEO)
							</a>
						</li>
					@endcan
					@can('config-percent-view')
						<li>
							<a href="config/porcentagens" class="file-link">
								<span class="icon file-percent"></span>
								Editar Porcentagens
							</a>
						</li>
					@endcan


				</ul>
			</div>
		</div>

	</div>
</div>