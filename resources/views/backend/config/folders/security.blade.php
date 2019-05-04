<p class="message icon-info-round white-gradient">
Permisões de acesso aos modulos do sistema.
</p>
<ul class="files-icons on-dark">
	@can('config-module-view')
		<li>
			<a href="config/modulos" class="file-link">
				<span class="icon folder-program"></span>
				Modulos do Sistema
			</a>
		</li>
	@endcan
	@can('config-profile-view')
	<li>
		<a href="config/perfis" class="file-link">
			<span class="icon folder-program"></span>
			Perfis dos usuários
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