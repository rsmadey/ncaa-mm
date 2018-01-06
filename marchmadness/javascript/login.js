/*$('.tab a').on('click', function (e) {

  e.preventDefault();

  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');

  target = $(this).attr('href');

  $('.tab-switch > div').not(target).hide();

  $(target).fadeIn(600);

});
*/

function login(){
    var user = document.forms["login"]["loginusername"].value;	
    var password = document.forms["login"]["loginpassword"].value;	
    response = $.ajax({
	type: 'POST',
	url: 'login.php',
	async: false,
	data: 'login=set&luser='+user+'&lpass='+password,
    });
    return response['responseText'];
};

function createUser(){
    var user = document.forms["createuser"]["username"].value;
    var firstName = document.forms['createuser']["firstname"].value;
    var lastName = document.forms["createuser"]["lastname"].value;
    var password1 = document.forms["createuser"]["password"].value;
    var password2 = document.forms["createuser"]["password2"].value;
    response = $.ajax({
        type: 'POST',
	url: 'login.php',
	async: false,
	data: 'createUser=set' +
	    '&first=' + firstName +
	    '&last=' + lastName +
	    '&user=' + user +
	    '&pass1=' + password1 +
	    '&pass2=' + password2,
    });
    return response['responseText'];
};
