function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

function saveGame(year, game, round, favorite, underdog, winner) {
    var response = $.ajax({
	type: 'POST',
	async: false,
	url: 'admin.php',
	data: 'updateGame=set' +
	    '&year=' + year +
	    '&game=' + game +
	    '&favorite=' + favorite +
	    '&round=' + round +
	    '&underdog=' + underdog +
	    '&winner=' +  winner
    });
    var updateStatus = response['responseText'];
    return response['responseText'];
    if(updateStatus == 'success'){
	return 'success';
    }else{
	alert("didn't process");
    }
}

function setWinner(game, winner, round) {
    var response = $.ajax({
	type: 'POST',
	async: false,
	url: 'admin.php',
	data: 'winner=' + winner +
	    '&game=' + game +
	    '&round=' + round +
	    '&setWinner=true'
    });
	return response.responseText;

}

function saveRound(round){

    var set;
    if(document.getElementById("round" + round + "start").checked){
        set = 1;
    }else{
        set = 0;
    }

    $.ajax({
	type: 'POST',
	async: true,
	url: 'admin.php',
	data: 'startRound=true' +
	    '&round=' + round +
	    '&startRound=' + set
    });
}
