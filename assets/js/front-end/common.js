var isDevice = "";
var theMap = $('.map-canvas,#google-map');
var theHeight = $(window).height();
var theWidth = $(window).width();
var baseUrl = window.location.origin + '/mywebgini';
var baseUrlImg = baseUrl+'/assets/img/';
var cookiePath = 'mywebgini';
var activeSearchForm = 'simple_search_form';
var provider_list = provider_utilizer_list = validProviderIds = filterProviderClass = [];
var marker = '';

var landmark_marker_icon_2 = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/landmark-poiner.png";
var airport_marker_icon_2 = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/airport-pointer.png";
var landmark_marker_icon = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/landmark-pointer-y.png";
var airport_marker_icon = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/airport-pointer-y.png";
var provider_marker_blue_dot = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-blue-dot.svg";
var provider_marker_blue = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-blue.svg";
var provider_marker_gray = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-gray.svg";
var provider_marker_orange = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-orange.svg";
var provider_marker_red = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-red.svg";
var avail_marker = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-blue.svg";
var notavail_marker = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-gray.svg";
var notmatch_marker = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-orange.svg";
if (navigator.userAgent.match(/MSIE/) || navigator.userAgent.match(/Trident\/7.0/)) {
    center_marker = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/red-flag.png";
    provider_marker_blue_dot = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-blue-dot.png";
    provider_marker_blue = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-blue.png";
    provider_marker_gray = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-gray.png";
    provider_marker_orange = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-orange.png";
    provider_marker_red = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-red.png";
    avail_marker = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-blue.png";
    notavail_marker = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-gray.png";
    notmatch_marker = "https://www.reservationcounter.com/application/themes/twig_theme/default/images/map/hotel-marker-orange.png";
}


var theDevice = function (isDevice, theWidth) {
    if (theWidth >= 1040) {
        isDevice = "desktop";
    } else if (theWidth >= 768 && theWidth <= 1139) {
        isDevice = "tablet";
    } else {
        isDevice = "mobile";
    }
    return isDevice
}
isDevice = theDevice(isDevice, theWidth);

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/" + cookiePath;
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function redirectURL(n) {
    window.location.href = n;
}





var getSetChipData = function (chipsObj) {

    var data = $(chipsObj).material_chip('data');
    console.log('I am inside getSetChipData ', chipsObj);
    var str = '';
    //for (var i = 0; i < Object.size(data); i++) {
    for (var i = 0; i < Object.keys(data).length; i++) {
        if (i == 0) {
            str += data[i].tag;
        } else {
            str += "," + data[i].tag;
        }
    }
    setCookie('skills', str, 1);
    $("#skills").val(str);

};

function getParamFrmCookieGet(key) {
    var valueParam = getUrlParameter(key);
    return ((valueParam) ? valueParam : decodeURI(getCookie(key)));

}
function getParamFrmCookie(key) {
    return decodeURI(getCookie(key));

}
function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}
;

var initSkillAutoComplete = function () {
    $.ajax({
        type: 'POST',
        url: baseUrl + '/search/getSkills',
        success: function (response) {
            response = JSON.parse(response);
            var skillArray = response;
            var dataSkill = [{}];
            var dataMain = [{}];
            /*for (var i = 0; i < skillArray.length; i++) {
             dataSkill[skillArray[i].skill] = skillArray[i].flag; //skillArray[i].flag or null
             }*/
            response.forEach(function (element, index) {
                dataSkill[element.skill] = ''; //skillArray[i].flag or null

            });
            var preSelectSkill = getParamFrmCookieGet('skills');
            $('#skills').val(preSelectSkill);
            var options = {
                autocompleteOptions: {
                    data: dataSkill,
                    limit: Infinity,
                    minLength: 1
                }
            };
            //console.log(preSelectSkill);
            if (preSelectSkill) {
                var arrSkill = preSelectSkill.split(",");
                console.log(preSelectSkill);
                var finalObj = [];
                for (i = 0; i < arrSkill.length; i++) {
                    finalObj.push({'tag': arrSkill[i]});
                }
//            $('.search-chips').material_chip({
//                data: finalObj,
//            });
                options = {
                    data: finalObj,
                    autocompleteOptions: {
                        data: dataSkill,
                        limit: Infinity,
                        minLength: 1
                    }
                };
            }
            $('.chips-autocomplete').material_chip(options);
        }
    });
};
var getRedirectParam = function (key, val) {
    var n = "";
    n = baseUrl + "/search/";
    n += "?" + key + "=" + encodeURI(val);
    n += "&random=" + (100000 + Math.floor(Math.random() * 899999));
    redirectURL(n);


};
     var submit_search_header_form = function () {
        var skillsInp = getParamFrmCookie('skills');
        var n = "";
        n = baseUrl + "/search/";
        n += "?skills=" + encodeURI(skillsInp);
        /*n += "&country=" + encodeURI(countryInp);
         n += "&city=" + encodeURI(cityInp);
         n += "&state=" + encodeURI(stateInp);
         n += "&noofemp=" + encodeURI(noOfEmpInp);
         n += "&noofexp=" + encodeURI(noOfExpInp);*/
        n += "&random=" + (100000 + Math.floor(Math.random() * 899999));
        /* setCookie('skills', encodeURI($("#skills").val()), 1);
         setCookie('country', encodeURI(stateInp), 1);
         setCookie('city', encodeURI(cityInp), 1);
         setCookie('state', encodeURI(stateInp), 1);
         setCookie('noofemp', encodeURI(noOfEmpInp), 1);
         setCookie('noofexp', encodeURI(noOfExpInp), 1);*/
        redirectURL(n);
    };
    
    var callAfterSearchAjax = function(){
        $('.modal-trigger').leanModal();
    }