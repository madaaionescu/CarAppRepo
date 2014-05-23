/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function submitNewFeedback()
{
    var form = $('form[name="mada_bundle_carappbundle_feedback"]');
    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        dataType: "json",
    })
            .done(function(data, textStatus, jqXHR) {
                var form = $('form[name="mada_bundle_carappbundle_feedback"]');
                alert(data['msg']);
                updateFeedbackList();
                form.each(function(){this.reset(); });
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                var responseText = $.parseJSON(jqXHR.responseText);
                alert(responseText['msg']);
            });
}

function updateFeedbackList()
{
    $("#feedback_list").load("/app_dev.php/feedback/listRoute/2");
}

function clearForm(oForm) {
    var frm_elements = oForm.elements;
    console.log(frm_elements);
    for (i = 0; i < frm_elements.length; i++)
    {
        field_type = frm_elements[i].type.toLowerCase();

        switch (field_type)
        {
            case "text":
            case "password":
            case "textarea":

                frm_elements[i].value = "";
                break;
            case "radio":
            case "checkbox":
                if (frm_elements[i].checked)
                {
                    frm_elements[i].checked = false;
                }
                break;
            case "select-one":
                frm_elements[i].selectedIndex = 0;
                break;
            case "select-multiple":

                frm_elements[i].selectedIndex = 0;
                break;
            default:
                break;
        }

    }
}