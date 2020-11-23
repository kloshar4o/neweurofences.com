function showFormErrors(form, errors) {

    const inputs = form.elements;

    for (let input_name in errors) {
        if (errors.hasOwnProperty(input_name)) {
            const input = inputs[input_name];
            const error = errors[input_name];
            const input_field = input.parentElement;
            const error_element = input_field.querySelector('.text-error');


            if (error_element)
                error_element.innerText = error;
            else {
                const span = document.createElement('span');
                span.classList.add('text-error');
                span.innerText = error;
                input_field.append(span);
            }

            input.classList.add('error-input');

        }
    }
}


function saveFormNew(e) {

    e.preventDefault();

    let form = e.target;

    let spinner = $("#loader-gif");

    let data = new FormData(form)

    spinner.fadeIn();

    $.ajax({
        method: "POST",
        url: form.action,
        data: data,
        contentType: false,
        processData: false,
    })
        .done(response => {

            const {status, messages, type} = response;

            if (status) {
                toastr.success(messages);
                form.reset();
                location.reload();
            } else {
                for (const messageIterator in response.messages) {
                    if (!response.messages.hasOwnProperty(messageIterator)) continue

                    if (type)
                        toastr[type](response.messages[messageIterator]);
                    else
                        toastr.error(response.messages[messageIterator]);
                }
            }
        })
        .fail(msg => {
            toastr.error('Status: ' + msg.status, 'Fail to send data');

            let errors = msg.responseJSON;
            if (!errors) return
            showFormErrors(form, errors)

        })
        .always(response => spinner.fadeOut());
}
