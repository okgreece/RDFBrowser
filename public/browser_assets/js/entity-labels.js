
function labels(){
    var resources = $(".resource");
    var item = '';
    for (item in resources){
        $.ajax({
            type: "POST",
            url: 'getLabel',
            data: {uri : resources[item].href}
        })
        .done(function(data) {
             console.log(data);
        });
        //resources[item].innerText = "test Label";
    };    
};

