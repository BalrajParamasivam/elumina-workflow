
    $( document ).ready( function () {

        //datepicker
        $('#date_of_birth').datepicker({
            autoclose:true,
            format: 'dd-mm-yyyy',
            endDate: '-1'
        });

        //datatable
        $('#registerTable').DataTable();

		// Form Validation
	$( "#registerForm" ).validate( {
	    rules: {
	        firstname: "required",
	        lastname: "required",
	        email: {
	            required: true,
	            email: true
	        },
            date_of_birth: "required",
	    },
	    messages: {
	        firstname: "Please enter your firstname",
	        lastname: "Please enter your lastname",
	        email: "Please enter a valid email address",
            date_of_birth: "Please select dateofbirth",
	    },
	    errorElement: "em",

	    errorPlacement: function ( error, element ) {
	        // Add the `invalid-feedback` class to the error element
	        error.addClass( "invalid-feedback" );
	        if ( element.prop( "type" ) === "checkbox" ) {
	            error.insertAfter(element.next( "label" ));
	        } else {
	            error.insertAfter(element.next(".pmd-textfield-focused"));
	        }
	    },
	    highlight: function ( element, errorClass, validClass ) {
	        $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
	    },
	    unhighlight: function (element, errorClass, validClass) {
	        $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
	    }
	} );


    $( "#loginForm" ).validate( {
	    rules: {
	        name: "required",
            password: "required",
	    },
	    messages: {
	        name: "Please enter your name",
            password: "Please enter your password",
	    },
	    errorElement: "em",

	    errorPlacement: function ( error, element ) {
	        // Add the `invalid-feedback` class to the error element
	        error.addClass( "invalid-feedback" );
	        if ( element.prop( "type" ) === "checkbox" ) {
	            error.insertAfter(element.next( "label" ));
	        } else {
	            error.insertAfter(element.next(".pmd-textfield-focused"));
	        }
	    },
	    highlight: function ( element, errorClass, validClass ) {
	        $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
	    },
	    unhighlight: function (element, errorClass, validClass) {
	        $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
	    }
	} );


} );


