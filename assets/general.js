function saveemployees()
{

	//var description = $("#description").val();	
	var url = $("#url").val();
	var employeeno = $("#employeeno").val();
	var firstname = $("#firstname").val();
	var lastname = $("#lastname").val();
	var othernames = $("#othernames").val();
	var email = $("#email").val();
	var gendercode = $("#gendercode").val();
	var designationcode = $("#designationcode").val();
	var departmentcode = $("#departmentcode").val();
	var countrycode = $("#countrycode").val();
	var hod = $("#hod").val();
	var employeetype = $("#employeetype").val();
	var physicaladdress = $("#physicaladdress").val();
	var phone = $("#phone").val();
	var officeno = $("#officeno").val();
	var datehired = $("#datehired").val();
	var dob = $("#dob").val();
	var approvallevel = $("#approvallevel").val();
	var firstapprover = $("#firstapprover").val();
	var altfirstapprover = $("#altfirstapprover").val();
	var secondapprover = $("#secondapprover").val();
	var altsecondapprover = $("#altsecondapprover").val();
	var thirdapprover = $("#thirdapprover").val();
	var altthirdapprover = $("#altthirdapprover").val();

	var countmonday = isChecked('monday') ? 'Y' : 'N';
	var counttuesday = isChecked('tuesady') ? 'Y' : 'N';
	var countwednesday = isChecked('wednesday') ? 'Y' : 'N';
	var countthursday = isChecked('thursday') ? 'Y' : 'N';
	var countfriday = isChecked('friday') ? 'Y' : 'N';
	var countsaturday = isChecked('saturday') ? 'Y' : 'N';
	var countsunday = isChecked('sunday') ? 'Y' : 'N';
	var countholiday = isChecked('holiday') ? 'Y' : 'N';
	uploadfile(url);

	validatedob(dob);

	$.ajax({
		type: "POST",
		data: {
			employeeno: employeeno,
			firstname: firstname,
			lastname: lastname,
			othernames: othernames,
			email: email,
			gendercode: gendercode,
			designationcode: designationcode,
			departmentcode: departmentcode,
			countrycode: countrycode,
			hod: hod,
			employeetype: employeetype,
			physicaladdress: physicaladdress,
			phone: phone,
			datehired: datehired,
			dob: dob,
			officeno: officeno,
			firstapprover: firstapprover,
			altfirstapprover: altfirstapprover,
			secondapprover: secondapprover,
			altsecondapprover: altsecondapprover,
			thirdapprover: thirdapprover,
			approvallevel: approvallevel,
			altthirdapprover: altthirdapprover,
			countmonday: countmonday,
			counttuesday: counttuesday,
			countwednesday: countwednesday,
			countthursday: countthursday,
			countfriday: countfriday,
			countsaturday: countsaturday,
			countsunday: countsunday,
			countholiday: countholiday,

		},

		url: url + "home/saveemployees",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added, An Email Has been sent to the employee Email address to Create his/her Login Details");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added, An Email Has been sent to the employee Email address to Create his/her Login Details");
				$("#err").hide();
				$("#succ").show();

				$("#employeeno").val("");
				$("#firstname").val("");
				$("#lastname").val("");
				$("#othernames").val("");
				$("#email").val("");
				$("#gendercode").val("");
				$("#designationcode").val("");
				$("#departmentcode").val("");
				$("#countrycode").val("");
				$("#hod").val("");
				$("#employeetype").val("");
				$("#physicaladdress").val("");
				$("#phone").val("");
				$("#officeno").val("");
				$("#datehired").val("");
				$("#dob").val("");
				$("#approvallevel").val("");
				$("#firstapprover").val("");
				$("#altfirstapprover").val("");
				$("#secondapprover").val("");
				$("#altsecondapprover").val("");
				$("#thirdapprover").val("");
				$("#altthirdapprover").val("");

			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}

function editemployees()
{

	//var description = $("#description").val();	
	var url = $("#url").val();
	var employeeno = $("#employeeno").val();
	var firstname = $("#firstname").val();
	var lastname = $("#lastname").val();
	var othernames = $("#othernames").val();
	var email = $("#email").val();
	var gendercode = $("#gendercode").val();
	var designationcode = $("#designationcode").val();
	var departmentcode = $("#departmentcode").val();
	var countrycode = $("#countrycode").val();
	var hod = $("#hod").val();
	var employeetype = $("#employeetype").val();
	var physicaladdress = $("#physicaladdress").val();
	var phone = $("#phone").val();
	var officeno = $("#officeno").val();
	var datehired = $("#datehired").val();
	var dob = $("#dob").val();
	var approvallevel = $("#approvallevel").val();
	var firstapprover = $("#firstapprover").val();
	var altfirstapprover = $("#altfirstapprover").val();
	var secondapprover = $("#secondapprover").val();
	var altsecondapprover = $("#altsecondapprover").val();
	var thirdapprover = $("#thirdapprover").val();
	var altthirdapprover = $("#altthirdapprover").val();
	var countmonday = isChecked('monday') ? 'Y' : 'N';
	var counttuesday = isChecked('tuesady') ? 'Y' : 'N';
	var countwednesday = isChecked('wednesday') ? 'Y' : 'N';
	var countthursday = isChecked('thursday') ? 'Y' : 'N';
	var countfriday = isChecked('friday') ? 'Y' : 'N';
	var countsaturday = isChecked('saturday') ? 'Y' : 'N';
	var countsunday = isChecked('sunday') ? 'Y' : 'N';
	var countholiday = isChecked('holiday') ? 'Y' : 'N';

	//Upload File Edit		  
	uploadfileedit(url);

	validatedob(dob);

	$.ajax({
		type: "POST",
		data: {
			employeeno: employeeno,
			firstname: firstname,
			lastname: lastname,
			othernames: othernames,
			email: email,
			gendercode: gendercode,
			designationcode: designationcode,
			departmentcode: departmentcode,
			countrycode: countrycode,
			hod: hod,
			employeetype: employeetype,
			physicaladdress: physicaladdress,
			phone: phone,
			datehired: datehired,
			dob: dob,
			officeno: officeno,
			firstapprover: firstapprover,
			altfirstapprover: altfirstapprover,
			secondapprover: secondapprover,
			altsecondapprover: altsecondapprover,
			thirdapprover: thirdapprover,
			approvallevel: approvallevel,
			altthirdapprover: altthirdapprover,
			countmonday: countmonday,
			counttuesday: counttuesday,
			countwednesday: countwednesday,
			countthursday: countthursday,
			countfriday: countfriday,
			countsaturday: countsaturday,
			countsunday: countsunday,
			countholiday: countholiday,

		},

		url: url + "home/editemployees",
		success: function (data)
		{
			$('#succ').text("Record Successfully Updated");

			if (data == "Success")
			{
				showsuccess("Record Successfully Update");
				$("#err").hide();
				$("#succ").show();
				window.location = url + "employees";
			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}

function adddesignation()
{

	//var description = $("#description").val();	
	var url = $("#url").val();
	var designationcode = $("#designationcode").val();
	var designation = $("#designation").val();


	$.ajax({
		type: "POST",
		data: {
			designation: designation,
			designationcode: designationcode,

		},

		url: url + "designation/adddesignation",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added");
				$("#err").hide();
				$("#succ").show();

				$("#designationcode").val("");
				$("#designation").val("");


			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}


function editdesignation()
{


	//var description = $("#description").val();	
	var url = $("#url").val();
	var designationcode = $("#designationcode").val();
	var designation = $("#designation").val();


	$.ajax({
		type: "POST",
		data: {
			designation: designation,
			designationcode: designationcode,

		},

		url: url + "designation/editdesignation",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added");
				$("#err").hide();
				$("#succ").show();

				$("#designationcode").val("");
				$("#designation").val("");


			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}


function adddepartment()
{

	//var description = $("#description").val();	
	var url = $("#url").val();
	var departmentcode = $("#departmentcode").val();
	var department = $("#department").val();


	$.ajax({
		type: "POST",
		data: {
			department: department,
			departmentcode: departmentcode,

		},

		url: url + "department/adddepartment",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added");
				$("#err").hide();
				$("#succ").show();

				$("#departmentcode").val("");
				$("#department").val("");


			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}


function editdepartment()
{


	//var description = $("#description").val();	
	var url = $("#url").val();
	var departmentcode = $("#departmentcode").val();
	var department = $("#department").val();


	$.ajax({
		type: "POST",
		data: {
			department: department,
			departmentcode: departmentcode,

		},

		url: url + "department/editdepartment",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added");
				$("#err").hide();
				$("#succ").show();

				$("#departmentcode").val("");
				$("#department").val("");


			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}

function editcourse()
{
	//var description = $("#description").val();	
	var url = $("#url").val();
	var course_id = $("#course_id").val();
	var description = $("#description").val();


	$.ajax({
		type: "POST",
		data: {
			description: description,
			course_id: course_id,

		},

		url: url + "course/editcourse",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added");
				$("#err").hide();
				$("#succ").show();

				$("#course_id").val("");
				$("#description").val("");


			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}

function addcourse()
{

	//var description = $("#description").val();	
	var url = $("#url").val();
	var course_id = $("#course_id").val();
	var description = $("#description").val();


	$.ajax({
		type: "POST",
		data: {
			description: description,
			course_id: course_id,

		},

		url: url + "course/addstudent",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added");
				$("#err").hide();
				$("#succ").show();

				$("#course_id").val("");
				$("#description").val("");


			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}

function addstudent()
{

	//var description = $("#description").val();	
	var url = $("#url").val();
	var regno = $("#regno").val();
	var name = $("#name").val();
	var admission_date = $("#admission_date").val();
	var email = $("#email").val();
	var course_id = $("#course_id").val();
	var mobile = $("#mobile").val();
	var deptcode = $("#deptcode").val();


	$.ajax({
		type: "POST",
		data: {
			regno: regno,
			name: name,
			admission_date: admission_date,
			email: email,
			course_id: course_id,
			mobile: mobile,
			deptcode: deptcode,

		},

		url: url + "student/addstudent",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added");
				$("#err").hide();
				$("#succ").show();

				$("#regno").val("");
				$("#name").val("");
				$("#admission_date").val("");
				$("#email").val("");
				$("#course_id").val("");
				$("#mobile").val("");
				$("#deptcode").val("");



			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}

function editstudent()
{

	//var description = $("#description").val();	
	var url = $("#url").val();
	var regno = $("#regno").val();
	var name = $("#name").val();
	var admission_date = $("#admission_date").val();
	var email = $("#email").val();
	var course_id = $("#course_id").val();
	var mobile = $("#mobile").val();
	var deptcode = $("#deptcode").val();

	$.ajax({
		type: "POST",
		data: {
			regno: regno,
			name: name,
			admission_date: admission_date,
			email: email,
			course_id: course_id,
			mobile: mobile,
			deptcode: deptcode,

		},

		url: url + "student/editstudent",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added");
				$("#err").hide();
				$("#succ").show();
				$("#regno").val("");
				$("#name").val("");
				$("#admission_date").val("");
				$("#email").val("");
				$("#course_id").val("");
				$("#mobile").val("");
				$("#deptcode").val("");
			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}


function addholiday()
{

	//var description = $("#description").val();	
	var url = $("#url").val();
	var description = $("#description").val();
	var holidaydate = $("#holidaydate").val();
	var sameeachyear = $("#sameeachyear").val();


	$.ajax({
		type: "POST",
		data: {
			description: description,
			HolidayDate: holidaydate,
			sameeachyear: sameeachyear,

		},

		url: url + "holiday/addholiday",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added");
				$("#err").hide();
				$("#succ").show();

				$("#description").val("");
				$("#holidaydate").val("");
				$("#sameeachyear").val("");


			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}


function editholiday()
{


	//var description = $("#description").val();	
	var url = $("#url").val();
	var description = $("#description").val();
	var holidaydate = $("#holidaydate").val();
	var sameeachyear = $("#sameeachyear").val();


	$.ajax({
		type: "POST",
		data: {
			description: description,
			HolidayDate: holidaydate,
			sameeachyear: sameeachyear,

		},

		url: url + "holiday/editholiday",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added");
				$("#err").hide();
				$("#succ").show();

				$("#description").val("");
				$("#holidaydate").val("");
				$("#sameeachyear").val("");


			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}

	});

}

function leaveapplications()
{
	$('#home').block({
		message: '<i class="fa fa-spinner fa-spin"></i> Leave Application In progress, Please be Patient...',
		css: { border: '3px solid #a00' }
	});
	var url = $("#url").val();
	var startdate = $("#startdate").val();
	var lastdate = $("#lastdate").val();
	var dateexpected = $("#dateexpected").val();
	var comments = $("#comments").val();
	var numberofleave = $("#numberofleave").val();
	var leavetype = $("#cboleavetype").val();
	var attachment = "";

	if (lastdate == "")
	{
		$("#err").text("Last Date Required");
		$("#err").show();
		showerrortop();
		return false;
	}

	if (dateexpected == "")
	{
		$("#err").text("Date Expected Required");
		$("#err").show();
		showerrortop();
		return false;
	}

	if (startdate == "")
	{
		$("#err").text("Start Date Required");
		$("#err").show();
		showerrortop();
		return false;
	}

	$.ajax({
		type: "POST",
		data: {
			startdate: startdate,
			lastdate: lastdate,
			dateexpected: dateexpected,
			comments: comments,
			leavetype: leavetype,
			attachment: attachment,
			numberofleave: numberofleave,

		},

		url: url + "applyleave/leaveapplications",
		success: function (data)
		{
			//$('#succ').text("Record Successfully Added");								

			if (data == "Success")
			{

				showsuccess("Leave Application Is Successful, Kindly Read the Instruction on top of  the Application Form ");
				$("#err").hide();
				$("#succ").show();

				$("#startdate").val("");
				$("#startdate").val("");
				$("#dateexpected").val("");
				$("#comments").val("");
				$("#numberofleave").val("0");
				App.unblockUI("#home");
				//window.location.reload(); 
			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
				App.unblockUI("#home");

			}
		}

	});

}
function checkduedates()
{

	var url = $("#url").val();
	var startdate = $("#applicationdate").val();
	var numofdays = $("#numberofleave").val();
	if (numofdays == 0)
	{
		alert("Number Of Leave Applying For cannot be Zero");
		return false;
	}

	if (numofdays == "")
	{
		alert("Number Of Leave Applying For cannot be Zero");
		return false;
	}
	$.ajax({
		type: "POST",
		data: {
			startdate: startdate,
		},

		url: url + "applyleave/determinestartdate",
		success: function (data)
		{
			determinelastdate(data);
			$("#startdate").val(data)
			//$('#succ').text(data);								
			//$( "#err" ).hide();
			//$( "#succ" ).show();				

		}

	});

}

function determinelastdate(startdate)
{

	var url = $("#url").val();
	var numofdays = $("#numberofleave").val();
	if (numofdays == "")
	{
		alert("Days Applying For Cannot Be Blank");
		return false;
	}

	if (numofdays == 0)
	{
		alert("Days Applying For Cannot Be Zero");
		return false;
	}

	var startdate = startdate;
	$.ajax({
		type: "POST",
		data: {
			numofdays: numofdays,
			startdate: startdate,
		},

		url: url + "applyleave/determinelastdate",
		success: function (data)
		{
			$("#lastdate").val(data)//Adjust last date
			determinedateexpected(data);

			//$('#succ').text(data);								
			//$( "#err" ).hide();
			// $( "#succ" ).show();				

		}

	});

}

function determinedateexpected(lastdate)
{

	var url = $("#url").val();
	var lastdate = lastdate;
	$.ajax({
		type: "POST",
		data: {
			lastdate: lastdate,
		},

		url: url + "applyleave/determinedateexpected",
		success: function (data)
		{
			$("#dateexpected").val(data)
			//$('#succ').text(data);								
			//$( "#err" ).hide();
			// $( "#succ" ).show();				

		}

	});

}

function loadbalances()
{

	var url = $("#url").val();
	var leavetype = $("#cboleavetype").val();
	App.blockUI({ target: '#balances' });
	$.ajax({
		type: "POST",
		data: {
			leavetype: leavetype,
		},

		url: url + "applyleave/loadleavebalances",
		success: function (data)
		{

			document.getElementById("balances").innerHTML = data;
			App.unblockUI("#balances");
			//$( "#err" ).hide();
			// $( "#succ" ).show();				

		}

	});

}

function showerror()
{
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-top-center",
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "500000000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
	toastr.error('You have Some Error to Correct? ,Kindly Correct them and proceed');
}

function showerrortop()
{
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-top-center",
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "500000000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
	toastr.error('You have Some Error to Correct? ,Kindly Check On The error Details at The top');
}

function showsuccess(data)
{
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-top-full-width",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
	toastr.success(data);
}

function validatedob(dob)  
{
	var arr_dateText = dob.split("/");
	day = arr_dateText[0];
	month = arr_dateText[1];
	year = arr_dateText[2];

	var mydate = new Date();
	mydate.setFullYear(year, month - 1, day);

	var maxDate = new Date();
	maxDate.setYear(maxDate.getFullYear() - 18);

	if (maxDate < mydate)
	{
		showerror("Sorry, only persons over the age of 18 can be Employed, Please Review Date of Birth And Submit!");
		$("#err").val("Sorry, only persons over the age of 18 can be Employed, Please Review Date of Birth And Submit!");
		$("#err").show();
		return false;
	}
}

function deleterecord(table, field, value)     
{
	bootbox.confirm(
		"Are you sure you want to delete this Record?",
		function (o)
		{
			if (o == true)
			{
				var url = $("#url").val();
				$.ajax({
					type: "POST",
					data: {
						table: table,
						field: field,
						value: value
					},

					url: url + "home/deleterecord",
					success: function (data)
					{

						$('#succ').text("Record Deleted Successfully");
						$("#succ").show();
						$("#err").hide();
						//location.reload();
						if (data == "Success")
						{
							showsuccess("Record Delete Success");
						} else
						{
							showerror();
						}
					}
				});


			} else
			{
				bootbox.alert("Delete Cancelled");
			}
		});

}


function setApprovers(approvalLevel)
{

	switch (eval(approvalLevel))
	{
		case 1:
			EnableObject('firstapprover', 'altfirstapprover');
			DisableObject('secondapprover', 'thirdapprover', 'altsecondapprover', 'altthirdapprover');
			return;
		case 2:
			EnableObject('firstapprover', 'secondapprover', 'altfirstapprover', 'altsecondapprover');
			DisableObject('thirdapprover', 'altthirdapprover');
			return;
		case 3:
			EnableObject('firstapprover', 'secondapprover', 'thirdapprover', 'altfirstapprover', 'altsecondapprover', 'altthirdapprover');
			//DisableObject('cboFourthApprover','cboAltFourthApprover');
			//return;
			//case 4:
			//	EnableObject('cboFourthApprover','cboAltFourthApprover','cboFirstApprover','cboSecondApprover','cboThirdApprover','cboAltFirstApprover','cboAltSecondApprover','cboAltThirdApprover');
			return;
		default:
			DisableObject('firstapprover', 'secondapprover', 'thirdapprover', 'altfirstapprover', 'altsecondapprover', 'altthirdapprover');
	}
}

function register(regno, course_id, unit, roomnumber, lessontime, lessondate)
{


	var url = $("#url").val();
	var regno = regno;
	var lessondate = lessondate;
	var lessontime = lessontime;
	var course_id = course_id;
	var unit = unit;
	var roomnumber = roomnumber;


	$.ajax({
		type: "POST",
		data: {
			regno: regno,
			lessondate: lessondate,
			lessontime: lessontime,
			course_id: course_id,
			unit: unit,
			roomnumber: roomnumber,
		},

		url: url + "Attendanceregister/register",
		success: function (data)
		{
			$('#succ').text("Record Successfully Added");

			if (data == "Success")
			{
				showsuccess("Record Successfully Added");
				$("#err").hide();
				$("#succ").show();
			} else
			{
				showerror();
				$("#err").text(data);
				$("#err").show();
			}
		}
	});
}


function EnableObject()
{
	var args = EnableObject.arguments;
	for (var i = 0; i < args.length; i++)
	{
		try
		{
			document.getElementById(args[i]).disabled = false;
		}
		catch (e)
		{
			//alert(e+': '+args[i]);
		}
	}
}

function DisableObject()
{
	var args = DisableObject.arguments;
	for (var i = 0; i < args.length; i++)
	{
		try
		{
			document.getElementById(args[i]).disabled = true;
		}
		catch (e)
		{
			alert(e + ': ' + args[i]);
		}
	}
}


function isChecked(chkBox)
{
	try
	{
		if (document.getElementById(chkBox).checked == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	catch (e)
	{
		return false;
		//alert(e+' ' +chkBox)	
	}
}

function check()
{
	var args = check.arguments;

	for (var i = 0; i < args.length; i++)
	{
		if (document.getElementById(args[i]).checked == false)
		{
			try
			{
				document.getElementById(args[i]).checked = true;
			}
			catch (e)
			{
				alert(e);
			}
		}
	}
}

function uncheck()
{
	var args = uncheck.arguments;

	for (var i = 0; i < args.length; i++)
	{
		if (document.getElementById(args[i]).checked == true)
		{
			try
			{
				document.getElementById(args[i]).checked = false;
			}
			catch (e)
			{
				alert(e);
			}
		}
	}
}


function uploadfile(vlink)
{

	var file = new FormData($('#empform')[0]);
	// alert($('#file_path')[0].files[0]);
	$.ajax({
		url: vlink + 'home/upload',
		type: 'POST',
		data: file,
		mimeType: 'multipart/form-data',
		processData: false,  // tell jQuery not to process the data
		contentType: false,  // tell jQuery not to set contentType
		success: function (data)
		{

			if (data == "Invalid File")
			{
				showsuccess(data);
				showerror();
				return false;
			} else
			{
				showsuccess("File Upload Success");
			}


		}
	});
}

function uploadfileedit(vlink)
{

	var file = new FormData($('#empeditform')[0]);
	// alert($('#file_path')[0].files[0]);
	$.ajax({
		url: vlink + 'home/upload',
		type: 'POST',
		data: file,
		mimeType: 'multipart/form-data',
		processData: false,  // tell jQuery not to process the data
		contentType: false,  // tell jQuery not to set contentType
		success: function (data)
		{

			if (data == "Invalid File")
			{
				showsuccess(data);
				showerror();
				return false;
			} else
			{
				showsuccess("File Upload Success");
			}


		}
	});
}

function approveleave()
{
	// App.blockUI({target:'#mainapproval'});
	//show spinner while approving Leave
	$('#mainapproval').block({
		message: '<i class="fa fa-spinner fa-spin"></i> Leave Approval in Progress...',
		css: { border: '3px solid #a00', pading: '5px' }
	});
	///end of spinner while approving Leave
	var url = $("#url").val();
	var appnum = $("#appnum").val();
	var Leavetype = $("#leavetype").val();
	var level = $("#level").val();
	var dateexpected = $("#DateExpected").val();
	var startdate = $("#StartDate").val();
	var lastdate = $("#LastDate").val();
	var daysapplied = $("#DaysApplied").val();
	var comments = $("#comments").val();
	var step = $("#step").val();
	$.ajax({
		type: "POST",
		data: {
			appnum: appnum,
			Leavetype: Leavetype,
			level: level,
			dateexpected: dateexpected,
			startdate: startdate,
			lastdate: lastdate,
			daysapplied: daysapplied,
			comments: comments,
			step: step,
		},
		url: url + "Approveleave/approveleave",
		success: function (data)
		{
			showsuccess(data);
			App.unblockUI("#mainapproval");
			$("#mainapproval").text(data);
			$("#sub").hide();
			$("#subcan").hide();
			// window.location.reload();			  

			//$( "#err" ).hide();
			//$( "#succ" ).show();				

		}



	});
}

function deleterecordnote(field, table, value)
{
	// App.blockUI({target:'#mainapproval'});
	//show spinner while approving Leave
	$('#commentpanel').block({
		message: '<i class="fa fa-spinner fa-spin"></i> Leave Approval in Progress...',
		css: { border: '3px solid #a00', pading: '5px' }
	});
	///end of spinner while approving Leave
	var url = $("#url").val();
	$.ajax({
		type: "POST",
		data: {
			field: field,
			table: table,
			value: value,
		},
		url: url + "home/deletenotification",
		success: function (data)
		{
			showsuccess(data);
			App.unblockUI("#commentpanel");
			reloadwindow();

		}



	});
}

function reloadwindow()
{
	window.location.reload();
}


