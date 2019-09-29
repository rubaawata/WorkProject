
function twoPoint() {
    var point1X= document.getElementById('firstXPointCoordinator').innerHTML;
    var point1Y= document.getElementById('firstYPointCoordinator').innerHTML;
    var point2X= document.getElementById('secondXPointCoordinator').innerHTML;
    var point2Y= document.getElementById('secondYPointCoordinator').innerHTML;
    if(requiredValidation(point1X, point1Y, point2X, point2Y) == false)
        return;
    var URL = '/Two/' + point1X + '/' + point2X + '/' + point1Y + '/' + point2Y;
    $.ajax({
        type:'GET',
        url:URL,
        success:function(data) {
            document.getElementById('Two').style.color = 'black';
            $("#Two").html(data.msg + " m");
        }
    });
}

function onePoint() {
    var point1X= document.getElementById('firstXPointCoordinator').innerHTML;
    var point1Y= document.getElementById('firstYPointCoordinator').innerHTML;
    var point2X= document.getElementById('secondXPointCoordinator').innerHTML;
    var point2Y= document.getElementById('secondYPointCoordinator').innerHTML;
    if(requiredValidation(point1X, point1Y, point2X, point2Y) == false)
        return;
    var URL = '/one/' + point1X + '/' + point2X + '/' + point1Y + '/' + point2Y;
    $.ajax({
        type:'GET',
        url:URL,
        success:function(data) {
            document.getElementById('OneB').style.color = 'black';
            document.getElementById('OneA').style.color = 'black';
            $("#OneA").html(data.msg1 + " m");
            $("#OneB").html(data.msg2 + " m");
        }
    });
}

function requiredValidation(...args) {
    for(i = 0; i < args.length; i++) {
        if(args[i] == "xx.xxxx" || args[i] == "yy.yyyy")
        {
            document.getElementById('validation_alert').style.display = 'block';
            return false;
        }
    }
    document.getElementById('validation_alert').style.display = 'none';
    return true;
}