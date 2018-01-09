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

function savePick(year, game, pick) {
    var response = $.ajax({
        type: 'POST',
        async: false,
        url: 'dashboard.php',
        data: 'updatePick=set' +
            '&pick=' + pick +
            '&game=' + game +
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

