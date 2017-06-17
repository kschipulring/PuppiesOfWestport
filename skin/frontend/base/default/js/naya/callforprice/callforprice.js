var callforprice = {
    removeButton : function() {
        document.observe("dom:loaded", function() {
            $$('button').each(function(buttonObject) {
                var removeCart = buttonObject.readAttribute('onclick');
                if(removeCart !== null){
                    if (removeCart.indexOf("remove-add-to-cart") > -1){
                        buttonObject.remove();
                    }
                }
            });
            $$('span.remove-unavailable-tag').each(function(removeTag) {
                var removeTagElement = removeTag.next('p.out-of-stock');
                if(removeTagElement !== null && removeTagElement !== undefined){
                    removeTagElement.remove();
                }
                removeTag.remove();
            });
        });
    }
};

callforprice.removeButton();


