$(function ()
{
	$("#submitxx").click(function ()
	{
		App.blockUI({ target: '#home' });

	});

	$("#submit1").click(function ()
	{
		var t = $(this);
		t.button("loading"),
			setTimeout(function ()
			{
				t.button("reset")
			}, 3e3)
	}),
		Ladda.bind(".mt-ladda-btn",
			{ timeout: 2e3 }),
		Ladda.bind(".mt-ladda-btn.mt-progress-demo ",
			{ callback: function (t) { var n = 0, a = setInterval(function () { n = Math.min(n + .1 * Math.random(), 1), t.setProgress(n), 1 === n && (t.stop(), clearInterval(a)) }, 200) } });


	$('#empform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			firstapprover: false,
			firstname: "required",
			lastname: "required",
			othernames: "required",
			email: {
				required: true,
				// Specify that email should be validated
				// by the built-in "email" rule
				email: true
			},
			gendercode: "required",
			designationcode: "required",
			departmentcode: "required",
			countrycode: "required",
			hod: "required",
			employeetype: "required",
			physicaladdress: "required",
			phone: "required",
			employeeno: "required",
			officeno: "required",
			dob: "required",
			datehired: "required"

		},

		messages: {
			firstapprover: "Select First Approver",
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			othernames: "Please Enter Other Names",
			emailaddress: "Please Enter a valid email address",
			gendercode: "Please Select Gender Male/Female",
			designationcode: "Please Select Designation",
			departmentcode: "Please Select Department",
			countrycode: "Please Select Country",
			hod: "Please Select The head of department or the Manager",
			employeetype: "Please select the Employment Type(Permanent or Temporary/Contract)",
			physicaladdress: "Kindly Provide the physical address of the Employee",
			employeeno: "Kindly Provide the employee Number",
			phone: "Kindly Provide the employee Phone Number",
			officeno: "Kindly provide the employee office number",
			dob: "Kindly select Date Of Birth to proceed",
			datehired: "Kindly select Date hired to proceed"
		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			saveemployees();
			App.unblockUI("#home");


		}


	});

	$('#empeditform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side
			firstapprover: false,
			firstname: "required",
			lastname: "required",
			othernames: "required",
			email: {
				required: true,
				// Specify that email should be validated
				// by the built-in "email" rule
				email: true
			},
			gendercode: "required",
			designationcode: "required",
			departmentcode: "required",
			countrycode: "required",
			hod: "required",
			employeetype: "required",
			physicaladdress: "required",
			phone: "required",
			employeeno: "required",
			officeno: "required",
			dob: "required",
			datehired: "required"

		},

		messages: {
			firstapprover: "Select First Approver",
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			othernames: "Please Enter Other Names",
			emailaddress: "Please Enter a valid email address",
			gendercode: "Please Select Gender Male/Female",
			designationcode: "Please Select Designation",
			departmentcode: "Please Select Department",
			countrycode: "Please Select Country",
			hod: "Please Select The head of department or the Manager",
			employeetype: "Please select the Employment Type(Permanent or Temporary/Contract)",
			physicaladdress: "Kindly Provide the physical address of the Employee",
			employeeno: "Kindly Provide the employee Number",
			phone: "Kindly Provide the employee Phone Number",
			officeno: "Kindly provide the employee office number",
			dob: "Kindly select Date Of Birth to proceed",
			datehired: "Kindly select Date hired to proceed"
		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			editemployees();
			App.unblockUI("#home");


		}


	});

	$('#designationform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side		    
			designationcode: "required",
			designation: "required"

		},

		messages: {
			designationcode: "Please Enter Designation Code Required",
			designation: "Please enter designation"

		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			adddesignation();
			App.unblockUI("#home");


		}


	});

	$('#editdesignationform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side		    
			designationcode: "required",
			designation: "required"

		},

		messages: {
			designationcode: "Please Enter Designation Code Required",
			designation: "Please enter designation"

		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			editdesignation();
			App.unblockUI("#home");


		}


	});



	$('#departmentform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side		    
			departmentcode: "required",
			department: "required"

		},

		messages: {
			departmentcode: "Please Enter Designation Code Required",
			department: "Please enter designation"

		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			adddepartment();
			App.unblockUI("#home");


		}


	});

	$('#editdepartmentform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side		    
			designationcode: "required",
			designation: "required"

		},

		messages: {
			departmentcode: "Please Enter Department Code Required",
			department: "Please enter Department"

		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			editdepartment();
			App.unblockUI("#home");


		}


	});



	$('#departmentform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side		    
			departmentcode: "required",
			department: "required"

		},

		messages: {
			departmentcode: "Please Enter Designation Code Required",
			department: "Please enter designation"

		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			adddepartment();
			App.unblockUI("#home");


		}


	});


	$('#editcourseform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side		    
			course_id: "required",
			description: "required"

		},

		messages: {
			course_id: "Please Enter Course Code Required",
			description: "Please enter Course Description"

		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			editcourse();
			App.unblockUI("#home");


		}


	});

	$('#courseform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side		    
			course_id: "required",
			description: "required"

		},

		messages: {
			course_id: "Please Enter Course id Required",
			description: "Please enter description"

		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			addcourse();
			App.unblockUI("#home");


		}


	});


	$('#studentform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side		    
			email: "required",
			regno: "required",
			mobile: "required",
			admission_date: "required",
			name: "required",
			course_id: "required",
			deptcode: "required"

		},

		messages: {
			email: "Please Enter A valid Email",
			regno: "Please Enter Registration No",
			mobile: "Please Enter Mobile Number",
			admission_date: "Please Select Admission Date",
			name: "Please Enter Name",
			course_id: "PLease Enter Course",
			deptcode: "PLease Enter Department"

		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			addstudent();
			App.unblockUI("#home");


		}


	});

	$('#editstudentform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side		    
			email: "required",
			regno: "required",
			mobile: "required",
			admission_date: "required",
			name: "required",
			course_id: "required",
			deptcode: "required"

		},

		messages: {
			email: "Please Enter A valid Email",
			regno: "Please Enter Registration No",
			mobile: "Please Enter Mobile Number",
			admission_date: "Please Select Admission Date",
			name: "Please Enter Name",
			course_id: "PLease Enter Course",
			deptcode: "PLease Enter Department"

		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			editstudent();
			App.unblockUI("#home");


		}


	});

	$('#editholidayform').validate({
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side		    
			description: "required",
			sameeachyear: "required",
			holidaydate: "required"

		},

		messages: {
			description: "Please Enter description Code Required",
			sameeachyear: "Please Enter description Code Required",
			holidaydate: "Please select holidaydate"

		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");

		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			App.unblockUI("#home");


		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			App.unblockUI("#home");


		},

		submitHandler: function (form)
		{

			editholiday();
			App.unblockUI("#home");


		}


	});

	$('#form_validation').validate({
		rules: {
			'checkbox': {
				required: true
			},
			'gender': {
				required: true
			}
		},
		highlight: function (input)
		{
			$(input).parents('.form-line').addClass('error');
		},
		unhighlight: function (input)
		{
			$(input).parents('.form-line').removeClass('error');
		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
		}
	});

	//Advanced Form Validation
	$('#form_advanced_validation').validate({
		rules: {
			'date': {
				customdate: true
			},
			'creditcard': {
				creditcard: true
			}
		},
		highlight: function (input)
		{
			$(input).parents('.form-line').addClass('error');
		},
		unhighlight: function (input)
		{
			$(input).parents('.form-line').removeClass('error');
		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
		}
	});



	//Custom Validations ===============================================================================
	//Date
	$.validator.addMethod('customdate', function (value, element)
	{
		return value.match(/^\d\d\d\d?-\d\d?-\d\d$/);
	},
		'Please enter a date in the format YYYY-MM-DD.'
	);

	//Credit card
	$.validator.addMethod('creditcard', function (value, element)
	{
		return value.match(/^\d\d\d\d?-\d\d\d\d?-\d\d\d\d?-\d\d\d\d$/);
	},
		'Please enter a credit card in the format XXXX-XXXX-XXXX-XXXX.'
	);




	//Leave application Validation

	$('#appleave').validate({
		//set spinner 
		errorClass: "help-block help-block-error",
		rules: {
			// The key name on the left side is the name attribute
			// of an input field. Validation rules are defined
			// on the right side

			startdate: "required",
			lastdate: "required",
			dateexpected: "required",
			cboleavetype: "required",
			numberofleave: "required",
			comments: false


		},

		messages: {
			startdate: "Start Date Required",
			lastdate: "Last Date Required",
			dateexpected: "Date expected Required",
			cboleavetype: "Leave Type Required",
			numberofleave: "Number Of Days Applying For Required"

		},


		highlight: function (input)
		{
			$(input).parents('.form-group').addClass('has-error');
			App.unblockUI("#home");
		},
		unhighlight: function (input)
		{
			$(input).parents('.form-group').removeClass('has-error');
			//App.unblockUI("#home");

		},
		errorPlacement: function (error, element)
		{
			$(element).parents('.form-group').append(error);
			$("#err").show();
			//App.unblockUI("#home");		

		},

		submitHandler: function (form)
		{
			leaveapplications();
			//App.unblockUI("#home");


		}


	});



	$('.btmapprove').click(function (e)
	{
		e.preventDefault();
		var l = Ladda.create(this);
		l.isLoading();
		l.setProgress(0 - 1);
		l.start();

		var url = $("#url").val();
		var appnum = '1';
		var Leavetype = 'A';
		$.ajax({
			type: "POST",
			data: {
				appnum: appnum,
				Leavetype: Leavetype,
			},

			url: url + "applyleave/approveleave",
			success: function (data)
			{
				//alert(data);
				l.stop();
				//$('#succ').text(data);								
				//$( "#err" ).hide();
				// $( "#succ" ).show();				

			}



		});
	});

});
