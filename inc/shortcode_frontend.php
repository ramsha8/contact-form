	
<?php  


if(empty($atts['id'])) return "Provide an Id.";  
 $id=sanitize_text_field($atts['id']) ;
   $contact_configuration = unserialize(get_post_meta($id, 'contact_configuration', true));
    $first_name="";$last_name='';$job_title='';$company='';$message='';$website_link='';
   if(isset($contact_configuration['first_name'])){
      $first_name_m=(isset($contact_configuration['first_name_m']))?'required':'';
$first_name='<p>
        <label for="first_name">First Name:</label><br>
        <input type="text" '.$first_name_m.' class="w-100" id="first_name" name="first_name" value="">
<span class="error"></span>
    </p>
  ';
   }

     if(isset($contact_configuration['last_name'])){
      $last_name_m=(isset($contact_configuration['last_name_m']))?'required':'';

  $last_name=' <p>
        <label for="last_name">Last Name:</label><br>
        <input type="text" '.$last_name_m.' class="w-100"id="last_name" name="last_name" value="">
        <span class="error"></span>
    </p>';
   } 
   if(isset($contact_configuration['job_title'])){
$job_title_m=(isset($contact_configuration['job_title_m']))?'required':'';
$job_title='    <p>
        <label for="job_title">Job Title:</label><br>
        <input type="text" '.$job_title_m.' class="w-100" id="job_title" name="job_title" value="">
        <span class="error"></span>
    </p>';

   }
   if(isset($contact_configuration['company'])){
    $company_m=(isset($contact_configuration['company_m']))?'required':'';
$company='    <p>
        <label for="company">Company:</label><br>
        <input type="text" '.$company_m.' class="w-100"id="company" name="company" value="">
        <span class="error"></span>
    </p> ';

   }
   if(isset($contact_configuration['website_link'])){
    $website_link_m=(isset($contact_configuration['website_link_m']))?'required':'';
$website_link='    <p>
        <label for="company">Website URL:</label><br>
        <input type="text" '.$website_link_m.' class="w-100"id="website_link" name="website_link" value="">
        <span class="error"></span>
    </p> ';

   }
   if(isset($contact_configuration['message'])){
$message_m=(isset($contact_configuration['message_m']))?'required':'';
  $message='<p>
        <label for="message">Message/Question:</label><br>
        <textarea id="message" '.$message_m.' class="w-100" placeholder="Write you query here." name="message"></textarea><span class="error"></span>
    </p>';
   }

$display=(isset($contact_configuration['display']))?esc_attr($contact_configuration['display']):'page';
$website_url=(isset($contact_configuration['website_url']))?esc_attr($contact_configuration['website_url']):'#';

$result="";$marginTop="";$height="158";
if($display=="popup" && count($contact_configuration)>5){$marginTop="margin-top:8em;";}
if($display=="slider" && count($contact_configuration)>3){$height="12";}

    // Include necessary CSS and JavaScript files based on the chosen style
$form= '<style>  .w-100{width:100%;}.error{color:#FF0000;}  textarea#message{height:'.$height.'px ;}
.d-none{display:none;} .bg-lightgreen{background:#93ff93;} .text-center{text-align:center;}
.success-msg,.failure-msg{padding: 6px !important; border: 1px solid #bdbdbd; border-radius: 8px; font-weight:500;}p{padding-bottom:1em;}textarea#message{padding-left: 5px;}.submit-button { display: inline-block; padding: 10px 20px; font-size: 16px; font-weight: bold; text-align: center; text-decoration: none; background-color: #4CAF50; color: #fff; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease; } .submit-button:hover { background-color: #45a049; } .submit-button:active { background-color: #3e8e41; }
.bg-lightred{background:#ff9b9b;} 
</style>
<div class="success-msg d-none bg-lightgreen text-center">Form submitted successfully!</div>
<div class="failure-msg d-none bg-lightred text-center">Form submission failed!</div>
<form method="POST" id="contact-us" onsubmit="validation(event)" novalidate>
'.$first_name.$last_name.$job_title.$company.$website_link.$message.'

     <br><p class="text-center">  <button class="submit-button">Submit</button></p>
    </form>
<script type="text/javascript">
function validation(event) {
  event.preventDefault();
  var count = 0;

  var firstNameElement = document.getElementById("first_name");
  if (firstNameElement !== null) {
    var isFirstNameRequired = firstNameElement.required;
    if (firstNameElement.value == "" && isFirstNameRequired) {
      count++;
      firstNameElement.nextElementSibling.style.display = "block";
      firstNameElement.nextElementSibling.textContent = "First name is required.";
    } else {
      if (/^\d+$/.test(firstNameElement.value)) {
        count++;
        firstNameElement.nextElementSibling.style.display = "block";
        firstNameElement.nextElementSibling.textContent = "First name cannot be a number.";
      } else {
        firstNameElement.nextElementSibling.style.display = "none";
      }
    }
  }

  var lastNameElement = document.getElementById("last_name");
  if (lastNameElement !== null) {
    var isLastNameRequired = lastNameElement.required;
    if (lastNameElement.value == "" && isLastNameRequired) {
      count++;
      lastNameElement.nextElementSibling.style.display = "block";
      lastNameElement.nextElementSibling.textContent = "Last name is required.";
    } else {
      if (/^\d+$/.test(lastNameElement.value)) {
        count++;
        lastNameElement.nextElementSibling.style.display = "block";
        lastNameElement.nextElementSibling.textContent = "Last name cannot be a number.";
      } else {
        lastNameElement.nextElementSibling.style.display = "none";
      }
    }
  }

  var website_link = document.getElementById("website_link");
  if (website_link !== null) {
    var website_linkr = website_link.required;
    if (website_link.value == "" && website_linkr) {
      count++;
      website_link.nextElementSibling.style.display = "block";
      website_link.nextElementSibling.textContent = "Website URL is required.";
    } else {
      if (/^(http(s)?:\/\/)?(www\.)?[a-zA-Z0-9_-]+(\.[a-zA-Z]+)+([/?#]\S*)?$/.test(website_link.value)) {
        website_link.nextElementSibling.style.display = "none";
      } else {
        count++;
        website_link.nextElementSibling.style.display = "block";
        website_link.nextElementSibling.textContent = "Website URL is not valid.";
      }
    }
  }

  var jobTitleElement = document.getElementById("job_title");
  if (jobTitleElement !== null) {
    var isJobTitleRequired = jobTitleElement.required;
    if (jobTitleElement.value == "" && isJobTitleRequired) {
      count++;
      jobTitleElement.nextElementSibling.style.display = "block";
      jobTitleElement.nextElementSibling.textContent = "Job title is required.";
    } else {
      if (/^\d+$/.test(jobTitleElement.value)) {
        jobTitleElement.nextElementSibling.style.display = "block";
        jobTitleElement.nextElementSibling.textContent = "Job title cannot be a number.";
        count++;
      } else {
        jobTitleElement.nextElementSibling.style.display = "none";
      }
    }
  }

  var companyElement = document.getElementById("company");
  if (companyElement !== null) {
    var isCompanyRequired = companyElement.required;
    if (companyElement.value == "" && isCompanyRequired) {
      count++;
      companyElement.nextElementSibling.style.display = "block";
      companyElement.nextElementSibling.textContent = "Company name is required.";
    } else {
      if (/^\d+$/.test(companyElement.value)) {
        count++;
        companyElement.nextElementSibling.style.display = "block";
        companyElement.nextElementSibling.textContent = "Company name cannot be a number.";
      } else {
        companyElement.nextElementSibling.style.display = "none";
      }
    }
  }

  var messageElement = document.getElementById("message");
  if (messageElement !== null) {
    var isMessageRequired = messageElement.required;
    if (messageElement.value == "" && isMessageRequired) {
      count++;
      messageElement.nextElementSibling.style.display = "block";
      messageElement.nextElementSibling.textContent = "Message is required.";
    } else {
      if (messageElement.value.length < 10) {
        count++;
        messageElement.nextElementSibling.style.display = "block";
        messageElement.nextElementSibling.textContent = "Message must be larger than 10 characters.";
      } else {
        messageElement.nextElementSibling.style.display = "none";
      }
    }
  }

  if (count === 0) {
    submitContactForm();
  }
}

	function 	submitContactForm(){
		  const form = document.getElementById("contact-us");
   var   formData = new FormData(form);
const formDataObject = Object.fromEntries(formData.entries());

  // Send form data using Fetch API
  const headers = new Headers();
  headers.append("Content-Type", "application/json");
  fetch("'.$website_url.'", {
    method: "POST",
    headers: headers,
    body: JSON.stringify(formDataObject)
  })
    .then(response => {
      if (response.ok) {
        // Form submission successful
        document.querySelector(".success-msg").classList.remove("d-none");
        setTimeout(function () {
          document.querySelector(".success-msg").classList.add("d-none");
        }, 3000);

        // Reset form fields if needed
        form.reset();
      } else {
        document.querySelector(".failure-msg").classList.remove("d-none");
        setTimeout(function () {
          document.querySelector(".failure-msg").classList.add("d-none");
        }, 3000);

      }
    })
    .catch(error => {
      // Error occurred during form submission
      
    });
	}
</script>
';
if($display=='popup'){
	return'<style>div.outer-nav{z-index:0;}.popup-container {   overflow: auto; display: flex; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; visibility: hidden; opacity: 0; transition: visibility 0s, opacity 0.3s; } .popup-container.active { visibility: visible; opacity: 1; } .popup { background-color: white;  max-width: 600px; border-radius: 5px;margin-top:2em; } .popup-header {     border-top-left-radius: 5px;
    border-top-right-radius: 5px;background: #d3d3d3; padding: 23px;display: flex; justify-content: space-evenly;position: relative; align-items: center; margin-bottom: 10px; } .popup-content { padding:10px;}div.contact-us{width: 200px !important;}
.closeBtn{border-radius:20px;  background:#00f;color:#fff;border:none;  position: absolute;    top: 3px;
    right: 2px;}.popup-header>h2 {color:#000;text-transform: none;}
.popup{width:600px;'.$marginTop.'} 
	</style>
	<div class="text-center contact-us"><button type="button" onclick="open_pop_up()" type="button" class="contact-us submit-button">Contact Us</button></div>
	<div class="popup-container" id="popupContainer">
  <div class="popup">
    <div class="popup-header">
      <h2>Contact Us</h2>
      <button onclick="closePopup()" class="closeBtn">&times;</button>
    </div>
    <div class="popup-content">
      '.$form.'
    </div>
  </div>
</div><script>function open_pop_up() {
  const popupContainer = document.getElementById("popupContainer");
  popupContainer.classList.add("active");
}

function closePopup() {
  const popupContainer = document.getElementById("popupContainer");
  popupContainer.classList.remove("active");
}
</script>';
	//$result+='';
}
else{
	if($display=='slider'){
			return'<style>div.outer-nav{z-index:0;}#popupButton { width:150px !important;position: fixed; top: 66%; right: 0; transform: translateY(-50%); padding: 10px; background-color: #0f0; color: #fff; border: none; cursor: pointer; z-index: 9998; } #popup { padding-top: 17px;
    padding-bottom: 17px;position: fixed; top: 2em; right: -21em; width: 400px !important; height: fit-content;background-color: #fff; transition: right 0.3s ease-in-out; z-index: 9999; } #popup.active { right: 0;     } #closeButton { background-color: #00f;border-radius:20px; color: #fff; border: none; cursor: pointer; }#popup h2{color: #535353;text-transform: unset;}.text-right{text-align:right;}
	</style>
  <button id="popupButton" onclick="sliderFunc.call(this)">Contact Us</button>
  <div id="popup">
  <div style="display:flex;justify-content: space-between;"><h2>Contact Us</h2>
  <div class="text-right"><button id="closeButton" onclick="sliderClose.call(this)">&times;</button></div>
    
    </div><br>
  '.$form.'
  </div>
<script> function sliderFunc() {
  this.nextElementSibling.classList.add("active");
}
 function sliderClose() {
  this.parentElement.parentElement.parentElement.classList.remove("active");
}
</script>';
	}
}
return $form;
?>
<script type="text/javascript">

</script>
<!--     // Render the form HTML based on the chosen style and fields


    // Handle form submission and validation

    // Return the form HTML -->
