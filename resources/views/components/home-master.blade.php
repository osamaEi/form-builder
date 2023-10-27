<!DOCTYPE html>
<html>
<head>
    <title>Form Builder Example</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
</head>
<body>

<div id="fb-editor"></div>

<div id="build-wrap"></div>

<form id="myForm" action="{{ route('save-selected-inputs') }}" method="POST">
    @csrf
    <div id="form-builder-data"></div>
    <button type="submit">Submit</button>
</form>

<div id="form-data-container">
    <h2>Saved Form Data</h2>
    <ul id="form-data-list"></ul>
</div>

<script>
    jQuery(($) => {
        const fbEditor = document.getElementById("build-wrap");
        const formBuilder = $(fbEditor).formBuilder();

        // Handle form submission
        $("#myForm").submit(function (event) {
            event.preventDefault();
            
            // Serialize the form builder data
            const formData = formBuilder.actions.getData();
            
            // Add the serialized data to a hidden input
            $("#form-builder-data").html(`<input type="hidden" name="form_data" value='${JSON.stringify(formData)}' />`);
            
            // Submit the form
            $.ajax({
                url: "{{ route('save-selected-inputs') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    // Handle the response from the server if needed
             if (response.success) {
            // Show a success message
            $("#myForm").html('<p>Thank you for your submission. Your data has been saved.</p>');
        }
                }
            });
        });

 
    });
</script>

</body>
</html>