var blacklist = ['AMERICAN','CANADIAN','NEW ZEALANDER','CHINESE','CUBAN','NORTH KOREAN','SERBIAN','TUNISIAN','SOMALI','ZIMBABWEAN','CONGOLESE','SOUTH SUDANESE','SUDANESE','TUNISIAN','TURKMEN','IRANIAN','IRAQI','LIBYAN','SYRIAN','ETHIOPIAN','YEMENI','SRI LANKAN','VENEZUELAN'];
var blacklisted = false;
for (var i = 0; i < blacklist.length; i++) { 
    /* console.log($("div:contains(" + blacklist[i] + ")")); */
    if($("div:contains(" + blacklist[i] + ")").length > 0){
        blacklisted = true;
    }
}
if(blacklisted){
    console.log("Blacklist!")
} else {
    console.log("Ok!")
}



blacklist.forEach((blacklist, index) => {
    $("div:contains(" + blacklist + ")");
  });


window.addEventListener('load', function() {
    var blacklist = ['AMERICAN','CANADIAN','NEW ZEALANDER','CHINESE','CUBAN','NORTH KOREAN','SERBIAN','TUNISIAN','SOMALI','ZIMBABWEAN','CONGOLESE','SOUTH SUDANESE','SUDANESE','TUNISIAN','TURKMEN','IRANIAN','IRAQI','LIBYAN','SYRIAN','ETHIOPIAN','YEMENI','SRI LANKAN','VENEZUELAN'];
var blacklisted = false;
for (var i = 0; i < blacklist.length; i++) { 
    /* console.log($("div:contains(" + blacklist[i] + ")")); */
    if($("div:contains(" + blacklist[i] + ")").length > 0){
        blacklisted = true;
    }
}
if(blacklisted){
    console.log("Blacklist!");
    alert("Blacklist!");
} else {
    console.log("Ok!");
}
}, false);
