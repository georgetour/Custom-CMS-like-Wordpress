<!--WYSIWYG HTML Editor-->
tinymce.init({ selector:'textarea' });

$(document).ready(function(){

    //For the posts that will check or uncheck all
    $("#selectAllBoxes").click(function () {
        if(this.checked) {

            $(".checkBoxes").each(function () {
                this.checked = true;
            })

        }else{
            $(".checkBoxes").each(function () {
                this.checked = false;
            })
        }

    });



});
