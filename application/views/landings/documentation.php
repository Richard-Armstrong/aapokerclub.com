
<?php $this->load->view("includes/header_only") ?>

<body>
	<div class="container">
		<p>
			api/data<br>
			Returns rows of form data, limited to the selected fields<br>

			Input: 'key': varchar (len 36), 'form_id': int, 'fields': array of varchars (len up to 100 each)<br>
			Output: JSON array of objects with fields corresponding to the input fields. Uses status 200 on success.<br>
			On failure, returns a string describing the error. Uses status 400 or 500 on failure.
		</p>
	</div>
</body>
</html>
