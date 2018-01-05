

function determineLocation(){
	var input = document.forms["phraseForm"]["keyphrase"].value;
	if(input == 'mm2018'){
		return 'marchmadness/login.php';
	}
	return "index.html";
}
