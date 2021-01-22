

<style>
	.my-custom-scrollbar
	{
		position: relative;
		height: 300px;
		overflow: auto;
	}
	.table-wrapper-scroll-y
	{
		display: block;
	}
</style>

<div class="container" style="margin-top: 150px;">
	<div class="row">
		<div class="col-md-2">

		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header bg-dark">
					<a><span style="color:white;">Kategorie zdjęć</span></a>
				</div>
				<div class="card-body bg-dark h-100" style="text-align: center;">
					<div class="table-wrapper-scroll-y my-custom-scrollbar" style="height:300px;">
						<table class="table-striped table-dark mb-0">
							<tbody>
								<?php
									//handling display of all categories
									include('handleCategoriesDisplay.inc.php')
								?>
							</tbody>
						</table>
					</div>
			</div>
		</div>
		<div class="col-md-2">

		</div>
	</div>
</div>


