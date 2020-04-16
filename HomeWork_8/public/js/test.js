function addGoodInBasket (id) {
    jQery.ajax({
        url: `?p=basket&a=ajaxAdd&id={id}`,
        type: 'get',
        success: function (responce) {
            jQery('#basket').html(responce.count);  
            
        }
    });
}