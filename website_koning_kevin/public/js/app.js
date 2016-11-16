window.onload = function(){
    var inputs= document.getElementsByTagName('input');
    for(var i =0; i<inputs.length;i++){
        add_astriks(inputs[i]);
    }
    function add_astriks(element) {
        if(element.hasAttribute("required")){
            var name_attribute = element.getAttribute('name');
            var label = document.querySelector('label[for="'+name_attribute+'"]');
            if(label)
            label.innerHTML= label.innerHTML+'*';
            console.log(label);
        }
    }
}