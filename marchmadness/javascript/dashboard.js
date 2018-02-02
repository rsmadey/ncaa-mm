function openTab(evt, tabName) {
    var i, usertab, tablinks;
    usertab = document.getElementsByClassName("usertab");
    for (i = 0; i < usertab.length; i++) {
        usertab[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

function savePick(year, game, pick, round) {
    var response = $.ajax({
        type: 'POST',
        async: false,
        url: 'dashboard.php',
        data: 'updatePick=set' +
            '&pick=' + pick +
            '&game=' + game +
	    '&round=' + round +
            '&pick=' +  pick
    });
    var updateStatus = response['responseText'];
    return response['responseText'];
    if(updateStatus == 'success'){
        return 'success';
    }else{
        alert("didn't process");
    }
}

