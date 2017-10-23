// validate add/edit contact form on keyup and submit
		$("#addeditcontact").validate({
			rules: {
				fname: "required",
				lname: "required",
                                title: "required",
				phone: {
					required: true,
					minlength: 8
				},
                                email: {
					required: true,
					email: true
				}
			},
			messages: {
				fname: "Please enter your firstname",
				lname: "Please enter your lastname",
                                lname: "Please enter your Title",
				phone: {
					required: "Please enter a Phone Number",
					minlength: "Your username must consist of at least 8 characters"
				},
                                email: "Please enter a valid email address",
				
			}
                }); // end of  validate add/edit contact form on keyup and submit
                
                $("#addeditgender").validate({
			rules: {
				gender: "required",
				gender_abbrv: "required",
			},
			messages: {
				gender: "Please enter your gender",
				gender_abbrv: "Please enter your gender abbreviation"
                               
			}
                }); // end of  validate add/edit genders table form on keyup and submit
                
                
                $("#addeditproductype").validate({
			rules: {
				product_type: "required"
			},
			messages: {
				product_type: "Please enter Product Type"
                               
			}
                }); // end of  validate add/edit product type table form on keyup and submit
                
                  $("#addeditstudytype").validate({
			rules: {
				study_type: "required"
			},
			messages: {
				study_type: "Please enter Study Type"
                               
			}
                }); // end of  validate add/edit product type table form on keyup and submit
                
                $("#addeditclassific").validate({
			rules: {
				classification: "required"
			},
			messages: {
				classification: "Please enter Classification"
                               
			}
                }); // end of  validate add/edit product type table form on keyup and submit
                
                $("#addeditparticipant").validate({
			rules: {
				fname: "required",
                                lname: "required",
			},
			messages: {
				fname: "Please enter First Name",
                                lname: "Please enter Last Name"
                               
			}
                }); // end of  validate add/edit participant table form on keyup and submit
                
                 $("#addeditstudy").validate({
			rules: {
				client_id: "required",
                                product_name: "required",
			},
			messages: {
				client_id: "Please Select Client",
                                product_name: "Please enter Product Name"
                               
			}
                }); // end of  validate add/edit participant table form on keyup and submit
                
                 $("#addeditquestion").validate({
			rules: {
                                question: "required"
			},
			messages: {
                                question: "Please enter Question"
                               
			}
                }); // end of  validate add/edit participant table form on keyup and submit
                
                
    
    //confirmation before deleta
    $("a.delete").click(function(e){
        if(!confirm('Are you sure?')){
            e.preventDefault();
            return false;
        }
        return true;
    });


/*******************************************iaa_cms**********************************************************/


$("#loginform").validate({
	rules:{
		username:{
				required: true,
			},
		password:{
				required: true,
			},	
		},
	messages:{
		username:{
				required: "Please enter the username.",
			},
		password:{
				required: "Please enter the password.",
			},
		},
});
$("#forgotpasswordform").validate({
	rules:{
		email:{
				required: true,
				email: true,
			},	
		},
	messages:{
		email:{
				required: "Please enter the email.",
				email: "Please enter valid email address.",
			},
		},
});
$("#resetpassword_form").validate({
	rules:{
		newpassword:{
				required: true,
			},
		confirmpassword:{
				required: true,
				equalTo: '#newpassword'
			},	
		},
	messages:{
		newpassword:{
				required: "Please enter the new password.",
			},
		confirmpassword:{
				required: "Please enter confirm password.",
				equalTo: "Password do not match.",
			},
		},
});

// validate add/edit user form on keyup and submit
		$("#changepassword").validate({
			rules: {
				
				password: {
					required: true,
					minlength: 5
				},
				cpassword: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				}
			},
			messages: {
				
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				cpassword: {
					required: "Please provide a confirm password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				}
				
			}
		});
                
                
                $("#addedituser").validate({
			rules: {
				fname: "required",
				lname: "required",
				username: {
					required: true,
					minlength: 2
				},
				password: {
					required: true,
					minlength: 5
				},
				cpassword: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				email: {
					required: true,
					email: true
				}
			},
			messages: {
				fname: "Please enter your firstname",
				lname: "Please enter your lastname",
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				cpassword: {
					required: "Please provide a confirm password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				email: "Please enter a valid email address",
				
			}
		});
                

		// propose username by combining first- and lastname
		$("#username").focus(function() {
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			if (firstname && lastname && !this.value) {
				this.value = firstname + "." + lastname;
			}
		});
          
       