var trips = [];
var compareTemp = false;

function compareTo(a, b) {
    // alert("I am here");
    var found = false;
    for (var i = 0; i < trips.length; i++) {
        /* alert("I am for loop");*/
        if (trips[i] == a) {
            /* alert("I am in if else");*/
            found = true;
            trips.splice(i, 1);
        }
    }
    if (found == false) {
        $(b).addClass('active');
        if (trips.length == 3) {
            compareTemp = true;
        } else {
            trips.push(a);
            var tripsno = trips.length;
            /* alert(tripsno);*/
            switch (tripsno) {
                case 1:
                    // alert("I am number 1");
                    $('#modal20').modal('show');
                    compareTemp = false;
                    break;
                case 2:
                    /* alert("I am in number 2");*/
                    compareTemp = false;
                    $("#modal2").modal('show');
                    break;
                case 3:
                    ViewComparison();
                    break;
                /* case 4:
                     $("#modal3").modal('open');
                     break;*/
            }
        }
    } else {
        $(b).removeClass('active');
    }
}

function ViewComparison() {
    var triplist = "";
    for (var i = 0; i < trips.length; i++) {
        triplist = triplist + trips[i] + ",";
    }
    if (triplist.length > 0) {
        triplist = triplist.substring(0, triplist.length - 1);

    }
    var compareurl = "/compare/" + triplist;
    for (var i = 0; i < trips.length; i++) {

    }
    window.open(compareurl, '_blank');
    trips.length = 0;
    trips.checked = false;
    var compareCheckbox = document.getElementsByClassName("compareCheckbox");

    for (i = 0; i < compareCheckbox.length; i++) {
        compareCheckbox[i].checked = false;
    }
    // location.reload();
}