</article>
</div>
<footer>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.js"></script>
	<script src="js/dataTables.bootstrap.js"></script>

	<script>
	$(document).ready(function() {
		$('.table').dataTable( {
			"language": {
				"lengthMenu": "Exibir _MENU_",
				"zeroRecords": "Nenhum Registro",
				"info": "Exibindo _PAGE_ de _PAGES_",
				"search":         "Pesquisar: ",
				"infoEmpty": "Nenhum Registro",
				"infoFiltered": "(filtrando _MAX_ registros)",
				"paginate": {
					"first":      "Primeira",
					"last":       "Última",
					"next":       "Proxima",
					"previous":   "Anterior"
				}
			}
		} );
	} );
	</script>
</footer>		
</body>
</html>