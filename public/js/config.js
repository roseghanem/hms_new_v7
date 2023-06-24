var BaseUrl  ;
function initBaseUrl( url ) {
    BaseUrl = url ; 
}


function initSelect2( select ,  url ) {
    console.log("url",BaseUrl + url);
    $(select).select2({
        ajax: {
            type    : "GET",
            dataType: 'json',
            url     : BaseUrl + url,
    
            data: function(params) {
                return {
                    term: params.term ,
                    page: params.page || 1
                }
            },
            cache: true
        }
    });
}
 
 


